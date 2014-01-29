<?php
ob_start();
session_start();
include("dbs.php");
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
	//echo "select USER_IMAGE from user where USER_ID='".$_REQUEST['user_id']."'";
	$qry_user = "select USER_IMAGE from user where USER_ID='".$_REQUEST['user_id']."'";
	$rs= mysql_query( $qry_user );
	$coun  = count($rs);		
	$row=mysql_fetch_array($rs);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>View User Photo</title>
</head>
<body>
<form name="prf_form1" action="" method="post" class="niceform">
<table cellspacing=1 cellpadding=3 border=0 width="82%" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:10px;font-weight:bold;">    
  <tr>
    <td align="center"> <img src="images/user/<?php echo $row[USER_IMAGE]; ?>" width="100" height="100" border="0" /> </td>
	</tr> 
  <?php if($coun=="") {?>
  <tr>
   <td align="center">No Photo's Found.</td>
  </tr>
 <?php } ?>
    <tr>
   <td colspan="2" align="right"><a href="#" onclick="javascript:window.close();">Close</a></td>
  </tr>
  </table>
</form>
</body>
</html>