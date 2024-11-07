<?php
// Key and initialization vector for encryption - store securely and avoid hardcoding in real-world apps
define('ENCRYPTION_KEY', 'your-256-bit-secret-key');
define('ENCRYPTION_IV', 'your-16-character-iv'); // Must be 16 characters for AES-256-CBC

function encrypt($data) {
    $encrypted = openssl_encrypt($data, 'AES-256-CBC', ENCRYPTION_KEY, 0, ENCRYPTION_IV);
    return base64_encode($encrypted); // Encode to make it URL-safe
}

function decrypt($data) {
    $decrypted = openssl_decrypt(base64_decode($data), 'AES-256-CBC', ENCRYPTION_KEY, 0, ENCRYPTION_IV);
    return $decrypted;
}

?>