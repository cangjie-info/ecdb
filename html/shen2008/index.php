<?php
$page_name = 'Shen & Cao (2008)';
require '../../includes/all.php';
require $includes . 'db_connect.php';

$query = 'SELECT * FROM ref_shen2008;';

$result = mysqli_query($link, $query);
if (!$result)
{
    $output = 'Error fetching Shen & Cao (2008): ' . mysqli_error($link);
    include $includes . 'error.html.php';
    exit();
}

while ($row = mysqli_fetch_array($result))
{
    $shen[] = $row['shen2008_number'] . $row['shen2008_var'];
    $gulin[] = $row['gulin_number'];
    $img_file[] = $row['page_image'];
}

require 'shen2008.html.php';

?>
