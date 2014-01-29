<?php
include("header.php"); 
//ob_start();
session_start();
include("dbs.php");

/*echo "<pre>";
print_r($_SESSION);
print_r($_COOKIE);
echo "</pre>";*/
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

$show_query = "SHOW TABLE STATUS like 'user_temp%'";
$show_result = mysql_query($show_query);
$show_num = mysql_num_rows($show_result);
if($show_num > 0) {
while($show_row=mysql_fetch_array($show_result)) {
$show_name = $show_row[Name];


$drop_query = "drop table $show_name";	
//exit;		
$drop_result = mysql_query($drop_query) or die("Data not found.");
}
?>

 <div class="center_content">   
    <div class="one-row_content">      
    
<?php
if($drop_result) {
echo "<div class='valid_box'>Temporary Tables have been dropped successfully.</div>";
}
else {
echo "<div class='error_box'>Temporary Tables cannot be dropped due to some errors.</div>";
}
}
else {
echo "<div class='error_box'>No Temporary Tables to be dropped.</div>";
}
?>
 </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->
