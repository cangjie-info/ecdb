<?php

$page_name = "Edit Publication"; // title and <h1>

//paths and other config
require '../../includes/all.php';

//connect to db
//all pages needing db connection need this
require $includes . 'db_connect.php';

if (isset($_GET['pub']) && is_numeric($_GET['pub']) && $_GET['pub'] > 0) {
   $id = $_GET['pub'];
   $result = mysqli_query("SELECT * FROM pubs WHERE id=$id")
      or die(mysqli_error);
   $row = mysqli_fetch_array($result);
   if($row) {
      $name = $row['name'];
      $date = $row['date'];
      $full_name = $row['full_name'];
      $zh_short_name = $row['zh_short_name'];
      $zh_bibliography = $row['zh_bibliography'];
      $bibliography = $row['bibliography'];
      $notes = $row['notes'];
      renderForm($id, 
         $date, 
         $full_name, 
         $zh_short_name, 
         $zh_bibliography, 
         $bibliography, 
         $notes)
   }
   else {
      echo "No results for that pub id.";
   }
}
else {
   echo 'pub id in URL is not valid.';
}

//include page with html
require 'pubs.html.php';

?>
