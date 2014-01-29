<?php
include("header.php"); ?>
<?php
include("dbs.php");
require_once( "classes/admin.class.php" );
	 $admincheck        = 	new Admin();
	$adminlogincheck	=	$admincheck -> Admin_available(); 

	 if( isset( $_POST['submit'] ) ){
	  
			 $err	=	$admincheck -> admin_registration();
			
			if($err == 1)
			{
			echo '<script language="javascript">
			function redirect()
			{
			  window.document.location.href=\'adminregister.php?msg=success\';
			}
			window.setTimeout(\'redirect()\',0);</script>';
			exit;
			}
			else
			{
			echo '<script language="javascript">
			function redirect()
			{
			  window.document.location.href=\'adminregister.php?msg=fail\';
			}
			window.setTimeout(\'redirect()\',0);</script>';
			exit;
			}								 
	 }
 ?>
<script language="javascript" src="js/adminvalidate.js"></script>
 <div class="center_content">   
    <div class="one-row_content">            
     
     <h2>Add Admin </h2>
     <?PHP if($_GET['msg']=="success") { ?>
     <div class="valid_box">
       New Admin has been added successfully. | <a href="adminprofile.php"><b style="font-size:18px">View Admin</b></a>
     </div>
     <?PHP } ?> 
      <?PHP if($_GET['msg']=="fail") { ?>
     <div class="error_box">
       Admin Name Already Exists in DB.Plz Choose New Admin Name !. | <a href="adminprofile.php"><b style="font-size:18px">View Admin</b></a>
     </div>
     <?PHP } ?> 
         <div class="form">
         <form name="adminreg" action="" method="post" onsubmit="return adminregvalidate(this);" class="niceform">
                 
                <fieldset>
                
                
                    <dl>
                        <dt><label for="email">User Name:</label></dt>
                        <dd><input class="text" type="text" name="adname"  id="adname" size="54"></dd>
                    </dl>
                    <dl>
                        <dt><label for="password">Password:</label></dt>
                        <dd><input class="text" type="password" name="adpass" id="adpass" size="54"/></dd>
                    </dl>
                      <dl>
                        <dt><label for="E-mail">E-mail:</label></dt>
                        <dd><input class="text" type="text" name="ademail" id="ademail" size="54"/></dd>
                    </dl>
                       <dl>
                        <dt><label for="mobile">Mobile Number:</label></dt>
                        <dd><input class="text" type="text" name="admobile"  id="admobile" maxlength="10" size="54"/></dd>
                    </dl>
                    
                    
                    
                    
                     <dl class="submit">
                    <input type="submit" name="submit" id="submit" value="Add Admin" />
                     </dl>
                     
                     
                    
                </fieldset>
                
         </form>
         </div>  
      
     
     </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->               
                    
                    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    
   <?php include("footer.php") ?>

