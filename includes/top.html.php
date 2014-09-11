<!DOCTYPE html>
<!--- TOP PANEL FOR ALL PAGES -->
<html>
    <head>
        <meta charset='UTF-8' />
        <title>ECDB - <?php echo $page_name; ?></title>
    </head>
    <body>
        <h1>ECDB</h1>
        <p>NAVIGATION: 
            <a <?php echo "href='$home_path/html/'"; ?> >HOME</a> |
            <a <?php echo "href='$home_path/html_public/'"; ?> >HOME PUBLIC</a> | 
            <a <?php echo "href='$home_path/html/czcn/'"; ?> >CZCN ALL</a> |
            <a <?php echo "href='$home_path/html/updates/'"; ?>>UPDATES</a> |
            <a <?php echo "href='$home_path/html/todo/'"; ?> >TODO</a>
        </p>
        <h1><?php echo $page_name; ?></h1>
