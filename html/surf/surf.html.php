<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8' />
<title>ECDB - surfaces</title>
</head>
<body>
<h1>ECDB - surfaces</h1>
<?php
echo "<h2>Surface = $surf</h2><p>";
$inscr_current = 0;
for ($i=0; $i<sizeof($ics3); $i++)
{
    if ($inscr_current != $inscr[$i])
    {   //new inscription
       echo '</p><p>' . $inscr[$i] 
            . ' : ';
       $inscr_current++;
    }
    echo '<span style="font-family:ics3;">'
         . $ics3[$i] . '</span>';
}
echo '</p>';
?>

</body>
</html>
