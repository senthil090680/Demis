
<?php 
		mysql_connect ("mysql", "ticket", "mysql4digient") or die ('I cannot connect to the database because: ' . mysql_error());
		mysql_select_db ("snow") or die ('I cannot connect to the database because: ' . mysql_error());
?>