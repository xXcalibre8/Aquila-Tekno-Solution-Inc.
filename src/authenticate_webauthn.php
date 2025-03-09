<?php
require '../vendor/autoload.php';
use lbuchs\WebAuthn\{WebAuthn, WebAuthnException};

session_start();
include("config.php");

function getStoredCredential($con, $userId) {
    $stmt = $con->prepare("SELECT public_key, sign_count FROM webauthn_credentials WHERE user_id = ?");
    $stmt->bind_param("s", $userId);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function updateSignCount($con, $userId, $newCount) {
    $stmt = $con->prepare("UPDATE webauthn_credentials SET sign_count = ? WHERE user_id = ?");
    $stmt->bind_param("ss", $newCount, $userId);
    return $stmt->execute();
}

try {
    if (!isset($_SESSION['userId'])) {
        throw new WebAuthnException('User not authenticated');
    }

    $webAuthn = new WebAuthn(
        "AQUILA CORPS", 
        'http://localhost:90/webauth/src'
    );
    
    $data = json_decode(file_get_contents('php://input'), true);
    if (!$data) {
        throw new WebAuthnException('Invalid request data');
    }

    $credential = getStoredCredential($con, $_SESSION['userId']);
    if (!$credential) {
        throw new WebAuthnException('No credentials found');
    }

    // Verify the assertion
    $webAuthn->processGet(
        base64_decode($data['response']['clientDataJSON']),
        base64_decode($data['response']['authenticatorData']),
        base64_decode($data['response']['signature']),
        $challenge,
        $credential['public_key'],
        $credential['sign_count']
    );

    // Update sign count
    if (!updateSignCount($con, $_SESSION['userId'], $webAuthn->getSignatureCounter())) {
        throw new WebAuthnException('Failed to update signature count');
    }

    echo json_encode(['status' => 'ok']);

} catch (WebAuthnException $e) {
    http_response_code(400);
    echo json_encode([
        'status' => 'error', 
        'message' => $e->getMessage()
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Internal server error'
    ]);
}
?>
