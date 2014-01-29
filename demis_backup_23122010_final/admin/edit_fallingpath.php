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
$query="update fallingpath set DEGREE='{$_REQUEST[degree]}',OCCURRENCE='{$_REQUEST[occurrence]}' where FALLINGPATH_ID='{$_REQUEST[id]}'";
$results=mysql_query($query) or die("connection failed");
	header("Location: edit_fallingpath.php?msg=su&id={$_REQUEST['id']}");
	exit;
}
else
{
$query_profile = "select * from fallingpath where FALLINGPATH_ID='{$id}'";
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
        Falling Path has been updated successfully | <a href="viewfallingpaths.php"><b style="font-size:18px">View Falling Paths</b></a>
     </div>
     <?PHP } ?>        
         <div class="form">         
         <form name="fp" method="post" onSubmit="return fpeditvalidate(this);" class="niceform">
                <fieldset>                
                
                    <dl>
                        <dt><label for="email">Degree:</label></dt>
                        <dd><input type="text" name="degree" id="degree" value="<?PHP echo $rowcnt['DEGREE'];?>" size="54" class="text"/></dd>
                    </dl>
                    <dl>
                        <dt><label for="text">Occurrence:</label></dt>
                        <dd><input type="text" name="occurrence" id="occurrence" value="<?PHP echo $rowcnt['OCCURRENCE'];?>" size="54" class="text"/></dd>
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

