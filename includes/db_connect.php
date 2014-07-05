<?php

//all php files that access MySQL need to get credentials from
//mysql.php
//place outside web root online for security
//code to guess whether we are remote or local
if($_SERVER['DOCUMENT_ROOT']=='/var/www/html') //if local
{
    $config_path = '/var/www/html/mysql.php';
}
else //if remote
{
    $config_path = '/home1/adamsmit/mysql.php';
}

include $config_path;

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

?>
