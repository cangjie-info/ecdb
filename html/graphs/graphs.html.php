<?php require $includes . 'top.html.php'; ?>

<h1><?php echo $page_name; ?></h1>
<p>This is a list of all graphs currently in the ECDB sign-list. Not all are used in the current transcriptions.</p>
<p>Graphs in sign-list = <?php echo $graph_count; ?></p>
<p>Graphs in inscriptions = <?php echo $running_total; ?></p>
<table style="width:400px">
<tr>
    <th>graph (ics3)</th>
    <th>count</th>
    <th>rank</th>
    <th>cumulative %</th>
</tr>
<?php
for ($i=0; $i<count($id); $i++)
{
    $cum_pc = round($cum[$i] / $running_total * 100, 2);  
    echo '<tr>';
    echo "<td><span style='font-family:ics3'>$ics3[$i]</span></td>";
    echo "<td>$count[$i]</td>";
    echo "<td>$i</td>";
    echo "<td>$cum_pc</td>";
    echo '</tr>';
}
?>
</table>
</body>
</html>
