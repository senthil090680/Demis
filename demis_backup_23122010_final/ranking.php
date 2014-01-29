<?php
session_start();
include("admin/dbs.php");
$RandomStr = md5(microtime());
$token = substr($RandomStr,0,5);
@extract($_REQUEST);
/*echo "<pre>";
print_r($_REQUEST);
echo "</pre>";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";*/


?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NieveEnLima.pe - Resultados</title>

<link href="css/style.css" rel="stylesheet" type="text/css" />
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
<script type="text/javascript">

$(document).ready(function() {
	$('a.poplight[href^=#]').click(function() {
    var popID = $(this).attr('rel'); //Get Popup Name
    var popURL = $(this).attr('href'); //Get Popup href to define size

    //Pull Query & Variables from href URL
    var query= popURL.split('?');
    var dim= query[1].split('&');
    var popWidth = dim[0].split('=')[1]; //Gets the first query string value

    //Fade in the Popup and add close button
    $('#' + popID).fadeIn().css({ 'width': Number( popWidth ) }).prepend('<a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>');

    //Define margin for center alignment (vertical   horizontal) - we add 80px to the height/width to accomodate for the padding  and border width defined in the css
    var popMargTop = ($('#' + popID).height() + 80) / 2;
    var popMargLeft = ($('#' + popID).width() + 80) / 2;

    //Apply Margin to Popup
    $('#' + popID).css({
        'margin-top' : -popMargTop,
        'margin-left' : -popMargLeft
    });

    //Fade in Background
    $('body').append('<div id="fade"></div>'); //Add the fade layer to bottom of the body tag.
    $('#fade').css({'filter' : 'alpha(opacity=60)'}).fadeIn(); //Fade in the fade layer - .css({'filter' : 'alpha(opacity=80)'}) is used to fix the IE Bug on fading transparencies 

    return false;
});

//Close Popups and Fade Layer
$('a.close, #fade').live('click', function() { //When clicking on the close or fade layer...
    $('#fade , .popup_block').fadeOut(function() {
        $('#fade, a.close').remove();  //fade them both out
    });
    return false;
});

$('#demis_forgetpassword').hide();

$('.login').click(function(){
$('#demis_userlogin').show();
$('#demis_forgetpassword').hide();});
$('#register-now').click(function(){$('#login').hide("slow");});
$('.forget-password').click(function(){$('#demis_forgetpassword').show();$('#demis_userlogin').hide();});

});


</script>
</head>

<body>

<div id="main_wrapper">
<div id="content_wrapper">

<!-- primary navigation starts -->
<div id="primary_nav">
  <ul>
    <li class="jugar"><a href="jugar.html"><img src="images/jugar.png" alt="" title="Jugar" /></a></li>
     <li class="reglas"><a href="reglas.html"><img src="images/reglas.png" alt="" title="Reglas" /></a></li>
      <li class="informacion"><a href="informacion.html"><img src="images/informacion.gif" alt="" title="Informacion" /></a></li>
  
  </ul>

</div>
<!-- primary navigation ends -->

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



/*$user_details_query = "select * from user where USER_ID='$user_id'";
$user_details_result = mysql_query($user_details_query) or die (mysql_error());
$user_details_row = mysql_fetch_array($user_details_result);

$score_old = $user_details_row['SCORE'];*/


