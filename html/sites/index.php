<?php
$page_name = "Sites";
require '../../includes/all.php';
require $includes . 'db_connect.php';

$query = 'SELECT arch_sites.id as id,
    arch_sites.name as site_name, 
    arch_sites.name_zh as site_name_zh, 
    arch_sites.address_zh as address, 
    arch_sites.description as site_desc, 
    arch_localities.id as loc_id,
    arch_localities.name as loc_name, 
    arch_localities.name_zh as loc_name_zh, 
    arch_localities.description as description
FROM arch_sites
    INNER JOIN arch_localities 
    ON arch_sites.id = site_id
ORDER BY arch_sites.name, arch_localities.name';

$result = mysqli_query($link, $query);
if (!$result)
{
    $output = 'Error fetching XYZ: ' . mysqli_error($link);
    include $includes . 'error.html.php';
    exit();
}

while ($row = mysqli_fetch_array($result))
{
    $data[] = $row;
}

foreach($data as $datum)
{
    $sites[$datum['id']] = array('name' => $datum['site_name'],
        'name_zh' => $datum['site_name_zh'],
        'address' => $datum['address'],
        'desc' => $datum['site_desc'],
        'localities' => array());
}

foreach($data as $datum)
{
    $sites[$datum['id']]['localities'][] = array(
        'id' => $datum['loc_id'],
        'name' => $datum['loc_name'],
        'name_zh' => $datum['loc_name_zh'],
        'desc' => $datum['description'] );
}

require 'sites.html.php';

?>
