<?php
session_start();
session_unset();
session_destroy();
//require 'admin/dbs.php';



//$temp_drop = "drop table $_SESSION[user_tem]";
//$temp_drop_result = mysql_query($temp_drop) or die("Data not found.");		

echo '<script language="javascript">
function redirect()
{
window.document.location.href=\'index.php\';
}
window.setTimeout(\'redirect()\',0);</script>';

?>