//commented so no need for updation
/*if($score_new > $score_old)
{
	//if the current score is greater than old score
	echo "1";
	$user_update  = "update user set SCORE='$score_new',LEVEL_ID='$level_new',LAST_PLAYED_DATE=NOW(),LASTPLAYED_TYPE='$lastplayed_type',BEST_PLAYED_DATE=NOW() where USER_ID='$user_id'";
	$user_update_result = mysql_query($user_update) or die (mysql_error());

	$user_game_update  = "insert into game (USER_ID,SCORE,TOTAL_SECS,LEVEL_ID,GAME_DATE,TYPE_GAME,PIC_PATH) values('$user_id','$score_new','$total_secs','$level_new',NOW(),'$lastplayed_type','$pic_path')";
	$user_game_update_result = mysql_query($user_game_update) or die (mysql_error());
}
else
{
	//if the old score is greater than current score
	echo "2";
	$user_update  = "update user set LASTPLAYED_DATE=NOW(),LASTPLAYED_TYPE='$lastplayed_type' where USER_ID='$user_id'";
	$user_update_result = mysql_query($user_update) or die (mysql_error());

	$user_game_update  = "insert into game (USER_ID,SCORE,TOTAL_SECS,LEVEL_ID,GAME_DATE,TYPE_GAME,PIC_PATH) values('$user_id','$score_new','$total_secs','$level_new',NOW(),'$lastplayed_type','$pic_path')";
	$user_game_update_result = mysql_query($user_game_update) or die (mysql_error());
}*/

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
    <h1>Your's Rank from All Users</h1>

<div class="tableContainer">
 <div class="table-header">
 <span class="rank">Rank</span>
<span class="user-avatar">User Avatar</span>
 <span class="f-name">First Name</span> 
  <span class="l-name">Last Name</span>
    <span class="n-name">Level Nick Name</span>
    <span class="total-score">Total Score</span>
   <span class="date-time">Date & Time of Occurrence</span>
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



<h1>Your's Rank from All Users</h1>

<div id="not-in-list" class="tableContainer">
<div class="table-header">
    <span class="rank">Rank</span>
    <span class="user-avatar">User Avatar</span>
    <span class="f-name">First Name</span>   
    <span class="l-name">Last Name</span>
     <span class="n-name">Current Score</span>
    <span class="n-name">Total Cumulative Score</span>
    <span class="n-name">Level Nick Name</span>
    <span class="total-score">Total Score</span>
    <span class="date-time">Date & Time of Occurrence</span>
   </div>

  
    <div class="table-body">
    <div class="table-row">
	<?php 
    $user_level  = "select NICKNAME from level where LEVEL_ID='$LEVEL_ID'";
    $user_rank = mysql_query($user_level) or die (mysql_error());
    $level_row=mysql_fetch_array($user_rank); @extract($rowcnt); 
	?>

    <span class="rank"><?php echo $user_rank_pos; ?></span>
    <span class="user-avatar"><img src="admin/images/user/<?php echo $USER_IMAGE; ?>"  width="25" height="25"/></span>
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
<?php //needs to be commented

