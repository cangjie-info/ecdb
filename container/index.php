<?php

//paths and other config
require '../includes/all.php';

if(!isset($_GET['id'])) {
   $output = "id not set.";
   require $includes . 'error.html.php';
   exit();
}

$container_id = $_GET['id'];
if(!is_numeric($container_id)) {
   $output = "id is not numeric";
   require $includes . 'error.html.php';
   exit();
}

//connect to db
//all pages needing db connection need this
require $includes . 'mysql_connect.php';

$query = "SELECT name_zh, name_en, descr
   FROM containers
   WHERE id=$container_id;";

$result = mysqli_query($link, $query);
if (!$result)
{
    $output = 'Error fetching container: ' . mysqli_error($link);
    include $includes . 'error.html.php';
    exit();
}

$row = mysqli_fetch_array($result);
$name_zh = $row['name_zh'];
$name_en = $row['name_en'];
$descr = $row['descr'];

$page_name = "Container : $name_zh $name_en"; // title and <h1>

$query = "SELECT subcontainers.name_zh AS name_zh,
   subcontainers.name_en AS name_en, 
   subcontainers.id AS id
   FROM subcontainers
   WHERE container_id = $container_id;";

$result = mysqli_query($link, $query);

if (!$result)
{
    $output = 'Error fetching subcontainers: ' . mysqli_error($link);
    include $includes . 'error.html.php';
    exit();
}

while ($row = mysqli_fetch_array($result)) {
   $sc_id[] = $row['id'];
   $sc_name_zh[] = $row['name_zh'];
   $sc_name_en[] = $row['name_en'];
}

$sc_count = count($sc_id);

//include page with html
require 'container.html.php';

?>
