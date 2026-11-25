<?php
if (function_exists('mysqli_report') && defined('MYSQLI_REPORT_OFF')) {
    mysqli_report(MYSQLI_REPORT_OFF);
}

$db_host = getenv('DB_HOST') ? getenv('DB_HOST') : 'localhost';
$db_user = getenv('DB_USER') ? getenv('DB_USER') : 'root';
$db_pass = getenv('DB_PASS') !== false ? getenv('DB_PASS') : '';
$db_name = getenv('DB_NAME') ? getenv('DB_NAME') : 'course_portal';

$connect = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$connect) {
    die("Could not connect to database: " . htmlspecialchars(mysqli_connect_error(), ENT_QUOTES, 'UTF-8'));
}
if (!@mysqli_set_charset($connect, 'utf8mb4')) {
    mysqli_set_charset($connect, 'utf8');
}

function db_escape($value)
{
    global $connect;
    return mysqli_real_escape_string($connect, (string)$value);
}

function db_query($sql)
{
    global $connect;
    return mysqli_query($connect, $sql);
}

function db_fetch_array($result)
{
    if (!$result) {
        return null;
    }
    return mysqli_fetch_array($result, MYSQLI_ASSOC);
}

function db_num_rows($result)
{
    if (!$result) {
        return 0;
    }
    return mysqli_num_rows($result);
}

function h($value)
{
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}
?>
