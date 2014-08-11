<?php require $includes . 'top.html.php'; ?>

<h1><?php echo $page_name; ?></h1>

<?php 
foreach($sites as $site)
{
    echo '<h2>' . $site['name'] . ' ' . $site['name_zh'] . '</h2>';
    echo '<p>' . $site['address'] . '</p>';
    echo '<p>' . $site['desc'] . '</p>';
}
?>
</body>
</html>
