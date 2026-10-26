<?php
$server_name = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : 'localhost';
$nodeSegment = explode('.', $server_name);
$sub = $nodeSegment[0];
$is_local = (
    $server_name === 'localhost' ||
    $server_name === '127.0.0.1' ||
    substr($server_name, -10) === '.localhost' ||
    substr($server_name, -6) === '.local'
);

if ($is_local) {
    $node = ($sub === 'localhost' || $sub === '127' || $sub === 'msbbiling') ? 'node' : $sub;
    if (!defined('DB_SERVER')) define('DB_SERVER', 'localhost');
    if (!defined('DB_USER')) define('DB_USER', 'root');
    if (!defined('DB_PASSWORD')) define('DB_PASSWORD', '');
    if (!defined('DB_NAME')) define('DB_NAME', $node);
} else {
    $node = 'u404684354_' . $sub;
    if (!defined('DB_SERVER')) define('DB_SERVER', 'localhost');
    if (!defined('DB_USER')) define('DB_USER', $node);
    if (!defined('DB_PASSWORD')) define('DB_PASSWORD', 'BR66MK55@msb');
    if (!defined('DB_NAME')) define('DB_NAME', $node);
}
