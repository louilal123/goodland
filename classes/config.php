<?php
function encryptor($action, $string) {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    
    $secret_key = 'louiegwapogihahhahha';
    $secret_iv = 'iloveyouteresa';

    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    if ($action == 'encrypt') {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } elseif ($action == 'decrypt') {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}
?>
