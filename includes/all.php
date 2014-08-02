<?php

// ALL (!) ECDB php files must include this file.
// Use a relative path, since that is the same locally and 
// remotely.

error_reporting(E_ALL);
ini_set( 'display_errors','1');

//code to guess whether we are remote or local
//and set paths accordingly
if($_SERVER['DOCUMENT_ROOT']=='/var/www/html') //if local linux
{
    $home_path = '/ecdb';
    $config_path = '/var/www/html/mysql.php';
    $repo_path = '/ecdb/repository/';
    $includes = '/var/www/html/ecdb/includes/';
}
else if ($_SERVER['DOCUMENT_ROOT']=='C:/wamp/www/') //if local windows
{
	$home_path = '/ecdb';
	$config_path = '/wamp/www/mysql.php';
	$repo_path = '/ecdb/repository/';
	$includes = '/wamp/www/ecdb/includes/';
}
else //if remote
{
    $home_path = '/ecdb';
    $config_path = '/home1/adamsmit/mysql.php';
    $repo_path = '/ecdb/repository/';
    $includes = '/home1/adamsmit/public_html/ecdb/includes/';
}
?>
