<?php

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

?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
 <HEAD>
  <TITLE>Validate image on upload @ BitRepository.com</TITLE>
  <META NAME="Author" CONTENT="Bit Repository">

  <META NAME="Keywords" CONTENT="validate, extensions, file, javascript">
  <META NAME="Description" CONTENT="A JavaScript Extension Validator for Images">

<SCRIPT LANGUAGE="JavaScript">

<!--
function validate()
{
var extensions = new Array("jpg","jpeg","gif","png","bmp");

/*
// Alternative way to create the array

var extensions = new Array();

extensions[1] = "jpg";
extensions[0] = "jpeg";
extensions[2] = "gif";
extensions[3] = "png";
extensions[4] = "bmp";
*/

var image_file = document.form.image_file.value;

var image_length = document.form.image_file.value.length;

var pos = image_file.lastIndexOf('.') + 1;

var ext = image_file.substring(pos, image_length);

var final_ext = ext.toLowerCase();

for (i = 0; i < extensions.length; i++)
{
    if(extensions[i] == final_ext)
    {
    return true;
    }
}

alert("You must upload an image file with one of the following extensions: "+ extensions.join(', ') +".");
return false;
}
 //-->

 </SCRIPT>

 </HEAD>

<BODY>

<center>

<form name="form" action="http://www.microsoft.com" enctype="multipart/form-data" method="post" onSubmit="return validate();">

<h2>Validate image on upload</h2>

<br />

	Upload an image: <INPUT type="file" name="image_file"> <input type="submit" name="submit" value="Submit">

</form>

</center>

</BODY>

</HTML>
