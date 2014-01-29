<?php include("header.php"); 
if(!isset($_SESSION['admin_id']))
{
   echo '<script language="javascript">
   function redirect()
    {
      window.document.location.href=\'index.php\';
    }
    window.setTimeout(\'redirect()\',0);</script>';
   exit (0);
}
include("dbs.php");
@extract($_REQUEST);

if($_REQUEST[submit])
{
	
	//echo "hedf";
	//exit;
	echo $msg_count  = "select * from message";
	$result = mysql_query($msg_count) or die (mysql_error());
	echo $num=mysql_num_rows($result);

	if($msg_old == $message)
	{ 						
		echo "update message set MESSAGE='{$_REQUEST[message]}' where MESSAGE_ID='{$_REQUEST[id]}'";
		//exit;
		$query="update message set MESSAGE='{$_REQUEST[message]}' where MESSAGE_ID='{$_REQUEST[id]}'";
		$results=mysql_query($query) or die("connection failed");
		header("Location: edit_message.php?msg=su&id={$_REQUEST['id']}");
		exit;				
			//exit;
	}
	else
	{
		echo $msg_count1  = "select * from message";
		$result1 = mysql_query($msg_count1) or die (mysql_error());
		echo $num=mysql_num_rows($result1);		
	
		if($num == 1)
		{ 		
			$query="update message set MESSAGE='{$_REQUEST[message]}' where MESSAGE_ID='{$_REQUEST[id]}'";
			$results=mysql_query($query) or die("connection failed");
			header("Location: edit_message.php?msg=su&id={$_REQUEST['id']}");
			exit;	
		}
	}
}
else
{
	$query_profile = "select * from message where MESSAGE_ID='{$id}'";
	$results=mysql_query($query_profile) or die("connection failed");
	$rowcnt=mysql_fetch_array($results);	
}
?>
<script language="javascript" src="js/adminvalidate.js"></script> 
              
    <div class="center_content">     
    
    <div class="one-row_content">            
     
     <h2>Edit Message</h2>
     <?PHP if($_GET['msg']=="su") { ?>
     <div class="valid_box">
        Message has been updated successfully | <a href="viewmessage.php"><b style="font-size:18px">View Message</b></a>
     </div>
     <?PHP } ?> 
     <?PHP if($msg_1 != "" ) { ?>
     <div class="error_box">
       <?php echo $msg_1; ?> | <a href="viewmessage.php"><b style="font-size:18px">View Message</b></a>
     </div>
     <?PHP } ?>      
         <div class="form">         
         <form name="occur" method="post" onSubmit="return msgeditvalidate(this);" class="niceform" enctype="multipart/form-data">
                <fieldset>                                                	               
                    <dl>
                        <dt><label for="email">Message:</label></dt>
                        <dd><textarea class="text" name="message"  id="message" cols="26" rows="6" size="54"><?PHP echo $rowcnt['MESSAGE'];?></textarea></dd>                       <input type="hidden" name="msg_old"  id="msg_old" value="<?PHP echo $rowcnt['MESSAGE']; ?>">
                    </dl>
                                   
                     <dl class="submit">
                    <input type="submit" name="submit" value="Update" /><input type="hidden" name="id"  id="id" value="<?PHP echo $_REQUEST['id'];?>">
                     </dl>
                   
                </fieldset>
                
         </form>
         </div>  
      
     
     </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->               
                    
                    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    
   <?php include("footer.php") ?>