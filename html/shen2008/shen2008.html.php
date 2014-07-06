<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8' />
<title>ECDB - Shen & Cao (2008)</title>
</head>
<body>
<h1>ECDB - Shen & Cao (2008)</h1>
<p>The version of the oracle-bone sign list in the ECDB database.</p>
<p>Shen Jianhua 沈建華 and Cao Jinyan 曹錦炎. 2008. <i>Jiaguwen Zixing Biao</i> 甲骨文字形表. Revised edition. Shanghai: Shanghai Cishu Chubanshe 上海辭書出版社.</p>
<?php
for ($i=0; $i<count($shen); $i++)
{
    $img_path = $repo_path . 'sign_list_imgs/sc/' . $img_file[$i];
    echo "<p>$shen[$i]: gulin = $gulin[$i] <a href='$img_path'>page</a></p>\n";
}
?>
</body>
</html>
