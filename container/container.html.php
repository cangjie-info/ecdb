<?php require $includes . 'top1.html.php'; ?>
<?php require $includes . 'top2.html.php'; ?>

<p><?php echo $descr; ?></p>

<ul>
<?php 
for($i = 0; $i < $sc_count; $i++) {
   echo "<li>$sc_name_zh[$i] $sc_name_en[$i] 
            <a href='../subcontainer/?id=$sc_id[$i]'>link</a>
            </li>";
}
?>
</ul>

<?php require $includes . 'bottom.html.php'; ?>
