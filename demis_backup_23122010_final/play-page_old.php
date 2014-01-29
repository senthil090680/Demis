<?php
session_start();
require 'admin/dbs.php';
@extract($_REQUEST);

if(isset($user_temp)) {
$_SESSION['USER_TEMP']=$user_temp;
}
//$_SESSION['TWITTER_ID']=$tw_id;
print_r($_SESSION);
$user_details_query="select * from user where FACEBOOK_ID='{$_SESSION[FACEBOOK_ID]}'";
$user_details_result=mysql_query($user_details_query);
$user_details_row=mysql_fetch_array($user_details_result);

$user_image=$user_details_row['USER_IMAGE'];



?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="google-site-verification" content="pavUhskTsNYJlCFAedmLSwflHeQnHs8Agw1mgNQCdkg" />
<meta name="alexaVerifyID" content="I0w_XgUh-2BxvHWkUv0SW7mfGws" />
<title>FASHION GAME|GIRLS GAME|FREE FLASH GAME|GAME FOR GIRLS|HIDDEN GAME| Play Free online games for Girls and Kids at Dressupfiesta.com - Homepage</title>




<link rel="image_src" href="http://www.nieveenlima.pe/juego_dev/images/profile_picture.png" />
<title>Snowflakes Game</title>
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

<script src="js/AC_RunActiveContent.js" type="text/javascript"></script>
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
</head>

<body>

<div id="main_wrapper">
<div id="content_wrapper">

<!-- primary navigation starts -->
<div id="primary_nav">
  <ul>
    <li class="jugar"><a href="jugar.php"><img src="images/jugar.png" alt="" title="Jugar" /></a></li>
     <li class="reglas"><a href="reglas.php"><img src="images/reglas.png" alt="" title="Reglas" /></a></li>
      <li class="informacion"><a href="informacion.php"><img src="images/informacion.png" alt="" title="Informacion" /></a></li>
  
  </ul>

</div>
<!-- primary navigation ends -->

<div id="flash_video_palyer">
  
<script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','624','height','485','src','Snowflakes','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie','Snowflakes' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="624" height="485">
                <param name="movie" value="Snowflakes.swf" />
                <param name="quality" value="high" />
                <embed src="Snowflakes.swf" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="624" height="485"></embed>
              </object></noscript>
</div>


<div style='float:right;margin-right:10px;margin-top:20px;'>



</div>

<div id="social_networking" expr:addthis:title='data:post.title' expr:addthis:url='data:post.url'>


  
   <!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style">

<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_google"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_orkut"></a>
<a class="addthis_button_digg"></a>
<a class="addthis_button_friendster"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=xa-4cc966c705b68836"></script>

<!-- AddThis Button END -->

  
   
   <a href="#" class="" title="Twitter"><img src="images/twitter.png" alt="" /></a><a href="#" class="" title="You Tube"><img src="images/you_tube.png" alt="" /></a></div>


<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-18497919-1']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })(); 
</script>

</div>
</div>
</body>
</html>
