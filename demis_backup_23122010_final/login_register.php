<?php
session_start();
include("admin/dbs.php");

@extract($_REQUEST);

//echo '0';

if( isset($_REQUEST['submit_login']) ){
	  
			  $user_temp=$_SESSION['USER_TEMP'];		 
			  $user_count  = "select * from user where USERNAME=BINARY('{$_REQUEST[username]}') and PASSWORD=BINARY('{$_REQUEST[password]}')";
			  
			  
			  $result = mysql_query($user_count) or die (mysql_error());
		  	  $num=mysql_num_rows($result);	
			  //exit;
			   
			  if($num>0)
			   { 						
					$row = mysql_fetch_array($result);
					$userid=$row[USER_ID];
					
					$_SESSION['USER_ID'] = $userid;
					if(isset($_SESSION['user_tem'])) {						
						//echo $temp_to_userid_query = "update $_SESSION[user_tem] set USER_ID='$userid' where USER_ID=232";
						$temp_to_userid_query = "update $_SESSION[user_tem] set USER_ID='$userid' where USER_ID='$user_temp'";
						$temp_to_userid_result = mysql_query($temp_to_userid_query) or die("Data not found.");
						
						$userto_game_query = "insert into game (USER_ID,SCORE,FLAKES,LEVEL_ID,GAME_DATE,PIC_PATH) SELECT USER_ID,SCORE,FLAKES,LEVEL_ID,GAME_DATE,PIC_PATH from $_SESSION[user_tem]";
						$userto_game_result = mysql_query($userto_game_query) or die("Data not found.");
						
						$drop_query = "drop table $_SESSION[user_tem]";
						$drop_result = mysql_query($drop_query) or die("Data not found.");
						
						$image_query = "update user set PIC_PATH='{$_SESSION[PIC_IMAGE]}' where USER_ID='$userid'";			
						$image_result = mysql_query($image_query) or die("Data not found.");
						
						$game_datas = "select SUM(SCORE) AS game_score, SUM(FLAKES) AS game_flakes from game WHERE USER_ID='$userid'";
						$game_datas_result = mysql_query($game_datas) or die("Data not found.");				
						$game_datas_row = mysql_fetch_array($game_datas_result) or die("Data not found.");	
						$game_score=$game_datas_row['game_score'];
						$game_flakes=$game_datas_row['game_flakes'];
						
						$user_insert = "update user set SCORE='$game_score', FLAKES='$game_flakes', LEVEL_ID='{$_SESSION['LEVEL_NEW']}',LASTPLAYED_DATE=NOW() where USER_ID='$userid'";
						$game_insert_result = mysql_query($user_insert) or die("Data not found.");
						
						$_SESSION['user_tem'] = "";
						}
					
					echo 1;
					exit(0);
			   }
			 else if ($num == 0)
			 {				
					echo 0;
					exit(0);
			 }
		}


if( isset( $_GET['submit_register'] ) ){
	  
			  echo $user_count  = "select * from user where USERNAME='{$_POST[username]}'";
			  //exit;
			  $result = mysql_query($user_count) or die (mysql_error());
		  	  $num=mysql_num_rows($result);	
			  
			   
			  if($num>0)
			   { 						
					//echo $msg_1 = "Username Already Exists in DB. Plz Choose New Username!.";		
					//echo 0;		
			 }
			 else
			 {
					//echo "insert into level (LEVEL_ID,LEVEL_DESC,POINTS_BEAT,SNOW_FREQUENCY,SNOW_MAXSPEED,NICKNAME) values('{$_POST[level_id]}','$level_desc','$points_beat','$snow_frequency','$snow_maxspeed','$nickname')";
					//exit;
					$photo=$token.$_FILES['user_image']['name'];
					$path='admin/images/user/';
					$tmp=$_FILES['user_image']['tmp_name'];
					$filepath=$path.$photo;
					//exit;
					move_uploaded_file($tmp,$filepath);										
					
					//$userinsert_query = "insert into user (USERNAME,PASSWORD,FIRSTNAME,LASTNAME,FACEBOOK_ID,TWITTER_ID,EMAIL,GENDER,USER_IMAGE,REGISTERED_DATE,STATUS) values('$username','$password','$firstname','$lastname','$fb_id','$twitter_id','$email','$gender','$photo',NOW(),'1')";

					echo $userinsert_query = "insert into user (USERNAME,PASSWORD,FIRSTNAME,LASTNAME,EMAIL,GENDER,USER_IMAGE,REGISTERED_DATE,STATUS) values('$username','$password','$firstname','$lastname','$email','$gender','$photo',NOW(),'1')";
					
					$result = mysql_query($userinsert_query) or die (mysql_error());						   		
					if( $result ) 
					{	
						$user_count  = "select * from user where USERNAME='$username'";			  
			  
						$result = mysql_query($user_count) or die (mysql_error());
						$row = mysql_fetch_array($result);
						echo $row[USER_ID];
						
						
						echo '<script language="javascript">
						function redirect()
						{
						window.document.location.href=\'play-page.php\';
						}
						window.setTimeout(\'redirect()\',0);</script>';
						$msg = "Successfully the username has been added to the list.";	
						
						exit(0);
						//echo 1;			
					}
					else
					{	
						//echo $msg = "Username cannot be added to the list due to some DB errors!.";				
						echo 2;				
				    }	
			 }
		}







if( isset($_GET['submit_for']) ){
	  
			  			 
			  //$email="senthil_sang24@yahoo.co.in";
			  $pass_count  = "select * from user where EMAIL=BINARY('$email')";
			  //exit;
			  
			  $result = mysql_query($pass_count) or die (mysql_error());
			  
			  $row=mysql_fetch_array($result);
			  
			  $password1=$row[PASSWORD];
		  	  
			  
			 //to			  
			  $to = $email;
		
			// subject
			$subject = "PASSWORD CHECK" ;
			
			// message
			$message = '
			<table width="550" border="0" align="center" cellpadding="6" cellspacing="0">
			<tr valign="top"> 
			<td colspan="2" class="tdtext"><table width="100%" border="0" cellspacing="0" cellpadding="0">
			</table></td>
			</tr>
			<tr valign="top"> 
			<td width="25%" class="tdtext" nowrap>Your Password is</td>
			<td width="75%" class="tdtext">'.$password1.'.
			</td>
			</tr>						
			</table>
			';
			
			/*$from_email="senthil@digient.in";
			// To send HTML mail, the Content-type header must be set
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
			$headers .= "From: ".$from_email."\r\n";*/
			
			
			// To send HTML mail, the Content-type header must be set
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			// Additional headers
			$headers .= "To: $email \r\n";
			$headers .= "From: senthil@digient.in \r\n";
			// Mail it
			mail($to, $subject, $message, $headers);
			
			if(mail)
			{
				echo 1;
			}
			else
			{
				echo 0;
			}
			  
		}


?>