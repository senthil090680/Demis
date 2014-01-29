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

if($_REQUEST['status']=="set")
 {
		 $qry_user = "update user set STATUS='1' where USER_ID='".$_REQUEST['userid']."'";
		$rs= mysql_query( $qry_user );
		
				
 }
 else if($_REQUEST['status']=="unset")
 {
		$qry_user = "update user set STATUS='0' where USER_ID='".$_REQUEST['userid']."'";
		$rs=mysql_query( $qry_user );
		
}  
?>