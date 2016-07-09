<?php require $includes . 'top.html.php'; ?>

<?php 
for($i = 0; $i < count($id); $i++) {
   echo "<h2>$full_name[$i]</h2>";
   echo "<p>Surfaces in database = $count[$i]</p>";
   echo "<p>$name[$i] $zh_short_name[$i] $date[$i]</p>"; 
   echo "<p>$zh_bibliography[$i]</p>";
   echo "<p>$bibliography[$i]</p>";
   echo "<p>$notes[$i]</p>";
   echo "<p><a href='../edit_pub/?pub=$id[$i]'>EDIT</a></p>";
   echo '<hr />';
}
?>

<?php require $includes . 'public_bottom.html.php'; ?>

