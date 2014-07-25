<?php

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

$query = 'SELECT inscr_surfs.name as surf, 
            inscrs.number as inscr, 
            ics3_glyph as ics3
FROM inscr_surfs
INNER join inscrs
ON inscr_surf_id=inscr_surfs.id
INNER JOIN inscr_graphs
ON inscr_id=inscrs.id
INNER JOIN graphs
ON graph_id=graphs.id ' .
"WHERE inscr_surfs.id=$id " .
'ORDER BY inscr, inscr_graphs.number;';

$result = mysqli_query($link, $query);
if (!$result)
{
    $output = 'Error fetching Shen & Cao (2008): ' . mysqli_error($link);
    include $includes . 'error.html.php';
    exit();
}

$row = mysqli_fetch_array($result);
$surf = $row['surf'];
$inscr[] = $row['inscr'];
$ics3[] = $row['ics3'];

while ($row = mysqli_fetch_array($result))
{
    $inscr[] = $row['inscr'];
    $ics3[] = $row['ics3'];
}

require 'surf.html.php';

?>
