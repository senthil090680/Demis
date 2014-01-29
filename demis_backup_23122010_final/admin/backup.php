<?php
	ob_start();
	session_start();	
	/*$dbuser 	= DB_USERNAME;
	$dbpwd 	    = DB_PASSWORD;
	$dbname 	= DB_NAME;
	$dbhost 	= DB_HOSTNAME;*/
	
	/*$dbuser 	= 'root';
	$dbpwd 	    = '';
	$dbname 	= 'nude';
	$dbhost 	= 'localhost';*/
	$dbuser 	= 'nieve_nievdev';
	$dbpwd 	    = 'copos123';
	$dbname 	= 'nieve_copos_dev';
	$dbhost 	= 'localhost';
	
	$dbprefix 	= '';
	if(!$mycon = @mysql_connect($dbhost,$dbuser,$dbpwd)) die('Database Error: '.mysql_error());
	elseif(!@mysql_select_db($dbname,$mycon)) die ('Database Error: '.mysql_error());

	include_once("dbs.php");
//	error_reporting(E_ALL & ~E_NOTICE);
	$verbose = !empty($_REQUEST['verbose']) ? 1 : 0;
	@set_time_limit(600); // try to give ourselves plenty of time to run

	function backup_mysql()
	{
		global $dbname, $verbose;
		$backticks =1;
		$ticks = ($backticks == 1)? '`' : "'";
		$set['data'] = 1; //with data;
		$set['endit'] = 1;
		$set['usedrop']= 1;

		$tables = mysql_list_tables($dbname) or die(mysql_error());
		$gettables = @mysql_num_rows($tables);
		
		$a .= "##--------------------------------------------\r\n";
		$a .= "##--------------------------------------------\r\n";
		$a .= "##--".$_SERVER['SERVER_NAME']." mySQL Database : ".$dbname."\r\n";
		$a .= "##--Total Tables : ".$gettables." Saved On :".date("Y-m-d H:i:s",time())." \r\n";
		$a .= "##--------------------------------------------\r\n";
		$a .= "##--------------------------------------------\r\n\r\n";
		if($verbose) echo "<pre>".$a."</pre>";

		$ender = ($set['endit']) ? ';':'';

		$sql = mysql_query("SHOW TABLES");
		while($table1 = mysql_fetch_array($sql))
		{
			$table = $table1[0];
			$a .= "\r\n##------------------ ".$table." ----------------------\r\n \r\n";
				
			$drop = "DROP TABLE IF EXISTS $ticks".$table.$ticks.$ender."\r\n";
			$a .= ($set['usedrop']== 1) ? $drop:'';

			$row1 = mysql_query("SHOW CREATE TABLE ".$table) or die(mysql_error());
			$row2 = mysql_fetch_array($row1);
			$row2 = ($backticks == 1) ? $row2[1] : str_replace("`","'",$row2[1]);
			$a .= $row2.$ender."\r\n";
			
			//data
			$a .= ($set['data'] == 1) ? "\r\n".backup_table($table,$set['endit']):'';
			$a .= "\r\n\r\n\r\n\r\n";
		/*	echo "<meta http-equiv='refresh' content='0; URL=login_admin.php?backup=1'>";
			exit; */
			$_SESSION['backup']=1;
			header("location: viewbackup.php?bk=1");
		}
		$a .= "##------------ END OF FILE ----------------------\r\n \r\n";
		define( '_MSOL_PATH', dirname(__FILE__) );
		$filename ="backup/".'sql_'.$dbname.'_'.date("M_d_Y_s").'.sql';
		$filename1 ='sql_'.$dbname.'_'.date("M_d_Y_s").'.sql';
		//echo $filename;date("F j, Y, g:i a");  
		$backupinsert_query = "insert into backup(FILE_NAME) values('$filename1')";					
		$result = mysql_query($backupinsert_query) or die (mysql_error());		
		               
		$filelength = strlen($a);
		$filedata = $a;
		if($verbose) echo "<pre> Path : ".$filename."</pre>";

		if (!$handle = fopen($filename, 'w+')) {
			die("Failed to open stream : ".$filename);
		}
		if (!fwrite($handle,$filedata)){
			die("Fail - Not able to right to file : ".$filename);	
		}
		fclose($handle);
		exit();
	}
	function backup_table($table,$endit=0)
	{
		global $dbname, $verbose;

		$sql = mysql_query("SELECT * FROM $table") or die(mysql_error());
		$count = mysql_num_rows($sql);

		$backticks = 1;
		$ticks = ($backticks == 1)? '`' : "'";
		$countit = mysql_num_fields($sql);		

		while ($row = mysql_fetch_array($sql))
		{
			$a .= "INSERT INTO $ticks".$table."$ticks SET ";
			
			for ($i=0; $i < $countit; $i++)
			{
				$get = mysql_fetch_field($sql,$i);
				$a .= $ticks.$get->name.$ticks."='".addslashes(stripslashes($row[$i]))."'";
				
				if ($i+1 < $countit)
				{
					$a .= ", ";
				}
			}
			
			$a .= ($endit == 1 )? ";":"";
			$a .= "\r\n";
		}
		return $a;
	}
	if($verbose) echo "<br>Starting Backup!";
	backup_mysql();
?>
