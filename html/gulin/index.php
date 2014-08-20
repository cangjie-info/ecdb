<?php
$page_name = 'Gulin'; 
require '../../includes/all.php';
require $includes . 'db_connect.php';

if (!isset($_GET['gulin']))
{
    $output = '4-digit integer gulin number must be present in url.';
    include $includes . 'error.html.php';
    exit();
}

$gulin = $_GET['gulin'];
//validate as 4-digit string
$regex = '/^\d{4}$/';
if (!preg_match($regex, $gulin))
{
    $output = 'Gulin number must be a 4-digit string.';
    $output .=  '$gulin = ' . $gulin;
    include $includes . 'error.html.php';
    exit();
}

$page_name .= " $gulin";

if(isset($_POST['interpolate']))
{
    $page_name = "interpolation";
}

$query = 'SELECT number, page, page_interpolated
          FROM ref_gulin
          WHERE number = ' .
          $gulin .
          ';';

$result = mysqli_query($link, $query);
if (!$result)
{
    $output = 'Error fetching Gulin page: ' . mysqli_error($link);
    include $includes . 'error.html.php';
    exit();
}

$row = mysqli_fetch_array($result);
$page = $row['page'];
$page_interpolated = $row['page_interpolated'];

if (isset($_GET['page']))
{
    $display_page = $_GET['page'];
}
else
{
    $display_page = $page;
}

$img_path = $repo_path . "sign_list_imgs/gl/gl_$display_page.jpg";

$forward_page = (int)$display_page + 1;
$forward_page = str_pad($forward_page, 4, '0', STR_PAD_LEFT);
$back_page = (int)$display_page - 1;
if ($back_page < 1) $back_page = 1;
$back_page = str_pad($back_page, 4, '0', STR_PAD_LEFT);
$forward10 = (int)$display_page + 10;
$forward10 = str_pad($forward10, 4, '0', STR_PAD_LEFT);
$back10 = (int)$display_page - 10;
if ($back10 < 1) $back10 = 1;
$back10 = str_pad($back10, 4, '0', STR_PAD_LEFT);
require 'gulin.html.php';
?>
