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
$RandomStr = md5(microtime());
$token = substr($RandomStr,0,5); 

@extract($_REQUEST);
/*echo "<pre>";
print_r($_REQUEST);
echo "</pre>";
*/	 if( isset( $_POST['submit'] ) ){
	  
			  $config_check  = "select * from config";
			  //exit;
			  $result = mysql_query($config_check) or die (mysql_error());
		  	  $num=mysql_num_rows($result);	
			  
			   
			  if($num == 1)
			   { 	
					$msg_1 = "Maximum 1 Application is allowed!. Please delete a record to add!";		
			   }
			   else
			   {
						//echo "insert into level (LEVEL_ID,LEVEL_DESC,POINTS_BEAT,SNOW_FREQUENCY,SNOW_MAXSPEED,NICKNAME) values('{$_POST[level_id]}','$level_desc','$points_beat','$snow_frequency','$snow_maxspeed','$nickname')";
					//exit;					
					$sound=$token.$_FILES['music_path']['name'];
					$path='music_file/';
					$tmp=$_FILES['music_path']['tmp_name'];
					$filepath=$path.$sound;
					move_uploaded_file($tmp,$filepath);
					
					
					$configinsert_query = "insert into config (APPLICATION_NAME,LEVEL_TIME,NONCAM_BG_PATH,MUSIC_PATH) values('$application_name','{$_POST[level_time]}','$noncam_bg_path','$sound')";
					
					$result = mysql_query($configinsert_query) or die (mysql_error());						   		
					if( $result ) 
					{	
						$msg = "Successfully the Application Name has been added to the list.";				
					}
					else
					{	
						$msg_1 = "Application Name cannot be added to the list due to some DB errors!.";				
				    }
			   }			  			  
		}
 
$query_profile = "select * from background";
$results=mysql_query($query_profile) or die("connection failed");
 
 ?>
<script language="javascript" src="js/adminvalidate.js"></script>
 <div class="center_content">   
    <div class="one-row_content">            
     
     <h2>Add Application </h2>
     <?PHP if($msg != "" ) { ?>
     <div class="valid_box">
       <?php echo $msg; ?> | <a href="viewconfigs.php"><b style="font-size:18px">View Applications</b></a>
     </div>
     <?PHP } ?> 
     <?PHP if($msg_1 != "" ) { ?>
     <div class="error_box">
       <?php echo $msg_1; ?> | <a href="viewconfigs.php"><b style="font-size:18px">View Applications</b></a>
     </div>
     <?PHP } ?>
         <div class="form">
         <form name="config" action="" method="post" onsubmit="return configaddvalidate(this);" class="niceform" enctype="multipart/form-data">
                 
                <fieldset>
                	
                    <dl>
                        <dt><label for="email">Application Name:</label></dt>
                        <dd><input class="text" type="text" name="application_name"  id="application_name" size="54"></dd>
                    </dl>
                    
                    <dl>
                        <dt><label for="email">Level Time:</label></dt>
                        <dd><input class="text" type="text" name="level_time"  id="level_time" size="54"></dd>
                    </dl>
                    
                    <dl>
                        <dt><label for="file">Noncam BG Image:</label></dt>
                        <dd><select name="noncam_bg_path" id="noncam_bg_path" class="text" onchange="imageshow()">
                        	<option value="">-----Select-----</option>
                            <?php while($row= mysql_fetch_array($results)) { ?>
                            <option value="<?php echo $row[BACKGROUND_ID]; ?>"><?php echo $row[BACKGROUND_PATH]; ?></option>
							<?php } ?>
                            </select>
                        </dd>
                        <div id="image_div"></div>
                    </dl>
                     <dl>
                        <dt><label for="file">Music File:</label></dt>
                        <dd><input class="text" type="file" name="music_path" id="music_path" size="54" style="height:40px"/></dd>
                    </dl>
                    
                     <dl class="submit">
                    <input type="submit" name="submit" id="submit" value="Add Application" />
                     </dl>
                     
                     
                    
                </fieldset>
                
         </form>
         </div>  
      
     
     </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->               
                    
                    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    
   <?php include("footer.php") ?>