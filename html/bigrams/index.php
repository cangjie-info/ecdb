<?php
# PAGE TEMPLATE FOR ALL HTML PAGES
# To create a new page: 
# cp -r page_template <new_page_name>
# index.php should be exlusively php.
# Handles configuration files, db connection
# and querying, and data processing.
# It then 'includes' the html to display
# the page from the .html.php file in the same
# directory

$page_name = "Bigrams"; // title and <h1>

//paths and other config
require '../../includes/all.php';

//connect to db
//all pages needing db connection need this
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

$query = 'SELECT ICS3 AS headword
   FROM graphs
   WHERE id = ' . "$id;";

$result = mysqli_query($link, $query);
if (!$result)
{
    $output = 'Error fetching XYZ: ' . mysqli_error($link);
    include $includes . 'error.html.php';
    exit();
}

$headword = mysqli_fetch_array($result)['headword'];

$query1 = 'SELECT g1.ICS3 AS ics, COUNT(g1.ICS3) AS count
   FROM 
      inscr_graphs AS t1
         INNER JOIN graphs AS g1 ON t1.graph_id = g1.id, 
      inscr_graphs AS t2 
         INNER JOIN graphs AS g2 ON t2.graph_id = g2.id
   WHERE t2.graph_id = ' . "$id " . 
      'AND t1.inscr_id = t2.inscr_id 
      AND t1.number = t2.number - 1
      GROUP BY g1.ICS3
      ORDER BY count DESC;';

$result = mysqli_query($link, $query1);
if (!$result)
{
    $output = 'Error fetching XYZ: ' . mysqli_error($link);
    include $includes . 'error.html.php';
    exit();
}

while ($row = mysqli_fetch_array($result))
{
   $ics1[] = $row['ics'];
   $count1[] = $row['count'];
}

$query2 = 'SELECT g1.ICS3 AS ics, COUNT(g1.ICS3) AS count
   FROM 
      inscr_graphs AS t1
         INNER JOIN graphs AS g1 ON t1.graph_id = g1.id, 
      inscr_graphs AS t2 
         INNER JOIN graphs AS g2 ON t2.graph_id = g2.id
   WHERE t2.graph_id = ' . "$id " . 
      'AND t1.inscr_id = t2.inscr_id 
      AND t1.number = t2.number + 1
      GROUP BY g1.ICS3
      ORDER BY count DESC;';

$result = mysqli_query($link, $query2);
if (!$result)
{
    $output = 'Error fetching XYZ: ' . mysqli_error($link);
    include $includes . 'error.html.php';
    exit();
}

while ($row = mysqli_fetch_array($result))
{
   $ics2[] = $row['ics'];
   $count2[] = $row['count'];
}
//include page with html
require 'bigrams.html.php';

?>
