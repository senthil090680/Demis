<?php include("header.php"); 
include("dbs.php");
$RandomStr = md5(microtime());
$token = substr($RandomStr,0,5); 
@extract($_REQUEST);

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

if($_REQUEST[submit])
{
		$photo1=$_FILES['noncam_bg_path']['name'];
		$photo=$token.$_FILES['noncam_bg_path']['name'];
		$path='images/noncambg/';
		$tmp=$_FILES['noncam_bg_path']['tmp_name'];
		$filepath=$path.$photo;
		move_uploaded_file($tmp,$filepath);
				
		$Sel_flag="select * from background where BACKGROUND_ID='{$_REQUEST[id]}'";
		$Res_flag=mysql_query($Sel_flag);	
		$Res_flag=mysql_fetch_array($Res_flag);
		$oldimagepath=$Res_flag[BACKGROUND_PATH];
		
		if($photo1!="")
		{
			unlink("$path".$oldimagepath);
			$sql="BACKGROUND_PATH ='{$photo}'";
		}
		else
		{
			$sql="BACKGROUND_PATH ='{$oldimagepath}'";
		}
		
echo "update background set $sql where BACKGROUND_ID='{$_REQUEST[id]}'";
//exit;
$query="update background set $sql where BACKGROUND_ID='{$_REQUEST[id]}'";
$results=mysql_query($query) or die("connection failed");
	header("Location: edit_bg.php?msg=su&id={$_REQUEST['id']}");
	exit;
}
else
{
$query_profile = "select * from background where BACKGROUND_ID='{$id}'";
$results=mysql_query($query_profile) or die("connection failed");
$rowcnt=mysql_fetch_array($results);
}
?>
<script language="javascript" src="js/adminvalidate.js"></script> 
<!--<script language="javascript" >
//bgeditvalidate Start
function bgeditvalidate(field)
{	
	with (field)
	{				
		 if ((noncam_bg_path1.value=="") || (noncam_bg_path1.value==null)){
		if ((noncam_bg_path.value=="") || (noncam_bg_path.value==null)) {
			 alert("Please pick the noncam BG image.");
			 noncam_bg_path.focus();
			 return false;
			}
		 if (document.bg.noncam_bg_path.value != "")
		 {
				var extensions = new Array("jpg","jpeg","gif","png","bmp");
				
				/*
				// Alternative way to create the array
				
				var extensions = new Array();
				
				extensions[1] = "jpg";
				extensions[0] = "jpeg";
				extensions[2] = "gif";
				extensions[3] = "png";
				extensions[4] = "bmp";
				*/
				
				var image_file = document.bg.noncam_bg_path.value;
				
				var image_length = document.bg.noncam_bg_path.value.length;
				
				var pos = image_file.lastIndexOf('.') + 1;
				
				var ext = image_file.substring(pos, image_length);
				
				var final_ext = ext.toLowerCase();
				
				for (i = 0; i < extensions.length; i++)
				{
					if(extensions[i] == final_ext)
					{
					return true;
					}
				}
				alert("You must upload an image file with one of the following extensions: "+ extensions.join(', ') +".");
				return false;
			}
		}
		
	return true; 
	}
}
//bgeditvalidate end
</script>-->
              
    <div class="center_content">     
    
    <div class="one-row_content">            
     
     <h2>Edit Background</h2>
     <?PHP if($_GET['msg']=="su") { ?>
     <div class="valid_box">
        Background has been updated successfully | <a href="viewbgs.php"><b style="font-size:18px">View Backgrounds</b></a>
     </div>
     <?PHP } ?>        
         <div class="form">         
         <form name="bg" method="post" onSubmit="return bgeditvalidate(this);" class="niceform" enctype="multipart/form-data">
                <fieldset>                
                
                    <dl>
                        <dt><label for="file">Background Image:</label></dt>
                        <dd><input class="text" type="file" name="noncam_bg_path" style="float:left;width:210px;" id="noncam_bg_path" size="54"/><img src="images/noncambg/<?PHP echo $rowcnt['BACKGROUND_PATH'];?>" width="20px" height="20px" style="float:left"/>
                        	<input name="noncam_bg_path1" id="noncam_bg_path1" type="hidden" value="<?PHP echo $rowcnt['BACKGROUND_PATH'];?>"></dd>
                    </dl>
                    <span>(Note : The image width should be 532 and height should be 393)</sapn>
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

