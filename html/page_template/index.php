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

$page_name = "Page title"; // title and <h1>

//paths and other config
require '../../includes/all.php';

//connect to db
//all pages needing db connection need this
require $includes . 'db_connect.php';

// MYSQL QUERY CODE SKETCH
/*
$query = 'SELECT etc. etc.';

$result = mysqli_query($link, $query);
if (!$result)
{
    $output = 'Error fetching XYZ: ' . mysqli_error($link);
    include $includes . 'error.html.php';
    exit();
}

while ($row = mysqli_fetch_array($result))
{
    //code to process rows of result table goes here
}
*/

//include page with html
require 'page_template.html.php';

?>
