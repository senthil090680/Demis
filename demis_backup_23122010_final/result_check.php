<?php
//ob_start();
session_start();

echo '<script language="javascript">
function redirect()
{
window.document.location.href=\'final3.php\';
}
window.setTimeout(\'redirect()\',0);</script>';


?>