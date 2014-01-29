<?php
session_start();
include("admin/dbs.php");
$RandomStr = md5(microtime());
$token = substr($RandomStr,0,5);
/*echo "<pre>";
print_r($_SESSION);
print_r($_COOKIE);
echo "</pre>";*/

if($_REQUEST['type']=="Save"){
		
		$_SESSION[PIC_IMAGE] = '';
		$score=$_REQUEST['score'];
		$level=$_REQUEST['level'];	
		$flakes=$_REQUEST['flakes'];
		$bitdata=$_REQUEST['bitdata'];
				
		$_SESSION['score_flash']=$score;
		$_SESSION['level_flash']=$level;
		$_SESSION['flakes_flash']=$flakes;
		$_SESSION['bitdata_flash']=$bitdata;
		$_SESSION['type_flash']=$_REQUEST['type'];
		
		if(isset($_SESSION['USER_ID'])) {
			$user_id=$_SESSION['USER_ID'];
		}
		else if(isset($_SESSION['FACEBOOK_ID'])) {		
			$fb_id=$_SESSION['FACEBOOK_ID'];
		}
		else if($_SESSION['USER_TEMP'] != '' ) {						
			$user_temp=$_SESSION['USER_TEMP'];						
		}
		else if((isset($_SESSION['USER_TEMP'])) && ($_SESSION['USER_TEMP'] == '')) {
			$user_temp=$token;						
			$_SESSION['USER_TEMP']=$user_temp;						
		}
		else if(!isset($_SESSION['USER_TEMP'])) {		
			$user_temp=$token;
			$_SESSION['USER_TEMP']=$user_temp;
		}

		
		
		/*if(!isset($_SESSION['USER_TEMP'])) {		
			$user_temp=$token;
			$_SESSION['USER_TEMP']=$user_temp;
		}
		else
		{	
			if(isset($_SESSION['USER_ID'])) {
				$user_id=$_SESSION['USER_ID'];
			}
			else if(isset($_SESSION['FACEBOOK_ID'])) {		
				$fb_id=$_SESSION['FACEBOOK_ID'];
			}
			else if($_SESSION['USER_TEMP'] != '' ) {						
				$user_temp=$_SESSION['USER_TEMP'];						
			}
			else if((isset($_SESSION['USER_TEMP'])) && ($_SESSION['USER_TEMP'] == '')) {
				$user_temp=$token;						
				$_SESSION['USER_TEMP']=$user_temp;						
			}
		}*/
					
		//$score = 3;
	
		if(!isset($_SESSION['SCORE_NEW'])) {
			$_SESSION['SCORE_NEW'] = $score;
		}
		else {				
			$_SESSION['SCORE_NEW'] = $_SESSION['SCORE_NEW']+$score;
		}
		
		$_SESSION['LEVEL_NEW'] = $level;
		
		if(!isset($_SESSION['FLAKES_NEW'])) {
			$_SESSION['FLAKES_NEW'] = $flakes;
		}
		else {				
			$_SESSION['FLAKES_NEW'] = $_SESSION['FLAKES_NEW']+$flakes;
		}
		
		
		
		

		if($user_id != "")
		{	
			$level_query = "select * from game where LEVEL_ID='$level' and USER_ID='$user_id'";			
			$level_result = mysql_query($level_query) or die("Data not found.");
			$level_num=mysql_num_rows($level_result);
			
			//modificado para siempre insertar
			$level_num=0;
			
			if($level_num > 0)
			{
				$score_row=mysql_fetch_array($level_result);
				$score1=$score_row['SCORE'];
				$score_final=$score1+$score;

				$flakes1=$score_row['FLAKES'];
				$flakes_final=$flakes1+$flakes;
				
				//$game_update = "update game set SCORE='$score_final', FLAKES='$flakes_final', GAME_DATE=NOW() WHERE USER_ID='$user_id' and LEVEL_ID='$level'";
				$game_update = "insert into game (USER_ID,SCORE,FLAKES,LEVEL_ID,GAME_DATE) values('$user_id','$score','$flakes','$level',NOW())";
				$game_result = mysql_query($game_update) or die("Data not found.");
			}
			else
			{
				$game_insert = "insert into game (USER_ID,SCORE,FLAKES,LEVEL_ID,GAME_DATE) values('$user_id','$score','$flakes','$level',NOW())";
				$game_insert_result = mysql_query($game_insert) or die("Data not found.");				
			}
			
				$game_datas = "select SUM(SCORE) AS game_score, SUM(FLAKES) AS game_flakes from game WHERE USER_ID='$user_id'";
				$game_datas_result = mysql_query($game_datas) or die("Data not found.");				
				$game_datas_row = mysql_fetch_array($game_datas_result) or die("Data not found.");	
				$game_score=$game_datas_row['game_score'];
				$game_flakes=$game_datas_row['game_flakes'];
				
				$user_insert = "update user set SCORE='$game_score', FLAKES='$game_flakes', LEVEL_ID='{$_SESSION['LEVEL_NEW']}',LASTPLAYED_DATE=NOW() where USER_ID='$user_id'";
				$game_insert_result = mysql_query($user_insert) or die("Data not found.");			
			if($bitdata != '')
		{
			$_SESSION['LEVEL_NEW'] = 11;
			function curPageURL() {
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
			
			
			//$url_image = str_replace("data.php","test.jpg",$url_find);
			
			
		   function display_img($imgcode,$type,$id,$path)  
		   {  
			  header('Content-type: image/'.$type);  
			  //header('Content-length: '.size($imgcode));  
			  //echo base64_decode($imgcode);  
			  
			  	$s_Filename = "images/user/webcam_picture/$path";								
				$image_query = "update user set PIC_PATH='$path' where USER_ID='$id'";			
				$image_result = mysql_query($image_query) or die("Data not found.");

			 $data = base64_decode($imgcode);
			 file_put_contents($s_Filename, $data); 
		   }   
		   
		   function display_img1($imgcode1,$type1,$id1,$path1)  
		   {  
			  header('Content-type: image/'.$type1);  
			  //header('Content-length: '.size($imgcode));  
			  //echo base64_decode($imgcode);  
			  
			  	$s_Filename = "images/user/webcam_picture/$path1";
				$image_query = "update $_SESSION[user_tem] set PIC_PATH='$path1' where USER_ID='$id1'";			
				$image_result = mysql_query($image_query) or die("Data not found.");

			 $data = base64_decode($imgcode);
			 file_put_contents($s_Filename, $data); 
		   }   
		   
			//display_img($bitdata,"png");
			if($user_id != '') {
				$image_path = $user_id.$token."_webimage.jpg";
				$_SESSION['PIC_IMAGE'] = $image_path;
				
				$pic_query = "select PIC_PATH from user where USER_ID='{$user_id}'";			
				$pic_result = mysql_query($pic_query) or die("Data not found.");
				$pic_num = mysql_num_rows($pic_result);
				
				if($pic_num > 0) {
					$pic_row=mysql_fetch_array($pic_result);
					echo $pic=$pic_row[PIC_PATH];
					$path = "http://nieveenlima.pe/juego_dev/images/user/webcam_picture/";
					unlink("$path".$pic);
				}
				
				display_img($bitdata,"png",$user_id,$image_path);
			}
			if(isset($_SESSION[FACEBOOK_ID])) {
				$image_path = $fb_id."_webimage.jpg";
				$_SESSION['PIC_IMAGE'] = $image_path;
				$image_user_id_query = "select USER_ID from user where FACEBOOK_ID='{$_SESSION[FACEBOOK_ID]}'";			
				$image_user_id_result = mysql_query($image_user_id_query) or die("Data not found.");
				$image_user_id_row = mysql_fetch_array($image_user_id_result);
				$image_user_id=$image_user_id_row['USER_ID'];	
				display_img($bitdata,"png",$image_user_id,$image_path);
			}
			if($user_temp != '') {
				$image_path = $user_temp."_webimage.jpg";
				$_SESSION['PIC_IMAGE'] = $image_path;
				display_img1($bitdata,"png",$user_temp,$image_path);
			}
			//$image_query = "update user set PIC_PATH='$flData' where USER_ID='68'";			
			//$image_result = mysql_query($image_query) or die("Data not found.");*/						
		}
			echo "saved";		
		}
		else if ($fb_id != "")
		{
					
			$user_id_query = "select USER_ID from user where FACEBOOK_ID='$fb_id'";			
			$user_id_result = mysql_query($user_id_query) or die("Data not found.");
			$user_id_row = mysql_fetch_array($user_id_result);
			$user_id1=$user_id_row['USER_ID'];
			
			$level_query = "select * from game where LEVEL_ID='$level' and USER_ID='$user_id1'";			
			$level_result = mysql_query($level_query) or die("Data not found.");
			$level_num=mysql_num_rows($level_result);
			
			//modificado para siempre insertar
			$level_num=0;
			if($level_num > 0)
			{
				$score_row=mysql_fetch_array($level_result);
				$score1=$score_row['SCORE'];				
				$score_final=$score1+$score;
				$flakes1=$score_row['FLAKES'];
				$flakes_final=$flakes1+$flakes;
				//$game_update = "update game set SCORE='$score_final', FLAKES='$flakes_final', GAME_DATE=NOW() WHERE USER_ID='$user_id1' and LEVEL_ID='$level'";
				$game_update = "insert into game (USER_ID,SCORE,FLAKES,LEVEL_ID,GAME_DATE) values('$user_id1','$score','$flakes','$level',NOW())";
				$game_result = mysql_query($game_update) or die("Data not found.");
			}
			else
			{
				$game_insert = "insert into game (USER_ID,SCORE,FLAKES,LEVEL_ID,GAME_DATE) values('$user_id1','$score','$flakes','$level',NOW())";
				$game_insert_result = mysql_query($game_insert) or die("Data not found.");				
			}
			$game_datas = "select SUM(SCORE) AS game_score, SUM(FLAKES) AS game_flakes from game WHERE USER_ID='$user_id1'";
			$game_datas_result = mysql_query($game_datas) or die("Data not found.");				
			$game_datas_row = mysql_fetch_array($game_datas_result) or die("Data not found.");	
			$game_score=$game_datas_row['game_score'];
			$game_flakes=$game_datas_row['game_flakes'];
			
			$user_insert = "update user set SCORE='$game_score', FLAKES='$game_flakes', LEVEL_ID='{$_SESSION['LEVEL_NEW']}',LASTPLAYED_DATE=NOW() where USER_ID='$user_id1'";
			$game_insert_result = mysql_query($user_insert) or die("Data not found.");	
			if($bitdata != '')
		{
			$_SESSION['LEVEL_NEW'] = 11;
			function curPageURL() {
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
			
			
			//$url_image = str_replace("data.php","test.jpg",$url_find);
			
			
		   function display_img($imgcode,$type,$id,$path)  
		   {  
			  header('Content-type: image/'.$type);  
			  //header('Content-length: '.size($imgcode));  
			  //echo base64_decode($imgcode);  
			  
			  	$s_Filename = "images/user/webcam_picture/$path";								
				$image_query = "update user set PIC_PATH='$path' where USER_ID='$id'";			
				$image_result = mysql_query($image_query) or die("Data not found.");

			 $data = base64_decode($imgcode);
			 file_put_contents($s_Filename, $data); 
		   }   
		   
		   function display_img1($imgcode1,$type1,$id1,$path1)  
		   {  
			  header('Content-type: image/'.$type1);  
			  //header('Content-length: '.size($imgcode));  
			  //echo base64_decode($imgcode);  
			  
			  	$s_Filename = "images/user/webcam_picture/$path1";
				$image_query = "update $_SESSION[user_tem] set PIC_PATH='$path1' where USER_ID='$id1'";			
				$image_result = mysql_query($image_query) or die("Data not found.");

			 $data = base64_decode($imgcode);
			 file_put_contents($s_Filename, $data); 
		   }   
		   
			//display_img($bitdata,"png");
			if($user_id != '') {
				$image_path = $user_id."_webimage.jpg";
				$_SESSION['PIC_IMAGE'] = $image_path;
				display_img($bitdata,"png",$user_id,$image_path);
			}
			if(isset($_SESSION[FACEBOOK_ID])) {
				$image_path = $fb_id.$token."_webimage.jpg";
				$_SESSION['PIC_IMAGE'] = $image_path;
				
				
				$pic_query = "select PIC_PATH from user where FACEBOOK_ID='{$_SESSION[FACEBOOK_ID]}'";			
				$pic_result = mysql_query($pic_query) or die("Data not found.");
				$pic_num = mysql_num_rows($pic_result);
				
				if($pic_num > 0) {
					$pic_row=mysql_fetch_array($pic_result);
					echo $pic=$pic_row[PIC_PATH];
					$path = "http://nieveenlima.pe/juego_dev/images/user/webcam_picture/";
					unlink("$path".$pic);
				}
				
				
				
				
				$image_user_id_query = "select USER_ID from user where FACEBOOK_ID='{$_SESSION[FACEBOOK_ID]}'";			
				$image_user_id_result = mysql_query($image_user_id_query) or die("Data not found.");
				$image_user_id_row = mysql_fetch_array($image_user_id_result);
				$image_user_id=$image_user_id_row['USER_ID'];	
				display_img($bitdata,"png",$image_user_id,$image_path);
			}
			if($user_temp != '') {
				$image_path = $user_temp."_webimage.jpg";
				$_SESSION['PIC_IMAGE'] = $image_path;
				display_img1($bitdata,"png",$user_temp,$image_path);
			}
			//$image_query = "update user set PIC_PATH='$flData' where USER_ID='68'";			
			//$image_result = mysql_query($image_query) or die("Data not found.");*/						
		}
			
			echo "saved";
		}
		else if($user_temp != "")
		{	
			$temp_flakes_query = "select FLAKES from game where USER_ID='temp'";			
			$temp_flakes_result = mysql_query($temp_flakes_query) or die("Data not found.");
			$temp_flakes_num=mysql_num_rows($temp_flakes_result);
			$temp_flakes_num;
			/*if($temp_flakes_num == 0 ) {
				echo "sdfsdfsd";
				$temp_flakes_final=$_SESSION['FLAKES_NEW'];
			}
			else
			{	*/
				$temp_flakes_row=mysql_fetch_array($temp_flakes_result);
				$temp_flakes1=$temp_flakes_row['FLAKES'];
				$temp_flakes_final=$temp_flakes1+$_SESSION['FLAKES_NEW'];
			//}
			
			$temp_flakes_update_query = "update game set FLAKES='$temp_flakes_final' where USER_ID='temp'";			
			$temp_flakes_update_result = mysql_query($temp_flakes_update_query) or die("Data not found.");
				

			if(!isset($_SESSION[user_tem])) {
				$_SESSION['USER_TEMP']=$user_temp;
				$_SESSION[user_tem]="user_temp".$token;
				
				$quiz_new_create=@mysql_query("create table $_SESSION[user_tem] (GAME_ID int primary key auto_increment, USER_ID varchar(200), SCORE varchar(200), FLAKES varchar(200), LEVEL_ID int(11), GAME_DATE varchar(200), PIC_PATH varchar(200))");
			}
			$level_query = "select * from $_SESSION[user_tem] where LEVEL_ID='$level' and USER_ID='$user_temp'";			
			$level_result = mysql_query($level_query) or die("Data not found.");
			$level_num=mysql_num_rows($level_result);
			
			
			if($level_num > 0)
			{
				$score_row=mysql_fetch_array($level_result);
				$score1=$score_row['SCORE'];				
				$score_final=$score1+$score;
				$flakes1=$score_row['FLAKES'];
				$flakes_final=$flakes1+$flakes;
				
				$game_update = "update $_SESSION[user_tem] set SCORE='$score_final', FLAKES='$flakes', GAME_DATE=NOW() WHERE USER_ID='$user_temp' and LEVEL_ID='$level'";
				$game_result = mysql_query($game_update) or die("Data not found.");
			}
			else
			{
				$game_insert = "insert into $_SESSION[user_tem] (USER_ID,SCORE,FLAKES,LEVEL_ID,GAME_DATE) values('$user_temp','$score','$flakes','{$_SESSION[LEVEL_NEW]}',NOW())";
				$game_insert_result = mysql_query($game_insert) or die("Data not found.");				
			}
		
		if($bitdata != '')
		{
			$_SESSION['LEVEL_NEW'] = 11;
			function curPageURL() {
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
			
			
			//$url_image = str_replace("data.php","test.jpg",$url_find);
			
			
		   function display_img($imgcode,$type,$id,$path)  
		   {  
			  header('Content-type: image/'.$type);  
			  //header('Content-length: '.size($imgcode));  
			  //echo base64_decode($imgcode);  
			  
			  	$s_Filename = "images/user/webcam_picture/$path";								
				$image_query = "update user set PIC_PATH='$path' where USER_ID='$id'";			
				$image_result = mysql_query($image_query) or die("Data not found.");

			 $data = base64_decode($imgcode);
			 file_put_contents($s_Filename, $data); 
		   }   
		   
		   function display_img1($imgcode1,$type1,$id1,$path1)  
		   {  
			  header('Content-type: image/'.$type1);  
			  //header('Content-length: '.size($imgcode));  
			  //echo base64_decode($imgcode);  
			  
			  	$s_Filename = "images/user/webcam_picture/$path1";
				$image_query = "update $_SESSION[user_tem] set PIC_PATH='$path1' where USER_ID='$id1'";			
				$image_result = mysql_query($image_query) or die("Data not found.");

			 $data = base64_decode($imgcode1);
			 file_put_contents($s_Filename, $data); 
		   }   
		   
			//display_img($bitdata,"png");
			if($user_id != '') {
				$image_path = $user_id."_webimage.jpg";
				$_SESSION['PIC_IMAGE'] = $image_path;
				display_img($bitdata,"png",$user_id,$image_path);
			}
			if(isset($_SESSION[FACEBOOK_ID])) {
				$image_path = $fb_id."_webimage.jpg";
				$_SESSION['PIC_IMAGE'] = $image_path;
				$image_user_id_query = "select USER_ID from user where FACEBOOK_ID='{$_SESSION[FACEBOOK_ID]}'";			
				$image_user_id_result = mysql_query($image_user_id_query) or die("Data not found.");
				$image_user_id_row = mysql_fetch_array($image_user_id_result);
				$image_user_id=$image_user_id_row['USER_ID'];	
				display_img($bitdata,"png",$image_user_id,$image_path);
			}
			if($user_temp != '') {
				$image_path = $user_temp."_webimage.jpg";
				$_SESSION['PIC_IMAGE'] = $image_path;
				display_img1($bitdata,"png",$user_temp,$image_path);
			}
			//$image_query = "update user set PIC_PATH='$flData' where USER_ID='68'";			
			//$image_result = mysql_query($image_query) or die("Data not found.");*/						
		}
			$val = "register";
			$val = trim($val);
			echo $val;
		}
		

}
else if($_REQUEST['type']=="Insert"){
		
		//datas from flash for each level
		
		$_SESSION[PIC_IMAGE] = '';
		if(isset($_SESSION['USER_ID'])) {
			$user_id=$_SESSION['USER_ID'];
		}
		else if(isset($_SESSION['FACEBOOK_ID'])) {		
			$fb_id=$_SESSION['FACEBOOK_ID'];
		}
		else if($_SESSION['USER_TEMP'] != '' ) {						
			$user_temp=$_SESSION['USER_TEMP'];						
		}
		else if((isset($_SESSION['USER_TEMP'])) && ($_SESSION['USER_TEMP'] == '')) {
			$user_temp=$token;						
			$_SESSION['USER_TEMP']=$user_temp;						
		}
		else if(!isset($_SESSION['USER_TEMP'])) {		
			$user_temp=$token;
			$_SESSION['USER_TEMP']=$user_temp;
		}
		
		
		/*if(!isset($_SESSION['USER_TEMP'])) {		
			$user_temp=$token;
			$_SESSION['USER_TEMP']=$user_temp;
		}
		else
		{	
			if(isset($_SESSION['USER_ID'])) {
				$user_id=$_SESSION['USER_ID'];
			}
			else if(isset($_SESSION['FACEBOOK_ID'])) {		
				$fb_id=$_SESSION['FACEBOOK_ID'];
			}
			else if($_SESSION['USER_TEMP'] != '' ) {						
				$user_temp=$_SESSION['USER_TEMP'];						
			}
			else if((isset($_SESSION['USER_TEMP'])) && ($_SESSION['USER_TEMP'] == '')) {
				$user_temp=$token;						
				$_SESSION['USER_TEMP']=$user_temp;						
			}
		}*/
		
		
		$score=$_REQUEST['score'];
		$level=$_REQUEST['level'];		
		$flakes=$_REQUEST['flakes'];
		
				
		if(!isset($_SESSION['SCORE_NEW'])) {
			$_SESSION['SCORE_NEW'] = $score;
		}
		else {				
			$_SESSION['SCORE_NEW'] = $_SESSION['SCORE_NEW']+$score;
		}
		
		$_SESSION['LEVEL_NEW'] = $level;
		
		if(!isset($_SESSION['FLAKES_NEW'])) {
			$_SESSION['FLAKES_NEW'] = $flakes;
		}
		else {				
			$_SESSION['FLAKES_NEW'] = $_SESSION['FLAKES_NEW']+$flakes;
		}		
		
		
		
		if($user_id != "")
		{				
			$level_query = "select * from game where LEVEL_ID='$level' and USER_ID='$user_id'";			
			$level_result = mysql_query($level_query) or die("Data not found.");
			$level_num=mysql_num_rows($level_result);
			
			//modificado para siempre insertar
			$level_num=0;
			if($level_num > 0)
			{
				$score_row=mysql_fetch_array($level_result);
				$score1=$score_row['SCORE'];
				$score_final=$score1+$score;
				
				$flakes1=$score_row['FLAKES'];
				$flakes_final=$flakes1+$flakes;
				
				//$game_update = "update game set SCORE='$score_final', FLAKES='$flakes_final', GAME_DATE=NOW() WHERE USER_ID='$user_id' and LEVEL_ID='$level'";
				$game_update = "insert into game (USER_ID,SCORE,FLAKES,LEVEL_ID,GAME_DATE) values('$user_id','$flakes','$score','$level',NOW())";
				$game_result = mysql_query($game_update) or die("Data not found.");
			}
			else
			{
				$game_insert = "insert into game (USER_ID,SCORE,FLAKES,LEVEL_ID,GAME_DATE) values('$user_id','$flakes','$score','$level',NOW())";
				$game_insert_result = mysql_query($game_insert) or die("Data not found.");				
			}
			$game_datas = "select SUM(SCORE) AS game_score, SUM(FLAKES) AS game_flakes from game WHERE USER_ID='$user_id'";
			$game_datas_result = mysql_query($game_datas) or die("Data not found.");				
			$game_datas_row = mysql_fetch_array($game_datas_result) or die("Data not found.");	
			$game_score=$game_datas_row['game_score'];
			$game_flakes=$game_datas_row['game_flakes'];
			
			$user_insert = "update user set SCORE='$game_score', FLAKES='$game_flakes', LEVEL_ID='{$_SESSION['LEVEL_NEW']}',LASTPLAYED_DATE=NOW() where USER_ID='$user_id'";
			$game_insert_result = mysql_query($user_insert) or die("Data not found.");							
		}
		else if ($fb_id != "")
		{
			$user_id_query = "select USER_ID from user where FACEBOOK_ID='$fb_id'";			
						
			$user_id_result = mysql_query($user_id_query) or die("Data not found.");
			$user_id_row = mysql_fetch_array($user_id_result);
			$user_id1=$user_id_row['USER_ID'];
			
			$level_query = "select * from game where LEVEL_ID='$level' and USER_ID='$user_id1'";			
			$level_result = mysql_query($level_query) or die("Data not found.");
			$level_num=mysql_num_rows($level_result);
			
			//modificado para siempre insertar
			$level_num=0;			
			if($level_num > 0)
			{
				$score_row=mysql_fetch_array($level_result);
				$score1=$score_row['SCORE'];				
				$score_final=$score1+$score;
				$flakes1=$score_row['FLAKES'];
				$flakes_final=$flakes1+$flakes;
				//$game_update = "update game set SCORE='$score_final', FLAKES='$flakes_final', GAME_DATE=NOW() WHERE USER_ID='$user_id1' and LEVEL_ID='$level'";
				$game_update = "insert into game (USER_ID,SCORE,FLAKES,LEVEL_ID,GAME_DATE) values('$user_id1','$score','$flakes','$level',NOW())";
				$game_result = mysql_query($game_update) or die("Data not found.");
			}
			else
			{
				$game_insert = "insert into game (USER_ID,SCORE,FLAKES,LEVEL_ID,GAME_DATE) values('$user_id1','$score','$flakes','$level',NOW())";
				$game_insert_result = mysql_query($game_insert) or die("Data not found.");				
			}
		}
		else if($user_temp != "")
		{	
			if(!isset($_SESSION[user_tem])) {
				/*echo $user_temp=$token;
				echo $_SESSION['USER_TEMP']=$user_temp;*/
				$_SESSION[user_tem]="user_temp".$token;
				
				//echo "create table $_SESSION[user_tem] (GAME_ID int primary key auto_increment, USER_ID varchar(200), SCORE varchar(200), FLAKES varchar(200), LEVEL_ID int(11), GAME_DATE varchar(200), PIC_PATH varchar(200))";
				
				$quiz_new_create=@mysql_query("create table $_SESSION[user_tem] (GAME_ID int primary key auto_increment, USER_ID varchar(200), SCORE varchar(200), FLAKES varchar(200), LEVEL_ID int(11), GAME_DATE varchar(200), PIC_PATH varchar(200))");
			}
			$level_query = "select * from $_SESSION[user_tem] where LEVEL_ID='$level' and USER_ID='$user_temp'";			
			$level_result = mysql_query($level_query) or die("Data not found.");
			$level_num=mysql_num_rows($level_result);
			
			
			if($level_num > 0)
			{
				$score_row=mysql_fetch_array($level_result);
				$score1=$score_row['SCORE'];
				$score_final=$score1+$score;
				$flakes1=$score_row['FLAKES'];
				$flakes_final=$flakes1+$flakes;
				
				$score_final=$score1+$score;
				$game_update = "update $_SESSION[user_tem] set SCORE='$score_final', FLAKES='$flakes',GAME_DATE=NOW() WHERE USER_ID='$user_temp' and LEVEL_ID='$level'";
				$game_result = mysql_query($game_update) or die("Data not found.");
			}
			else
			{
				$game_insert = "insert into $_SESSION[user_tem] (USER_ID,SCORE,FLAKES,LEVEL_ID,GAME_DATE) values('$user_temp','$score','$flakes','{$_SESSION[LEVEL_NEW]}',NOW())";
				$game_insert_result = mysql_query($game_insert) or die("Data not found.");				
			}			
		}
		echo "insert";
}

else{

		
		$level_query = "SELECT * FROM level as l LEFT JOIN level_snowflake as ls on l.LEVEL_ID=ls.LEVEL_ID where l.LEVEL_ID != 11 ORDER BY ls.LEVEL_ID,ls.SNOWFLAKE_ID ASC";
		$level_result = mysql_query($level_query) or die("Data not found.");
		
		$sf_query = "SELECT POINTS FROM snowflake ORDER BY ABS(POINTS) ASC";  // query for points
		$sf_result = mysql_query($sf_query) or die("Data not found.");
		
		$sf_query1 = "SELECT COLOR FROM snowflake ORDER BY ABS(POINTS) ASC";  // query for colors
		$sf_result1 = mysql_query($sf_query1) or die("Data not found.");
		
		$sf_query2 = "SELECT SOUND_PATH FROM snowflake ORDER BY ABS(POINTS) ASC";  // query for sound file
		$sf_result2 = mysql_query($sf_query2) or die("Data not found.");
		
		$music_query = "SELECT MUSIC_PATH FROM config";  // query for music file
		$music_result = mysql_query($music_query) or die("Data not found.");
		
		$bg_query = "SELECT BACKGROUND_PATH FROM background WHERE BACKGROUND_ID = (SELECT NONCAM_BG_PATH FROM config)";  // query for bg image
		$bg_result = mysql_query($bg_query) or die("Data not found.");
		
		$xml_output = "<?xml version=\"1.0\"?>\n";
		$xml_output .= "<snowflake>\n";
		
		
		$xml_output .= "<points>\n";
		
		for($x = 0 ; $x < mysql_num_rows($sf_result) ; $x++){
			$sf_row = mysql_fetch_assoc($sf_result);
			$sf_val = $sf_row['POINTS'];
			
			if($x == 0) { 
			
			$sf_val1 = str_replace("+","",$sf_val);
			$xml_output .= "\t\t<standardpoints>" . $sf_val1 . "</standardpoints>\n";  }
			
			else if ($x == 1) {
			$sf_val1 = str_replace("+","",$sf_val);
			$xml_output .= "\t\t<pluspoints>" . $sf_val1 . "</pluspoints>\n"; }
			else {
			$sf_val1 = str_replace("+","",$sf_val);
			$xml_output .= "\t\t<toppoints>" . $sf_val1 . "</toppoints>\n"; }
			
		}
		$xml_output .= "</points>\n";
		
		
		$xml_output .= "<colors>\n";
		
		for($u = 0 ; $u < mysql_num_rows($sf_result1) ; $u++){
			$sf_row1 = mysql_fetch_assoc($sf_result1);
			$sf_color = $sf_row1['COLOR'];
			
			if($u == 0) { 
			
			$sf_color1 = str_replace("#","0x",$sf_color);
			$xml_output .= "\t\t<standardcolor>" . $sf_color1 . "</standardcolor>\n";  }			
			else if ($u == 1) {
			$sf_color1 = str_replace("#","0x",$sf_color);
			$xml_output .= "\t\t<pluscolor>" . $sf_color1 . "</pluscolor>\n"; }
			else if ($u == 2){
			$sf_color1 = str_replace("#","0x",$sf_color);
			$xml_output .= "\t\t<topcolor>" . $sf_color1 . "</topcolor>\n"; }
			
		}
		$xml_output .= "</colors>\n";		 		
					
		function curPageURL() {
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
				
		$xml_output .= "<sound>\n";
		
		for($t = 0 ; $t < mysql_num_rows($sf_result2) ; $t++){
			$sf_row2 = mysql_fetch_assoc($sf_result2);
			$sf_path = $sf_row2['SOUND_PATH'];
			
			if($t == 0) { 
			
			$url_sound = str_replace("data.php","admin/sound_file/",$url_find);
			
			$xml_output .= "\t\t<standardsound>" . $url_sound.$sf_path . "</standardsound>\n";  }			
			else if ($t == 1) {
			$xml_output .= "\t\t<plussound>" . $url_sound.$sf_path . "</plussound>\n"; }
			else if ($t == 2){
			$xml_output .= "\t\t<topsound>" . $url_sound.$sf_path . "</topsound>\n"; }
			
		}
		$xml_output .= "</sound>\n";
		
		$xml_output .= "<music>\n";
		
		$music_row = mysql_fetch_assoc($music_result);
		$music_path = $music_row['MUSIC_PATH'];			
		$url_music = str_replace("data.php","admin/music_file/",$url_find);			
		$xml_output .= "\t\t<music_path>" . $url_music.$music_path . "</music_path>\n"; 	
//		$xml_output .= "\t\t<music_path>" . "http://nieveenlima.pe/juego/admin/music_file/84efemusic_duplicate.mp3" . "</music_path>\n"; 	
		
		$xml_output .= "</music>\n";
		
		$xml_output .= "<noncambg>\n";
		
		$bg_row = mysql_fetch_assoc($bg_result);
		$bg_path = $bg_row['BACKGROUND_PATH'];			
		$url_bg = str_replace("data.php","admin/images/noncambg/",$url_find);			
		$xml_output .= "\t\t<noncambg_path>" . $url_bg.$bg_path . "</noncambg_path>\n"; 		
//		$xml_output .= "\t\t<noncambg_path>" . "http://nieveenlima.pe/juego/admin/images/noncambg/572b9animated_snow_flakes-300x225.gif" . "</noncambg_path>\n"; 	

		$xml_output .= "</noncambg>\n";
				
		$url_start = str_replace("data.php","playpage.php",$url_find);
		
//		$url_register = str_replace("data.php","register.php",$url_find);
//		$url_rank = str_replace("data.php","ranking.php",$url_find);

		$url_register = str_replace("data.php","result_check.php",$url_find);
		$url_rank = str_replace("data.php","final3.php",$url_find);

		$url_notregister = str_replace("data.php","final3.php",$url_find);
		$xml_output .= "\t\t<url_notregister>" . $url_notregister . "</url_notregister>\n"; 
		$url_fb_register = str_replace("data.php","final5.php",$url_find);
		$xml_output .= "\t\t<url_fb_register>" . $url_fbregister . "</url_fb_register>\n"; 
		$url_nonfb = str_replace("data.php","final4.php",$url_find);
		$xml_output .= "\t\t<url_nonfb>" . $url_nonfb . "</url_nonfb>\n";
		
		$url_exit = str_replace("data.php","result_check.php",$url_find);
		$xml_output .= "<url>\n";
		$xml_output .= "\t\t<url_start>" . $url_start . "</url_start>\n";
		$xml_output .= "\t\t<url_register>" . $url_register . "</url_register>\n"; 
		$xml_output .= "\t\t<url_rank>" . $url_rank. "</url_rank>\n";
		$xml_output .= "\t\t<url_exit>" . $url_exit. "</url_exit>\n";
		$xml_output .= "</url>\n";
		$fp_query = "SELECT * FROM fallingpath";
		$fp_result = mysql_query($fp_query) or die("Data not found.");
		
		$xml_output .= "<fallingpaths>\n";
				
		for($y = 0 ; $y < mysql_num_rows($fp_result) ; $y++){
		$fp_row = mysql_fetch_assoc($fp_result);
		$xml_output .= "\t\t<degree>" . $fp_row['DEGREE'] . "</degree>\n"; 
		$xml_output .= "\t\t<occurrence>" . $fp_row['OCCURRENCE'] . "</occurrence>\n"; 
		}
		
		$xml_output .= "</fallingpaths>\n";		 
		
		$xml_output .= "<data>";
		 
		for($z = 0 ; $z < mysql_num_rows($level_result) ; $z++){
		$level_row = mysql_fetch_assoc($level_result); 
		$xml_output .= "<level>\n";
		$xml_output .= "\t\t<id>" . $level_row['LEVEL_ID'] . "</id>\n"; 
		
		$sf_ids = explode(",",$level_row[OCCURRENCE]);
		 
		$g=0;
		foreach($sf_ids as $sf_id)
		{
						
			if($g == 0){ 
			
			$xml_output .= "\t\t<standard>" . $sf_id .  "</standard>\n"; }
			else if ($g == 1){
			$xml_output .= "\t\t<plus>" . $sf_id .  "</plus>\n"; }
			else {
			$xml_output .= "\t\t<top>" . $sf_id .  "</top>\n"; }
			$g++;
		}
		$xml_output .= "\t\t<frequency>" . $level_row['SNOW_FREQUENCY'] . "</frequency>\n";
		$xml_output .= "\t\t<maxspeed>" . $level_row['SNOW_MAXSPEED'] . "</maxspeed>\n";
		$xml_output .= "\t\t<pointstobeat>" . $level_row['POINTS_BEAT'] . "</pointstobeat>\n";  
		$xml_output .= "</level>";		 
		}	 
		
		$xml_output .= "</data>";
		$xml_output .= "</snowflake>";				
		//Write File End
		echo $xml_output; 
	}
?>
