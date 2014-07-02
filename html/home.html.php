<!DOCTYPE html>
<html>
    <head>
    <meta charset='UTF-8' />
    <title>ECDB - HOME</title>
</head>
<body>
<h1>Early Chinese Database - Home</h1>
<p>
<?php

//comment out error reporting before pushing online
error_reporting(E_ALL);
ini_set( 'display_errors','1');

echo 'Succesfully connected to MySQL ECDB. PHP working.\n';
print_r($_SERVER);
?>
</p>

</body>
</html>
