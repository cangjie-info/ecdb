<?php require $includes . 'top.html.php'; ?>

<?php 
foreach($sites as $id => $site)
{
    echo '<h2>' . $site['name'] . ' ' . $site['name_zh'] . '</h2>';
    echo '<p>' . $site['address'] . '</p>';
    echo '<p>' . $site['desc'] . '</p>';
    echo '<ul>';
    foreach($sites[$id]['localities'] as $locality)
    {
        echo '<li><p><a href="../localities/?id=' . $locality['id'] . '">' 
            . $locality['name'] . '</a> ' 
            . $locality['name_zh'] . ' ' 
            . $locality['desc'] . '</p></li>';
    }
    echo '</ul>';
}
?>
</body>
</html>
