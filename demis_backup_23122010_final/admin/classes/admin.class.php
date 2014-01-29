<?php
class Admin
{
	
    function adminUser_Login()   {
	
	  	 global  $DB;
		 
	     $user_login     = $_POST['adminuser'];
		 $pass_word      = $_POST['adminpassword'];
	     $q_user       = "select ADMIN_ID,USERNAME,PASSWORD from admin where USERNAME=BINARY('{$user_login}') and PASSWORD=BINARY('{$pass_word}')";
		  
		  $result = mysql_query($q_user) or die (mysql_error());
		  $num=mysql_num_rows($result);		
	      
			if($num>0)
				{		
					$row = mysql_fetch_array($result);																
					$_SESSION[ admin_id ] =	$row['ADMIN_ID'];
					$_SESSION[ admin_name ] =	$row['USERNAME'];					
					return true;
			    }
				
			else	
			  return false;   
			  }
			  
			  
			  function Admin_available( ){
	 
         	if( "" == $_SESSION[ admin_id ]  && ! trim( $_SESSION[ admin_id ]  ) ){
 
 		    echo "<script>alert('You are not yet Logged In');</script>";
		    header("location:index.php");
		    exit;
	          }
			 
			 else	
			    return true;  }
			  
				
	function admin_registration() {		
	
	          global  $DB;				
			  $admin_count  = "select * from admin where USERNAME='{$_POST[adname]}'";
			  $result = mysql_query($admin_count) or die (mysql_error());
			  $num=mysql_num_rows($result);	
			  
			 // $exe_user_count    = $DB -> Execute($admin_count);
            //  $fetch_admin_count  = $exe_user_count->fields[dup_cnt];
			   
			  if($num>0)
			   { 	
			   		 //$err="Admin User Already Exists in DB.Plz Choose New User Name !";
					return  0;
			 }
			 else
			 {
			 	//echo "insert into admin (USERNAME,PASSWORD,EMAIL,MOBILE,STATUS) values('{$_POST[adname]}','{$_POST[adpass]}','{$_POST[ademail]}','{$_POST[admobile]}','Y')";
				$admininsert_query = "insert into admin (USERNAME,PASSWORD,EMAIL,MOBILE,STATUS) values('{$_POST[adname]}','{$_POST[adpass]}','{$_POST[ademail]}','{$_POST[admobile]}','Y')";
					
					$result = mysql_query($admininsert_query) or die (mysql_error());						   		
			  		//$err="New Admin User Added Successfully";
		 			return  1;		
			}
		}		

}
?>