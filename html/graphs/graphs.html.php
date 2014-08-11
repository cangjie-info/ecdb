<?php require $includes . 'top.html.php'; ?>

<h1><?php echo $page_name; ?></h1>
<p>This is a list of all graphs currently in the ECDB sign-list. Some are not used in the current transcriptions (count = 0).</p>
<p>Graphs in sign-list = <?php echo $graph_count; ?></p>
<p>Graphs in inscriptions = <?php echo $running_total; ?></p>
<table style="width:400px">
<tr>
    <th>graph (ics3)</th>
    <th>Matt glyph</th>
    <th>Matt cp</th>
    <th>count</th>
    <th>rank</th>
    <th>cumulative %</th>
</tr>
<?php
for ($i=0; $i<count($id); $i++)
{
    $cum_pc = round($cum[$i] / $running_total * 100, 2);  
    echo '<tr>';
    echo "<td><span style='font-family:ics3'><a href='../graph/?id=$id[$i]'>$ics3[$i]</a></span></td>";
    echo '<td>';
    if ($matt_cp[$i] >= 131072) // CJK Ext B or Chant.ttf
    {
        $matt_glyph[$i] = "&#$matt_cp[$i];";
        if ($matt_cp[$i] >= 983040) // CHant.ttf, not Ext B
        {
            echo "<span style='font-family:chant'>";
        } else { // Ext B
            echo "<span style='font-family:Han Nom B'>";
        }
    }
    else //neither Ext B nor Chant
    {
        echo '<span>';
    }
    echo "<a href='../graph/?id=$id[$i]'>$matt_glyph[$i]</a></span></td>";
    echo "<td>$matt_cp[$i]</td>";
    echo "<td>$count[$i]</td>";
    echo "<td>$i</td>";
    echo "<td>$cum_pc</td>";
    echo '</tr>';
}
?>
</table>
</body>
</html>
