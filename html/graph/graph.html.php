<?php require $includes . 'top.html.php'; ?>

<p>ICS3 glyph = <span style='font-family:ics3'>
<?php echo $ics3; ?>
</span></p>

<p>ICS4 glyph = <span style='font-family:ics4'>
<?php echo $ics4; ?>
</span></p>

<p>HD glyph = <span style='font-family:HuaDong'>
<?php echo $hd; ?>
</span></p>

<p><i>Gulin</i> = <a href = '../gulin/?gulin=<?php echo $gulin; ?>'>
    <?php echo $gulin; ?></a></p>
<p>Shen &amp; Cao (2008) = <?php echo '<a href = "' . $img_path . '">' . "$shen2008</a>";?></p>

<p>count (all inscriptions) =
<?php echo $count; ?>
</p>

<p><a href='../concord/?id=<?php echo $id ?>'>Link to concordance</a></p> 
</body>
</html>
