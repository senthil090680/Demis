<?php
session_start();
include("admin/dbs.php");
$RandomStr = md5(microtime());
$token = substr($RandomStr,0,5);
if($_REQUEST['type']=="Save"){
		
		//datas from flash final level
				
		/*$user_id=$_SESSION['USER_ID'];
		$fb_id=$_SESSION['FACEBOOK_ID'];
		$user_temp=$_SESSION['USER_TEMP'];
		$score=$_REQUEST['score'];
		$level=$_REQUEST['level'];*/
		
		$user_id=1;
		//$fb_id=231232323232;
		//$user_temp=232;
		$score=2;
		$level=1;
		
		$bitdata=$_REQUEST['bitdata'];	
				
		if($user_id != "")
		{				
			$level_query = "select * from game where LEVEL_ID='$level'";			
			$level_result = mysql_query($level_query) or die("Data not found.");
			$level_num=mysql_num_rows($level_result);
			
			
			if($level_num > 0)
			{
				$score_row=mysql_fetch_array($level_result);
				$score1=$score_row['SCORE'];
				
				echo $score_final=$score1+score;
				$game_update = "update game set SCORE='$score_final', GAME_DATE=NOW() WHERE USER_ID='$user_id' and LEVEL_ID='$level'";
				$game_result = mysql_query($game_update) or die("Data not found.");
			}
			else
			{
				$game_insert = "insert into game (USER_ID,SCORE,LEVEL_ID,GAME_DATE) values('$user_id','$score','$level',NOW())";
				$game_insert_result = mysql_query($game_insert) or die("Data not found.");				
			}
			echo "saved";			
		}
		else if ($fb_id != "")
		{
			$user_id_query = "select USER_ID from user where FACEBOOK_ID='$fb_id'";			
			$user_id_result = mysql_query($user_id_query) or die("Data not found.");
			$user_id_row = mysql_fetch_array($user_id_result);
			$user_id1=$user_id_row['USER_ID'];
			
			$level_query = "select * from game where LEVEL_ID='$level'";			
			$level_result = mysql_query($level_query) or die("Data not found.");
			$level_num=mysql_num_rows($level_result);
			
			
			if($level_num > 0)
			{
				$score_row=mysql_fetch_array($level_result);
				$score1=$score_row['SCORE'];
				
				$score_final=$score1+score;
				$game_update = "update game set SCORE='$score_final', GAME_DATE=NOW() WHERE USER_ID='$user_id' and LEVEL_ID='$level'";
				$game_result = mysql_query($game_update) or die("Data not found.");
			}
			else
			{
				$game_insert = "insert into game (USER_ID,SCORE,LEVEL_ID,GAME_DATE) values('$user_id','$score','$level',NOW())";
				$game_insert_result = mysql_query($game_insert) or die("Data not found.");				
			}
			echo "saved";
		}
		else if($user_temp != "")
		{	
			if(!isset($_SESSION[user_temp])) {
				$_SESSION[user_temp]="user_temp".$token;
				$quiz_new_create=@mysql_query("create table $_SESSION[quiz_temp] (GAME_ID int primary key auto_increment, USER_ID int, SCORE varchar(200), LEVEL_ID int(11), GAME_DATE varchar(200))");
			}
			$level_query = "select * from $_SESSION[quiz_temp] where LEVEL_ID='$level'";			
			$level_result = mysql_query($level_query) or die("Data not found.");
			$level_num=mysql_num_rows($level_result);
			
			
			if($level_num > 0)
			{
				$score_row=mysql_fetch_array($level_result);
				$score1=$score_row['SCORE'];
				
				$score_final=$score1+score;
				$game_update = "update $_SESSION[quiz_temp] set SCORE='$score_final', GAME_DATE=NOW() WHERE USER_ID='$user_id' and LEVEL_ID='$level'";
				$game_result = mysql_query($game_update) or die("Data not found.");
			}
			else
			{
				$game_insert = "insert into $_SESSION[quiz_temp] (USER_ID,SCORE,LEVEL_ID,GAME_DATE) values('$user_id','$score','$level',NOW())";
				$game_insert_result = mysql_query($game_insert) or die("Data not found.");				
			}
			echo "register";			
		}
		
					
		
}
else if($_REQUEST['type']=="Insert"){
		
		//datas from flash for each level
		/*$user_id=$_SESSION['USER_ID'];
		$fb_id=$_SESSION['FACEBOOK_ID'];
		$user_temp=$_SESSION['USER_TEMP'];
		$score=$_REQUEST['score'];
		$level=$_REQUEST['level'];*/
		
		$user_id=1;
		//$fb_id=231232323232;
		//$user_temp=232;
		$score=2;
		$level=1;

		
		$bitdata=$_REQUEST['bitdata'];	
	
		if($user_id != "")
		{				
			echo $level_query = "select * from game where LEVEL_ID='$level'";			
			$level_result = mysql_query($level_query) or die("Data not found.");
			echo $level_num=mysql_num_rows($level_result);
			
			
			if($level_num > 0)
			{
				$score_row=mysql_fetch_array($level_result);
				$score1=$score_row['SCORE'];
				
				$score_final=$score1+score;
				echo $game_update = "update game set SCORE='$score_final', GAME_DATE=NOW() WHERE USER_ID='$user_id' and LEVEL_ID='$level'";
				$game_result = mysql_query($game_update) or die("Data not found.");
			}
			else
			{
				echo $game_insert = "insert into game (USER_ID,SCORE,LEVEL_ID,GAME_DATE) values('$user_id','$score','$level',NOW())";
				$game_insert_result = mysql_query($game_insert) or die("Data not found.");				
			}			
		}
		else if ($fb_id != "")
		{
			$user_id_query = "select USER_ID from user where FACEBOOK_ID='$fb_id'";			
			$user_id_result = mysql_query($user_id_query) or die("Data not found.");
			$user_id_row = mysql_fetch_array($user_id_result);
			$user_id1=$user_id_row['USER_ID'];
			
			$level_query = "select * from game where LEVEL_ID='$level'";			
			$level_result = mysql_query($level_query) or die("Data not found.");
			$level_num=mysql_num_rows($level_result);
			
			
			if($level_num > 0)
			{
				$score_row=mysql_fetch_array($level_result);
				$score1=$score_row['SCORE'];
				
				$score_final=$score1+score;
				$game_update = "update game set SCORE='$score_final', GAME_DATE=NOW() WHERE USER_ID='$user_id' and LEVEL_ID='$level'";
				$game_result = mysql_query($game_update) or die("Data not found.");
			}
			else
			{
				$game_insert = "insert into game (USER_ID,SCORE,LEVEL_ID,GAME_DATE) values('$user_id','$score','$level',NOW())";
				$game_insert_result = mysql_query($game_insert) or die("Data not found.");				
			}
		}
		else if($user_temp != "")
		{	
			if(!isset($_SESSION[user_temp])) {
				$_SESSION[user_temp]="user_temp".$token;
				$quiz_new_create=@mysql_query("create table $_SESSION[quiz_temp] (GAME_ID int primary key auto_increment, USER_ID int, SCORE varchar(200), LEVEL_ID int(11), GAME_DATE varchar(200))");
			}
			$level_query = "select * from $_SESSION[quiz_temp] where LEVEL_ID='$level'";			
			$level_result = mysql_query($level_query) or die("Data not found.");
			$level_num=mysql_num_rows($level_result);
			
			
			if($level_num > 0)
			{
				$score_row=mysql_fetch_array($level_result);
				$score1=$score_row['SCORE'];
				
				$score_final=$score1+score;
				$game_update = "update $_SESSION[quiz_temp] set SCORE='$score_final', GAME_DATE=NOW() WHERE USER_ID='$user_id' and LEVEL_ID='$level'";
				$game_result = mysql_query($game_update) or die("Data not found.");
			}
			else
			{
				$game_insert = "insert into $_SESSION[quiz_temp] (USER_ID,SCORE,LEVEL_ID,GAME_DATE) values('$user_id','$score','$level',NOW())";
				$game_insert_result = mysql_query($game_insert) or die("Data not found.");				
			}			
		}
}
?>