<?php
session_start();

$RandomStr = md5(microtime());
$token = substr($RandomStr,0,5); 
ini_set('extension', 'php_openssl.dll');
ini_set('extension', 'php_curl.dll');
require 'src/facebook.php';
@extract($_REQUEST);
/*echo "<pre>";
print_r($_SESSION);
print_r($_COOKIE);
echo "</pre>";
*/

Facebook::$CURL_OPTS[CURLOPT_SSL_VERIFYPEER] = false;
Facebook::$CURL_OPTS[CURLOPT_SSL_VERIFYHOST] = 2;
// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  /*'appId'  => '145525952135269',
  'secret' => '02b079e4e11d4c10c4c72c2335ffe7b9',
  'cookie' => true,*/  
  
  'appId'  => '172175656133736',
  'secret' => '058f4ac1eba141f7558dd6834ccfc319',
  'cookie' => true,
));

// We may or may not have this data based on a $_GET or $_COOKIE based session.
//
// If we get a session here, it means we found a correctly signed session using
// the Application Secret only Facebook and the Application know. We dont know
// if it is still valid until we make an API call using the session. A session
// can become invalid if it has already expired (should not be getting the
// session back in this case) or if the user logged out of Facebook.
$session = $facebook->getSession();

$me = null;
// Session based API call.
if ($session) {
  try {
    $uid = $facebook->getUser();
    $me = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
  }
}

// login or logout url will be needed depending on current user state.
if ($me) {
  $logoutUrl = $facebook->getLogoutUrl();
} else {
  $loginUrl = $facebook->getLoginUrl();
}

// This call will always work since we are fetching public data.
$naitik = $facebook->api('/naitik');

?>
<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    
  </head>
  <body>
    <!--
      We use the JS SDK to provide a richer user experience. For more info,
      look here: http://github.com/facebook/connect-js
    -->
    <div id="fb-root"></div>
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId   : '<?php echo $facebook->getAppId(); ?>',
          session : <?php echo json_encode($session); ?>, // don't refetch the session when PHP already has it
          status  : true, // check login status
          cookie  : true, // enable cookies to allow the server to access the session
          xfbml   : true // parse XFBML
        });

        // whenever the user logs in, we refresh the page
        FB.Event.subscribe('auth.login', function() {
          window.location.reload();
		  //window.top.location = 'http://www.google.in';
		  //window.top.location = 'http://localhost/snow/';
		  window.top.location = 'http://nieveenlima.pe/juego/';
		  
		  //http://digient.in/snow/index.php
        });
      };

      (function() {
        var e = document.createElement('script');
        e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
        e.async = true;
        document.getElementById('fb-root').appendChild(e);
      }());
    </script>




   </body>
   </html>


