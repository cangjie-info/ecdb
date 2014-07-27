<?php
$page_name = "Graphs"; 

//paths and other config
require '../../includes/all.php';

//connect to db
require $includes . 'db_connect.php';

$query = 'SELECT COUNT(*) AS count FROM graphs;';
$result = mysqli_query($link, $query);
if (!$result)
{
    $output = 'Error fetching graphs list: ' . mysqli_error($link);
    include $includes . 'error.html.php';
    exit();
}
$row = mysqli_fetch_array($result);
$graph_count = $row['count'];

$query = 'SELECT graphs.id AS id, 
            ics3_glyph AS ics3, 
            count( inscr_graphs.graph_id ) AS count
        FROM graphs
        LEFT JOIN inscr_graphs 
        ON graphs.id = inscr_graphs.graph_id
        GROUP BY graphs.id
        ORDER BY count DESC, gulin ASC';


$result = mysqli_query($link, $query);
if (!$result)
{
    $output = 'Error fetching graphs list: ' . mysqli_error($link);
    include $includes . 'error.html.php';
    exit();
}

$running_total = 0;
while ($row = mysqli_fetch_array($result))
{
    $id[] = $row['id'];
    $ics3[] = $row['ics3'];
    $count[] = $row['count'];
    $running_total += $row['count'];
    $cum[]  = $running_total;
}

//include page with html
require 'graphs.html.php';
?>
