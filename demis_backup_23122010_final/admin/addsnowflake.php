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
@extract($_REQUEST);
$RandomStr = md5(microtime());
$token = substr($RandomStr,0,5); 
$admincheck        = 	new Admin();
$adminlogincheck	=	$admincheck -> Admin_available(); 

/*echo "<pre>";
print_r($_REQUEST);
echo "</pre>";*/
	 if( isset( $_POST['submit'] ) ){
	  
			  $admin_count  = "select * from snowflake where SNOWFLAKE_DESC='{$_POST[snowflake_desc]}'";
			  $result = mysql_query($admin_count) or die (mysql_error());
		  	  $num=mysql_num_rows($result);	
			  //exit;
			 // $exe_user_count    = $DB -> Execute($admin_count);
            //  $fetch_admin_count  = $exe_user_count->fields[dup_cnt];
			  
			  if($num>0)
			  { 	
			  		$msg_1 = "Snowflake Already Exists in DB.Plz Choose New Snowflake Name!.";			   			
			  }
			 else
			 {					
					$sf_check  = "select * from snowflake";
				    $sf_result = mysql_query($sf_check) or die (mysql_error());
				    $sf_num=mysql_num_rows($sf_result);	
					
					if(($sf_num > 3) ||  ($sf_num == 3)) 
					{
						$msg_1 = "Maximum Three Snowflakes are allowed to be added to the list!.";					
					}
					else
					{					
						//$points = "+".$_REQUEST['points'];
						$photo=$token.$_FILES['image_path']['name'];
						$path='images/snowflake_image/';
						$tmp=$_FILES['image_path']['tmp_name'];
						$filepath=$path.$photo;
						move_uploaded_file($tmp,$filepath);
						
						$sound=$token.$_FILES['sound_path']['name'];
						$path='sound_file/';
						$tmp=$_FILES['sound_path']['tmp_name'];
						$filepath=$path.$sound;
						move_uploaded_file($tmp,$filepath);
						
						//echo "insert into snowflake (SNOWFLAKE_DESC,IMAGE_PATH,COLOR,POINTS,SOUND_PATH) values('{$_POST[snowflake_desc]}','$photo','$color1','{$_POST[points]}','$sound')";
						//exit;
						$snowinsert_query = "insert into snowflake (SNOWFLAKE_DESC,IMAGE_PATH,COLOR,POINTS,SOUND_PATH) values('{$_POST[snowflake_desc]}','$photo','$color1','$points','$sound')";
						
						$result = mysql_query($snowinsert_query) or die (mysql_error());						   		
						if( $result ) 
						{	
							$msg = "Successfully the Snowflake has been added to the list.";				
						}
						else
						{	
							$msg_1 = "Snowflake cannot be added to the list due to some DB errors!.";				
						}
					}
			 }
		}							 
 ?>
<script language="javascript" src="js/adminvalidate.js"></script>
<script language="javascript">
function val()
{
	//salert(document.getElementById('color').value);
	document.getElementById('color1').value=document.getElementById('color').value;
}
</script>
<script type="text/javascript" src="js/jscolor.js"></script>
 <div class="center_content">   
    <div class="one-row_content">            
     
     <h2>Add Snowflake </h2>
     <?PHP if($msg != "" ) { ?>
     <div class="valid_box">
       <?php echo $msg; ?> | <a href="viewsnowflakes.php"><b style="font-size:18px">View Snowflakes</b></a>
     </div>
     <?PHP } ?>
      <?PHP if($msg_1 != "" ) { ?>
     <div class="error_box">
       <?php echo $msg_1; ?> | <a href="viewsnowflakes.php"><b style="font-size:18px">View Snowflakes</b></a>
     </div>
     <?PHP } ?> 
         <div class="form">
         <form name="sf" action="" method="post" onsubmit="return sfaddvalidate(this);" class="niceform" enctype="multipart/form-data">
                 
                <fieldset>
                
                
                    <dl>
                        <dt><label for="email">Snowflake Description:</label></dt>
                        <dd><input class="text" type="text" name="snowflake_desc"  id="snowflake_desc" size="54"></dd>
                    </dl>
                    <dl>
                        <dt><label for="file">Image File:</label></dt>
                        <dd><input class="text" type="file" name="image_path" id="image_path" size="54"/></dd>
                    </dl>
                     <dl>
                        <dt><label for="email">Color:</label></dt>
                        <dd><input  class="color{hash:true}" value="" size="54" type="button" onclick="val();" name="color" id="color" />
                        	<input name="color1" id="color1" type="hidden" />
                        </dd>
                    </dl>
                     <dl>
                        <dt><label for="text">Points:</label></dt>
                        <dd><input class="text" type="level_" name="points" id="points" size="54"/></dd>
                    </dl>
                     <dl>
                        <dt><label for="file">Sound File:</label></dt>
                        <dd><input class="text" type="file" name="sound_path" id="sound_path" size="54"/></dd>
                    </dl>
                    
                     <dl class="submit">
                    <input type="submit" name="submit" id="submit" value="Add Snowflake" />
                     </dl>
                     
                     
                    
                </fieldset>
                
         </form>
         </div>  
      
     
     </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->               
                    
                    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    
   <?php include("footer.php") ?>