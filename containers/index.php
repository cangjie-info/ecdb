<?php

$page_name = "Containers"; // title and <h1>

//paths and other config
require '../includes/all.php';

//connect to db
//all pages needing db connection need this
require $includes . 'mysql_connect.php';

$query = 'SELECT id, name_zh, name_en, descr
   FROM containers
   ORDER BY name_en;'; 

$result = mysqli_query($link, $query);
if (!$result)
{
    $output = 'Error fetching XYZ: ' . mysqli_error($link);
    include $includes . 'error.html.php';
    exit();
}

while ($row = mysqli_fetch_array($result))
{
   $id[] = $row['id'];
   $name_zh[] = $row['name_zh'];
   $name_en[] = $row['name_en'];
   $descr[] = $row['descr'];
}

$containers_count = count($id);

//include page with html
require 'containers.html.php';

?>
