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

<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
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
    <li class="jugar"><a href="jugar.html"><img src="images/jugar.png" alt="" title="Jugar" /></a></li>
     <li class="reglas"><a href="reglas.html"><img src="images/reglas.png" alt="" title="Reglas" /></a></li>
      <li class="informacion"><a href="informacion.html"><img src="images/informacion.gif" alt="" title="Informacion" /></a></li>
  
  </ul>

</div>
<!-- primary navigation ends -->

<div id="result">
<!--<table summary="Game Result" id="rounded-corner">

<thead>

<tr>
<th class="rounded-company" scope="col">Rank</th><th class="rounded-q1" scope="col">User Avatar</th><th class="rounded-q2" scope="col">First Name</th><th class="rounded-q3" scope="col">Last Name</th><th class="rounded-q4" scope="col">Level Nick Name</th><th class="rounded-q5" scope="col">Total Score</th><th class="rounded-q6" scope="col">Date Time</th></tr></thead><tfoot>
<tr>

<td class="rounded-foot-left" colspan="6"><em>The above data were fictional and made up, please do not sue me</em></td><td class="rounded-foot-right">&nbsp;</td></tr></tfoot>
<tbody>

<tr><td>1</td><td><img src="images/avatar.png"  width="25" height="25"/> </td><td>Senthil</td><td>Kumar</td><td>1</td><td>23.5</td><td>12-10-2010 - 12.00</td></tr>
<tr><td>2</td><td><img src="images/avatar.png"  width="25" height="25"/> </td><td>Senthil</td><td>Kumar</td><td>1</td><td>23.5</td><td>12-10-2010 - 12.00</td></tr>
<tr><td>3</td><td><img src="images/avatar.png"  width="25" height="25"/> </td><td>Senthil</td><td>Kumar</td><td>1</td><td>23.5</td><td>12-10-2010 - 12.00</td></tr>
<tr><td>4</td><td><img src="images/avatar.png"  width="25" height="25"/> </td><td>Senthil</td><td>Kumar</td><td>1</td><td>23.5</td><td>12-10-2010 - 12.00</td></tr>
<tr><td>5</td><td><img src="images/avatar.png"  width="25" height="25"/> </td><td>Senthil</td><td>Kumar</td><td>1</td><td>23.5</td><td>12-10-2010 - 12.00</td></tr>
<tr><td>6</td><td><img src="images/avatar.png"  width="25" height="25"/> </td><td>Senthil</td><td>Kumar</td><td>1</td><td>23.5</td><td>12-10-2010 - 12.00</td></tr>
<tr><td>7</td><td><img src="images/avatar.png"  width="25" height="25"/> </td><td>Senthil</td><td>Kumar</td><td>1</td><td>23.5</td><td>12-10-2010 - 12.00</td></tr>
<tr><td>8</td><td><img src="images/avatar.png"  width="25" height="25"/> </td><td>Senthil</td><td>Kumar</td><td>1</td><td>23.5</td><td>12-10-2010 - 12.00</td></tr>
<tr><td>9</td><td><img src="images/avatar.png"  width="25" height="25"/> </td><td>Senthil</td><td>Kumar</td><td>1</td><td>23.5</td><td>12-10-2010 - 12.00</td></tr>
<tr><td>10</td><td><img src="images/avatar.png"  width="25" height="25"/> </td><td>Senthil</td><td>Kumar</td><td>1</td><td>23.5</td><td>12-10-2010 - 12.00</td></tr>

</tbody>
</table>-->



<div class="tableContainer">

   <div class="table-header">
    <span class="rank">Rank</span>
    <span class="user-avatar">User Avatar</span>
    <span class="f-name">First Name</span>   
    <span class="l-name">Last Name</span>
    <span class="n-name">Level Nick Name</span>
    <span class="total-score">Total Score</span>
    <span class="date-time">Date Time</span>
   </div>
   
   <div class="table-body">
       <div class="table-row odd">
    <span class="rank">1</span>
    <span class="user-avatar"><img src="images/avatar.png"  width="25" height="25"/></span>
    <span class="f-name">First Name</span>   
    <span class="l-name">Last Name</span>
    <span class="n-name">Level Nick Name</span>
    <span class="total-score">Total Score</span>
    <span class="date-time">Date Time</span>
   </div>
       <div class="table-row">
    <span class="rank">2</span>
    <span class="user-avatar"><img src="images/avatar.png"  width="25" height="25"/></span>
    <span class="f-name">First Name</span>   
    <span class="l-name">Last Name</span>
    <span class="n-name">Level Nick Name</span>
    <span class="total-score">Total Score</span>
    <span class="date-time">Date Time</span>
   </div>
       <div class="table-row odd">
    <span class="rank">3</span>
    <span class="user-avatar"><img src="images/avatar.png"  width="25" height="25"/></span>
    <span class="f-name">First Name</span>   
    <span class="l-name">Last Name</span>
    <span class="n-name">Level Nick Name</span>
    <span class="total-score">Total Score</span>
    <span class="date-time">Date Time</span>
   </div>
       <div class="table-row">
    <span class="rank">4</span>
    <span class="user-avatar"><img src="images/avatar.png"  width="25" height="25"/></span>
    <span class="f-name">First Name</span>   
    <span class="l-name">Last Name</span>
    <span class="n-name">Level Nick Name</span>
    <span class="total-score">Total Score</span>
    <span class="date-time">Date Time</span>
   </div>
       <div class="table-row odd">
    <span class="rank">5</span>
    <span class="user-avatar"><img src="images/avatar.png"  width="25" height="25"/></span>
    <span class="f-name">First Name</span>   
    <span class="l-name">Last Name</span>
    <span class="n-name">Level Nick Name</span>
    <span class="total-score">Total Score</span>
    <span class="date-time">Date Time</span>
   </div>
       <div class="table-row">
    <span class="rank">6</span>
    <span class="user-avatar"><img src="images/avatar.png"  width="25" height="25"/></span>
    <span class="f-name">First Name</span>   
    <span class="l-name">Last Name</span>
    <span class="n-name">Level Nick Name</span>
    <span class="total-score">Total Score</span>
    <span class="date-time">Date Time</span>
   </div>
   </div>

