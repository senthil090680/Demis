<?php
session_start();
include("admin/dbs.php");
$RandomStr = md5(microtime());
$token = substr($RandomStr,0,5);
@extract($_REQUEST);
?>
<!--link href="css/style.css" rel="stylesheet" type="text/css" /-->
<div id="result">
<?php

$user_id=$_SESSION['USER_ID'];
$fb_id=$_SESSION['FACEBOOK_ID'];
$score_new=$_SESSION['SCORE_NEW']; 
$level_new=$_SESSION['LEVEL_NEW']; 
$flakes_new=$_SESSION['FLAKES_NEW']; 
//$pic_path=$_SESSION['PIC_PATH'];
//$lastplayed_date=$lastplayed_date; //needs to be commented
//$lastplayed_type="nonwebcam"; 

//$user_id=8; //needs to be commented
//$score_new=32; //needs to be commented
//$level_new=3; //needs to be commented
//$pic_path="webcambg.jpg"; //needs to be commented
//$lastplayed_type="nonwebcam"; //needs to be commented
//$total_secs=25; //needs to be commented


$total_cum_score_query = "select SUM(SCORE) AS total_cum_score from user";
$total_cum_score_result = mysql_query($total_cum_score_query) or die("Data not found.");
$total_cum_score_row = mysql_fetch_array($total_cum_score_result);
$total_cum_score=$total_cum_score_row[total_cum_score];

$total_no_games_query = "select TOTAL_PLAYS from stats ORDER BY ABS(STATS_ID) DESC";
$total_no_games_result = mysql_query($total_no_games_query) or die("Data not found.");
$total_no_games_row = mysql_fetch_array($total_no_games_result);
$total_plays=$total_no_games_row[TOTAL_PLAYS];
$total_no_games=total_plays+1;

$total_no_users_query = "select count(*) AS total_no_users from user";
$total_no_users_result = mysql_query($total_no_users_query) or die("Data not found.");
$total_no_users_row = mysql_fetch_array($total_no_users_result);
$total_no_users=$total_no_users_row[total_no_users];

$top_user_query = "select USER_ID from user ORDER BY ABS(SCORE) DESC limit 0,10";
$top_user_result = mysql_query($top_user_query) or die("Data not found.");
$top_user_num = mysql_num_rows($top_user_result);

$h=1;
$top_user = "";
while($top_user_row = mysql_fetch_array($top_user_result))
{
	if($h == $top_user_num)
	{
		$top_user .= $top_user_row[USER_ID];
	}
	else
	{
		$top_user .= $top_user_row[USER_ID].",";
	}
	
}


$stats_insert = "insert into stats (TOTAL_SCORE,TOTAL_PLAYS,TOTAL_USERS,BEST_PLAYER_ID) values('$total_cum_score','$total_no_games','$total_no_users','$top_user')";

$stats_result = mysql_query($stats_insert) or die("Data not found.");

?>




<?php

if($fb_id != "")
{
	$userid_query = "select * from user where FACEBOOK_ID='$fb_id'";
	$userid_result = mysql_query($userid_query) or die("Data not found.");
	$userid_row= mysql_fetch_array($userid_result);
	$user_id= $userid_row[USER_ID];
}

//Getting all user's information
$user_count  = "select * from user where USER_ID='$user_id'";
$result = mysql_query($user_count) or die (mysql_error());
$num=mysql_num_rows($result);
$rowcnt=mysql_fetch_array($result);


//Overall ranking from the user table
$all_rank  = "select * from user ORDER BY ABS(SCORE) DESC limit 0,10";
$result_rank = mysql_query($all_rank) or die (mysql_error());
$num_rank=mysql_num_rows($result_rank);
$v = mysql_query("SET @rownum := 0");
$user_rank = "
SELECT rank FROM (
                    SELECT @rownum := @rownum + 1 AS rank, USER_ID
                    FROM user ORDER BY ABS(SCORE) DESC 
                    ) as result where USER_ID='{$user_id}'";
$result_user_rank = mysql_query($user_rank) or die (mysql_error());
$user_row=mysql_fetch_array($result_user_rank);

