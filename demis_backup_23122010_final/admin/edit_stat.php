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
$query="update stats set TOTAL_SCORE='{$_REQUEST[total_score]}',TOTAL_PLAYS='{$_REQUEST[total_plays]}',TOTAL_USERS='{$_REQUEST[total_users]}',BEST_PLAYER_ID='{$_REQUEST[best_player_id]}' where STATS_ID='{$_REQUEST[id]}'";
$results=mysql_query($query) or die("connection failed");
	header("Location: edit_stat.php?msg=su&id={$_REQUEST['id']}");
	exit;
}
else
{
$query_profile = "select * from stats where STATS_ID='{$id}'";
$results=mysql_query($query_profile) or die("connection failed");
$rowcnt=mysql_fetch_array($results);
}
?>                   
<script language="javascript" src="js/adminvalidate.js"></script>               
    <div class="center_content">     
    
    <div class="one-row_content">            
     
     <h2>Edit Stats</h2>
     <?PHP if($_GET['msg']=="su") { ?>
     <div class="valid_box">
        Statistics has been updated successfully | <a href="viewstats.php"><b style="font-size:18px">View Statistics</b></a>
     </div>
     <?PHP } ?>        
         <div class="form">         
         <form name="stats" method="post" onSubmit="return statseditvalidate(this);" class="niceform">
                <fieldset>                
                
                    <dl>
                        <dt><label for="email">Total Score:</label></dt>
                        <dd><input type="text" name="total_score" id="total_score" value="<?PHP echo $rowcnt['TOTAL_SCORE'];?>" size="54" class="text"/></dd>
                    </dl>
                     <dl>
                        <dt><label for="email">Total Plays:</label></dt>
                        <dd><input type="text" name="total_plays" id="total_plays" value="<?PHP echo $rowcnt['TOTAL_PLAYS'];?>" size="54" class="text"/></dd>
                    </dl>
                     <dl>
                        <dt><label for="email">Total Users:</label></dt>
                        <dd><input type="text" name="total_users" id="total_users" value="<?PHP echo $rowcnt['TOTAL_USERS'];?>" size="54" class="text"/></dd>
                    </dl>
                     <dl>
                        <dt><label for="email">Best Player:</label></dt>
                        <dd><input type="text" name="best_player_id" id="best_player_id" value="<?PHP echo $rowcnt['BEST_PLAYER_ID'];?>" size="54" class="text"/></dd>
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

