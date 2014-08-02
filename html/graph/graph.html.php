<?php require $includes . 'top.html.php'; ?>

<h1><?php echo $page_name; ?></h1>

<p>ICS3 glyph = <span style='font-family:ics3'>
<?php echo $ics3; ?>
</span></p>

<p>ICS4 glyph = <span style='font-family:ics4'>
<?php echo $ics4; ?>
</span></p>

<p>HD glyph = <span style='font-family:HuaDong'>
<?php echo $hd; ?>
</span></p>

<p><i>Gulin</i> = <?php echo $gulin; ?></p>

<p>count (all inscriptions) =
<?php echo $count; ?>
</p>

<p><a href='../concord/?id=<?php echo $id ?>'>Link to concordance</a></p> 
</body>
</html>
