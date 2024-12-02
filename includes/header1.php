<?php
session_start();

// Improve session security
ini_set('session.cookie_httponly', 1); // Prevent JavaScript access to session cookies
ini_set('session.cookie_secure', 1);   // Use cookies only over HTTPS
ini_set('session.use_strict_mode', 1); // Prevent session fixation attacks

// Force HTTPS if not already using it
if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== 'on') {
    header("Location: https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    exit();
}

// Validate a URL to ensure it matches your domain
function isValidUrl($url) {
    return preg_match('/^https?:\/\/(www\.)?goodlandv2\.com/', $url);
}

// Example usage of the function
$link = "https://goodlandv2.com";
if (!isValidUrl($link)) {
    echo "Invalid URL.";
    exit();
}

// Prevent direct access to the header.php file
if (basename($_SERVER['PHP_SELF']) === 'header.php') {
    header("HTTP/1.1 403 Forbidden");
    exit("Access denied.");
}

// Add security headers
header("Content-Security-Policy: default-src 'self'; script-src 'self' https://goodlandv2.com;");
header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: SAMEORIGIN");
header("X-XSS-Protection: 1; mode=block");
header("Referrer-Policy: strict-origin-when-cross-origin");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");
header("Permissions-Policy: geolocation=()");

// Sanitize all GET, POST, and COOKIE inputs
foreach ($_GET as $key => $value) {
    $_GET[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
foreach ($_POST as $key => $value) {
    $_POST[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
foreach ($_COOKIE as $key => $value) {
    $_COOKIE[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

// Output Content-Type as UTF-8 for proper encoding
header('Content-Type: text/html; charset=utf-8');

?>
