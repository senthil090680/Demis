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
$RandomStr = md5(microtime());
$token = substr($RandomStr,0,5); 

/*echo "<pre>";
print_r($_REQUEST);
echo "</pre>";
*/	 if( isset( $_POST['submit'] ) ){
	  
			//echo "insert into level (LEVEL_ID,LEVEL_DESC,POINTS_BEAT,SNOW_FREQUENCY,SNOW_MAXSPEED,NICKNAME) values('{$_POST[level_id]}','$level_desc','$points_beat','$snow_frequency','$snow_maxspeed','$nickname')";
			//exit;
			
			echo $fil=str_replace(" ","_",$_FILES['noncam_bg_path']['name']);
			//exit;
			$photo=$token.$fil;
			$path='images/noncambg/';
			$tmp=$_FILES['noncam_bg_path']['tmp_name'];
			$filepath=$path.$photo;
			move_uploaded_file($tmp,$filepath);
			
			$bginsert_query = "insert into background (BACKGROUND_PATH) values('$photo')";
			
			$result = mysql_query($bginsert_query) or die (mysql_error());						   		
			if( $result ) 
			{	
				$msg = "Successfully the Background has been added to the list.";				
			}
			else
			{	
				$msg_1 = "Background cannot be added to the list due to some DB errors!.";				
			}	
		}
 ?>
<script language="javascript" src="js/adminvalidate.js"></script>
 <div class="center_content">   
    <div class="one-row_content">            
     
     <h2>Add Application </h2>
     <?PHP if($msg != "" ) { ?>
     <div class="valid_box">
       <?php echo $msg; ?> | <a href="viewbgs.php"><b style="font-size:18px">View Backgrounds</b></a>
     </div>
     <?PHP } ?> 
     <?PHP if($msg_1 != "" ) { ?>
     <div class="error_box">
       <?php echo $msg_1; ?> | <a href="viewbgs.php"><b style="font-size:18px">View Backgrounds</b></a>
     </div>
     <?PHP } ?>
         <div class="form">
         <form name="bg" action="" method="post" onsubmit="return bgaddvalidate(this);" class="niceform" enctype="multipart/form-data">
                 
                <fieldset>
                	
                    <dl>
                        <dt><label for="file">Noncam BG Image:</label></dt>
                        <dd><input class="text" type="file" name="noncam_bg_path" id="noncam_bg_path" size="54"/></dd>
                    </dl>
                    <span>(Note : The image width should be 532 and height should be 393)</sapn>
                     <dl class="submit">
                    <input type="submit" name="submit" id="submit" value="Add Level" />
                     </dl>
                     
                     
                    
                </fieldset>
                
         </form>
         </div>  
      
     
     </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->               
                    
                    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    
   <?php include("footer.php") ?>