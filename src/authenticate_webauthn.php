<?php
require '../vendor/autoload.php';
use lbuchs\WebAuthn\WebAuthn;
use lbuchs\WebAuthn\WebAuthnException;

include("config.php");
session_start();

try {
    $webAuthn = new WebAuthn("AQUILA CORPS", 'http://localhost:90/webauth/src');
    $data = json_decode(file_get_contents('php://input'), true);

    // Fetch the stored credential from the database
    // Example:
    $stmt = $con->prepare("SELECT * FROM webauthn_credentials WHERE user_id = ?");
    $stmt->bind_param("s", $_SESSION['userId']);
    $stmt->execute();
    $result = $stmt->get_result();
    $credential = $result->fetch_assoc();

    $publicKey = $credential['public_key'];
    $signCount = $credential['sign_count'];

    // Verify the assertion
    $webAuthn->processGet(
        base64_decode($data['response']['clientDataJSON']),
        base64_decode($data['response']['authenticatorData']),
        base64_decode($data['response']['signature']),
        $challenge,
        $publicKey,
        $signCount
    );

    // Update sign count in the database
    $newSignCount = $webAuthn->getSignatureCounter();
    $stmt = $con->prepare("UPDATE webauthn_credentials SET sign_count = ? WHERE user_id = ?");
    $stmt->bind_param("ss", $newSignCount, $_SESSION['userId']);
    $stmt->execute();

    echo json_encode(['status' => 'ok']);
} catch (WebAuthnException $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
