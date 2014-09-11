<?php require $includes . 'top.html.php'; ?>

<?php

echo "<p><a href='$repo_path$img_url'>Image</a></p>";

$inscr_current = 0;
$inscr_graph_current = 0;
for ($i=0; $i<sizeof($ics3); $i++):
    //if beginning of a new inscr
    if ($inscr_current != $inscr[$i]): 
?>

<!--New inscription on new line -->
<p><?php echo $inscr[$i]; ?> :

<?php $inscr_current = $inscr[$i];
    endif;
?>

<!--Markup for individual graph-->
<span style="font-family:ics3;">
<a href='../graph/?id=<?php echo $graph[$i]; ?>'>
<?php echo $ics3[$i]; ?></a></span>


<?php //if last graph in surf or inscr
    if ($i + 1 == sizeof($ics3) or $inscr_current != $inscr[$i + 1]):
?>

<!--End of inscription line-->
</p>

<?php
    endif;
    endfor;
?>
<?php echo $zot_data; ?>
</body>
</html>
