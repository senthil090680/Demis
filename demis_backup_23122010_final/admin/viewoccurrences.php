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
$querydel="delete from level_snowflake where LEVEL_SF_ID='{$_REQUEST['id']}'";
$resultsdel=mysql_query($querydel) or die("connection failed");
header("Location:viewoccurrences.php?msg=d");
}

?>
                  
                    
    <div class="center_content">  
    
    <div class="one-row_content">            
        
    <h2>Occurrences</h2>
    <?PHP if($_GET['msg']=="d") { ?>
                <div class="valid_box">
        Occurrence has been deleted Successfully.</a>
     </div>  
     <?PHP } ?>  
                    
                    
<table id="rounded-corner" summary="2007 Major IT Companies' Profit">
    <thead>
    	<tr>
            <th scope="col" class="rounded-company">Id</th>
            <th scope="col" class="rounded">Snowflakes</th>
            <th scope="col" class="rounded">Level </th>
            <th scope="col" class="rounded">Occurrence</th>
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
	
$query="select * from level_snowflake order by ABS(LEVEL_ID) ASC LIMIT $startpoint,$perpage";
$results=mysql_query($query) or die("connection failed");

$querycnt="select count(*) as cnt from level_snowflake";
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
$query_profile = "select * from snowflake";
$sf_results=mysql_query($query_profile) or die("connection failed");
$num_sf=mysql_num_rows($sf_results);
//$rowcnt_sf=mysql_fetch_array($sf_results);
$query_profile1 = "select LEVEL_ID from level where LEVEL_ID='$LEVEL_ID'";
$lev_results=mysql_query($query_profile1) or die("connection failed");
$rowcnt_lev=mysql_fetch_array($lev_results);
	
?>    
    	<tr>
            <td><?PHP echo $i; ?></td>
        	<td><?php $z=1; while ($rowcnt_sf = mysql_fetch_array($sf_results)) { ?>
                            <?php if($num_sf == $z) 
								  {
								 echo $rowcnt_sf[SNOWFLAKE_DESC]; } else {
								 echo $rowcnt_sf[SNOWFLAKE_DESC].","; } ?><?php $z++; }?></td>
        	<td><?PHP if($rowcnt_lev[LEVEL_ID] == 11) { echo "Win"; } else if ($rowcnt_lev[LEVEL_ID] != 0) { echo "Level $rowcnt_lev[LEVEL_ID]"; } ?></td>
        	<td><?PHP echo $OCCURRENCE; ?></td>

            <td><a href="edit_occurrence.php?id=<?PHP echo $LEVEL_SF_ID;?>"><img src="images/user_edit.png" alt="" title="" border="0" /></a></td>
            <td><a href="viewoccurrences.php?id=<?PHP echo $LEVEL_SF_ID;?>&del=del" class="ask"><!--<a href="view.php?id=<?PHP echo $LEVEL_SF_ID;?>&del=del" onclick="return confirm('Are you sure? you want to delete the record.')">--><img src="images/trash.png" alt="" title="" border="0" /></a></td>
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
echo Pages("level_snowflake",$perpage,"viewoccurrences.php?"); 
?>
        </div> 
     
 
     
     </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->               
                    
                    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    
   <?php include("footer.php") ?>

