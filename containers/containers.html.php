<?php require $includes . 'top1.html.php'; ?>
<!-- HEAD CONTENTS GO HERE -->
<?php require $includes . 'top2.html.php'; ?>

<?php

echo "<p>There are currently $containers_count text containers in ECDB.</p>";

for ($i = 0; $i < count($name_zh); $i++) {
   echo "<p>$name_zh[$i] $name_en[$i] <a href='../container/?id=$id[$i]'>link</a></p>";
   echo "<details><summary>Description</summary><p>$descr[$i]</p></details>";
}
?>


<?php require $includes . 'bottom.html.php'; ?>