</div>
<div id="not-in-list" class="tableContainer">

   <div class="table-header">
    <span class="rank">Rank</span>
    <span class="user-avatar">User Avatar</span>
    <span class="f-name">First Name</span>   
    <span class="l-name">Last Name</span>
    <span class="n-name">Level Nick Name</span>
    <span class="total-score">Total Score</span>
    <span class="date-time">Date Time</span>
   </div>
   
   <div  class="table-body">
       <div class="table-row">
    <span class="rank">1</span>
    <span class="user-avatar"><img src="images/avatar.png"  width="25" height="25"/></span>
    <span class="f-name">First Name</span>   
    <span class="l-name">Last Name</span>
    <span class="n-name">Level Nick Name</span>
    <span class="total-score">Total Score</span>
    <span class="date-time">Date Time</span>
   </div>
      
   </div>

</div>
<div class="tableContainer">

   <div class="table-header">
    <span class="rank">Rank</span>
    <span class="user-avatar">User Avatar</span>
    <span class="f-name">First Name</span>   
    <span class="l-name">Last Name</span>
    <span class="n-name">Level Nick Name</span>
    <span class="total-score">Total Score</span>
    <span class="date-time">Date Time</span>
   </div>
   
   <div class="table-body">
       <div class="table-row">
    <span class="rank">1</span>
    <span class="user-avatar"><img src="images/avatar.png"  width="25" height="25"/></span>
    <span class="f-name">First Name</span>   
    <span class="l-name">Last Name</span>
    <span class="n-name">Level Nick Name</span>
    <span class="total-score">Total Score</span>
    <span class="date-time">Date Time</span>
   </div>
       <div class="table-row">
    <span class="rank">2</span>
    <span class="user-avatar"><img src="images/avatar.png"  width="25" height="25"/></span>
    <span class="f-name">First Name</span>   
    <span class="l-name">Last Name</span>
    <span class="n-name">Level Nick Name</span>
    <span class="total-score">Total Score</span>
    <span class="date-time">Date Time</span>
   </div>
       <div class="table-row">
    <span class="rank">3</span>
    <span class="user-avatar"><img src="images/avatar.png"  width="25" height="25"/></span>
    <span class="f-name">First Name</span>   
    <span class="l-name">Last Name</span>
    <span class="n-name">Level Nick Name</span>
    <span class="total-score">Total Score</span>
    <span class="date-time">Date Time</span>
   </div>
       <div class="table-row">
    <span class="rank">4</span>
    <span class="user-avatar"><img src="images/avatar.png"  width="25" height="25"/></span>
    <span class="f-name">First Name</span>   
    <span class="l-name">Last Name</span>
    <span class="n-name">Level Nick Name</span>
    <span class="total-score">Total Score</span>
    <span class="date-time">Date Time</span>
   </div>
       <div class="table-row">
    <span class="rank">5</span>
    <span class="user-avatar"><img src="images/avatar.png"  width="25" height="25"/></span>
    <span class="f-name">First Name</span>   
    <span class="l-name">Last Name</span>
    <span class="n-name">Level Nick Name</span>
    <span class="total-score">Total Score</span>
    <span class="date-time">Date Time</span>
   </div>
       <div class="table-row">
    <span class="rank">6</span>
    <span class="user-avatar"><img src="images/avatar.png"  width="25" height="25"/></span>
    <span class="f-name">First Name</span>   
    <span class="l-name">Last Name</span>
    <span class="n-name">Level Nick Name</span>
    <span class="total-score">Total Score</span>
    <span class="date-time">Date Time</span>
   </div>
   </div>

</div>
<div id="not-in-list" class="tableContainer">

   <div class="table-header">
    <span class="rank">Rank</span>
    <span class="user-avatar">User Avatar</span>
    <span class="f-name">First Name</span>   
    <span class="l-name">Last Name</span>
    <span class="n-name">Level Nick Name</span>
    <span class="total-score">Total Score</span>
    <span class="date-time">Date Time</span>
   </div>
   
   <div  class="table-body">
       <div class="table-row">
    <span class="rank">1</span>
    <span class="user-avatar"><img src="images/avatar.png"  width="25" height="25"/></span>
    <span class="f-name">First Name</span>   
    <span class="l-name">Last Name</span>
    <span class="n-name">Level Nick Name</span>
    <span class="total-score">Total Score</span>
    <span class="date-time">Date Time</span>
   </div>
      
   </div>

</div>

</div>


<div id="social_networking">
  
   <a href="#" class="" title="Facebook"><img src="images/facebook.png" alt="" /></a><a href="#" class="" title="Twitter"><img src="images/twitter.png" alt="" /></a><a href="#" class="" title="You Tube"><img src="images/you_tube.png" alt="" /></a></div>

</div>
</div>


</body>
</html>
