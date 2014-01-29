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
$RandomStr = md5(microtime());
$token = substr($RandomStr,0,5); 
@extract($_REQUEST);
$query_profile_bg = "select * from background";
$results_bg=mysql_query($query_profile_bg) or die("connection failed");

if($_REQUEST[submit])
{		

	if($noncambg_old == $noncam_bg_path)
	{ 						
		$sound1=$_FILES['music_path']['name'];
		$sound=$token.$_FILES['music_path']['name'];
		$path1='music_file/';
		$tmp1=$_FILES['music_path']['tmp_name'];
		$filepath1=$path1.$sound;
		move_uploaded_file($tmp1,$filepath1);	
		
		$Sel_flag="select * from config where CONFIG_ID='{$_REQUEST[id]}'";
		$Res_flag=mysql_query($Sel_flag);	
		$Res_flag=mysql_fetch_array($Res_flag);
		$oldsoundpath=$Res_flag[MUSIC_PATH];
				
		if($sound1!="")
		{
			if($oldsoundpath != '')
			{
				unlink("$path1".$oldsoundpath);
			}
			$sql1=",MUSIC_PATH ='{$sound}'";
		}
		else
		{
			$sql1=",MUSIC_PATH ='{$oldsoundpath}'";
		}
		
		echo "update config set APPLICATION_NAME='{$_REQUEST[application_name]}', LEVEL_TIME='{$_REQUEST[level_time]}', NONCAM_BG_PATH='$noncam_bg_path' $sql1  where CONFIG_ID='{$_REQUEST[id]}'";
		//exit;
		$query="update config set APPLICATION_NAME='{$_REQUEST[application_name]}', LEVEL_TIME='{$_REQUEST[level_time]}', NONCAM_BG_PATH='$noncam_bg_path' $sql1  where CONFIG_ID='{$_REQUEST[id]}'";
		$results=mysql_query($query) or die("connection failed");
			header("Location: edit_config.php?msg=su&id={$_REQUEST['id']}");
			exit;			
			//exit;
	}
	else
	{
		echo $config_count1  = "select * from config";
		$result1 = mysql_query($config_count1) or die (mysql_error());
		echo $num=mysql_num_rows($result1);		
	
		if($num == 1)
		{ 		
			$sound1=$_FILES['music_path']['name'];
		$sound=$token.$_FILES['music_path']['name'];
		$path1='music_file/';
		$tmp1=$_FILES['music_path']['tmp_name'];
		$filepath1=$path1.$sound;
		move_uploaded_file($tmp1,$filepath1);	
		
		$Sel_flag="select * from config where CONFIG_ID='{$_REQUEST[id]}'";
		$Res_flag=mysql_query($Sel_flag);	
		$Res_flag=mysql_fetch_array($Res_flag);
		$oldsoundpath=$Res_flag[MUSIC_PATH];
				
		if($sound1!="")
		{
			if($oldsoundpath != '')
			{
				unlink("$path1".$oldsoundpath);
			}
			$sql1=",MUSIC_PATH ='{$sound}'";
		}
		else
		{
			$sql1=",MUSIC_PATH ='{$oldsoundpath}'";
		}
			
			echo "update config set APPLICATION_NAME='{$_REQUEST[application_name]}', LEVEL_TIME='{$_REQUEST[level_time]}', NONCAM_BG_PATH='$noncam_bg_path' $sql1  where CONFIG_ID='{$_REQUEST[id]}'";
		//exit;
		$query="update config set APPLICATION_NAME='{$_REQUEST[application_name]}', LEVEL_TIME='{$_REQUEST[level_time]}', NONCAM_BG_PATH='$noncam_bg_path' $sql1  where CONFIG_ID='{$_REQUEST[id]}'";
		$results=mysql_query($query) or die("connection failed");
			header("Location: edit_config.php?msg=su&id={$_REQUEST['id']}");
			exit;	
		}
	}

		
}
else
{
$query_profile = "select * from config where CONFIG_ID='{$id}'";
$results=mysql_query($query_profile) or die("connection failed");
$rowcnt=mysql_fetch_array($results);
}
?>
<script language="javascript" src="js/adminvalidate.js"></script> 
    <div class="center_content">     
    
    <div class="one-row_content">            
     
     <h2>Edit Application</h2>
     <?PHP if($_GET['msg']=="su") { ?>
     <div class="valid_box">
        Application has been updated successfully | <a href="viewconfigs.php"><b style="font-size:18px">View Application</b></a>
     </div>
     <?PHP } ?>        
         <div class="form">         
         <form name="config" method="post" onSubmit="return configeditvalidate(this);" class="niceform" enctype="multipart/form-data">
                <fieldset>                
                
                    <dl>
                        <dt><label for="email">Application Name:</label></dt>
                        <dd><input type="text" name="application_name" id="application_name" value="<?PHP echo $rowcnt['APPLICATION_NAME'];?>" size="54" class="text"/></dd>
                    </dl>
                    <dl>
                        <dt><label for="text">Level Time:</label></dt>
                        <dd><input class="text" type="level_" name="level_time" id="level_time" value="<?PHP echo $rowcnt['LEVEL_TIME']; ?>" size="54"/>
                       	</dd>
                    </dl>                  
                    <dl>
                        <dt><label for="file">Noncam BG Image:</label></dt>
                        <dd><select name="noncam_bg_path" id="noncam_bg_path" class="text" onchange="imageshow()">
                        	<option value="">-----Select-----</option>
                            <?php while($row= mysql_fetch_array($results_bg)) { ?>
                            <option value="<?php echo $row[BACKGROUND_ID]; ?>" <?php if($row[BACKGROUND_ID] == $rowcnt[NONCAM_BG_PATH]) { ?> selected <?php } ?> ><?php echo $row[BACKGROUND_PATH]; ?></option>
                            <?php } ?>
                            </select>
                        </dd>
                        <div id="image_div"></div>
                    </dl>
                     <input type="hidden" name="noncambg_old"  id="noncambg_old" value="<?PHP echo $rowcnt['NONCAM_BG_PATH']; ?>">         
                     <dl>
                        <dt><label for="file">Music File:</label></dt>
                        <dd><input class="text" style="float:left;width:210px;" type="file" name="music_path" id="music_path" size="54"/><span style="display:block;float:left"><?PHP echo $rowcnt['MUSIC_PATH'];?></span>
							<input name="music_path1" id="music_path1" type="hidden" value="<?PHP echo $rowcnt['MUSIC_PATH'];?>">
						</dd>
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

