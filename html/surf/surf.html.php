<?php require $includes . 'top.html.php'; ?>

<h1><?php echo $page_name; ?></h1>
<h2><?php echo "$surf" ?></h2>

<?php
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
</body>
</html>
