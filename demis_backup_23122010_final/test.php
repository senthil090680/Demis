<?php
include("admin/dbs.php");
$query="Select PIC_PATH from user where USER_ID=65";
$res= mysql_query($query) or die(mysql_error());
$result=mysql_fetch_assoc($res);
header('Content-Type: image/jpeg');
echo $result['PIC_PATH'];



/*mysql_connect ("localhost", "root", "") or die ('I cannot connect to the database because: ' . mysql_error());
mysql_select_db ("imageprocess") or die ('I cannot connect to the database because: ' . mysql_error());
$query="Select ImageContent from imagedetails where ID=1";
$res= mysql_query($query) or die(mysql_error());
$result=mysql_fetch_assoc($res);
header('Content-Type: image/jpeg');
echo $result['ImageContent'];	
*/



?>
