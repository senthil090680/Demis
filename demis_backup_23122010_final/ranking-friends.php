	<?php
session_start();
include("admin/dbs.php");
$RandomStr = md5(microtime());
$token = substr($RandomStr,0,5);
@extract($_REQUEST);
?>
<div id="result_friends" style="position:relative; float:left">
<?php
$user_id=$_SESSION['USER_ID'];
$fb_id=$_SESSION['FACEBOOK_ID'];
$score_new=$_SESSION['SCORE_NEW']; 
$level_new=$_SESSION['LEVEL_NEW']; 
$flakes_new=$_SESSION['FLAKES_NEW']; 

if($fb_id != "")
{
$userid_query = "select * from user where FACEBOOK_ID='$fb_id'";
$userid_result = mysql_query($userid_query) or die("Data not found.");
$userid_row= mysql_fetch_array($userid_result);
$user_id= $userid_row[USER_ID];
$fb_user=mysql_num_rows($userid_result); 

if($fb_user > 0){

$friend_rank  = "select * from user where FACEBOOK_ID in (select USER_FR_FB_ID from user_friend_fb where USER_ID = $fb_id)
UNION
select * from user where FACEBOOK_ID = $fb_id
ORDER BY ABS(SCORE) DESC limit 0,3";
$friend_rank_result = mysql_query($friend_rank) or die (mysql_error());
$friend_rank_num=mysql_num_rows($friend_rank_result);  ?>
<?php if($friend_rank_num > 0) { ?>
 <div class="tableContainer_friends">
   <div class="table-body_friends">
	  <div class="table-row_friends">
	    <span class="friends" style="font:Comic Sans; font-size:18px; font-weight:bold;">Tus amigos</span>
    	<span class="user-avatar_friends"><img src="images/facebook-icon.png" style="vertical-align:middle; height:19px; width:50px;" /></span>
	  </div>
  </div>
 </div>
 
 <div class="tableContainer_friends">

   <div class="table-body_friends">
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

  <table>
  <?php 
$user_level  = "select NICKNAME from level where LEVEL_ID='$LEVEL_ID'";
$user_rank = mysql_query($user_level) or die (mysql_error());
$level_row=mysql_fetch_array($user_rank); ?>
	<tr>
		<td>
			<img src="<?php echo $USER_IMAGE; ?>" width="35" height="35"/>
		</td>
		<td>
			<table>
				<tr>
					<td>
		    <span class="f-name_friends" style="font-size:12px"><?php echo $FIRSTNAME; ?></span>
					</td>
				</tr>
				<tr>
					<td>
					    <span class="total-score_friends" style="font-size:12px"><?php echo $SCORE . " copos"; ?></span>
					</td>
				</tr>
			</table>
		</td>
	</tr>       
  </table>
  <?php   ?>


<?php  }  else { ?>
  
<table>
  <?php 
$user_level  = "select NICKNAME from level where LEVEL_ID='$LEVEL_ID'";
$user_rank = mysql_query($user_level) or die (mysql_error());
$level_row=mysql_fetch_array($user_rank); ?>
    <!--span class="rank"><--?php echo $user_friend_rank_pos; ?></span-->
	<tr>
		<td>
			<img src="<?php echo $USER_IMAGE; ?>" width="35" height="35"/>
		</td>
		<td>
			<table>
				<tr>
					<td>
		    <span class="f-name_friends" style="font-size:12px"><?php echo $FIRSTNAME; ?></span>
					</td>
				</tr>
				<tr>
					<td>
					    <span class="total-score_friends" style="font-size:12px"><?php echo $SCORE . " copos"; ?></span>
					</td>
				</tr>
			</table>
		</td>
	</tr>       
  </table>
  <?php $i++; } } 
  
  else { ?>
  
<table>
  <?php 
$user_level  = "select NICKNAME from level where LEVEL_ID='$LEVEL_ID'";
$user_rank = mysql_query($user_level) or die (mysql_error());
$level_row=mysql_fetch_array($user_rank); ?>
    <!--span class="rank"><--?php echo $user_friend_rank_pos; ?></span-->
	<tr>
		<td>
			<img src="<?php echo $USER_IMAGE; ?>" width="35" height="35"/>
		</td>
		<td>
			<table>
				<tr>
					<td>
		    <span class="f-name_friends" style="font-size:12px"><?php echo $FIRSTNAME; ?></span>
					</td>
				</tr>
				<tr>
					<td>
					    <span class="total-score_friends" style="font-size:12px"><?php echo $SCORE . " copos"; ?></span>
					</td>
				</tr>
			</table>
		</td>
	</tr>       
  </table>
<?php $i++; } } 
  ?>
  </div>

<?php }  ?>
</div>
<?php if($ijk != 6) { ?>


 <div class="tableContainer_friends">
   <div class="table-body_friends">
	  <div class="table-row_friends">
	    <span class="friends" style="font:Comic Sans; font-size:18px; font-weight:bold;">Tus amigos</span>
<span class="user-avatar_friends"><img src="images/facebook-icon.png" style="vertical-align:middle; height:19px; width:50px;" /></span>
	  </div>
  </div>
 </div>
   
<table>
  <?php @extract($rowcnt);
$user_level  = "select NICKNAME from level where LEVEL_ID='$LEVEL_ID'";
$user_rank = mysql_query($user_level) or die (mysql_error());
$level_row=mysql_fetch_array($user_rank);  ?>
    <!--span class="rank"><--?php echo $user_friend_rank_pos; ?></span-->
	<tr>
		<td>
			<img src="<?php echo $USER_IMAGE; ?>" width="35" height="35"/>
		</td>
		<td>
			<table>
				<tr>
					<td>
		    <span class="f-name_friends" style="font-size:12px"><?php echo $FIRSTNAME; ?></span>
					</td>
				</tr>
				<tr>
					<td>
					    <span class="total-score_friends" style="font-size:12px"><?php echo $SCORE . " copos"; ?></span>
					</td>
				</tr>
			</table>
		</td>
	</tr>       
  </table>

</div>



<?php } } }?>

</div>
</div>
