<?php
if (!defined('DEBUG')) {
    define('DEBUG', false);
}
if (!defined('LOCAL')) {
    define('LOCAL', FALSE);
}

// Configuration par défaut : dev-isi (non local)
$dsn = 'mysql:dbname=royer__m;host=localhost;charset=utf8';
$username = 'royer__m';
$password = 'hrWSHuUq';

if (LOCAL) {
    // Configuration locale (localhost)
    $dsn = 'mysql:dbname=CAVE;host=localhost;charset=utf8';
    $username = 'root';
    $password = 'root';
}

// DEBUG
if (DEBUG) {
    echo "<ul>";
    echo "<li>dsn = $dsn</li>";
    echo "<li>username = $username</li>";
    echo "<li>password = $password</li>";
    echo "<li>---</li>";
    echo "<li>root = $root</li>";
    echo "</ul>";
}

?>
