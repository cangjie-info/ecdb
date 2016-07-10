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
require '../includes/all.php';

//connect to db
//all pages needing db connection need this
require $includes . 'mengzi_db_connect.php';


$query = 'SELECT subcontainers.name_en,
            subcontainers.name_zh,
            COUNT(inscr_graphs.id) AS graph_count,
            COUNT(DISTINCT(narratives.id)) AS narrative_count
         FROM subcontainers 
         INNER JOIN narratives 
            ON subcontainer_id = subcontainers.id
         INNER JOIN sentences
            ON narrative_id = narratives.id
         INNER JOIN inscr_graphs
            ON sentence_id = sentences.id
         WHERE container_id = 40
         GROUP BY subcontainers.id
         ORDER BY subcontainers.number;';

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
   $name_zh[] = $row['name_zh'];
   $name_en[] = $row['name_en'];
   $graph_count[] = $row['graph_count'];
   $narrative_count[] = $row['narrative_count'];
}
$json_rows = json_encode($rows, JSON_PRETTY_PRINT);

//include page with html
require 'home.html.php';


?>
