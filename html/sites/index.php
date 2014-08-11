<?php
$page_name = "Sites";
require '../../includes/all.php';
require $includes . 'db_connect.php';

$query = 'SELECT arch_sites.id as id,
    arch_sites.name as site_name, 
    arch_sites.name_zh as site_name_zh, 
    arch_sites.address_zh as address, 
    arch_sites.description as site_desc, 
    arch_localities.name as loc_name, 
    arch_localities.name_zh as loc_name_zh, 
    arch_localities.notes as notes
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
    $sites[$row['id']] = array('name' => $row['site_name'],
        'name_zh' => $row['site_name_zh'],
        'address' => $row['address'],
        'desc' => $row['site_desc']);
}

require 'sites.html.php';

?>
