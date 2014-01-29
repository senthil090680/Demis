<?php
ob_start();
session_start();
include("dbs.php");
extract($_REQUEST);
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
//echo "select * from user where USER_ID='".$_REQUEST[user_id]."' and FACEBOOK_ID = '' and TWITTER_ID = ''";
//exit;
$qry_user = "select * from user where USER_ID=$user_id and FACEBOOK_ID = '' and TWITTER_ID = ''";
$rs= mysql_query( $qry_user );
$rs_cnt = mysql_num_rows($rs);

if($rs_cnt > 0)
{	
	echo 0;
	exit(0);
}
else
{
	echo 1;
	exit(0);
}
  
?>