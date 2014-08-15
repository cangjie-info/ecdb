<?php require $includes . 'top.html.php'; ?>

<p>List of objects excavated from <?php echo $context; ?>, together with publication numbers of inscribed surfaces. If an object has been published more than once, it will appear more than once in the list.</p>
<p>Number of objects excavated from <?php echo $context; ?> = <?php echo count($objects); ?>.</p>

<table style="width:400px">
<tr>
    <th>Published surface</th>
    <th>Excavated object</th>
</tr>

<?php foreach ($objects as $object)
{
    echo '<tr>';
    echo '<td><a href="../surf/?id=' . 
        $object['surf_id'] . '">' . 
        $object['pub'] . 
        $object['surf'] . '</a></td>';
    echo '<td>' . $context . ':' . $object['object'] . '</td>';
    echo '</tr>';
}
echo '</table>';
?>

</body>
</html>
