<?php

$page_name = "CZCN"; // title and <h1>

require '../../includes/all.php';
require $includes . 'db_connect.php';

$query = 'select inscr_surfs.name AS name, 
    inscrs.number AS inscr_number,
    inscr_graphs.markup AS markup,
    inscr_graphs.punc AS punc,
    graphs.ics3_glyph AS ics3,
    matt_glyph,
    matt_cp
from inscr_surfs
inner join inscrs on inscr_surfs.id = inscr_surf_id
inner join inscr_graphs on inscr_id = inscrs.id
inner join graphs on graph_id = graphs.id
where inscr_surfs.pub_id = 113
order by cast(inscr_surfs.name as unsigned), inscr_number, inscr_graphs.number;';    

$result = mysqli_query($link, $query);
if (!$result)
{
    $output = 'Error fetching CZCN inscrptions: ' . mysqli_error($link);
    include $includes . 'error.html.php';
    exit();
}

while ($row = mysqli_fetch_array($result))
{
    $data[] = $row;
}

foreach($data as $datum) //first pass to get surface names
{
    $surfaces[$datum['name']] = array();
}

foreach($data as $datum) //second pass to get inscriptions
{
    $surfaces[$datum['name']][$datum['inscr_number']] = array();
}

foreach($data as $datum) //3rd pass to get graphs
{
    $surfaces[$datum['name']][$datum['inscr_number']][] = array(
        'markup' => $datum['markup'],
        'punc' => $datum['punc'],
        'ics3' => $datum['ics3'],
        'matt_glyph' => $datum['matt_glyph'],
        'matt_cp' => $datum['matt_cp'] );
}

require 'czcn.html.php';

?>