if($fb_id != "")
{
$fb_user_query = "select * from user where FACEBOOK_ID = '$fb_id'";
$fb_user_result = mysql_query($fb_user_query) or die (mysql_error());
//echo "<br>";
$fb_user=mysql_num_rows($fb_user_result); 
//echo "<br>";
if($fb_user > 0){



?>

<?php 

$friend_rank  = "select * from user where FACEBOOK_ID in (select USER_FR_FB_ID from user_friend_fb where USER_ID = $fb_id)
UNION
select * from user where FACEBOOK_ID = $fb_id
ORDER BY ABS(SCORE) DESC limit 0,10";
$friend_rank_result = mysql_query($friend_rank) or die (mysql_error());
$friend_rank_num=mysql_num_rows($friend_rank_result);  ?>
<?php if($friend_rank_num > 0) { ?>

<h1>Your Rank from Your Friends</h1>
 
 <div class="tableContainer">

   <div class="table-header">
    <span class="rank">Rank</span>
    <span class="user-avatar">User Avatar</span>
    <span class="f-name">First Name</span>   
    <span class="l-name">Last Name</span>
    <span class="n-name">Level Nick Name</span>
    <span class="total-score">Total Score</span>
    <span class="date-time">Date & Time of Occurrence</span>
   </div>
   
   <div class="table-body">
  <?php $ijk = 5; ?>
  <?php $i=1; while($friend_rank_row=mysql_fetch_array($friend_rank_result)) { @extract($friend_rank_row); 
  ?>
	 
<?php  $l = mysql_query("SET @rownum := 0");
$user_friend_rank = "
SELECT friend_rank FROM (
                    SELECT @rownum := @rownum + 1 AS friend_rank, FACEBOOK_ID
                    FROM user ORDER BY SCORE DESC 
                    ) as result where FACEBOOK_ID='$FACEBOOK_ID'";
$result_friend_rank = mysql_query($user_friend_rank) or die (mysql_error());
$user_friend_row=mysql_fetch_array($result_friend_rank);

$user_friend_rank_pos=$user_friend_row['friend_rank'];  ?>
<?php $user_friend_rank_pos; $user_rank_pos; ?>



<?php if($ijk == 5) { ?>
<?php  if($user_friend_rank_pos > $user_rank_pos) {       $ijk++;    ?>
  

       <!--div class="table-row">
  <!?php echo $user_rank_pos;
$user_level  = "select NICKNAME from level where LEVEL_ID='$LEVEL_ID'";
$user_rank = mysql_query($user_level) or die (mysql_error());
$level_row=mysql_fetch_array($user_rank); ?>
    <span class="rank"><!?php echo $user_rank_pos; ?></span>
    <span class="user-avatar"><img src="<!?php echo $USER_IMAGE; ?>" width="25" height="25"/></span>
    <span class="f-name"><!?php echo $FIRSTNAME; ?></span>
    <span class="l-name"><!?php echo $LASTNAME; ?></span>
    <span class="n-name"><!?php echo $level_row[NICKNAME]; ?></span>
    <span class="total-score"><!?php echo $SCORE; ?></span>
    <span class="date-time"><!?php echo $LASTPLAYED_DATE; ?></span>
  </div-->
  <div class="table-row">
  <?php 
$user_level  = "select NICKNAME from level where LEVEL_ID='$LEVEL_ID'";
$user_rank = mysql_query($user_level) or die (mysql_error());
$level_row=mysql_fetch_array($user_rank); ?>
    <span class="rank"><?php echo $user_friend_rank_pos; ?></span>
    <span class="user-avatar"><img src="<?php echo $USER_IMAGE; ?>" width="50" height="50"/></span>
    <span class="f-name"><?php echo $FIRSTNAME; ?></span>
    <span class="l-name"><?php echo $LASTNAME; ?></span>
    <span class="n-name"><?php echo $level_row[NICKNAME]; ?></span>
    <span class="total-score"><?php echo $SCORE; ?></span>
    <span class="date-time"><?php echo $LASTPLAYED_DATE; ?></span>
  </div>
  <?php   ?>


<?php  }  else { ?>
  
   <div class="table-row">
  <?php 
$user_level  = "select NICKNAME from level where LEVEL_ID='$LEVEL_ID'";
$user_rank = mysql_query($user_level) or die (mysql_error());
$level_row=mysql_fetch_array($user_rank); ?>
    <span class="rank"><?php echo $user_friend_rank_pos; ?></span>
    <span class="user-avatar"><img src="<?php echo $USER_IMAGE; ?>" width="50" height="50"/></span>
    <span class="f-name"><?php echo $FIRSTNAME; ?></span>
    <span class="l-name"><?php echo $LASTNAME; ?></span>
    <span class="n-name"><?php echo $level_row[NICKNAME]; ?></span>
    <span class="total-score"><?php echo $SCORE; ?></span>
    <span class="date-time"><?php echo $LASTPLAYED_DATE; ?></span>
  </div>
  <?php $i++; } } 
  
  else { ?>
  
 <div class="table-row">
  <?php 
$user_level  = "select NICKNAME from level where LEVEL_ID='$LEVEL_ID'";
$user_rank = mysql_query($user_level) or die (mysql_error());
$level_row=mysql_fetch_array($user_rank); ?>
    <span class="rank"><?php echo $user_friend_rank_pos; ?></span>
    <span class="user-avatar"><img src="<?php echo $USER_IMAGE; ?>" width="50" height="50"/></span>
    <span class="f-name"><?php echo $FIRSTNAME; ?></span>
    <span class="l-name"><?php echo $LASTNAME; ?></span>
    <span class="n-name"><?php echo $level_row[NICKNAME]; ?></span>
    <span class="total-score"><?php echo $SCORE; ?></span>
    <span class="date-time"><?php echo $LASTPLAYED_DATE; ?></span>
  </div>
  <?php $i++; } } 
  ?>
  </div>

<?php }  ?>
</div>
<?php if($ijk != 6) { ?>

<h1>Your's Rank from your friends</h1>

  <div id="not-in-list" class="tableContainer">
    <div class="table-header">
    <span class="rank">Rank</span>
    <span class="user-avatar">User Avatar</span>
    <span class="f-name">First Name</span>   
    <span class="l-name">Last Name</span>
    <span class="l-name">Current Score</span>
     <span class="l-name">Total Cumulative Score</span>
    <span class="n-name">Level Nick Name</span>
    <!--<span class="total-score">Total Score</span>-->
    <span class="date-time">Date & Time of Occurrence</span>
   </div>
   
<div  class="table-body">
       <div class="table-row">
  <?php @extract($rowcnt);
$user_level  = "select NICKNAME from level where LEVEL_ID='$LEVEL_ID'";
$user_rank = mysql_query($user_level) or die (mysql_error());
$level_row=mysql_fetch_array($user_rank);  ?>
    <span class="rank"><?php echo $user_rank_pos; ?></span>
    <span class="user-avatar"><img src="<?php echo $USER_IMAGE; ?>" width="50" height="50"/></span>
    <span class="f-name"><?php echo $FIRSTNAME; ?></span>
    <span class="l-name"><?php echo $LASTNAME; ?></span>
    <span class="total-score"><?php echo $score_new; ?></span>
<?php $user_total_cum_query  = "select SUM(SCORE) user_total_cum from game where USER_ID='$user_id'";
$user_total_cum_result = mysql_query($user_total_cum_query) or die (mysql_error());
$user_total_cum_row=mysql_fetch_array($user_total_cum_result); ?>   
    
    <span class="total-score"><?php echo $user_total_cum_row[user_total_cum]; ?></span>
    <span class="n-name"><?php echo $level_row[NICKNAME]; ?></span>
    <!--<span class="total-score"><?php echo $SCORE; ?></span>-->
    <span class="date-time"><?php echo $LASTPLAYED_DATE; ?></span>
  </div>
      
   </div>
</div>

</div>



<?php } } }?>


<script language="javascript" src="js/user.js"></script>
  <div id="social_networking">
 <?php if($fb_id != "") {
			//if(isset($_SESSION['NEW']))
			//{
			?>
				<a href="facebook_post.php" class="" title="Facebook"><img src="images/facebook.png" alt="" /></a>
				<!--a href="final3.php" class="" ><img src="images/go-to-result.png" /></a-->
				<a href="final4.php" class="" ><img src="images/go-to-result.png" /></a>
			<?php
			
			}
			else
			{
				//automatic post of facebook share
			
			
			}
		//}
	
	
	?>
       
   
   
  <!-- <a href="#" class="" title="Twitter"><img src="images/twitter.png" alt="" /></a> -->
   
   <?php 
   if($fb_id == "") {
   if($user_id != "") {
   //if(isset($_SESSION['NEW']))
	//{
	?>
    
    <p class="align_center"><a href="email_to_friends.php" class="tell-a-friend" style="margin:0 5px 0 0"><img src="images/tell-a-friends.png" /></a><a href="final4.php" class="" ><img src="images/go-to-result.png" /></a></p>
    
	<?php
	
	}
   }
   ?>
   </div>

</div>
</div>
 
</body>
</html>
