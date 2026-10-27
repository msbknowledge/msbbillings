<?php
/**
 * MsbBillings Frontend Home Page
 * Upgraded to Smart School UI
 */
if (file_exists(__DIR__ . '/fastapp/views/index_tpl.php')) {
    // If running in CI context or standalone
    if (!function_exists('base_url')) {
        function base_url($path = '') {
            $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443)) ? "https://" : "http://";
            $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
            $script = isset($_SERVER['SCRIPT_NAME']) ? str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']) : '/';
            return rtrim($protocol . $host . $script, '/') . '/' . ltrim($path, '/');
        }
    }
    if (!function_exists('console_url')) {
        function console_url($path = '') {
            return base_url('console/' . ltrim($path, '/'));
        }
    }
    include __DIR__ . '/fastapp/views/index_tpl.php';
}
?>
