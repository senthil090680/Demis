<?php
$file=$_REQUEST['filename'];
header('Content-disposition: attachment; filename='.$file);
header('Content-type: application/sql');
readfile('backup/'.$file);
?>
