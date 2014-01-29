<?php
session_start();
include("admin/dbs.php");

echo $image_query = "select PIC_PATH from user where USER_ID='68'";			
$image_result = mysql_query($image_query) or die("Data not found.");
$image_row=mysql_fetch_array($image_result);
$image = $image_row['PIC_PATH'];
header("Content-Type: image/jpeg" );
echo $image;
echo "sfesdfsdf";
?>