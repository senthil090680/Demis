<?php include("header.php");
ob_start();
session_start();
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
?>
<?PHP
include("dbs.php");
if(isset($_REQUEST['del'])=="del")
{
$config_query="select * from config where CONFIG_ID='{$_REQUEST['id']}'";
$config_result=mysql_query($config_query) or die("connection failed");
$config_row=mysql_fetch_array($config_result);
$music_path=$config_row['MUSIC_PATH'];

$removemusic="music_file/".$music_path;
unlink($removemusic);
//exit;
$querydel="delete from config where CONFIG_ID='{$_REQUEST['id']}'";
$resultsdel=mysql_query($querydel) or die("connection failed");
//header("Location:viewconfigs.php?msg=d");
}

?>
                  
                    
    <div class="center_content">  
    
    <div class="one-row_content">            
        
    <h2>Applications</h2>
    <?PHP if($_GET['msg']=="d") { ?>
                <div class="valid_box">
        Application has been deleted Successfully.</a>
     </div>  
     <?PHP } ?>  
                    
                    
<table id="rounded-corner" summary="2007 Major IT Companies' Profit">
    <thead>
    	<tr>
        	
            <th scope="col" class="rounded-company">Id</th>
            <th scope="col" class="rounded">Application Name</th>
            <th scope="col" class="rounded">Level Time</th>
            <th scope="col" class="rounded">Noncam BG Image</th>
            <th scope="col" class="rounded">Music File</th>
            <th scope="col" class="rounded">Edit</th>
            <th scope="col" class="rounded-q4">Delete</th>
        </tr>
    </thead>     
    <tbody>
    <?php
include("dbs.php");
@extract($_POST);

require_once ('pagination.php');
$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
$page = ($page == 0 ? 1 : $page);
$perpage = 10;//limit in each page
$startpoint = ($page * $perpage) - $perpage;
	
$query="select * from config order by CONFIG_ID ASC LIMIT $startpoint,$perpage";
$results=mysql_query($query) or die("connection failed");

$querycnt="select count(*) as cnt from config";
$resultscnt=mysql_query($querycnt) or die("connection failed");
$rowcnt=mysql_fetch_array($resultscnt);

if($rowcnt['cnt']>0)
{	
	if(isset($_REQUEST['page']))
	{
	$i=$startpoint+1;
	}
	else
	{
	$i=1;
	}
while($row=mysql_fetch_array($results))
{	
@extract($row);		
$querycnt1="select * from background where BACKGROUND_ID='$NONCAM_BG_PATH'";
$resultscnt1=mysql_query($querycnt1) or die("connection failed");
$rowcnt1=mysql_fetch_array($resultscnt1);
?>    
    	<tr>
        	<td><?PHP echo $i; ?></td>
        	<td><?PHP echo $APPLICATION_NAME; ?></td>
        	<td><?PHP echo $LEVEL_TIME; ?></td>
        	<td><img src="images/noncambg/<?PHP echo $rowcnt1[BACKGROUND_PATH]; ?>" width="30" height="30"/></td>
        	<td><?PHP echo $MUSIC_PATH;?></td>

            <td><a href="edit_config.php?id=<?PHP echo $CONFIG_ID;?>"><img src="images/user_edit.png" alt="" title="" border="0" /></a></td>
            <td><a href="viewconfigs.php?id=<?PHP echo $CONFIG_ID;?>&del=del" class="ask"><!--<a href="view.php?id=<?PHP echo $CONFIG_ID;?>&del=del" onclick="return confirm('Are you sure? you want to delete the record.')">--><img src="images/trash.png" alt="" title="" border="0" /></a></td>
        </tr>    
   
    <?PHP
	$i++;
}
}
else
{
?>
<tr>
<td colspan="7">No Records Found.</td>
</tr>  
<?PHP 
}
?>
 </tbody>
</table>

	     
     
      <div class="pagination">
        <!--<span class="disabled"><< prev</span><span class="current">1</span><a href="">2</a><a href="">3</a><a href="">4</a><a href="">5</a><a href="">next >></a>-->
<?PHP //show pages
echo Pages("config",$perpage,"viewconfigs.php?"); 
?>
        </div> 
     
 
     
     </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->               
                    
                    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    
   <?php include("footer.php") ?>

