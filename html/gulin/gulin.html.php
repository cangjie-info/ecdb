<?php require $includes . 'top.html.php'; ?>
<?php 
if (isset($_POST['interpolate']))
{
    echo '<p style="color:red">INTERPOLATION SUCCESSFUL (I THINK). MERIT ACQUIRED.</p>';
}
if ($page_interpolated)
{
    echo '<p style="color:red">THIS PAGE NUMBER IS INTERPOLATED. It may only be approximately correct.</p>';
}
?>
<p><?php echo "Page currently assigned to this gulin number = $page"; ?></p>
<p><?php echo "Page displayed = $display_page"; ?></p>
<p>PAGE NAVIGATION: 
    <a href='?gulin=<?php echo $gulin; ?>&page=<?php echo $back10; ?>'>Back 10</a> | 
    <a href='?gulin=<?php echo $gulin; ?>&page=<?php echo $back_page; ?>'>Back</a> | 
    <a href='?gulin=<?php echo $gulin; ?>&page=<?php echo $forward_page; ?>'>Forward</a> | 
    <a href='?gulin=<?php echo $gulin; ?>&page=<?php echo $forward10; ?>'>Forward 10</a>
</p>
<?php if(isset($_GET['page'])): ?>
<p>If this gulin number has an interpolated page number, or if you believe that the non-interpolated page number is incorrect: navigate to the correct PAGE for the gulin NUMBER displayed above, and then hit this button. If the page number is interpolated, and it is correct, again, hit this button.</p>
<form action="" method="post">
    <input type="hidden" name="interpolate" value="1" />
    <input type="submit" value="Set page number" />
</form>
<?php endif; ?>
<p><img src='<?php echo $img_path; ?>' /><p>
</body>
</html>
