<?php

$page_name = "Publications"; // title and <h1>

//paths and other config
require '../../includes/all.php';

//connect to db
//all pages needing db connection need this
require $includes . 'db_connect.php';

$query = 'SELECT pubs.*, COUNT(inscr_surfs.id) AS count
   FROM pubs
   LEFT JOIN inscr_surfs
   ON pubs.id = pub_id
   GROUP BY pubs.id 
   ORDER BY date;';

$result = mysqli_query($link, $query);
if (!$result)
{
    $output = 'Error fetching XYZ: ' . mysqli_error($link);
    include $includes . 'error.html.php';
    exit();
}

while ($row = mysqli_fetch_array($result))
{
   $id[] = $row['id'];
   $name[] = $row['name'];
   $date[] = $row['date'];
   $full_name[] = $row['full_name'];
   $zh_short_name[] = $row['zh_short_name'];
   $zh_bibliography[] = $row['zh_bibliography'];
   $bibliography[] = $row['bibliography'];
   $notes[] = $row['notes'];
   $count[] = $row['count'];
}

//include page with html
require 'pubs.html.php';

?>
