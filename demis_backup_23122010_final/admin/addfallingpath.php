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

	 if( isset( $_POST['submit'] ) ){
	  
			  $admin_count  = "select * from fallingpath where DEGREE='{$_POST[degree]}' and OCCURRENCE='{$_POST[occurrence]}'";
			  $result = mysql_query($admin_count) or die (mysql_error());
		  	  $num=mysql_num_rows($result);	
			  
			 // $exe_user_count    = $DB -> Execute($admin_count);
            //  $fetch_admin_count  = $exe_user_count->fields[dup_cnt];
			   
			  if($num>0)
			   { 	
			   		$msg_1 = "Falling Path Already Exists in DB.Plz Choose New Falling Path Name!.";		
			   }
			 else
			 {
					$fp_check  = "select * from fallingpath";
				    $fp_result = mysql_query($fp_check) or die (mysql_error());
				    $fp_num=mysql_num_rows($fp_result);	
					
					if(($fp_num > 3) ||  ($fp_num == 3))
					{
						$msg_1 = "Maximum Three Fallingpaths are allowed to be added to the list!.";					
						//exit;
					}
					else
					{		
						//exit;					
						$admininsert_query = "insert into fallingpath (DEGREE,OCCURRENCE) values('{$_POST[degree]}','{$_POST[occurrence]}')";
						
						$result = mysql_query($admininsert_query) or die (mysql_error());						   		
						if( $result ) 
						{	
							$msg = "Successfully the Falling Path has been added to the list.";				
						}
						else
						{	
							$msg_1 = "Falling Path cannot be added to the list due to some DB errors!.";				
						}	
					}
			 }
		}							 
 ?>
<script language="javascript" src="js/adminvalidate.js"></script>
 <div class="center_content">   
    <div class="one-row_content">            
     
     <h2>Add Fallingpath </h2>
     <?PHP if($msg != "" ) { ?>
     <div class="valid_box">
       <?php echo $msg; ?> | <a href="viewfallingpaths.php"><b style="font-size:18px">View Falling Paths</b></a>
     </div>
     <?PHP } ?>
     <?PHP if($msg_1 != "" ) { ?>
     <div class="error_box">
       <?php echo $msg_1; ?> | <a href="viewfallingpaths.php"><b style="font-size:18px">View Falling Paths</b></a>
     </div>
     <?PHP } ?>
     
         <div class="form">
         <form name="fp" action="" method="post" onsubmit="return fpaddvalidate(this);" class="niceform">
                 
                <fieldset>
                
                
                    <dl>
                        <dt><label for="email">Degree:</label></dt>
                        <dd><input class="text" type="text" name="degree"  id="degree" size="54"></dd>
                    </dl>
                    <dl>
                        <dt><label for="password">Occurrence:</label></dt>
                        <dd><input class="text" type="level_" name="occurrence" id="occurrence" size="54"/></dd>
                    </dl>
                    
                     <dl class="submit">
                    <input type="submit" name="submit" id="submit" value="Add Falling Path" />
                     </dl>
                     
                     
                    
                </fieldset>
                
         </form>
         </div>  
      
     
     </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->               
                    
                    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    
   <?php include("footer.php") ?>