<?php
//comment out error reporting before pushing online
error_reporting(E_ALL);
ini_set( 'display_errors','1');

//all php files that access MySQL need to get credentials from
//mysql.php
//place at root so that it can be the same locally and remotely.
//needs testing on server
include '/mysql.php';

$link = mysqli_connect($db_host, $db_user, $db_pw);
if (!$link)
{
    $output = 'Unable to connect to MySQL.';
    include 'error.html.php';
    exit();
}

if (!mysqli_set_charset($link, 'utf8'))
{
    $output = 'Unable to set connection encoding.';
    include 'error.html.php';
    exit();
}

if (!mysqli_select_db($link, $db_prefix . "ecdb"))
{
    $output = 'Unable to locate the ecdb database.';
    include 'error.html.php';
    exit();
}

include 'home.html.php';

?>
