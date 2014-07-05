<?php

// ALL (!) ECDB php files must include this file.
// Use a relative path, since that is the same locally and 
// remotely.

error_reporting(E_ALL);
ini_set( 'display_errors','1');

//code to guess whether we are remote or local
//and set paths accordingly
if($_SERVER['DOCUMENT_ROOT']=='/var/www/html') //if local
{
    $config_path = '/var/www/html/mysql.php';
    $repo_path = '/home/ads/ecdb/repository/';
    $includes = '/var/www/html/ecdb/includes/';
}
else //if remote
{
    $config_path = '/home1/adamsmit/mysql.php';
    $repo_path = '/home1/adamsmit/public_html/ecdb/repository/';
    $includes = '/home1/adamsmit/public_html/ecdb/includes/';
}
?>
