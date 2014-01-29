<?PHP 
session_start();
include("admin/dbs.php");

//inicio de codigo para postear en el wall de FB
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
// Session based API call.
if ($session) {
  try {
    $uid = $facebook->getUser();
    $me = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
  }
}

$facebook_id=$_SESSION['FACEBOOK_ID'];
$level_query = "select * from game where game_id in (select max(game_id) from game g inner join user u on g.user_id=u.user_id where FACEBOOK_ID='". $facebook_id."')";			
$level_result = mysql_query($level_query) or die("Data not found.");
$score_row=mysql_fetch_array($level_result);

//$user_level  = "select NICKNAME from level where LEVEL_ID='".$_SESSION['LEVEL_NEW']."'";
//$user_level  = "select NICKNAME from level where lev_id in (select max(lev_id) from level where POINTS_BEAT<".$_SESSION['FLAKES_NEW']." and POINTS_BEAT>0)";
$rank_query  = "select NICKNAME from level where LEVEL_ID='".$score_row['LEVEL_ID']."'";
$rank_result = mysql_query($rank_query) or die("Data not found.");
$rank_row=mysql_fetch_array($rank_result);

//$description ='Capturé '.$_SESSION['FLAKES_NEW'].' copos, soy un '. $level_row['NICKNAME'] . ' tú cuántos harías?';
$description ='Capturé '.$_SESSION['FLAKES_NEW'].' copos, tú cuántos harías? Ayúdanos a capturar 1 millón para tener nieve en Lima.';

  $attachment =  array(
//        'access_token' => $access_token,
        'message' => "Acabo de prestar mi lengua para que tengamos Nieve en Lima!",
        'name' => "",
        'link' => "http://nieveenlima.pe/juego_dev/",
        'description' => $description,
        'picture'=> "http://nieveenlima.pe/juego_dev/images/default_fb.png"
        );

//This was working but now it is not... the post on fb wall
//    $facebook->api('/me/feed', 'POST', $attachment);
		

//fin de codigo para postear en el wall de FB
?>
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
<div id="post-login">

  <div class="tus-result">
     
     
     <div class="avatar">
    <?PHP 
$queryimg = "select USER_IMAGE from user where USER_ID='{$_SESSION['USER_ID']}'";
$resultimg = mysql_query($queryimg) or die("Data not found.");
$resimg=mysql_fetch_array($resultimg);
?> 
<!--Quitar comentario cuando se jale avatar!-->     
<!--img src="admin/images/user/<!?PHP echo $resimg['USER_IMAGE']; ?>" alt="" /--> 
<img src="images/default_fb.png" alt="" style="width:120px;height:80px;" > 
     <br />
     <br />
     </div>
     
     <div class="avatar-info">
      
      <p>
      <img src="images/capturaste.png" alt="" /><br />
      <span><?PHP //echo $_SESSION['FLAKES_NEW'];
	  				echo $score_row['SCORE']; ?> copos</span>
      </p>
         
          <p>
      <img src="images/tu-total.png" alt="" /><br />
      <span>
	  <?PHP 
$query = "select sum(FLAKES) as totalflakes from game where USER_ID='".$_SESSION['USER_ID']."'";
$result = mysql_query($query) or die("Data not found.");
$res=mysql_fetch_array($result);
echo $res['totalflakes'];
?> copos</span>
      </p>
       <p>
      <img src="images/portanto.png" alt="" /><br />
      <span><?PHP //echo $_SESSION['LEVEL_NEW']; 
	  				echo $rank_row['NICKNAME']; ?></span>
      </p>
     
     
     </div>
  
  </div>
  
  
    <div id="demuestra-postlogin">
 <a href="http://facebook.com"><img src="images/facebook-icon.png" alt="" /></a>
  
  </div>
  


</div>

<div id="solo">
<img class="copometro" src="images/copometro2.png" alt="" />
<span id="digi-score">
<?PHP 
$querytot = "select sum(FLAKES) as totalflakes from game";
$resulttot = mysql_query($querytot) or die("Data not found.");
$restot=mysql_fetch_array($resulttot);
echo $restot['totalflakes'];
?>
</span>

</div>
<a href="#?w=470" class="ranking-global poplight" rel="global-ranking"><img src="images/ranking-global.png" alt="" /></a>
</div>


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
