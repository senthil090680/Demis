<?php
session_start();
session_unset();
session_destroy();

echo '<script language="javascript">
function redirect()
{
window.document.location.href=\'register.php\';
}
window.setTimeout(\'redirect()\',0);</script>';

?>