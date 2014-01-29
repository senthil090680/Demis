<?php
include("header.php");
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
require_once( "classes/admin.class.php" );
$admincheck        = 	new Admin();
$adminlogincheck	=	$admincheck -> Admin_available(); 
@extract($_REQUEST);
/*echo "<pre>";
print_r($_REQUEST);
echo "</pre>";
*/	 if( isset( $_POST['submit'] ) ){
	  
			  $occur_check  = "select * from message";
			  //exit;
			  $result = mysql_query($occur_check) or die (mysql_error());
		  	  $num=mysql_num_rows($result);	
			  
			   
			  if($num == 1)
			   { 	
					$msg_1 = "Maximum 1 Message is allowed!. Please delete a record to add!";		
			   }
			   else
			   {
						//echo "insert into level (LEVEL_ID,LEVEL_DESC,POINTS_BEAT,SNOW_FREQUENCY,SNOW_MAXSPEED,NICKNAME) values('{$_POST[level_id]}','$level_desc','$points_beat','$snow_frequency','$snow_maxspeed','$nickname')";
						//exit;
						$msginsert_query = "insert into message (MESSAGE) values('$message')";
						
						$result = mysql_query($msginsert_query) or die (mysql_error());						   		
						if( $result ) 
						{	
							$msg = "Successfully the Message has been added to the list.";				
						}
						else
						{	
							$msg_1 = "Message cannot be added to the list due to some DB errors!.";				
						}
			   }
}
 ?>
<script language="javascript" src="js/adminvalidate.js"></script>
 <div class="center_content">   
    <div class="one-row_content">            
     
     <h2>Add Message </h2>
     <?PHP if($msg != "" ) { ?>
     <div class="valid_box">
       <?php echo $msg; ?> | <a href="viewmessage.php"><b style="font-size:18px">View Message</b></a>
     </div>
     <?PHP } ?> 
     <?PHP if($msg_1 != "" ) { ?>
     <div class="error_box">
       <?php echo $msg_1; ?> | <a href="viewmessage.php"><b style="font-size:18px">View Message</b></a>
     </div>
     <?PHP } ?>
         <div class="form">
         <form name="level" action="" method="post" onsubmit="return msgaddvalidate(this);" class="niceform" enctype="multipart/form-data">
                 
                <fieldset>
                    <dl>
                        <dt><label for="email">Message:</label></dt>
                        <dd><textarea class="text" name="message"  id="message" cols="26" rows="6" size="54"></textarea></dd>
                    </dl>
                    
                     <dl class="submit">
                    <input type="submit" name="submit" id="submit" value="Add Message" />
                     </dl>
                     
                     
                    
                </fieldset>
                
         </form>
         </div>  
      
     
     </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->               
                    
                    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    
   <?php include("footer.php") ?>