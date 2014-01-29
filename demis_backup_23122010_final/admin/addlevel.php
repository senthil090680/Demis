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
	  
			  $admin_count  = "select * from level where LEVEL_ID='{$_POST[level_id]}'";
			  $result = mysql_query($admin_count) or die (mysql_error());
		  	  $num=mysql_num_rows($result);	
			  
			 // $exe_user_count    = $DB -> Execute($admin_count);
            //  $fetch_admin_count  = $exe_user_count->fields[dup_cnt];
			   
			  if($num>0)
			   { 						
					$msg_1 = "Level Already Exists in DB. Plz Choose New Level Name !.";		
			   }
			 else
			 {
			 	echo "sdfsdfd";
										//echo "insert into level (LEVEL_ID,LEVEL_DESC,POINTS_BEAT,SNOW_FREQUENCY,SNOW_MAXSPEED,NICKNAME) values('{$_POST[level_id]}','$level_desc','$points_beat','$snow_frequency','$snow_maxspeed','$nickname')";
					//exit;
					$levelinsert_query = "insert into level (LEVEL_ID,LEVEL_DESC,POINTS_BEAT,SNOW_FREQUENCY,SNOW_MAXSPEED,NICKNAME) values('{$_POST[level_id]}','$level_desc','$points_beat','$snow_frequency','$snow_maxspeed','$nickname')";
					
					$result = mysql_query($levelinsert_query) or die (mysql_error());						   		
					if( $result ) 
					{	
						$msg = "Successfully the level has been added to the list.";				
					}
					else
					{	
						$msg_1 = "Level cannot be added to the list due to some DB errors!.";				
				    }	
			 }
		}							 
 ?>
<script language="javascript" src="js/adminvalidate.js"></script>
 <div class="center_content">   
    <div class="one-row_content">            
     
     <h2>Add Level </h2>
     <?PHP if($msg != "" ) { ?>
     <div class="valid_box">
       <?php echo $msg; ?> | <a href="viewlevels.php"><b style="font-size:18px">View Levels</b></a>
     </div>
     <?PHP } ?>
     <?PHP if($msg_1 != "" ) { ?>
     <div class="error_box">
       <?php echo $msg_1; ?> | <a href="viewlevels.php"><b style="font-size:18px">View Levels</b></a>
     </div>
     <?PHP } ?> 
         <div class="form">
         <form name="level" action="" method="post" onsubmit="return leveladdvalidate(this);" class="niceform" enctype="multipart/form-data">
                 
                <fieldset>
                
                	<dl>
                        <dt><label for="email">Level:</label></dt>
                        <dd><select name="level_id" id="level_id" class="text">
	                        <option value='' >-----Select-----</option>
                            <?php for($i=1; $i<12; $i++) if($i == 11) {?>
                            <option value="<?php echo $i; ?>" >Win</option><?php } else {?>
                            <option value="<?php echo $i; ?>" >Level <?php echo $i; ?></option><?php } ?>
                            </select></dd>
                    </dl>
                
                    <dl>
                        <dt><label for="email">Level Description:</label></dt>
                        <dd><input class="text" type="text" name="level_desc"  id="level_desc" size="54"></dd>
                    </dl>
                    <dl>
                        <dt><label for="file">Points To Beat:</label></dt>
                        <dd><input class="text" type="text" name="points_beat" id="points_beat" size="54"/></dd>
                    </dl>
                   	<dl>
                        <dt><label for="text">Snow Frequency:</label></dt>
                        <dd><input class="text" type="level_" name="snow_frequency" id="snow_frequency" size="54"/></dd>
                    </dl>
                     <dl>
                        <dt><label for="text">Snow Maxspeed:</label></dt>
                        <dd><input class="text" type="level_" name="snow_maxspeed" id="snow_maxspeed" size="54"/></dd>
                    </dl>
                    <dl>
                        <dt><label for="text">Nickname:</label></dt>
                        <dd><input class="text" type="level_" name="nickname" id="nickname" size="54"/></dd>
                    </dl>
                    
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