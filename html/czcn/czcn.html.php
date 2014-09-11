<?php require $includes . 'top.html.php'; ?>

<?php 
foreach ($surfaces as $name => $surface)
{
    $img_link = "<a href='$repo_path$img_url[$name]'>$name</a>";
    echo '<h2>CZCN ' . $img_link . '</h2>';
    foreach ($surface as $number => $inscription)
    {
        echo '<p>' . $number . ': <span style="font-family:ics3;">';
        foreach ($inscription as $graph)
        {
            $ics3 = $graph['ics3'];
            if($ics3=='') {$ics3='X';}
            echo $ics3;
        }
        echo '</span></p>';
        echo '<p>' . $number . ': ';
        foreach ($inscription as $graph)
        {
            $matt_glyph = $graph['matt_glyph'];
            $matt_cp = $graph['matt_cp'];
            if ($matt_cp >= 131072) // CJK Ext B or Chant.ttf
            {
                $matt_glyph = "&#$matt_cp;";
                if ($matt_cp >= 983040) // CHant.ttf, not Ext B
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
            echo "$matt_glyph</span>";
            }
        echo '</p>';
    }
}
?>
</body>
</html>
