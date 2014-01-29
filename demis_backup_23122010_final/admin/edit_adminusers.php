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
$query="update admin set USERNAME='{$_REQUEST[adname]}',PASSWORD='{$_REQUEST[adpass]}',EMAIL='{$_REQUEST[ademail]}', MOBILE='{$_REQUEST[admobile]}' where ADMIN_ID='{$_REQUEST[id]}'";
$results=mysql_query($query) or die("connection failed");
	header("Location: edit_adminusers.php?msg=su&id={$_REQUEST['id']}");
	exit;
}
else
{
//echo "select * from admin where ADMIN_ID='{$id}'";
$query_profile = "select * from admin where ADMIN_ID='{$id}'";
$results=mysql_query($query_profile) or die("connection failed");
$rowcnt=mysql_fetch_array($results);
}
?>                   
<script language="javascript" src="js/adminvalidate.js"></script>               
    <div class="center_content">     
    
    <div class="one-row_content">            
     
     <h2>Edit Admin</h2>
     <?PHP if($_GET['msg']=="su") { ?>
     <div class="valid_box">
        Admin profile has been updated successfully | <a href="adminprofile.php"><b style="font-size:18px">View admin</b></a>
     </div>
     <?PHP } ?>        
         <div class="form">         
         <form name="adminreg" method="post" onSubmit="return adminregvalidateedit(this);" class="niceform">
                <fieldset>                
                
                    <dl>
                        <dt><label for="email">User Name:</label></dt>
                        <dd><input type="text" name="adname" id="adname" value="<?PHP echo $rowcnt['USERNAME'];?>" size="54" class="text"/></dd>
                    </dl>
                    <dl>
                        <dt><label for="password">Password:</label></dt>
                        <dd><input type="password" name="adpass" id="adpass" value="<?PHP echo $rowcnt['PASSWORD'];?>" size="54" class="text"/></dd>
                    </dl>
                      <dl>
                        <dt><label for="E-mail">E-mail:</label></dt>
                        <dd><input type="text" name="ademail"  id="ademail" value="<?PHP echo $rowcnt['EMAIL'];?>" size="54" class="text"/></dd>
                    </dl>
                       <dl>
                        <dt><label for="mobile">Mobile Number:</label></dt>
                        <dd><input type="text" name="admobile" id="admobile" value="<?PHP echo $rowcnt['MOBILE'];?>" size="54" maxlength="10" class="text"></dd>
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

