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

//paths and other config
require '../../includes/all.php';

//connect to db
//all pages needing db connection need this
require $includes . 'mengzi_db_connect.php';


$query = 'SELECT COUNT(*) AS graph_count,
            inscr_graphs.TEST_graph AS graph
         FROM inscr_graphs
         GROUP BY TEST_graph
         ORDER BY COUNT(*) DESC;';

$result = mysqli_query($link, $query);
if(!$result)
{
   $output = 'Error fetching containers: ' . mysqli_error($link);
   include $includes . 'error.html.php';
   exit();
}

$rows = [];
while ($row = mysqli_fetch_assoc($result))
{
   $rows[] = $row;
}
$json_rows = json_encode($rows, JSON_PRETTY_PRINT);

//include page with html
require 'graph_frequency.html.php';


?>
