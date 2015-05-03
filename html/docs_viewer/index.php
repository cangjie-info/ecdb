<?php

$page_name = "Viewer documentation"; // title and <h1>

//paths and other config
require '../../includes/all.php';

//connect to db
//all pages needing db connection need this
require $includes . 'db_connect.php';

// MYSQL QUERY CODE SKETCH
/*
$query = 'SELECT etc. etc.';

$result = mysqli_query($link, $query);
if (!$result)
{
    $output = 'Error fetching XYZ: ' . mysqli_error($link);
    include $includes . 'error.html.php';
    exit();
}

while ($row = mysqli_fetch_array($result))
{
    //code to process rows of result table goes here
}
*/

//include page with html
require 'docs_viewer.html.php';

?>
