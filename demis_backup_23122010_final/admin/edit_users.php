<?php include("header.php"); ?>

<?php
include("dbs.php");
extract($_REQUEST);
if(($_REQUEST[submit]) && ($val == ''))
{	
	//echo "update user set FIRSTNAME='{$_REQUEST[firstname]}',LASTNAME='{$_REQUEST[lastname]}',USERNAME='{$_REQUEST[username]}',EMAIL='{$_REQUEST[email]}',GENDER='{$_REQUEST[gender]}',LASTPLAYED_DATE='{$_REQUEST[lastplayed_date]}' where USER_ID='{$_REQUEST[id]}'";
//exit;
$query="update user set FIRSTNAME='{$_REQUEST[firstname]}',LASTNAME='{$_REQUEST[lastname]}',USERNAME='{$_REQUEST[username]}',PASSWORD='{$_REQUEST[password]}',EMAIL='{$_REQUEST[email]}',GENDER='{$_REQUEST[gender]}',LASTPLAYED_DATE='{$_REQUEST[lastplayed_date]}',SCORE='{$_REQUEST[score]}' where USER_ID='{$_REQUEST[id]}'";
$results=mysql_query($query) or die("connection failed");
	header("Location: edit_users.php?msg=su&id={$_REQUEST['id']}&val=$val");
	exit;
}
else if (($_REQUEST[submit]) && ($val != ''))
{

	//echo "update user set FIRSTNAME='{$_REQUEST[firstname]}',LASTNAME='{$_REQUEST[lastname]}',USERNAME='{$_REQUEST[username]}',EMAIL='{$_REQUEST[email]}',GENDER='{$_REQUEST[gender]}',LASTPLAYED_DATE='{$_REQUEST[lastplayed_date]}' where USER_ID='{$_REQUEST[id]}'";
	//exit;
	$query="update user set GENDER='{$_REQUEST[gender]}',LASTPLAYED_DATE='{$_REQUEST[lastplayed_date]}',SCORE='{$_REQUEST[score]}' where USER_ID='{$_REQUEST[id]}'";
	$results=mysql_query($query) or die("connection failed");
		header("Location: edit_users.php?msg=su&id={$_REQUEST['id']}&val=$val");
		exit;
}
else
{
$query_profile = "select * from user where USER_ID='{$id}'";
$results=mysql_query($query_profile) or die("connection failed");
$rowcnt=mysql_fetch_array($results);
}
?>                   
<script language="javascript" src="js/adminvalidate.js"></script>
<link type="text/css" rel="stylesheet" href="css/rfnet" media="screen"/>
<script src = "js/datetimepicker_css.js"  type="text/javascript" language="javascript"></script>               
    <div class="center_content">     
    
    <div class="one-row_content">            
     
     <h2>Edit User</h2>
     <?PHP if($_GET['msg']=="su") { ?>
     <div class="valid_box">
        User has been updated successfully | <a href="viewusers.php"><b style="font-size:18px">View Users</b></a>
     </div>
     <?PHP } ?>        
         <div class="form">         
         <form name="user" method="post" onSubmit="return usereditvalidate(this);" class="niceform">
                <fieldset>                
                	<?php if($val == ''){ ?>
                    <dl>
                        <dt><label for="email">First Name:</label></dt>
                        <dd><input type="text" name="firstname" id="firstname" value="<?PHP echo $rowcnt['FIRSTNAME'];?>" size="54" class="text"/></dd>
                    </dl>
                    <?php }  ?>
                    <?php if($val == ''){ ?>
                    <dl>
                        <dt><label for="email">Last Name:</label></dt>
                        <dd><input type="text" name="lastname" id="lastname" value="<?PHP echo $rowcnt['LASTNAME'];?>" size="54" class="text"/></dd>
                    </dl>
                    <?php }  ?>
                    <?php if($val == ''){ ?>
                    <dl>
                        <dt><label for="email">User Name:</label></dt>
                        <dd><input type="text" name="username" id="username" value="<?PHP echo $rowcnt['USERNAME'];?>" size="54" class="text"/></dd>
                    </dl>
                    <?php }  ?>
                    <?php if($val == ''){ ?>
                    <dl>
                        <dt><label for="email">Password:</label></dt>
                        <dd><input type="text" name="password" id="password" value="<?PHP echo $rowcnt['PASSWORD'];?>" size="54" class="text"/></dd>
                    </dl>
                    <?php }  ?>
                    <?php if($val == ''){ ?>
                    <dl>
                        <dt><label for="email">E-mail:</label></dt>
                        <dd><input type="text" name="email" id="email" value="<?PHP echo $rowcnt['EMAIL'];?>" size="54" class="text"/></dd>
                    </dl>
                    <?php }  ?>
                    <dl>
                        <dt><label for="email">Gender:</label></dt>
                        <dd><select name="gender" id="gender" class="text">
	                        <option value='' >-----Select-----</option>
                            <option value="Male" <?php if(($rowcnt['GENDER'] == "Male") || ($rowcnt['GENDER'] == "male")){ ?>selected <?php } ?> >Male</option>
                            <option value="Female" <?php if(($rowcnt['GENDER'] == "Female") || ($rowcnt['GENDER'] == "female")) { ?>selected <?php } ?>>Female</option>
                            </select><input type="hidden" name="val" id="val" value="<?PHP echo $val; ?>"/></dd>
                    </dl>
                    <dl>
                        <dt><label for="email">Score:</label></dt>
                        <dd><input type="text" name="score" id="score" value="<?PHP echo $rowcnt['SCORE'];?>" size="54" class="text"/></dd>
                    </dl>                    
                    <dl>
                        <dt><label for="email">Date & Time of Last Game:</label></dt>
                        <dd><input type="text" name="lastplayed_date" id="lastplayed_date" readonly value="<?PHP echo $rowcnt['LASTPLAYED_DATE'];?>" size="54" class="text"/><input type="button" value="Cal" onclick="NewCssCal('lastplayed_date','yyyymmdd','arrow',true,12,false)"></dd>
                    </dl>
                    
                     <dl class="submit">
                    <input type="submit" name="submit" value="Update" /><input type="hidden" name="id"  id="id" value="<?PHP echo $_REQUEST['id'];?>"><?php if(isset($val)){ ?><?php }  ?>
                     </dl>
                     
                     
                    
                </fieldset>
                
         </form>
         </div>  
      
     
     </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->               
                    
                    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    
   <?php include("footer.php") ?>

