<?php
ob_start();
session_start();
require 'admin/dbs.php';
		
if(isset($_SESSION['user_tem']))
{
	session_unset();
	session_destroy();	
	$temp_drop = "drop table $_SESSION[user_tem]";
	$temp_drop_result = mysql_query($temp_drop);
	if($temp_drop_result) {
		/*echo '<script language="javascript">
		function redirect()
		{
		window.document.location.href=\'index.php\';
		}
		window.setTimeout(\'redirect()\',0);</script>';*/
		header( 'Location: http://nieveenlima.pe/juego_dev/index.php' ) ;
	}
}
else if (!isset($_SESSION['user_tem']))
{	
	session_unset();
	session_destroy();
	/*echo '<script language="javascript">
	function redirect()
	{
	window.document.location.href=\'index.php\';
	}
	window.setTimeout(\'redirect()\',0);</script>';*/
	header( 'Location: http://nieveenlima.pe/juego_dev/index.php' ) ;
}
?>