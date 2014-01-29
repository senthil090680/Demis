<?php include("header.php"); ?>
    
<?php
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
$querydel="delete from admin where ADMIN_ID='{$_REQUEST['id']}'";
$resultsdel=mysql_query($querydel) or die("connection failed");
header("Location:adminprofile.php?msg=d");
}

?>
                  
                    
    <div class="center_content">  
    
    <div class="one-row_content">            
        
    <h2>Admin Profile's</h2>
    <?PHP if($_GET['msg']=="d") { ?>
                <div class="valid_box">
        Admin Details has been deleted Successfully.</a>
     </div>  
     <?PHP } ?>  
                    
                    
<table id="rounded-corner" summary="2007 Major IT Companies' Profit">
    <thead>
    	<tr>
        	
            <th scope="col" class="rounded-company">Id</th>
            <th scope="col" class="rounded">User Name</th>
            <th scope="col" class="rounded">Password</th>
            <th scope="col" class="rounded">Email Id</th>
            <th scope="col" class="rounded">Mobile Number</th>
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
$perpage = 7;//limit in each page
$startpoint = ($page * $perpage) - $perpage;
	
$query="select * from admin order by ADMIN_ID ASC LIMIT $startpoint,$perpage";
$results=mysql_query($query) or die("connection failed");

$querycnt="select count(*) as cnt from admin";
$resultscnt=mysql_query($querycnt) or die("connection failed");
$rowcnt=mysql_fetch_array($resultscnt);

if($rowcnt['cnt']>0)
{
while($row=mysql_fetch_array($results))
{	
@extract($row);		
?>    
    	<tr>
        	<td><?PHP echo $ADMIN_ID;?></td>
        	<td><?PHP echo $USERNAME;?></td>
            <td><?PHP echo $PASSWORD;?></td>
            <td><?PHP echo $EMAIL;?></td>
            <td><?PHP echo $MOBILE;?></td>

            <td><a href="edit_adminusers.php?id=<?PHP echo $ADMIN_ID;?>"><img src="images/user_edit.png" alt="" title="" border="0" /></a></td>
            <td><a href="adminprofile.php?id=<?PHP echo $ADMIN_ID;?>&del=del" class="ask"><!--<a href="view.php?id=<?PHP echo $ADMIN_ID;?>&del=del" onclick="return confirm('Are you sure? you want to delete the record.')">--><img src="images/trash.png" alt="" title="" border="0" /></a></td>
        </tr>    
   
    <?PHP
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
echo Pages("admin",$perpage,"adminprofile.php?"); 
?>
        </div> 
     
 
     
     </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->               
                    
                    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    
   <?php include("footer.php") ?>

