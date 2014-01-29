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
$querydel="delete from level where LEVEL_ID='{$_REQUEST['id']}'";
$resultsdel=mysql_query($querydel) or die("connection failed");
header("Location:viewlevels.php?msg=d");
}

?>
                  
                    
    <div class="center_content">  
    
    <div class="one-row_content">            
        
    <h2>Levels</h2>
    <?PHP if($_GET['msg']=="d") { ?>
                <div class="valid_box">
        Level has been deleted Successfully.</a>
     </div>  
     <?PHP } ?>  
                    
                    
<table id="rounded-corner" summary="2007 Major IT Companies' Profit">
    <thead>
    	<tr>
            <th scope="col" class="rounded-company" nowrap="nowrap">Level ID</th>
            <th scope="col" class="rounded-company" >Levels</th>
            <th scope="col" class="rounded">Level Description</th>
            <th scope="col" class="rounded">Points to Beat</th>
            <th scope="col" class="rounded">Snow Frequency</th>
            <th scope="col" class="rounded">Snow Maxspeed</th>
            <th scope="col" class="rounded">Nickname</th>
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
	
$query="select * from level order by ABS(LEVEL_ID) ASC LIMIT $startpoint,$perpage";
$results=mysql_query($query) or die("connection failed");

$querycnt="select count(*) as cnt from level";
$resultscnt=mysql_query($querycnt) or die("connection failed");
$rowcnt=mysql_fetch_array($resultscnt);

$i=1;
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
?>    
    	<tr>
        	<td><?PHP echo $i; ?></td>
            <td nowrap="nowrap"><?PHP if($LEVEL_ID != 11) { echo "Level $LEVEL_ID"; } else if ($LEVEL_ID == 11) { echo "Win"; } ?></td>
        	<td><?PHP echo $LEVEL_DESC; ?></td>
        	<td><?PHP echo $POINTS_BEAT; ?></td>
        	<td><?PHP echo $SNOW_FREQUENCY; ?></td>
        	<td><?PHP echo $SNOW_MAXSPEED; ?></td>
        	<td><?PHP echo $NICKNAME; ?></td>

            <td><a href="edit_level.php?id=<?PHP echo $LEV_ID;?>"><img src="images/user_edit.png" alt="" title="" border="0" /></a></td>
            <td><a href="viewlevels.php?id=<?PHP echo $LEV_ID;?>&del=del" class="ask"><!--<a href="view.php?id=<?PHP echo $LEV_ID;?>&del=del" onclick="return confirm('Are you sure? you want to delete the record.')">--><img src="images/trash.png" alt="" title="" border="0" /></a></td>
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
echo Pages("level",$perpage,"viewlevels.php?"); 
?>
        </div> 
     
 
     
     </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->               
                    
                    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    
   <?php include("footer.php") ?>

