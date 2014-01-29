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
$removefile="backup/".$_REQUEST['filename'];
unlink($removefile);
$querydel="delete from backup where BACK_ID='{$_REQUEST['id']}'";
//exit;
$resultsdel=mysql_query($querydel) or die("connection failed");
header("Location:viewbackup.php?msg=d");
}
?>
  <div class="center_content">   
    <div class="one-row_content">            
        
    <h2 align="right"><a href="backup.php">Take Backup</a></h2>            
    <?PHP if($_GET['bk']=="1") { ?> <div class="valid_box">Database backup has been taken successfully.</div><?PHP } ?>  
    <?PHP if($_GET['msg']=="d") { ?> <div class="valid_box">File has been Deleted successfully.</div><?PHP } ?>                    
<table id="rounded-corner" summary="2007 Major IT Companies' Profit">
    <thead>
    	<tr>        	
            <th scope="col" class="rounded-company">Id</th>
            <th scope="col" class="rounded">File Name</th>            
            <th scope="col" class="rounded-q4">Delete</th>
        </tr>
    </thead>
        
    <tbody>
    
      <?php
include("dbs.php");
@extract($_POST);

/*echo "<pre>";
print_r($_REQUEST);
echo "<pre>";*/

require_once ('pagination.php');
$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
$page = ($page == 0 ? 1 : $page);
$perpage = 10;//limit in each page
$startpoint = ($page * $perpage) - $perpage;
	
$query="select * from backup order by BACK_ID ASC LIMIT $startpoint,$perpage";
$results=mysql_query($query) or die("connection failed");

$querycnt="select count(*) as cnt from backup";
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
?> 
    
       	<tr>
        	<td><?PHP echo $i;?></td>
        	<td ><a class="hover_color" href="download.php?filename=<?PHP echo $FILE_NAME;?>"><?PHP echo $FILE_NAME;?></a></td>                       
            <td><a href="viewbackup.php?id=<?PHP echo $BACK_ID; ?>&del=del&filename=<?PHP echo $FILE_NAME;?>" class="ask"><img src="images/trash.png" alt="" title="" border="0" /></a></td>
        </tr>
		<?PHP
		$i++;
        }
        }
        else
        {
        ?>
        <tr>
    	  <td colspan="6">No Records Found.</td>
    	  </tr> 
		<?PHP 
        }
        
        ?>    
    </tbody>
</table>     
     
      <div class="pagination">
       <?PHP //show pages
echo Pages("backup",$perpage,"viewbackup.php?"); 
?>
        </div> 
 
     
     </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    
   <?php include("footer.php") ?>