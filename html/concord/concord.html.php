<?php require $includes . 'top.html.php'; ?>

<h1><?php echo $page_name; ?></h1>

<?php
$current_inscr = 0;
$i=0;
$count = count($graph_id);
while ($i < $count)
{
    //if new inscription:
        //new line
        //new surf href
    if($current_inscr != $inscr[$i])
    {
        echo "<p><a href='../surf/?id=$surf[$i]'><span style='font-family:ics3'>";
        $current_inscr = $inscr[$i];
    }
    //write the graph
    if($id==$graph_id[$i])
    {
        echo "<span style='color:red'>$ics3[$i]</span>";
    }
    else
    {
        echo $ics3[$i];
    }
    //if last graph in an inscr
        //close tags
    if ($i == $count-1 or $current_inscr != $inscr[$i + 1])
    {
        echo '</span></a></p>';
    }
    $i++;
}
?>
</body>
</html>
            



</body>
</html>
