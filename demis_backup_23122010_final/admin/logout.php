<?PHP 
session_start();
if($_SESSION['admin_id'])
{
$_SESSION['admin_name']=="";
$_SESSION['admin_id']=="";

session_unset();
session_destroy();
echo '<script language="javascript">
function redirect()
{
	window.document.location.href=\'index.php\';
}
window.setTimeout(\'redirect()\',0);</script>';
exit (0);

}

?>