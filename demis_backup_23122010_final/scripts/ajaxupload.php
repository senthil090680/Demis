<?php
ob_start();
session_start();
include("../admin/dbs.php");
$RandomStr = md5(microtime());
$token = substr($RandomStr,0,5);
@extract($_REQUEST);



	$user_count  = "select * from user where USERNAME='{$_REQUEST[username]}'";
			  //exit;
			  $result = mysql_query($user_count) or die (mysql_error());
		  	  $num=mysql_num_rows($result);	
			  
			   
			  if($num>0)
			   { 						
					echo "Username Already Exists in DB. Plz Choose New Username!.";		
					//echo 0;		
			   }
			 else
			 {
					//echo "insert into level (LEVEL_ID,LEVEL_DESC,POINTS_BEAT,SNOW_FREQUENCY,SNOW_MAXSPEED,NICKNAME) values('{$_POST[level_id]}','$level_desc','$points_beat','$snow_frequency','$snow_maxspeed','$nickname')";
					//exit;
					$photo=$token.$_FILES['user_image']['name'];
					
					
					/* function curPageURL() {
					 $pageURL = 'http';
					 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
					 $pageURL .= "://";
					 if ($_SERVER["SERVER_PORT"] != "80") {
					  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
					 } else {
					  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
					 }
					 return $pageURL;
					}
						 
					$url_find = curPageURL(); 
					echo $image_url=str_replace("scripts/ajaxupload.php","admin/images/user/",$url_find);
					
					$path=$image_url;*/
					$path='../admin/images/user/';
					$tmp=$_FILES['user_image']['tmp_name'];
					$filepath=$path.$photo;
					//exit;
					$move_photo = move_uploaded_file($tmp,$filepath);										
										
					//$userinsert_query = "insert into user (USERNAME,PASSWORD,FIRSTNAME,LASTNAME,FACEBOOK_ID,TWITTER_ID,EMAIL,GENDER,USER_IMAGE,REGISTERED_DATE,STATUS) values('$username','$password','$firstname','$lastname','$fb_id','$twitter_id','$email','$gender','$photo',NOW(),'1')";

					$userinsert_query = "insert into user (USERNAME,PASSWORD,FIRSTNAME,LASTNAME,EMAIL,GENDER,USER_IMAGE,REGISTERED_DATE,STATUS) values('$username','$password','$firstname','$lastname','$email','$gender','$photo',NOW(),'1')";
					
					$result = mysql_query($userinsert_query) or die (mysql_error());						   		
					if( $result ) 
					{	
						$user_count  = "select USER_ID from user where USERNAME='$username'";			  
						$result = mysql_query($user_count) or die (mysql_error());
						$row = mysql_fetch_array($result);
						$userid = $row[USER_ID];
						
						
						
						
						$_SESSION['NEW'] = "1233";
						//header("Location:../index.php");
						
/*						echo '<script language="javascript">
						function redirect()
						{
						window.document.location.href=\'../index.php?msg=Successfully the username has been added.\';
						}
						window.setTimeout(\'redirect()\',0);</script>';
*/						//echo 1;	
						
						//exit(0);
						//echo 1;
						echo "Successfully the username has been added.  Click login to Continue";	
						//echo 1;			
					}
					else
					{	
						echo "Username cannot be added to the list due to some DB errors!.";				
						//echo 2;				
				    }	
			 }
?>