$user_rank_pos=$user_row['rank'];


if($num_rank > 0)
{

?>
    <h1>Ranking Global</h1>

<div class="tableContainer">
 <div class="table-header">
 <span class="rank">Pos</span>
<span class="user-avatar">Avatar</span>
 <span class="f-name">Nombres</span> 
  <span class="l-name">Apellidos</span>
    <span class="n-name">Categor&iacute;a</span>
    <span class="total-score">Copos</span>
   <span class="date-time">Fecha y Hora</span>
  </div>
  
  <div class="table-body">
  <?php $i=1; while($rowcnt_rank=mysql_fetch_array($result_rank)) { @extract($rowcnt_rank); ?>
 

 
       <div class="table-row odd">
  <?php 
$user_level  = "select NICKNAME from level where LEVEL_ID='$LEVEL_ID'";
$user_rank = mysql_query($user_level) or die (mysql_error());
$level_row=mysql_fetch_array($user_rank); ?>
    <span class="rank"><?php echo $i; ?></span>
    <span class="user-avatar"><?php if($FACEBOOK_ID == '') { ?><img src="admin/images/user/<?php echo $USER_IMAGE; ?>"  width="25" height="25"/> <?php } else { ?><img src="<?php echo $USER_IMAGE; ?>"  width="25" height="25"/> <?php } ?></span>
     <span class="f-name"><?php echo $FIRSTNAME; ?></span>
   <span class="l-name"><?php echo $LASTNAME; ?></span>
    <span class="n-name"><?php echo $level_row[NICKNAME]; ?></span>
    <span class="total-score"><?php echo $SCORE; ?></span>
    <span class="date-time"><?php echo $LASTPLAYED_DATE; ?></span>
   </div>
  <?php $i++; } ?>
 </div>

<?php } ?>
</div>

<?php
 if($user_rank_pos > 10 ) { ?>



<h1>Ranking Global</h1>

<div id="not-in-list" class="tableContainer">
<div class="table-header">
    <span class="rank">Pos</span>
    <span class="user-avatar">Avatar</span>
    <span class="f-name">Nombres</span>   
    <span class="l-name">Apellidos</span>
     <span class="n-name">Current Score</span>
    <span class="n-name">Copos Acumulados</span>
    <span class="n-name">Categor&iacute;a</span>
    <span class="total-score">Copos</span>
    <span class="date-time">Fecha y Hora</span>
   </div>

  
    <div class="table-body">
    <div class="table-row">
	<?php 
    $user_level  = "select NICKNAME from level where LEVEL_ID='$LEVEL_ID'";
    $user_rank = mysql_query($user_level) or die (mysql_error());
    $level_row=mysql_fetch_array($user_rank); @extract($rowcnt); 
	?>

    <span class="rank"><?php echo $user_rank_pos; ?></span>
    <span class="user-avatar"><?php if($FACEBOOK_ID == '') { ?><img src="admin/images/user/<?php echo $USER_IMAGE; ?>"  width="25" height="25"/> <?php } else { ?><img src="<?php echo $USER_IMAGE; ?>"  width="25" height="25"/> <?php } ?></span>    
    <span class="f-name"><?php echo $FIRSTNAME; ?></span>
    <span class="l-name"><?php echo $LASTNAME; ?></span>
    <span class="n-name"><?php echo $score_new; ?></span>
<?php $user_total_cum_query  = "select SUM(SCORE) AS user_total_cum from game where USER_ID='$user_id'";
$user_total_cum_result = mysql_query($user_total_cum_query) or die (mysql_error());
$user_total_cum_row=mysql_fetch_array($user_total_cum_result); ?>   
    
    <span class="n-name"><?php echo $user_total_cum_row[user_total_cum]; ?></span>    
    <span class="n-name"><?php echo $level_row[NICKNAME]; ?></span>
    <span class="total-score"><?php echo $SCORE; ?></span>
     <span class="date-time"><?php echo $LASTPLAYED_DATE; ?></span>
   </div>
</div>

</div>

<?php } ?>