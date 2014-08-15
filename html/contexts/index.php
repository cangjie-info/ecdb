<?php
$page_name = "Context: ";

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

$query = 'SELECT arch_contexts.name AS context, 
            arch_objects.name AS object, 
            inscr_surfs.name AS surf, 
            pubs.name AS pub,
            inscr_surfs.id AS surf_id
    FROM arch_contexts
    INNER JOIN arch_objects ON arch_contexts.id = context_id
    INNER JOIN inscr_surfs ON arch_objects.inscr_object_id = inscr_surfs.inscr_object_id
    INNER JOIN pubs ON pub_id = pubs.id ' .
    "WHERE arch_contexts.id = $id " .
    'ORDER BY pubs.id, cast( inscr_surfs.name AS unsigned );';

$result = mysqli_query($link, $query);
if (!$result)
{
    $output = 'Error fetching XYZ: ' . mysqli_error($link);
    include $includes . 'error.html.php';
    exit();
}

while ($row = mysqli_fetch_array($result))
{
    $objects[] = $row;
}

$context = $objects[0]['context'];
$page_name .= " $context";

require 'contexts.html.php';

?>
