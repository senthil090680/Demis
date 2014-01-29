<?PHP 
session_start();
include("admin/dbs.php");

require 'src/facebook.php';
@extract($_REQUEST);

Facebook::$CURL_OPTS[CURLOPT_SSL_VERIFYPEER] = false;
Facebook::$CURL_OPTS[CURLOPT_SSL_VERIFYHOST] = 2;
// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '172175656133736',
  'secret' => '058f4ac1eba141f7558dd6834ccfc319',
  'cookie' => true,
));

$session = $facebook->getSession();

$me = null;
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
	header( 'Location: http://nieveenlima.pe/juego_dev/final5.php' ) ;
}else{

//$user_level  = "select NICKNAME from level where LEVEL_ID='".$_SESSION['LEVEL_NEW']."'";
$user_level  = "select NICKNAME from level where lev_id in (select max(lev_id) from level where POINTS_BEAT<".$_SESSION['FLAKES_NEW']." and POINTS_BEAT>0)";

//$rank_query  = "select NICKNAME from level where LEVEL_ID='".$score_row['LEVEL_ID']."'";
//$rank_result = mysql_query($rank_query) or die("Data not found.");
//$rank_row=mysql_fetch_array($rank_result);

$user_rank = mysql_query($user_level) or die (mysql_error());
$level_row=mysql_fetch_array($user_rank);

?>

<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    
</head>
  <body>
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
		  //window.top.location = 'http://nieveenlima.pe/juego_dev/';
		  var url = "<?php echo $url; ?>";
		  //alert(url);		  
		  window.top.location = "<?php echo $url; ?>";
		  
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

 <script>
          //your fb login function
          function fblogin() {
            FB.login(function(response) {
              //...
            }, {perms:'email,user_birthday,publish_stream'});
          }
        </script>


   </body>
   </html>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NieveEnLima.pe - Resultados</title>
<!-- style Document -->
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
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

<!--[if IE ]>
<style type="text/css">
#digi-score{letter-spacing:16px;padding:10px 14px 0 0}
</style>
<![endif]-->


<!--[if IE 8]>
<style type="text/css">
#primary_nav{top:481px;left:14px;}
#primary_nav li.jugar{margin:1px 0 0 0}
#primary_nav li.reglas{margin:0 0 0 11px}
#primary_nav li.informacion{margin:0 0 0 14px}
</style>
<![endif]-->



</head>

<body>
<div id="main_wrapper_final">
<div id="content_wrapper">
<div class="status"><a href="#?w=470" rel="home-pop" class="poplight">Close</a></div>
<div id="pre-login">

  <div id="your-result">
  
     Aportaste:<br />
     <b><?PHP //echo $_SESSION['FLAKES_NEW']; 
	 			echo $score_row['SCORE']; ?> copos</b><br /><br />
     
         Por Tanto eres un:<br />
     <b><?PHP //echo $_SESSION['LEVEL_NEW'];
			  //echo $rank_row['NICKNAME']; 
			  echo $level_row['NICKNAME'] ?></b>

  </div>
  
  <div id="demuestra">
 <!--a href="#" onclick="fblogin();return false;"><img src="images/facebook-icon.png" alt=""></a-->
 <!--a href="http://www.facebook.com/"><img src="images/facebook-icon.png" alt="" /></a-->
 <!--fb:login-button perms="email,user_birthday,publish_stream"></fb:login-button-->
 <!--fb:prompt-permission perms="email,user_birthday,publish_stream"><img src="images/facebook-icon.png" alt="" /></fb:prompt-permission-->
	<a href="#" onclick="fblogin();return false;"><img src="images/facebook-icon.png"></a>

  
  </div>
  
  <div id="conoce">
  <a href="#?w=470" rel="conce-pop" class="poplight">
  <img  src="images/conoce.png" alt="" />
  </a>
  
  <div class="facebook-register">
  <a href="register.php" class="aqui"><img src="images/aqui.png" alt="" /></a>
  </div>
  
  </div>


</div>

<div id="solo">
<img class="copometro" src="images/copometro2.png" alt="" />

<span id="digi-score">

<?PHP 
$query = "select sum(FLAKES) as totalflakes from game";
$result = mysql_query($query) or die("Data not found.");
$res=mysql_fetch_array($result);
echo $res['totalflakes'];
?>

</span>
</div>
<a href="#?w=470" class="ranking-global poplight" rel="global-ranking"><img src="images/ranking-global.png" alt="" /></a>
</div>


</div>


<div id="conce-pop" class="popup_block">

 <p>
 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque pharetra, sapien eu placerat vulputate, metus odio molestie purus, sed fringilla quam odio nec leo. Integer vel sapien vel nisl sagittis sollicitudin. Etiam vitae ullamcorper arcu. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce ac euismod nibh. Suspendisse interdum fermentum elit vel lacinia. Nam et nisl est. Fusce quis lacus sem, in cursus urna. Morbi placerat mauris eget urna cursus quis cursus eros ullamcorper. Nulla dapibus imperdiet sagittis. Nunc est magna, vestibulum sit amet ultricies quis, accumsan eu ante. Nulla luctus tortor ut sapien condimentum vitae dapibus tellus molestie. Pellentesque rutrum velit ut est fringilla ullamcorper. Aenean risus turpis, tempor vel imperdiet sit amet, condimentum sed dolor. </p>
 
      
         
</div>

<div id="home-pop" class="popup_block">
<h4 class="" style="text-align:center">Closure</h4>
 <p style="display:block;text-align:center">
 <?PHP 
$querymsg = "select * from message";
$resultmsg = mysql_query($querymsg) or die("Data not found.");
$resmsg=mysql_fetch_array($resultmsg);
echo $resmsg['MESSAGE'];
?>
   
 </p>
 
 <span style="display:block;text-align:center;padding:5px 0"><a href="logout.php"><img src="images/logout.png"  /></a></span>

      
         
</div>

<div id="global-ranking" class="popup_block">
<?php include "ranking-global.php"; ?>
</div>
</body>
</html>
<? } ?>
