<?php

$page_name = "Graph"; // title and <h1>

require '../../includes/all.php';
require $includes . 'db_connect.php';

if (!isset($_GET['id']))
{
    $output = 'Integer id must be present in url.';
    include $includes . 'error.html.php';
    exit();
}

$id = $_GET['id'];
//validate as integer
if (!is_numeric($id))
{
    $output = 'Id must be numeric.';
    include $includes . 'error.html.php';
    exit();
}

$query = 'SELECT graphs.id AS id,
            ics3_glyph AS ics3,
            ics4_glyph AS ics4,
            hd_glyph AS hd,
            gulin AS gulin,
            count(inscr_graphs.graph_id) AS count
          FROM graphs
          LEFT JOIN inscr_graphs
          ON graphs.id = inscr_graphs.graph_id ' .
          "WHERE graphs.id = $id " .
          'GROUP BY graphs.id;' ; 

$result = mysqli_query($link, $query);
if (!$result)
{
    $output = "Error fetching graph with id=$id: " . mysqli_error($link);
    include $includes . 'error.html.php';
    exit();
}

$row = mysqli_fetch_array($result);
$ics3 = $row['ics3']; 
$ics4 = $row['ics4'];
$hd = $row['hd'];
$gulin = $row['gulin'];
$count = $row['count'];

//include page with html
require 'graph.html.php';

?>
