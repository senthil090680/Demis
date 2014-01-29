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
	echo "update level set LEVEL_ID='{$_REQUEST[level_id]}',LEVEL_DESC='{$_REQUEST[level_desc]}',POINTS_BEAT='{$_REQUEST[points_beat]}',SNOW_FREQUENCY='{$_REQUEST[snow_frequency]}',SNOW_MAXSPEED='{$_REQUEST[snow_maxspeed]}',NICKNAME='{$_REQUEST[nickname]}' where LEV_ID='{$_REQUEST[id]}'";
	//exit;
	$query="update level set LEVEL_ID='{$_REQUEST[level_id]}',LEVEL_DESC='{$_REQUEST[level_desc]}',POINTS_BEAT='{$_REQUEST[points_beat]}',SNOW_FREQUENCY='{$_REQUEST[snow_frequency]}',SNOW_MAXSPEED='{$_REQUEST[snow_maxspeed]}',NICKNAME='{$_REQUEST[nickname]}' where LEV_ID='{$_REQUEST[id]}'";
	$results=mysql_query($query) or die("connection failed");
		header("Location: edit_level.php?msg=su&id={$_REQUEST['id']}");
		exit;
}
else
{
$query_profile = "select * from level where LEV_ID='{$id}'";
$results=mysql_query($query_profile) or die("connection failed");
$rowcnt=mysql_fetch_array($results);
}
?>
<script language="javascript" src="js/adminvalidate.js"></script> 
              
    <div class="center_content">     
    
    <div class="one-row_content">            
     
     <h2>Edit Level</h2>
     <?PHP if($_GET['msg']=="su") { ?>
     <div class="valid_box">
        Level has been updated successfully | <a href="viewlevels.php"><b style="font-size:18px">View Levels</b></a>
     </div>
     <?PHP } ?>        
         <div class="form">         
         <form name="level" method="post" onSubmit="return leveleditvalidate(this);" class="niceform" enctype="multipart/form-data">
                <fieldset>                
                
                    <dl>
                        <dt><label for="email">Level:</label></dt>
                        <dd><select name="level_id" id="level_id" class="text">
	                        <option value='' >-----Select-----</option>
                            <?php for($i=1; $i<12; $i++) if($i == 11) {?>
                            <option value="<?php echo $i; ?>" <?php if($rowcnt['LEVEL_ID'] == $i ){ ?>selected <?php } ?> >Win</option><?php } else {?>
                            <option value="<?php echo $i; ?>" <?php if($rowcnt['LEVEL_ID'] == $i ){ ?>selected <?php } ?> >Level <?php echo $i; ?></option><?php } ?>
                            </select></dd>
                    </dl>
                
                    <dl>
                        <dt><label for="email">Level Description:</label></dt>
                        <dd><input class="text" type="text" name="level_desc"  id="level_desc" value="<?PHP echo $rowcnt['LEVEL_DESC'];?>" size="54"></dd>
                    </dl>
                    <dl>
                        <dt><label for="file">Points To Beat:</label></dt>
                        <dd><input class="text" type="text" name="points_beat" id="points_beat" value="<?PHP echo $rowcnt['POINTS_BEAT'];?>" size="54"/></dd>
                    </dl>
                   	<dl>
                        <dt><label for="text">Snow Frequency:</label></dt>
                        <dd><input class="text" type="level_" name="snow_frequency" id="snow_frequency" value="<?PHP echo $rowcnt['SNOW_FREQUENCY'];?>" size="54"/></dd>
                    </dl>
                     <dl>
                        <dt><label for="text">Snow Maxspeed:</label></dt>
                        <dd><input class="text" type="level_" name="snow_maxspeed" id="snow_maxspeed" value="<?PHP echo $rowcnt['SNOW_MAXSPEED'];?>" size="54"/></dd>
                    </dl>
                    <dl>
                        <dt><label for="text">Nickname:</label></dt>
                        <dd><input class="text" type="level_" name="nickname" id="nickname" value="<?PHP echo $rowcnt['NICKNAME'];?>" size="54"/></dd>
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

