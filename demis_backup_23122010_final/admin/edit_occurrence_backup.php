<?php include("header.php"); 
include("dbs.php");
@extract($_REQUEST);

if($_REQUEST[submit])
{
	echo $sf_old;
	echo $snowflake_id;
	echo $level_old;
	echo $level_id;
	//exit;	
	if(($sf_old == $snowflake_id) && ($level_old == $level_id))
	{
		//echo "hai";
		//exit;
		echo "update level_snowflake set SNOWFLAKE_ID='$snowflake_id',LEVEL_ID='{$_REQUEST[level_id]}',OCCURRENCE='{$_REQUEST[occurrence]}' where LEVEL_SF_ID='{$_REQUEST[id]}'";
		//exit;
		$query="update level_snowflake set SNOWFLAKE_ID='$snowflake_id',LEVEL_ID='{$_REQUEST[level_id]}',OCCURRENCE='{$_REQUEST[occurrence]}' where LEVEL_SF_ID='{$_REQUEST[id]}'";
		$results=mysql_query($query) or die("connection failed");
			header("Location: edit_occurrence.php?msg=su&id={$_REQUEST['id']}");
			exit;
	}
	else
	{
		//echo "hedf";
		//exit;
		echo $occur_count  = "select * from level_snowflake where SNOWFLAKE_ID='$snowflake_id' and LEVEL_ID='$level_id'";
		$result = mysql_query($occur_count) or die (mysql_error());
		echo $num=mysql_num_rows($result);		
	
		if($num>0)
		{ 						
			echo $sf_query_profile = "select SNOWFLAKE_DESC from snowflake where SNOWFLAKE_ID='$snowflake_id'";
			$sf_results=mysql_query($sf_query_profile) or die("connection failed");
			$rowcnt_sf=mysql_fetch_array($sf_results);
			echo $rowcnt_sf[SNOWFLAKE_DESC];
			$msg_1 = "This combination $rowcnt_sf[SNOWFLAKE_DESC] and Level $level_id Already Exists in DB.Plz Choose New Combination!.";
			header("Location: edit_occurrence.php?msg_1=$msg_1&id={$_REQUEST['id']}");
			exit;	
		}
		else
		{
			echo "update level_snowflake set SNOWFLAKE_ID='$snowflake_id',LEVEL_ID='{$_REQUEST[level_id]}',OCCURRENCE='{$_REQUEST[occurrence]}' where LEVEL_SF_ID='{$_REQUEST[id]}'";
			//exit;
			$query="update level_snowflake set SNOWFLAKE_ID='$snowflake_id',LEVEL_ID='{$_REQUEST[level_id]}',OCCURRENCE='{$_REQUEST[occurrence]}' where LEVEL_SF_ID='{$_REQUEST[id]}'";
			$results=mysql_query($query) or die("connection failed");
				header("Location: edit_occurrence.php?msg=su&id={$_REQUEST['id']}");
				exit;
		}
	}
}
else
{
	$query_profile = "select * from level_snowflake where LEVEL_SF_ID='{$id}'";
	$results=mysql_query($query_profile) or die("connection failed");
	$rowcnt=mysql_fetch_array($results);
	$query_profile1 = "select * from snowflake";
	$results1=mysql_query($query_profile1) or die("connection failed");
	$query_profile2 = "select * from level ORDER BY ABS(LEVEL_ID) ASC";
	$results2=mysql_query($query_profile2) or die("connection failed");

}
?>
<script language="javascript" src="js/adminvalidate.js"></script> 
              
    <div class="center_content">     
    
    <div class="one-row_content">            
     
     <h2>Edit Occurrence</h2>
     <?PHP if($_GET['msg']=="su") { ?>
     <div class="valid_box">
        Occurrence has been updated successfully | <a href="viewoccurrences.php"><b style="font-size:18px">View Occurrences</b></a>
     </div>
     <?PHP } ?> 
     <?PHP if($msg_1 != "" ) { ?>
     <div class="error_box">
       <?php echo $msg_1; ?> | <a href="viewoccurrences.php"><b style="font-size:18px">View Occurrences</b></a>
     </div>
     <?PHP } ?>      
         <div class="form">         
         <form name="occur" method="post" onSubmit="return occureditvalidate(this);" class="niceform" enctype="multipart/form-data">
                <fieldset>                
                
                	 <dl>
                        <dt><label for="email">Snowflake:</label></dt>
                        <dd><select name="snowflake_id" id="snowflake_id" class="text">
	                        <option value='' >-----Select-----</option>
                            <?php while ($rowcnt2 = mysql_fetch_array($results1)) { ?>
                            <option value="<?php echo $rowcnt2[SNOWFLAKE_ID]; ?>" <?php if($rowcnt2[SNOWFLAKE_ID] == $rowcnt[SNOWFLAKE_ID] ){ ?>selected <?php } ?> ><?php echo $rowcnt2[SNOWFLAKE_DESC]; ?></option><?php }?>
                            </select></dd>
                    </dl>
                    
                	<dl>
                        <dt><label for="email">Level:</label></dt>
                        <dd><select name="level_id" id="level_id" class="text">
	                        <option value='' >-----Select-----</option>
                            <?php while ($rowcnt1 = mysql_fetch_array($results2)) {  if($rowcnt1[LEVEL_ID] == 11) { } else { ?>
                            <option value="<?php echo $rowcnt1[LEVEL_ID]; ?>" <?php if($rowcnt1[LEVEL_ID] == $rowcnt[LEVEL_ID] ){ ?>selected <?php } ?> >Level <?php echo $rowcnt1[LEVEL_ID]; ?></option><?php } }?>
                            </select></dd>
                    </dl>
                
                <input type="hidden" name="sf_old"  id="sf_old" value="<?PHP echo $rowcnt[SNOWFLAKE_ID]; ?>">
                <input type="hidden" name="level_old"  id="level_old" value="<?PHP echo $rowcnt[LEVEL_ID]; ?>">
                    <dl>
                        <dt><label for="email">Occurrence:</label></dt>
                        <dd><input class="text" type="text" name="occurrence"  id="occurrence" value="<?PHP echo $rowcnt['OCCURRENCE'];?>" size="54"><span style="display:block;float:left">Please enter the values in the above-mentioned order of snowflakes</span></dd>
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