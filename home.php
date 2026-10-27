<?php
/**
 * MsbBillings Frontend Home Page Router
 * Routes to Main Corporate Landing or Dynamic Subdomain Tenant Portal
 */
$server_name = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : 'localhost';
$subdomain = explode('.', $server_name)[0];

$is_subdomain = false;
$node_target = '';

if (isset($_GET['node']) && !empty($_GET['node'])) {
    $is_subdomain = true;
    $node_target = trim($_GET['node']);
} elseif ($server_name !== 'localhost' && $server_name !== '127.0.0.1' && $server_name !== 'msbbiling.in' && $server_name !== 'www.msbbiling.in' && $server_name !== 'msbbillings.in' && $server_name !== 'www.msbbillings.in') {
    if ($subdomain !== 'localhost' && $subdomain !== 'www' && $subdomain !== 'msbbiling' && $subdomain !== 'msbbillings') {
        $is_subdomain = true;
        $node_target = $subdomain;
    }
}

if ($is_subdomain) {
    // Route to index.php with active node
    $query_str = !empty($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : ($node_target ? '?node=' . $node_target : '');
    header("Location: index.php" . $query_str);
    exit;
}

if (file_exists(__DIR__ . '/fastapp/views/index_tpl.php')) {
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
