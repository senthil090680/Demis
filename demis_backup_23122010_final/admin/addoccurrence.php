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
	  
			  $occur_check  = "select * from level_snowflake where SNOWFLAKE_ID='$snowflake_id' and LEVEL_ID='$level_id'";
			  //exit;
			  $result = mysql_query($occur_check) or die (mysql_error());
		  	  $num=mysql_num_rows($result);	
			  
			   
			  if($num>0)
			   { 	
					$sf_query_profile = "select SNOWFLAKE_DESC from snowflake where SNOWFLAKE_ID='$snowflake_id'";
					$sf_results=mysql_query($sf_query_profile) or die("connection failed");
					$rowcnt_sf=mysql_fetch_array($sf_results);
					$rowcnt_sf[SNOWFLAKE_DESC];
					$msg_1 = "This combination Snowflakes and Level $level_id Already Exists in DB.Plz Choose New Combination!.";		
			   }
			 else
			 {
					$ls_check  = "select * from level_snowflake";
				    $ls_result = mysql_query($ls_check) or die (mysql_error());
				    $ls_num=mysql_num_rows($ls_result);	
					
					if(($ls_num > 10) ||  ($ls_num == 10))
					{
						$msg_1 = "Maximum 10 Datas are allowed!. Please delete a record to add!";					
						//exit;
					}
					else
					{
					
						//echo "insert into level (LEVEL_ID,LEVEL_DESC,POINTS_BEAT,SNOW_FREQUENCY,SNOW_MAXSPEED,NICKNAME) values('{$_POST[level_id]}','$level_desc','$points_beat','$snow_frequency','$snow_maxspeed','$nickname')";
						//exit;
						$occurinsert_query = "insert into level_snowflake (SNOWFLAKE_ID,LEVEL_ID,OCCURRENCE) values('$snowflake_id','{$_POST[level_id]}','$occurrence')";
						
						$result = mysql_query($occurinsert_query) or die (mysql_error());						   		
						if( $result ) 
						{	
							$msg = "Successfully the occurrence has been added to the list.";				
						}
						else
						{	
							$msg_1 = "Occurrence cannot be added to the list due to some DB errors!.";				
						}
					}
			 }
		}
	$query_profile = "select * from snowflake";
	$results=mysql_query($query_profile) or die("connection failed");
	$num_sf=mysql_num_rows($results);
	$query_profile1 = "select * from level ORDER BY ABS(LEVEL_ID) ASC";
	$results1=mysql_query($query_profile1) or die("connection failed");
 ?>
<script language="javascript" src="js/adminvalidate.js"></script>
 <div class="center_content">   
    <div class="one-row_content">            
     
     <h2>Add Occurrences </h2>
     <?PHP if($msg != "" ) { ?>
     <div class="valid_box">
       <?php echo $msg; ?> | <a href="viewoccurrences.php"><b style="font-size:18px">View Occurrences</b></a>
     </div>
     <?PHP } ?> 
     <?PHP if($msg_1 != "" ) { ?>
     <div class="error_box">
       <?php echo $msg_1; ?> | <a href="viewoccurrences.php"><b style="font-size:18px">View Occurrences</b></a>
     </div>
     <?PHP } ?>
         <div class="form">
         <form name="level" action="" method="post" onsubmit="return occuraddvalidate(this);" class="niceform" enctype="multipart/form-data">
                 
                <fieldset>
                	
                    <dl>
                        <dt><label for="email">Snowflakes:</label></dt>
                        <dd><?php $i=1; while ($rowcnt = mysql_fetch_array($results)) { ?>
                            <?php $sf_val[$i] = $rowcnt[SNOWFLAKE_ID];
								  if($num_sf == $i) 
								  { 
								echo $rowcnt[SNOWFLAKE_DESC]."."; } else {
								echo $rowcnt[SNOWFLAKE_DESC].","; } ?><?php $i++; }?>
                                <?php $sf_value = implode(",",$sf_val);           ?>
                        
                        	<!--<select name="snowflake_id" id="snowflake_id" class="text">
	                        <option value='' >-----Select-----</option>
                            <?php while ($rowcnt = mysql_fetch_array($results)) { ?>
                            <option value="<?php echo $rowcnt[SNOWFLAKE_ID]; ?>" ><?php echo $rowcnt[SNOWFLAKE_DESC]; ?></option><?php }?>
                            </select>--></dd>
                    </dl>
                    
                	<dl>
                        <dt><label for="email">Level:</label></dt>
                        <dd><select name="level_id" id="level_id" class="text">
	                        <option value='' >-----Select-----</option>
                            <?php while ($rowcnt1 = mysql_fetch_array($results1)) {  if($rowcnt1[LEVEL_ID] == 11) { } else { ?>
                            <option value="<?php echo $rowcnt1[LEVEL_ID]; ?>" >Level <?php echo $rowcnt1[LEVEL_ID]; ?></option><?php } }?>
                            </select></dd>
                    </dl>
                 <input type="hidden" name="snowflake_id"  id="snowflake_id" value="<?PHP echo $sf_value; ?>">
                    <dl>
                        <dt><label for="email">Occurrence:</label></dt>
                        <dd><input class="text" type="text" name="occurrence"  id="occurrence" size="54"></dd>
                        <span style="display:block;float:left">(Please enter the values in the above-mentioned order of snowflakes.  Use COMMA IN BETWEEN values)</span>
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