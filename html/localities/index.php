<?php

$page_name = "Localities"; 

require '../../includes/all.php';
require $includes . 'db_connect.php';

if (!isset($_GET['id']))
{
    $output = 'Integer id must be present in url.';
    include $includes . 'error.html.php';
    exit();
}

$id = $_GET['id'];
if (!is_numeric($id))
{
    $output = 'Id must be numeric.';
    include $includes . 'error.html.php';
    exit();
}

$query = 'SELECT 
            arch_localities.name AS name, 
            arch_localities.name_zh AS name_zh,
            arch_excavations.id AS id,
            arch_excavations.year AS year,
            arch_contexts.id AS context_id,
            arch_contexts.name AS context
    FROM arch_localities
    INNER JOIN arch_excavations ON locality_id = arch_localities.id
    INNER JOIN arch_contexts ON arch_excavation_id = arch_excavations.id ' .
    "WHERE arch_localities.id = $id " .
    'ORDER BY year, arch_contexts.name;';

$result = mysqli_query($link, $query);
if (!$result)
{
    $output = 'Error fetching localities data: ' . mysqli_error($link);
    include $includes . 'error.html.php';
    exit();
}

while ($row = mysqli_fetch_array($result))
{
    $data[] = $row;
}

foreach($data as $datum) // each row is a context, but get years, discarding duplicates
{
    $excavations[$datum['id']] = array(
        'locality' => $datum['name'] . ' ' . $datum['name_zh'],
        'year' => $datum['year'],
        'contexts' => array());
}
foreach($data as $datum) //second pass for the contexts
{
    $excavations[$datum['id']]['contexts'][] = array(
        'id' => $datum['context_id'],
        'name' => $datum['context'] );
}
$page_name .= ': ' . reset($excavations)['locality']; 
require 'localities.html.php';

?>
