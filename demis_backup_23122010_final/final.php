<?php
session_start();
include("admin/dbs.php");
@extract($_REQUEST);
/*echo "<pre>";
print_r($_REQUEST);
echo "</pre>";
*/

$user_id=1;  //needs to be commented
//$user_id=$_SESSION['USER_ID'];
$fb_id=$_SESSION['FACEBOOK_ID'];
$tw_id=$_SESSION['TWITTER_ID'];
if($user_id != "")
{
	$user_details_query="select * from user where USER_ID='$user_id'";
	$user_fullscore_query="select SUM(SCORE) AS TOTAL_SCORE from game where USER_ID='$user_id'";
}
else if($fb_id != "")
{
	$user_details_query="select * from user where FACEBOOK_ID='$fb_id'";
	$user_id_query="select * from user where USER_ID='$user_id'";
	$user_id_result=mysql_query($user_id_query);
	$user_id_row=mysql_fetch_array($user_id_result);
	$user_id=$user_id_row['USER_ID'];
	$user_fullscore_query="select SUM(SCORE) AS TOTAL_SCORE from game where USER_ID='$user_id'";
}
else if($tw_id != "")
{
	$user_id_query="select * from user where TWITTER_ID='$tw_id'";
	$user_id_query="select * from user where USER_ID='$user_id'";
	$user_id_result=mysql_query($user_id_query);
	$user_id_row=mysql_fetch_array($user_id_result);
	$user_id=$user_id_row['USER_ID'];
	
	$user_fullscore_query="select SUM(SCORE) AS TOTAL_SCORE from game where USER_ID='$user_id'";
}
$user_details_result=mysql_query($user_details_query);
$user_details_row=mysql_fetch_array($user_details_result);

$user_fullscore_result=mysql_query($user_fullscore_query);
$user_fullscore_row=mysql_fetch_array($user_fullscore_result);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NieveEnLima.pe - Resultados</title>
<!-- style Document -->
<link href="css/style.css" rel="stylesheet" type="text/css" />

<!--[if IE 8]>
<style type="text/css">
#primary_nav{top:481px;left:14px;}
#primary_nav li.jugar{margin:1px 0 0 0}
#primary_nav li.reglas{margin:0 0 0 11px}
#primary_nav li.informacion{margin:0 0 0 14px}
</style>
<![endif]-->



</head>

<body>

<div id="main_wrapper_final">
<div id="content_wrapper">

<div id="final-content">
<div class="profile_picture">

<a href="#"><img src="images/profile_picture.png" /></a>
<a href="#"><span class="user_name">Pirerma villa</span></a>


</div>

<div class="personal-content">

<div class="personal">
<h1><img src="images/personal.png" /></h1>
<span><b><?php echo $user_details_row['SCORE']; ?></b></span>
</div>

<div class="personal">
<h1><img src="images/juego_dev.png" /></h1>
<span><b><?php echo $user_fullscore_row['TOTAL_SCORE'];  ?></b></span>
</div>

</div>

</div>

<span class="general">xxxxxxxx</span>
<div id="facebook-conn">
  
<a href="#"><img src="images/facebookconectate.png" alt="" /></a>
   
</div>
</div>

</div>


</body>
</html>
