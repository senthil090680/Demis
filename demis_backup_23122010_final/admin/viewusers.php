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
?>
<?PHP
include("dbs.php");
if(isset($_REQUEST['del'])=="del")
{
$querydel="delete from user where USER_ID='{$_REQUEST['id']}'";
$resultsdel=mysql_query($querydel) or die("connection failed");
header("Location:viewusers.php?msg=s");
}


?>
<script src = "js/adminvalidate.js"  type="text/javascript" language="javascript"></script>
<link type="text/css" rel="stylesheet" href="css/style.css" />
<div class="center_content">
<div class="one-row_content"> <h2>User's Search</h2>
<!--<input type="text" name="keyword" value="<?php// echo $keyword; ?>" size="54">-->
<form name="searchform" action="viewusers.php" method="post"  class="niceform" onsubmit="keyword_check()">
	<table cellpadding="3" cellspacing="3" align="center">    
			<td align="right">Search</td>
			<td>:</td>
			<td align="left">
             <input type="text" name="keyword" id="keyword" class="text" <?PHP if($keyword=="") { ?> value="Eg: username,firstname,lastname,email"  <?PHP } else { ?> value="<?php echo $keyword; ?>" <?PHP } ?> onclick="this.value=''"  size="54"/>
            <!--<input type="text" class="search_input" name="keyword" onblur="if (this.value == '') {this.value = 'Eg: username,firstname,lastname,email,country';}" onfocus="if (this.value == 'Eg: username,firstname,lastname,email,country') {this.value = '';}" <?PHP// if($keyword=="") { ?> value="Eg: username,firstname,lastname,email,country"  <?PHP// } else { ?> value="<?php// echo $keyword; ?>" <?PHP// } ?> size="54">--></td>
            <td align="left"><input type="image" class="search_submit" src="images/search.png" /></td>
		</tr>
		<!--<tr>			
		    <td align="center" colspan="3"><input type="submit" value="Search" name="search" /></td>
		</tr>	-->			
	</table>
</form>
   
           
        
    <h2>User Profile's</h2> 
       <?PHP if($_GET['msg']=="d") { ?><div class="valid_box">User Details has been deleted Successfully.</a></div><?PHP } ?>               
                    
<table id="rounded-corner" summary="2007 Major IT Companies' Profit">
    <thead>
    	<tr>
        	<th scope="col" class="rounded-company">Id</th>
            <th scope="col" class="rounded">Username</th>
            <th scope="col" class="rounded" nowrap="nowrap">First Name</th>
            <th scope="col" class="rounded" nowrap="nowrap">Last Name</th>
            <th scope="col" class="rounded">Email</th>
            <th scope="col" class="rounded">Gender</th>
            <th scope="col" class="rounded" >User Image</th>
           <!-- <th scope="col" class="rounded" >Registered Date</th>-->
            <th scope="col" class="rounded" nowrap="nowrap">Last Played Date</th>
           <!-- <th scope="col" class="rounded">Status</th>-->
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

if(isset($_POST['keyword']))
{
$keyword_srch=$_POST['keyword'];
$querycnt="select count(*) as cnt from user where FIRSTNAME like '%".$keyword_srch."%' or LASTNAME like '%".$keyword_srch."%' or USERNAME like '%".$keyword_srch."%' or EMAIL like '%".$keyword_srch."%'";
$query="select * from user where FIRSTNAME like '%".$keyword_srch."%' or LASTNAME like '%".$keyword_srch."%' or USERNAME like '%".$keyword_srch."%' or EMAIL like '%".$keyword_srch."%' order by USER_ID ASC LIMIT $startpoint,$perpage";
$results=mysql_query($query) or die("connection failed");
$resultscnt=mysql_query($querycnt) or die("connection failed");
$rowcnt=mysql_fetch_array($resultscnt);
}
else
{
$querycnt="select count(*) as cnt from user";
$query="select * from user order by USER_ID ASC LIMIT $startpoint,$perpage";
$results=mysql_query($query) or die("connection failed");

$resultscnt=mysql_query($querycnt) or die("connection failed");
$rowcnt=mysql_fetch_array($resultscnt);
//header('Location:users.php');
} 

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
        	<td><?PHP echo ucfirst($USERNAME); ?></td>
            <td><?PHP echo ucfirst($FIRSTNAME); ?></td>
             <td><?PHP echo ucfirst($LASTNAME); ?></td>
            <td><?PHP echo $EMAIL;?></td>
            <td><?PHP echo ucfirst($GENDER); ?></td>
            <td><A href="#" onClick="window.open('photo.php?user_id=<?php echo $USER_ID; ?>', 'MyPopUp',  'width=100,height=180,toolbar=0,scrollbars=1,screenX=200,screenY=200,left=200,top=200')"><img src="images/user/<?php echo $USER_IMAGE; ?>" alt="" title="" width="40" height="40" border="0" /></A></td>
<!--<td><?PHP echo $REGISTERED_DATE;?></td>-->
<td><?PHP echo $LASTPLAYED_DATE;?></td>    
            <!--<td><?php if($STATUS==1) {?>
	 <a href="javascript:userunsetauthenticate(<?php echo $USER_ID; ?>);"><img src="images/active.gif" alt="" title="" border="0" /></a>
<?php } else if($STATUS==0) { ?>
<a href="javascript:usersetauthenticate(<?php echo $USER_ID; ?>);"><img src="images/deactive.gif" alt="" title="" border="0" /></a>
<?php } ?></td>-->
<td><a href="javascript:checkfromfb(<?PHP echo $USER_ID;?>)"><img src="images/user_edit.png" alt="" title="" border="0" /></a></td>
<td><a href="viewusers.php?id=<?PHP echo $USER_ID;?>&del=del" class="ask"><img src="images/trash.png" alt="" title="" border="0" /></a></td>
        </tr>
			<?PHP
			$i++;
            }
            }
            else
            {
            ?>   
    		<tr>
        	
        	<td colspan="10">No Records Found.</td>
          </tr>
			<?PHP 
            }
            
            ?>
    </tbody>
</table>

	     
     
      <div class="pagination">
       <?PHP //show pages
echo Pages("user",$perpage,"viewusers.php?"); 
?>
        </div> 
     
<!-- 		<div id="showmsg1" class="showmsgclass"></div>
-->     
     </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->               
                    
                    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    
   <?php include("footer.php") ?>