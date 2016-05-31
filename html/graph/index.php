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
            ICS3,
            ICS4,
            HuaDong AS hd,
            gulin AS gulin,
            count(inscr_graphs.graph_id) AS count,
            CONCAT(shen2008_number, shen2008_var) AS shen2008,
            page_image
          FROM graphs
          INNER JOIN ref_shen2008 
            ON graphs.id = ref_shen2008.graph_id
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
$ics3 = $row['ICS3']; 
$ics4 = $row['ICS4'];
$hd = $row['hd'];
$gulin = $row['gulin'];
$count = $row['count'];
$shen2008 = $row['shen2008'];
$page_file = $row['page_image'];
$img_path = $repo_path . 'sign_list_imgs/sc/' . $page_file;
//include page with html
require 'graph.html.php';

?>
