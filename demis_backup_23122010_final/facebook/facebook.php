 <?php
	
	include_once("php/facebook.php");
	$api_key = '8d387b0559956c94b00825919d66bce1';
	$secret  = '058f4ac1eba141f7558dd6834ccfc319';
	$facebook = new Facebook($api_key, $secret);
//	$user_id = $facebook->require_login(); 
	$user=$facebook->get_loggedin_user();
	$_SESSION['userid_fb']=$user;	

 ?>