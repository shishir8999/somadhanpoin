<?php
/**
 * Root fallback entry point for shared hosting (Webuzo/cPanel)
 * Forwards requests directly to the public directory.
 */
$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH)
);

// If the requested file exists inside public/, serve it directly or forward
if ($uri !== '/' && file_exists(__DIR__ . '/public' . $uri)) {
    return false;
}

require_once __DIR__ . '/public/index.php';
