<?php require $includes . 'top.html.php'; ?>

<?php
foreach($excavations as $id => $excavation)
{
    echo '<h2>' . $excavation['year'] . '</h2>';
    echo "<ul>\n";
    foreach($excavations[$id]['contexts'] as $context)
    {
        echo '<li><p><a href="../contexts/?id=' . $context['id'] . '">'
            . $context['name'] . '</a></p></li>';
    }
    echo '</ul>';
}
?>
</body>
</html>
