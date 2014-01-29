<?php
session_id($_REQUEST['PHPSESSID']);
session_start();
require 'admin/dbs.php';
@extract($_REQUEST);

/*print_r($_SESSION);
//print_r($_COOKIE);
print_r($_REQUEST);*/


/*if(isset($user_temp)) {
$_SESSION['USER_TEMP']=$user_temp;
}*/
//$_SESSION['TWITTER_ID']=$tw_id;

$_SESSION['SCORE_NEW'] = '';
$_SESSION['LEVEL_NEW'] = '';
$_SESSION['FLAKES_NEW'] = '';
$_SESSION['USER_TEMP'] = '';

if(isset($_SESSION[user_tem])) {
$temp_drop = "drop table $_SESSION[user_tem]";
$temp_drop_result = mysql_query($temp_drop);
$_SESSION['user_tem'] = '';
}

$user_details_query="select * from user where FACEBOOK_ID='{$_SESSION[FACEBOOK_ID]}'";
$user_details_result=mysql_query($user_details_query);
$user_details_row=mysql_fetch_array($user_details_result);

$user_image=$user_details_row['USER_IMAGE'];



?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<title>NieveEnLima.pe - juego_dev</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="Snowflakes game is a new kind of game for the user to catch the snowflakes with thier tongue if they are using Webcamara, otherwise can catch the snowflakes with their keyboard.  It is really lot of fun playing this game." />

<title>Snowflakes Game</title>
<!-- style Document -->
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/playpage.css" rel="stylesheet" type="text/css" />

<!--[if IE 8]>
<style type="text/css">
#primary_nav{top:430px;left:800px;}
#primary_nav li.jugar{margin:1px 0 0 0}
#primary_nav li.reglas{margin:25px 0 0 11px}
#primary_nav li.informacion{margin:30px 0 0 25px}
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


<div id="flash_video_palyer">
  
<script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','624','height','485','src','Snowflakes','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie','Snowflakes' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="624" height="485">
                <param name="movie" value="Snowflakes.swf?phpurl=http://nieveenlima.pe/juego_dev/data.php,PHPSESSID=<?php echo session_id()
?>" />
                <param name="quality" value="high" />
                <embed src="Snowflakes.swf?phpurl=http://nieveenlima.pe/juego_dev/data.php,PHPSESSID=<?php echo session_id()?>" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="624" height="485"></embed>
              </object></noscript>
</div>


<div id="social_networking">
  
   <a class="addthis_button_preferred_1"> <!--<a href="#" class="" title="Facebook">--><img src="images/facebook.png" alt="" /></a><a href="#" class="" title="Twitter"><img src="images/twitter.png" alt="" /></a></div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=xa-4cc966c705b68836"></script>


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
