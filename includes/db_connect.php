<?php

// includes/all.php must have already have been included
// by the file that includes this one.
// That will set $config_path and $includes

// All php files that access MySQL need to get credentials from
// mysql.php found with $config_path variable.
// Place outside web root online for security

include $config_path;

$link = mysqli_connect($db_host, $db_user, $db_pw);
if (!$link)
{
    $output = 'Unable to connect to MySQL.';
    include $includes . 'error.html.php';
    exit();
}

if (!mysqli_set_charset($link, 'utf8'))
{
    $output = 'Unable to set connection encoding.';
    include $includes . 'error.html.php';
    exit();
}

if (!mysqli_select_db($link, $db_prefix . "ecdb"))
{
    $output = 'Unable to locate the ecdb database.';
    include $includes . 'error.html.php';
    exit();
}

?>
