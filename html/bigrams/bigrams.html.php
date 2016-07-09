<?php require $includes . 'top.html.php'; ?>
<p>Bigrams with headword second, in order of frequency:</p>
<table style="width:400px">
<tr>
   <th>bigram</th>
   <th>count</th>
</tr>

<?php 
for ($i = 0; $i < count($ics1); $i++)
{
   echo '<tr>';
   echo "<td class='ics3'>$ics1[$i]$headword</td>";
   echo "<td>$count1[$i]</td>";
   echo '</tr>';
}
?>

</table>

<p>Bigrams with headword first, in order of frequency:</p>
<table style="width:400px">
<tr>
   <th>bigram</th>
   <th>count</th>
</tr>

<?php 
for ($i = 0; $i < count($ics2); $i++)
{
   echo '<tr>';
   echo "<td class='ics3'>$headword$ics2[$i]</td>";
   echo "<td>$count2[$i]</td>";
   echo '</tr>';
}
?>

</table>
<?php require $includes . 'public_bottom.html.php'; ?>