<?php
include("admin/dbs.php");
if($me[id] != "")
{
$file=file_get_contents('https://graph.facebook.com/me/friends?access_token='.$session['access_token']);
  
$file=str_replace('{"data":[','',$file);
        if(preg_match_all('~{(.*?)}~', $file ,$title,PREG_SET_ORDER))
        {               
            foreach ($title as $val)
            {                 
					$row=explode('{"name":"',$val[0]);
					$row=$row[1];
					$row=explode('","id":"',$row);
					//$name=$row[0];
					$id=$row[1];//  we got the id as id=634931521"} now just remove the "}.. for that substr.
					$id=substr($id,0,-2);								           
					
					//echo "select USER_FR_FB_ID from user_friend_fb where USER_FR_FB_ID='{$id}'";
					$sqlcheck=@mysql_query("select USER_FR_FB_ID from user_friend_fb where USER_FR_FB_ID='{$id}'"); 
					$num=@mysql_num_rows($sqlcheck);
					//echo $num;
					if($num>0)
					{
						
					}
					else
					{
						//echo "insert into user_friend_fb (USER_ID,USER_FR_FB_ID) values ('{$me['id']}','{$id}')";
						$sqlinsert=@mysql_query("insert into user_friend_fb (USER_ID,USER_FR_FB_ID) values ('{$me['id']}','{$id}')"); 
					}
            }                            
        }
}
else if(isset($_SESSION[FACEBOOK_ID]))
{
	echo "<script>window.top.location = 'http://nieveenlima.pe/juego/logout.php'</script>";

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Demis - Play page</title>
<!-- style Document -->
<link href="css/style.css" rel="stylesheet" type="text/css" />

<!--[if IE 8]>
<style type="text/css">
#primary_nav{top:481px;left:14px;}
#primary_nav li.jugar{margin:1px 0 0 0}
#primary_nav li.reglas{margin:0 0 0 11px}
#primary_nav li.informacion{margin:0 0 0 14px}
</style>
<![endif]-->
<script language="javascript">

var xmlHttp
//Ads Start
function GetXmlHttpObject()
{

var objXMLHttp=null
if (window.XMLHttpRequest)
{
objXMLHttp=new XMLHttpRequest()
}
else if (window.ActiveXObject)
{
objXMLHttp=new ActiveXObject("Microsoft.XMLHTTP")
}
return objXMLHttp
}







</script>

<script type="text/javascript" src="js/jquery1.4.4.js"></script>
<script language="javascript" src="js/user.js"></script>
<!--<script type="text/javascript" src="scripts/ajaxupload.js"></script>-->
<script type="text/javascript">

$(document).ready(function() {
	$('a.poplight[href^=#]').click(function() {
    var popID = $(this).attr('rel'); //Get Popup Name
    var popURL = $(this).attr('href'); //Get Popup href to define size

    //Pull Query & Variables from href URL
    var query= popURL.split('?');
    var dim= query[1].split('&');
    var popWidth = dim[0].split('=')[1]; //Gets the first query string value

    //Fade in the Popup and add close button
    $('#' + popID).fadeIn().css({ 'width': Number( popWidth ) }).prepend('<a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>');

    //Define margin for center alignment (vertical   horizontal) - we add 80px to the height/width to accomodate for the padding  and border width defined in the css
    var popMargTop = ($('#' + popID).height() + 80) / 2;
    var popMargLeft = ($('#' + popID).width() + 80) / 2;

    //Apply Margin to Popup
    $('#' + popID).css({
        'margin-top' : -popMargTop,
        'margin-left' : -popMargLeft
    });

    //Fade in Background
    $('body').append('<div id="fade"></div>'); //Add the fade layer to bottom of the body tag.
    $('#fade').css({'filter' : 'alpha(opacity=60)'}).fadeIn(); //Fade in the fade layer - .css({'filter' : 'alpha(opacity=80)'}) is used to fix the IE Bug on fading transparencies 

    return false;
});

//Close Popups and Fade Layer
$('a.close, #fade').live('click', function() { //When clicking on the close or fade layer...
    $('#fade , .popup_block').fadeOut(function() {
        $('#fade, a.close').remove();  //fade them both out
    });
    return false;
});

$('#demis_forgetpassword').hide();

$('.login').click(function(){
$('#demis_userlogin').show();
$('#demis_forgetpassword').hide();});
$('#register-now').click(function(){$('#login').hide("slow");});
$('.forget-password').click(function(){$('#demis_forgetpassword').show();$('#demis_userlogin').hide();});

});


</script>
</head>

<body>

<div id="main_wrapper">
<div id="content_wrapper">

<!-- primary navigation starts -->
<div id="primary_nav">
  <ul>
    <li class="jugar"><a href="jugar.php"><img src="images/jugar.png" alt="" title="Jugar" /></a></li>
     <li class="reglas"><a href="reglas.php"><img src="images/reglas.png" alt="" title="Reglas" /></a></li>
      <li class="informacion"><a href="informacion.php"><img src="images/informacion.gif" alt="" title="Informacion" /></a></li>
  
  </ul>

</div>

<?php if(isset($msg)) { ?>
<span id="register_success"><?php echo $msg; ?></span>
<?php } ?>
<!-- primary navigation ends -->

<div class="content_bg">
<div class="content">
<h1>Reglas</h1>

<p class="how_to_play">

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque pharetra, sapien eu placerat vulputate, metus odio molestie purus, sed fringilla quam odio nec leo. Integer vel sapien vel nisl sagittis sollicitudin. Etiam vitae ullamcorper arcu. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce ac euismod nibh. Suspendisse interdum fermentum elit vel lacinia. Nam et nisl est. Fusce quis lacus sem, in cursus urna. Morbi placerat mauris eget urna cursus quis cursus eros ullamcorper. Nulla dapibus imperdiet sagittis. Nunc est magna, vestibulum sit amet ultricies quis, accumsan eu ante. Nulla luctus tortor ut sapien condimentum vitae dapibus tellus molestie. Pellentesque rutrum velit ut est fringilla ullamcorper. Aenean risus turpis, tempor vel imperdiet sit amet, condimentum sed dolor. <br /><br />

ullamcorper. Nulla dapibus imperdiet sagittis. Nunc est magna, vestibulum sit amet ultricies quis, accumsan eu ante. Nulla luctus tortor ut sapien condimentum vitae dapibus tellus molestie. Pellentesque rutrum velit ut est fringilla ullamcorper.

</p>

</div>
</div>


<?php if((isset($_SESSION['FACEBOOK_ID'])) || ($me['id'] !='')) {  ?>
<a href="playpage.php" class="start_playing">   </a>
<?php } 
	else if(isset($_SESSION['USER_ID'])) {  ?>
<a href="playpage.php" class="start_playing">   </a>
<?php } 
	else if((!isset($_SESSION['FACEBOOK_ID'])) && (!isset($_SESSION['USER_ID'])) && ($me['id'] =='')) {  ?>
<a href="playpage.php?user_temp=<?php echo $token; ?>" class="start_playing">   </a>
<?php } ?>



<div class="align_center" id="social">
<span class="facebook-connect">
	<?php if(!isset($_SESSION['USER_ID'])) { ?>
	<?php if ($me): ?>
      <a href="<?php echo $logoutUrl; ?>">
     <!-- <a href="logout.php">-->
     <!-- <a href="fb_logout.php">-->
      <img src="http://static.ak.fbcdn.net/rsrc.php/z2Y31/hash/cxrz4k7j.gif">
    </a>
        
    <?php else: ?>
   <fb:login-button perms="email,user_birthday"></fb:login-button><fb:activity-feed site="example.com"/>
    
   <!-- <div>
      Without using JavaScript &amp; XFBML:
      <a href="<?php// echo $loginUrl; ?>">
        <img src="http://static.ak.fbcdn.net/rsrc.php/zB6N8/hash/4li2k73z.gif">
      </a>
    </div>-->
    <?php endif ?>
	<?php } ?>	
<!--<a href="#" class="f-connect"><img src="images/f-connect.png" /></a>-->

<?php if((!isset($_SESSION['FACEBOOK_ID'])) && (!isset($_SESSION['USER_ID'])) && ($me['id'] =='') && (!isset($_SESSION['NEW']))) { ?>
<a href="#?w=470" rel="registeration" class="register poplight"> <img src="images/register.png" /></a>
<?php } ?>

<?php if((!isset($_SESSION['FACEBOOK_ID'])) && (!isset($_SESSION['USER_ID'])) && ($me['id'] =='')) { ?>
<a href="#?w=470" rel="login" class="login poplight"><img src="images/login.png" /></a>
<?php } ?>
<?php if((!isset($_SESSION['FACEBOOK_ID'])) && (isset($_SESSION['USER_ID'])) && ($me['id'] =='')) { ?>
<a href="logout.php" rel="login" class="login poplight"><img src="images/rhs-logout-button.gif" /></a>
<?php } ?>

</span>
</div>




<!-- social networking starts -->
<!--<div id="social_networking">
  
   <a href="#" class="" title="Facebook"><img src="images/facebook.png" alt="" /></a><a href="#" class="" title="Twitter"><img src="images/twitter.png" alt="" /></a><a href="#" class="" title="You Tube"><img src="images/you_tube.png" alt="" /></a></div>-->
<!-- social networking ends -->

</div><!-- registration pop up starts -->
<div id="registeration" class="popup_block">
   <img src="images/signup.png" alt="" />
    
						
                        <form method="post" class="niceform" enctype="multipart/form-data" >
							 <span class="error" id="error_msg1"></span>
                	
                    <dl class="username">
                        <dt><label for="email">Username:</label></dt>
                        <dd><input class="text" type="text" name="username"  id="username" size="54"></dd>
                    </dl>
                    
                     <dl class="password">
                        <dt><label for="email">Password:</label></dt>
                        <dd><input class="text" type="password" name="password"  id="password" size="54"></dd>
                    </dl>
                    
                    <dl class="firstname">
                        <dt><label for="email">First Name:</label></dt>
                        <dd><input class="text" type="text" name="firstname"  id="firstname" size="54"></dd>
                    </dl>
                    
                    <dl class="lastname">
                        <dt><label for="email">Last Name:</label></dt>
                        <dd><input class="text" type="text" name="lastname"  id="lastname" size="54"></dd>
                    </dl>
                  
                    <dl class="email">
                        <dt><label for="email">E-mail:</label></dt>
                        <dd><input class="text" type="text" name="email"  id="email" size="54"></dd>
                    </dl>
                    
                    <dl class="gender">
                        <dt><label for="email">Gender:</label></dt>
                        <dd><select name="gender" id="gender" class="text">
	                        <option value='' >-----Select-----</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            </select>
                      	</dd>
                    </dl>
                    
                    <dl class="upload">
                        <dt><label for="file">User Image:</label></dt>
                        <dd><input class="text" type="file" name="user_image" id="user_image" size="20" border="0"/></dd>
                    </dl>                    
                    
                     <?ph 
					 /*function curPageURL() {
					 $pageURL = 'http';
					 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
					 $pageURL .= "://";
					 if ($_SERVER["SERVER_PORT"] != "80") {
					  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
					 } else {
					  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
					 }
					 return $pageURL;
					}
						 
					$url_find = curPageURL(); 
					echo $image_url=str_replace("index.php","admin/images/user/",$url_find);*/
					?>
                   
                    
                    <!--<button onClick="ajaxUpload(this.form,'ajaxupload.php?user_image=user_image&amp;maxSize=9999999999&amp;maxW=200&amp;fullPath=http://localhost/snow/admin/images/user/&amp;relPath=admin/images/user/&amp;colorR=255&amp;colorG=255&amp;colorB=255&amp;maxH=300','upload_area','File Uploading Please Wait...&lt;br /&gt;&lt;img src=\'images/loader_light_blue.gif\' width=\'128\' height=\'15\' border=\'0\' /&gt;','&lt;img src=\'images/error.gif\' width=\'16\' height=\'16\' border=\'0\' /&gt; Error in Upload, check settings and path info in source code.'); return false;"/>Upload Image</button>-->
                    <!--<dl class="submit">
                    <button onClick="ajaxUpload(this.form,'scripts/ajaxupload.php?filename=user_image&username=username&firstname=firstname&lastname=lastname&password=password&email=email&gender=gender&submit_register=3&amp;maxSize=9999999999&amp;maxW=200&amp;fullPath=<?php echo $image_url; ?>&amp;relPath=../admin/images/user/&amp;colorR=255&amp;colorG=255&amp;colorB=255&amp;maxH=300','error_msg1','File Uploading Please Wait...&lt;br /&gt;&lt;img src=\'images/loader_light_blue.gif\' width=\'128\' height=\'15\' border=\'0\' /&gt;','&lt;img src=\'images/error.gif\' width=\'16\' height=\'16\' border=\'0\' /&gt; Error in Upload, check settings and path info in source code.'); return false;" id="reg-submit"></button>               
                    </dl>-->
                     <dl class="submit">
                    <button onClick="ajaxUpload(this.form,'scripts/ajaxupload.php?filename=user_image&username=username&firstname=firstname&lastname=lastname&password=password&email=email&gender=gender&submit_register=3&amp;maxSize=9999999999&amp;maxW=200&amp;fullPath=http://localhost/snow/admin/images/user/&amp;relPath=../admin/images/user/&amp;colorR=255&amp;colorG=255&amp;colorB=255&amp;maxH=300','error_msg1','File Uploading Please Wait...&lt;br /&gt;&lt;img src=\'images/loader_light_blue.gif\' width=\'128\' height=\'15\' border=\'0\' /&gt;','&lt;img src=\'images/error.gif\' width=\'16\' height=\'16\' border=\'0\' /&gt; Error in Upload, check settings and path info in source code.'); return false;" id="reg-submit"></button>               
                    </dl>
                    
                    
                  
                     
                     
                    
              
                
      </form>
							
					
									
   
   
</div>
<!-- registration pop up ends -->

<!-- login pop up starts -->
<div id="login" class="popup_block">

 <div id="demis_userlogin">
  <img src="images/userLogin.png" alt="" />
  <form name="user" class="niceform" id="login"><!--onSubmit="return userloginvalidate(this);"-->
                 
           <span class="error" id="error_msg2"></span>
                	
                    <dl>
                        <dt><label for="email">Username:</label></dt>
                        <dd><input class="text" type="text" name="username2"  id="username2" size="54" value=""></dd>
                    </dl>
                    <dl>
                        <dt><label for="email">Password:</label></dt>
                        <dd><input class="text" type="password" name="password2"  id="password2" size="54" value=""></dd>
                    </dl>                    
                    <dl class="submit" id="userlogin">
                    <input type="button" name="submit" id="submit" value="" onClick="userloginvalidate(this);"/>
                     </dl>
                     
                     
                    <a href="#?w=470" rel="registeration" class="poplight" id="register-now" >Register Now</a> | <a href="#" class="forget-password">Forgot Password</a>
               
                
         </form>
 </div>   
 
 <div id="demis_forgetpassword">
  <img src="images/forgetpassword.png" alt="" />
  <form name="user_forgot" class="niceform">
                 
          <span class="error" id="error_msg3"></span>
                	
          <dl>
                        <dt><label for="email">Email Id:</label></dt>
                        <dd><input class="text" type="text" name="email2"  id="email2" size="54"></dd>
          </dl>
                                  
                    <dl class="submit" id="forget">
                    <input type="button" name="submit" id="submit" value="" onClick="userforgotvalidate();"/>
          </dl>
                
         </form>
 </div> 
      
         
</div>
<!-- login pop up ends -->

</div>



</body>
</html>
<?php
if($me['id'] != "")
{
	//echo "sdfasdfsdddddddddddddddddddddddddddddddddddddddddd";
	include("admin/dbs.php");	
	$pic = $facebook->api(array( 'method' => 'fql.query', 'query' => 'select pic_big from user where uid='.$me['id'].'', ));	 
	$photo=$pic['0']['pic_big']; 
	//echo "select pic_big from user where uid='{$me['id']}";
	//echo "select * from user where FACEBOOK_ID='{$me['id']}'";
	//exit;
	$sqlinsert=@mysql_query("select FACEBOOK_ID from user where FACEBOOK_ID='{$me['id']}'"); 
	$num=@mysql_num_rows($sqlinsert);
	//echo $num;
	if($num>0)
	{
	$sqlinsert=@mysql_query("update user set LAST_LOGIN_DATE_TIME=NOW() where FACEBOOK_ID='{$me['id']}'");
	//echo "update user set LAST_LOGIN_DATE_TIME=NOW() where FACEBOOK_ID='{$me['id']}'";
	//exit;
						$_SESSION['FACEBOOK_ID'] = $me['id'];
						/*echo '<script language="javascript">
						function redirect()
						{
						window.document.location.href=\'play-page.php\';
						}
						window.setTimeout(\'redirect()\',0);</script>';*/
						exit (0);	
	}
	else
	{
	
	$sqlinsert=@mysql_query("INSERT INTO user (USERNAME, FIRSTNAME, LASTNAME, FACEBOOK_ID, EMAIL, GENDER, USER_IMAGE, REGISTERED_DATE, STATUS,LAST_LOGIN_DATE_TIME) VALUES ('{$me['name']}', '{$me['first_name']}', '{$me['last_name']}', '{$me['id']}','{$me['email']}', '{$me['gender']}', '{$photo}', NOW(), 1,NOW())");
	echo "INSERT INTO user (USERNAME, FIRSTNAME, LASTNAME, FACEBOOK_ID, EMAIL, GENDER, USER_IMAGE, REGISTERED_DATE, STATUS,LAST_LOGIN_DATE_TIME) VALUES ('{$me['name']}', '{$me['first_name']}', '{$me['last_name']}', '{$me['id']}','{$me['email']}', '{$me['gender']}', '{$photo}', NOW(), 1,NOW())";
	//exit;
						$_SESSION['NEW'] = "1233";
						$_SESSION['FACEBOOK_ID'] = $me['id'];
						/*echo '<script language="javascript">
						function redirect()
						{
						window.document.location.href=\'play-page.php\';
						}
						window.setTimeout(\'redirect()\',0);</script>';*/
						exit (0);	
	}
}



//echo $uid;
echo "<br>";
echo $me['id'];

?>
