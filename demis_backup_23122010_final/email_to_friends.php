<?php
ob_start();
session_start();
include("admin/dbs.php");
@extract($_REQUEST);
/*echo "<pre>";
print_r($_REQUEST);
echo "</pre>";
*/
$user_id=$_SESSION['USER_ID'];

if(isset($_REQUEST["submit"]))
{
	//ip=@$REMOTE_ADDR; 
	//$ip=$_SERVER['REMOTE_ADDR'];	
	
	for($i=0; $i <= $email_con; $i++)
	{
		if($email_con == $i)
		{
			$to .= $_REQUEST["email_".$i] ;	
		}
		else
		{
			$to .= $_REQUEST["email_".$i]."," ;
		}
	}
	

	// subject
	$subject = $sub ;
	
	// message
	$message = '
	<table width="550" border="0" align="center" cellpadding="6" cellspacing="0">
	<tr valign="top"> 
	<td colspan="2" class="tdtext"><table width="100%" border="0" cellspacing="0" cellpadding="0">
	</table></td>
	</tr>
	<tr valign="top"> 
	<td width="25%" class="tdtext" nowrap>System Generated Message</td>
	<td width="75%" class="tdtext">I have participated in snowflakes game.  My score is'.$score.'.  I have provided the link to play the game.  Just Click and start playing.
	</td>
	</tr>
	<tr valign="top"> 
	<td width="25%" class="tdtext" nowrap>Link to Start the game</td>
	<td width="75%" class="tdtext"><a href="http://digient.in/snow/" target="_blank">http://digient.in/snow/</a>
	</td>
	</tr>
	<tr valign="top"> 
	<td class="tdtext" nowrap>Your Friends Message</td>
	<td>'.$msg.' 
	</td>
	</tr>
	
	</table>
	';
	
	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
	// Additional headers
	//$headers .= 'To: $emails' . "\r\n";
	$headers .= 'From:'.$your_email. "\r\n";
	// Mail it
	mail($to, $subject, $message, $headers);
	
	if(mail)
	{
		header("Location:final4.php");
	}
	else
	{
		echo "Your mail has not been sent due to some errors";
	}
}
?>



<?php 
//$user_id=1; //needs to be commented
echo $user_details_query="select * from user where USER_ID='$user_id'";
$user_details_result=mysql_query($user_details_query);
$user_details_row=mysql_fetch_array($user_details_result);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<title>Email Your Friends</title>
</head>

<body>
<script language="javascript" type="text/javascript" src="js/user.js"></script>

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

<div class="guest-registeration">
<div id="registeration" class="register_block">
   <img src="images/tell-a-friend.png" alt="" />
 <form name="postemail" action="" method="post" onsubmit="return postemailvalidate(this)">

		<span id="error_msg3" style="color:#FF0000;"></span>
		<dl class="username">
		<dt><label for="email">Your's Friends E-mail:</label></dt>
         <dd>
         1:<input type="text" name="email_0" style="width:470px;" id="email_0">
          <div id="content"></div>
          <p><a href="javascript:addElement();" >Add</a> <a href="javascript:removeElement();" >Remove</a></p>
        <span id="email_count" style="display:none;"></span>
         </dd>
        </dl>
        
        
                 <dl class="password">
                        <dt><label for="email">Subject:</label></dt>
            <dd><input type="text" name="subj" id="subj" value="" style="width:470px;"></dd>
                    </dl>
                 <dl class="password">
                        <dt><label for="email">Message:</label></dt>
            <dd> <textarea name="msg" id="msg" cols="56" rows="6"></textarea></dd>
                    </dl>
                 <dl class="password">
                        <dt><label for="email">Your Score:</label></dt>
                        <dd><input type="text" name="score" id="score" disabled="disabled" style="color:#FF0000;" value="<?php echo $user_details_row[SCORE]; ?>"><input type="hidden" name="your_email" id="your_email" value="<?php echo $user_details_row[EMAIL]; ?>"><input type="hidden" name="user_id" id="user_id" value="<?php echo $user_details_row[USER_ID]; ?>"><input type="hidden" name="score" id="score" value="<?php echo $user_details_row[SCORE]; ?>"></dd>
          </dl>
                 <dl class="submit">
                     <input id="postyourscore" type="submit" name="submit" id="submit" value="">
                  
                     </dl>       
                        
                        
   </form>
   
   
</div>
</div>

</div>
</div>


</body>
</html>
