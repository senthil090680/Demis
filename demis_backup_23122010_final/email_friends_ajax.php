<?php
session_start();
include("admin/dbs.php");
@extract($_REQUEST);
echo "<pre>";
print_r($_REQUEST);
echo "</pre>";

$user_id=$_SESSION['USER_ID'];

	//ip=@$REMOTE_ADDR; 
	//$ip=$_SERVER['REMOTE_ADDR'];	
	
	for($i=0; $i <= $email_con; $i++)
	{
		if($i == 0)
		{
			$to = $_REQUEST["email_".$i].",";
		}
		else
		{		
			if($email_con == $i)
			{
				$to .= $_REQUEST["email_".$i];	
			}
			else
			{
				$to .= $_REQUEST["email_".$i].",";
			}
		}
	}
	

	echo $to;

	// subject
	$subject = $sub ;
	
	// message
	echo $message = '
	<table width="550" border="0" align="center" cellpadding="6" cellspacing="0">
	<tr valign="top"> 
	<td colspan="2" class="tdtext"><table width="100%" border="0" cellspacing="0" cellpadding="0">
	</table></td>
	</tr>
	<tr valign="top"> 
	<td width="25%" class="tdtext" nowrap>System Generated Message</td>
	<td width="75%" class="tdtext">I have participated in snowflakes game.  My score is '.$score.'.  I have provided the link to play the game.  Just Click and start playing.
	</td>
	</tr>
	<tr valign="top"> 
	<td width="25%" class="tdtext" nowrap>Link to Start the game</td>
	<td width="75%" class="tdtext"><a href="http://digient.in/snow/" target="_blank">http://digient.in/snow/</a>
	</td>
	</tr>
	<tr valign="top"> 
	<td class="tdtext" nowrap>Your Friends Message</td>
	<td><textarea rows="4">'.$msg.' </textarea>
	</td>
	</tr>
	
	</table>
	';
	
	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
	// Additional headers
	//$headers .= 'To: $emails' . "\r\n";
	$headers .= "From: $your_email \r\n";
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
?>
