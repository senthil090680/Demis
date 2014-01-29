<?php include("header.php"); 
include("dbs.php");
$RandomStr = md5(microtime());
$token = substr($RandomStr,0,5); 
@extract($_REQUEST);

if($_REQUEST[submit])
{
		$photo1=$_FILES['image_path']['name'];
		$photo=$token.$_FILES['image_path']['name'];
		$path='images/snowflake_image/';
		$tmp=$_FILES['image_path']['tmp_name'];
		$filepath=$path.$photo;
		move_uploaded_file($tmp,$filepath);
		
		$sound1=$_FILES['sound_path']['name'];
		$sound=$token.$_FILES['sound_path']['name'];
		$path1='sound_file/';
		$tmp1=$_FILES['sound_path']['tmp_name'];
		$filepath1=$path1.$sound;
		move_uploaded_file($tmp1,$filepath1);	
		
		//$points = "+".$_REQUEST['points'];
		
		$Sel_flag="select * from snowflake where SNOWFLAKE_ID='{$_REQUEST[id]}'";
		$Res_flag=mysql_query($Sel_flag);	
		$Res_flag=mysql_fetch_array($Res_flag);
		$oldimagepath=$Res_flag[IMAGE_PATH];
		$oldsoundpath=$Res_flag[SOUND_PATH];
		
		if($photo1!="")
		{
			unlink("$path".$oldimagepath);
			$sql=",IMAGE_PATH ='{$photo}'";
		}
		else
		{
			$sql=",IMAGE_PATH ='{$oldimagepath}'";
		}
		
		if($sound1!="")
		{
			if($oldsoundpath != '')
			{
				unlink("$path1".$oldsoundpath);
			}
			$sql1=",SOUND_PATH ='{$sound}'";
		}
		else
		{
			$sql1=",SOUND_PATH ='{$oldsoundpath}'";
		}

echo "update snowflake set SNOWFLAKE_DESC='{$_REQUEST[snowflake_desc]}' $sql ,COLOR='{$_REQUEST[color1]}',POINTS='$points' $sql1  where SNOWFLAKE_ID='{$_REQUEST[id]}'";
//exit;
$query="update snowflake set SNOWFLAKE_DESC='{$_REQUEST[snowflake_desc]}' $sql ,COLOR='{$_REQUEST[color1]}',POINTS='$points' $sql1  where SNOWFLAKE_ID='{$_REQUEST[id]}'";
$results=mysql_query($query) or die("connection failed");
	header("Location: edit_snowflake.php?msg=su&id={$_REQUEST['id']}");
	exit;
}
else
{
$query_profile = "select * from snowflake where SNOWFLAKE_ID='{$id}'";
$results=mysql_query($query_profile) or die("connection failed");
$rowcnt=mysql_fetch_array($results);
}
?>
<script type="text/javascript" src="js/jscolor.js"></script>                   
<script language="javascript" src="js/adminvalidate.js"></script> 
<script language="javascript">
function val()
{
	document.getElementById('color1').value=document.getElementById('color').value;
}
</script>
              
    <div class="center_content">     
    
    <div class="one-row_content">            
     
     <h2>Edit Snowflake</h2>
     <?PHP if($_GET['msg']=="su") { ?>
     <div class="valid_box">
        Snowflake has been updated successfully | <a href="viewsnowflakes.php"><b style="font-size:18px">View Snowflakes</b></a>
     </div>
     <?PHP } ?>        
         <div class="form">         
         <form name="sf" method="post" onSubmit="return sfeditvalidate(this);" class="niceform" enctype="multipart/form-data">
                <fieldset>                
                
                    <dl>
                        <dt><label for="email">Snowflake Description:</label></dt>
                        <dd><input type="text" name="snowflake_desc" id="snowflake_desc" value="<?PHP echo $rowcnt['SNOWFLAKE_DESC'];?>" size="54" class="text"/></dd>
                    </dl>
                    
                    <dl>
                        <dt><label for="file">Image File:</label></dt>
                        <dd style="width:250px" ><input style="float:left;width:210px;" type="file" name="image_path" id="image_path" size="34"/>
                        	<input name="image_path1" id="image_path1" type="hidden" value="<?PHP echo $rowcnt['IMAGE_PATH'];?>"><img src="images/snowflake_image/<?PHP echo $rowcnt['IMAGE_PATH'];?>" width="30px" height="30px" style="float:right"/></dd>
                    </dl>
                     <dl>
                        <dt><label for="email">Color:</label></dt>
                        <dd><input  class="color{hash:true}" value="<?PHP echo $rowcnt['COLOR']; ?>" size="54" type="button" onclick="val();" name="color" id="color" />
                        	<input name="color1" id="color1" type="hidden" />
                        </dd>
                    </dl>
                     <dl>
                        <dt><label for="text">Points:</label></dt>
                        <dd><input class="text" type="level_" name="points" id="points" value="<?PHP echo $rowcnt['POINTS']; ?>" size="54"/>
                       	</dd>
                    </dl>
                     <dl>
                        <dt><label for="file">Sound File:</label></dt>
                        <dd ><input style="float:left;width:210px;" class="text" type="file" name="sound_path" id="sound_path" size="54"/>
							<input name="sound_path1" id="sound_path1" type="hidden" value="<?PHP echo $rowcnt['SOUND_PATH'];?>">
                           
						</dd>
                        <dd>
                         <span style="display:block;padding:5px 0 0 0"><?PHP echo $rowcnt['SOUND_PATH'];?></span>
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

