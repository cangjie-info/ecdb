<?php

$page_name = "Concordance"; // title and <h1>

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


$query = 'SELECT inscrs.id AS inscr, 
                 inscr_surf_id, 
                 graph_id, 
                 ics3_glyph
        FROM inscrs
        INNER JOIN inscr_graphs
        ON inscrs.id = inscr_graphs.inscr_id
        INNER JOIN graphs
        ON inscr_graphs.graph_id = graphs.id
        WHERE inscrs.id in 
            (SELECT inscr_id 
             FROM inscr_graphs ' .
            "WHERE graph_id = $id)" .
        'ORDER BY 
            inscr_surf_id, 
            inscrs.number, 
            inscr_graphs.number;';

$result = mysqli_query($link, $query);
if (!$result)
{
    $output = 'Error fetching XYZ: ' . mysqli_error($link);
    include $includes . 'error.html.php';
    exit();
}
while ($row = mysqli_fetch_array($result))
{
    $inscr[] = $row['inscr'];
    $surf[] = $row['inscr_surf_id'];
    $graph_id[] = $row['graph_id'];
    $ics3[] = $row['ics3_glyph'];
}

//include page with html
require 'concord.html.php';

?>
