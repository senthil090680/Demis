function space(txtboxvalue){ 
var flag=0;
var strText = txtboxvalue; 
if (strText!="") { 
var strArr = new Array();
strArr = strText.split(" ");
for(var i = 0; i < strArr.length ; i++) { 
if(strArr[i] == "") { 
flag=1;       
break; } 
} 
if (flag==1) {
	alert("No Space is allowed."); return false; 
	}
	}
	}

function LTrim( value ) {
	
	var re = /\s*((\S+\s*)*)/;
	return value.replace(re, "$1");
	
}

// Removes ending whitespaces
function RTrim( value ) {
	
	var re = /((\s*\S+)*)\s*/;
	return value.replace(re, "$1");
	
}
// Removes leading and ending whitespaces
function trim( value ) {
	
	return LTrim(RTrim(value));
}

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


function keyword_check()
{
var words = document.getElementsByName('keyword');
if(words.value =="")
{
alert("Please enter the word to search");	
words.focus();
}
}

function adminlogin_check()
{
 if(document.adminlogin.adminuser.value=="")
 {
  alert("Enter admin username.");
  document.adminlogin.adminuser.focus();
  return false;
 }
 else if(space(document.adminlogin.adminuser.value)==false){			
	document.adminlogin.adminuser.focus();
	return false;
	}
 if(document.adminlogin.adminpassword.value=="")
 {
   alert("Enter admin password.");
   document.adminlogin.adminpassword.focus();
   return false;
 }
 else if(space(document.adminlogin.adminpassword.value)==false){			
	document.adminlogin.adminpassword.focus();
	return false;
	}
 return true;
} 

//facebookcheck Start
function checkfromfb(user_ids)
{	
	xmlHttp=GetXmlHttpObject()
	if (xmlHttp==null)
	{
	alert ("Browser does not support HTTP Request")
	return
	} 
	var url="checkforfbandtw.php?user_id="+user_ids;
	//url=url+"&action="+action
	//alert(url);
	xmlHttp.onreadystatechange=function () 
	{ 
	
		if( xmlHttp.readyState < 4 || xmlHttp.readyState!="Complete" )
		{
		}
	
		if (xmlHttp.readyState==4 || xmlHttp.readyState=="Complete")
		{ 
			var i = xmlHttp.responseText;
			if(i == 0)
			{
				//document.getElementById("showmsg1").style.display = "none";
				window.location= "edit_users.php?id="+user_ids;
			}
			else if(i == 1)
			{
				//document.getElementById('showmsg1').innerHTML = "This user cannot be edited because he is either a user of Facebook or Twitter";
				window.location= "edit_users.php?id="+user_ids+"&val="+5;
			}
						

		} 
	} 
	xmlHttp.open("GET",url,true)
	xmlHttp.send(null)	
}
//facebookcheck end


//useraddvalidate Start
function useraddvalidate(field)
{	
	with (field)
	{				
		 if(username.value=="" || username.value==null)
			{
			alert("Please enter the username.");
			username.focus();
			return false;
			}
		 if(firstname.value=="" || firstname.value==null)
			{
			alert("Please enter the firstname.");
			firstname.focus();
			return false;
			}	
		 if(lastname.value=="" || lastname.value==null)
			{
			alert("Enter the lastname.");
			lastname.focus();
			return false;
			}				
		if(email.value=="" || email.value==null)
			{
			alert("Enter the email.");
			email.focus();
			return false;
			}	
		if(email.value.search(/^(\w+(?:\.\w+)*)@((?:\w+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i))
		{
			alert("Please enter valid e-mail");
			email.focus();
			return false;
		}
		if(gender.value=="" || gender.value==null)
			{
			alert("Select the gender.");
			gender.focus();
			return false;
			}
		if(user_image.value=="" || user_image.value==null)
			{
			alert("Enter the score.");
			score.focus();
			return false;
			}		
	return true; 
	}
}
//useraddvalidate end




//usereditvalidate Start
function usereditvalidate(field)
{	
	with (field)
	{		
		var val1 = document.getElementById('val').value;
		 if(val1 == "" || val1 == null)
		 {
			 if(trim(firstname.value)=="" || trim(firstname.value)==null)
				{
				alert("Enter the firstname.");
				firstname.focus();
				return false;
				}
			else if(space(firstname.value)==false){			
					firstname.focus();
					return false;
				}
			 if(trim(lastname.value)=="" || trim(lastname.value)==null)
				{
				alert("Enter the lastname.");
				lastname.focus();
				return false;
				}
			else if(space(lastname.value)==false){			
					lastname.focus();
					return false;
				}
			if(trim(username.value)=="" || trim(username.value)==null)
				{
				alert("Enter the username.");
				username.focus();
				return false;
				}
			else if(space(username.value)==false){			
					username.focus();
					return false;
				}
			 if(trim(password.value)=="" || trim(password.value)==null)
				{
				alert("Please enter the password.");
				password.focus();
				return false;
				}
			else if(space(password.value)==false){			
					password.focus();
					return false;
				}
			if(email.value=="" || email.value==null)
				{
				alert("Enter the email.");
				email.focus();
				return false;
				}	
			if(email.value.search(/^(\w+(?:\.\w+)*)@((?:\w+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i))
			{
				alert("Please enter valid e-mail");
				email.focus();
				return false;
			}
			if(gender.value=="" || gender.value==null)
			{
			alert("Select the gender.");
			gender.focus();
			return false;
			}
		if(trim(score.value)=="" || trim(score.value)==null)
			{
			alert("Enter the score.");
			score.focus();
			return false;
			}
		else if(space(score.value)==false){			
				score.focus();
				return false;
			}		
		 if(isNaN(score.value)==true)
			{
			alert("Please enter the score as numeric value.");
			score.focus();
			return false;
		}
		
/*		 if(lastplayed_date.value=="" || lastplayed_date.value==null)
			{
			alert("Please pick the last played date.");
			lastplayed_date.focus();
			return false;
			}*/
		else if(space(lastplayed_date.value)==false){			
				lastplayed_date.focus();
				return false;
			}
		 }
		 else
		 {
			if(gender.value=="" || gender.value==null)
				{
				alert("Select the gender.");
				gender.focus();
				return false;
				}
			if(trim(score.value)=="" || trim(score.value)==null)
				{
				alert("Enter the score.");
				score.focus();
				return false;
				}
			else if(space(score.value)==false){			
					score.focus();
					return false;
				}		
			 if(isNaN(score.value)==true)
				{
				alert("Please enter the score as numeric value.");
				score.focus();
				return false;
			}
			
			 /*if(lastplayed_date.value=="" || lastplayed_date.value==null)
				{
				alert("Please pick the last played date.");
				lastplayed_date.focus();
				return false;
				}*/
			else if(space(lastplayed_date.value)==false){			
					lastplayed_date.focus();
					return false;
				}
		 }
	return true; 
	}
}
//usereditvalidate end


//statseditvalidate Start
function statseditvalidate(field)
{	
	with (field)
	{				
		 if(trim(total_score.value)=="" || trim(total_score.value)==null)
			{
			alert("Please enter the total score.");
			total_score.focus();
			return false;
			}
		else if(space(total_score.value)==false){			
				total_score.focus();
				return false;
			}
		 if(isNaN(total_score.value)==true)
			{
			alert("Please enter the total score as numeric value.");
			total_score.focus();
			return false;
		}
		 if(trim(total_plays.value)=="" || trim(total_plays.value)==null)
			{
			alert("Please enter the total plays.");
			total_plays.focus();
			return false;
			}
		else if(space(total_plays.value)==false){			
				total_plays.focus();
				return false;
			}
		 if(isNaN(total_plays.value)==true)
			{
			alert("Please enter the total plays as numeric value.");
			total_plays.focus();
			return false;
		}
		 if(trim(total_users.value)=="" || trim(total_users.value)==null)
			{
			alert("Please enter the total users.");
			total_users.focus();
			return false;
			}
		else if(space(total_users.value)==false){			
				total_users.focus();
				return false;
			}
		 if(isNaN(total_users.value)==true)
			{
			alert("Please enter the total users as numeric value.");
			total_users.focus();
			return false;
		}
		 if(trim(best_player_id.value)=="" || trim(best_player_id.value)==null)
			{
			alert("Please enter the best player.");
			best_player_id.focus();
			return false;
			}
		else if(space(best_player_id.value)==false){			
				best_player_id.focus();
				return false;
			}
	return true; 
	}
}
//statseditvalidate end

//configaddvalidate Start
function configaddvalidate(field)
{	
	with (field)
	{				
		 if(application_name.value=="" || application_name.value==null)
			{
			alert("Please enter the application name.");
			application_name.focus();
			return false;
			}
		else if(space(application_name.value)==false){			
				application_name.focus();
				return false;
			}
		 if(level_time.value=="" || level_time.value==null)
			{
			alert("Please enter the level time.");
			level_time.focus();
			return false;
			}
		else if(space(level_time.value)==false){			
				level_time.focus();
				return false;
			}
		 if(isNaN(level_time.value)==true)
			{
			alert("Please enter the level time as numeric value.");
			level_time.focus();
			return false;
		}
		 if(noncam_bg_path.value=="" || noncam_bg_path.value==null)
			{
			alert("Please pick the noncam BG image.");
			noncam_bg_path.focus();
			return false;
			}
		 if(music_path.value=="" || music_path.value==null)
			{
			alert("Please pick the music file.");
			music_path.focus();
			return false;
			}
			else
			{ 
			pattern2 = /\.mp3$|\.MP3$/i
			matchval=music_path.value.match(pattern2);
				if(matchval==null)
				{
					alert("Please upload '.MP3', '.mp3' file only and Check your File extention");
					music_path.focus();
					return false;
				}
		   } 
	return true; 
	}
}
//configaddvalidate end


//configeditvalidate Start
function configeditvalidate(field)
{	
	with (field)
	{				
		 if(trim(application_name.value)=="" || trim(application_name.value)==null)
			{
			alert("Please enter the application name.");
			application_name.focus();
			return false;
			}
		else if(space(application_name.value)==false){			
				application_name.focus();
				return false;
			}
		  if(trim(level_time.value)=="" || trim(level_time.value)==null)
			{
			alert("Please enter the level time.");
			level_time.focus();
			return false;
			}
		else if(space(level_time.value)==false){			
				level_time.focus();
				return false;
			}
			if(isNaN(level_time.value)==true)
			{
			alert("Please enter the level time as numeric value.");
			level_time.focus();
			return false;
		  }
		if ((noncam_bg_path.value=="") || (noncam_bg_path.value==null)) {
			 alert("Please pick the noncam BG image.");
			 noncam_bg_path.focus();
			 return false;
			}		
		if ((music_path1.value=="") || (music_path1.value==null)){
		if ((music_path.value=="") || (music_path.value==null)) {
						 alert("Please pick the music file.");
						 music_path.focus();
						 return false;
			}
		}
		if(music_path.value != ""){
			pattern2 = /\.mp3$|\.MP3$/i
			matchval=music_path.value.match(pattern2);
				if(matchval==null)
				{
					alert("Please upload '.MP3', '.mp3' file only and Check your File extention");
					music_path.focus();
					return false;
				}
		   }
	return true; 
	}
}
//configeditvalidate end




//bgaddvalidate Start
function bgaddvalidate(field)
{	
	with (field)
	{				
		 if(noncam_bg_path.value=="" || noncam_bg_path.value==null)
			{
			alert("Please pick the noncam BG image.");
			noncam_bg_path.focus();
			return false;
			}
			 if (document.bg.noncam_bg_path.value != "")
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
				
				var image_file = document.bg.noncam_bg_path.value;
				
				var image_length = document.bg.noncam_bg_path.value.length;
				
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
	return true; 
	}
}
//bgaddvalidate end


//bgeditvalidate Start
function bgeditvalidate(field)
{	
	//alert(4);
	with (field)
	{				
		 if ((noncam_bg_path1.value=="") || (noncam_bg_path1.value==null)){
		if ((noncam_bg_path.value=="") || (noncam_bg_path.value==null)) {
			 alert("Please pick the noncam BG image.");
			 noncam_bg_path.focus();
			 return false;
			}
		 }
		if (noncam_bg_path.value!="")
		 {			
			var ext_val = extension_check1(noncam_bg_path.value);
			
			if(ext_val == false )
			{
				return false;
			}
		 }
	return true; 
	}
}
//bgeditvalidate end


//msgaddvalidate Start
function msgaddvalidate(field)
{	
	with (field)
	{				
		 if(message.value=="" || message.value==null)
			{
			alert("Please enter the message.");
			message.focus();
			return false;
			}
		return true; 
	}
}
//msgaddvalidate end

//msgeditvalidate Start
function msgeditvalidate(field)
{	
	with (field)
	{				
		 if(message.value=="" || message.value==null)
			{
			alert("Please enter the message.");
			message.focus();
			return false;
			}
		return true; 
	}
}
//msgeditvalidate end



//snowflakeaddvalidate Start
function sfaddvalidate(field)
{	
	with (field)
	{				
		 val();
		 if(snowflake_desc.value=="" || snowflake_desc.value==null)
			{
			alert("Enter the snowflake.");
			snowflake_desc.focus();
			return false;
			}
		else if(space(snowflake_desc.value)==false){			
				snowflake_desc.focus();
				return false;
			}
		if(image_path.value=="" || image_path.value==null)
			{
			alert("Please pick the image.");
			image_path.focus();
			return false;
			}
		else if(space(image_path.value)==false){			
				image_path.focus();
				return false;
			}
			
		 if (document.sf.image_path.value != "")
		 {
			var ext_val = extension_check(document.sf.image_path.value);
			
			if(ext_val == false )
			{
				return false;
			}
		 }	
			
		 if(color1.value=="" || color1.value==null)
			{
			alert("Please pick the color.");
			color1.focus();
			return false;
			}
		else if(space(color1.value)==false){			
				color1.focus();
				return false;
			}
		 if(points.value=="" || points.value==null)
			{
			alert("Please enter the points.");
			points.focus();
			return false;
			}
		else if(space(points.value)==false){			
				points.focus();
				return false;
			}
		if(isNaN(points.value)==true)
			{
				alert("Please enter the points as numeric value.");
				points.focus();
				return false;
			}
		if(sound_path.value=="" || sound_path.value==null)
			{
			alert("Please pick the sound file.");
			sound_path.focus();
			return false;
			}
		else if(space(sound_path.value)==false){			
				sound_path.focus();
				return false;
			}
		else
		{ 
		pattern2 = /\.mp3$|\.MP3$/i
		matchval=sound_path.value.match(pattern2);
			if(matchval==null)
			{
				alert("Please upload '.MP3', '.mp3' file only and Check your File extention");
				sound_path.focus();
				return false;
			}
 	   } 
	return true; 
	}
}
//snowflakeaddvalidate end

//snowflakeeditvalidate Start
function sfeditvalidate(field)
{	
	with (field)
	{				
		 val();
		 if(trim(snowflake_desc.value)=="" || trim(snowflake_desc.value)==null)
			{
			alert("Enter the snowflake.");
			snowflake_desc.focus();
			return false;
			}
		else if(space(snowflake_desc.value)==false){			
				snowflake_desc.focus();
				return false;
			}
		 if ((image_path1.value=="") || (image_path1.value==null)){
		if ((image_path.value=="") || (image_path.value==null)) {
			 alert("Please pick the image.");
			 image_path.focus();
			 return false;
			}	
		}
		
		 if (document.sf.image_path.value != "")
		 {
			var ext_val = extension_check(document.sf.image_path.value);
			
			if(ext_val == false )
			{
				return false;
			}
		 }

		 if(color1.value=="" || color1.value==null)
			{
			alert("Please pick the color.");
			color1.focus();
			return false;
			}		
		 if(trim(points.value)=="" || trim(points.value)==null)
			{
			alert("Please enter the points.");
			points.focus();
			return false;
			}
		else if(space(points.value)==false){			
				points.focus();
				return false;
			}
		if(isNaN(points.value)==true)
			{
				alert("Please enter the points as numeric value.");
				points.focus();
				return false;
			}
		 if ((sound_path1.value=="") || (sound_path1.value==null)){
		if ((sound_path.value=="") || (sound_path.value==null)) {
						 alert("Please pick the sound file.");
						 sound_path.focus();
						 return false;
			}
		}
			if (sound_path.value != ""){			
			pattern2 = /\.mp3$|\.MP3$/i
			matchval=sound_path.value.match(pattern2);
				if(matchval==null)
				{
					alert("Please upload '.MP3', '.mp3' file only and Check your File extention");
					sound_path.focus();
					return false;
				}
		   }
	return true; 
	}
}
//snowflakeeditvalidate end


//leveladdvalidate Start
function leveladdvalidate(field)
{	
	with (field)
	{				
	 if(level_id.value=="" || level_id.value==null)
			{
			alert("Please select the level.");
			level_id.focus();
			return false;
			}	
		if(level_desc.value=="" || level_desc.value==null)
			{
			alert("Please enter the level description.");
			level_desc.focus();
			return false;
			}
		 else if(space(level_desc.value)==false){			
				level_desc.focus();
				return false;
			}
		if(level_id.value != 11)
		{
			if(points_beat.value=="" || points_beat.value==null)
				{
				alert("Please enter the points to beat.");
				points_beat.focus();
				return false;
				}
			 else if(space(points_beat.value)==false){			
				points_beat.focus();
				return false;
			}
			if(isNaN(points_beat.value)==true)
			{
				alert("Please enter the points to beat as numeric value.");
				points_beat.focus();
				return false;
			}
			if(snow_frequency.value=="" || snow_frequency.value==null)
				{
				alert("Please enter the snow frequency.");
				snow_frequency.focus();
				return false;
				}
			 else if(space(snow_frequency.value)==false){			
				snow_frequency.focus();
				return false;
			}
			if(isNaN(snow_frequency.value)==true)
			{
				alert("Please enter the snow frequency as numeric value.");
				snow_frequency.focus();
				return false;
			}
			if(snow_maxspeed.value=="" || snow_maxspeed.value==null)
				{
				alert("Please enter the snow maxspeed.");
				snow_maxspeed.focus();
				return false;
				}
			else if(space(snow_maxspeed.value)==false){			
				snow_maxspeed.focus();
				return false;
			}
			if(isNaN(snow_maxspeed.value)==true)
			{
				alert("Please enter the snow maxspeed as numeric value.");
				snow_maxspeed.focus();
				return false;
			}
			
		}
		if(nickname.value=="" || nickname.value==null)
			{
			alert("Please enter the nickname.");
			nickname.focus();
			return false;
			}	
		else if(space(nickname.value)==false){			
				nickname.focus();
				return false;
			}
	return true; 
	}
}
//leveladdvalidate end


//leveleditvalidate Start
function leveleditvalidate(field)
{	
	with (field)
	{				
	 if(level_id.value=="" || level_id.value==null)
			{
			alert("Please select the level.");
			level_id.focus();
			return false;
			}	
		if(trim(level_desc.value)=="" || trim(level_desc.value)==null)
			{
			alert("Please enter the level description.");
			level_desc.focus();
			return false;
			}
		 else if(space(level_desc.value)==false){			
				level_desc.focus();
				return false;
			}
		if(level_id.value != 11)
		{
			if(trim(points_beat.value)=="" || trim(points_beat.value)==null)
				{
				alert("Please enter the points to beat.");
				points_beat.focus();
				return false;
				}
			 else if(space(points_beat.value)==false){			
				points_beat.focus();
				return false;
			}
			if(isNaN(points_beat.value)==true)
			{
				alert("Please enter the points to beat as numeric value.");
				points_beat.focus();
				return false;
			}
			if(trim(snow_frequency.value)=="" || trim(snow_frequency.value)==null)
				{
				alert("Please enter the snow frequency.");
				snow_frequency.focus();
				return false;
				}
			else if(space(snow_frequency.value)==false){			
				snow_frequency.focus();
				return false;
			}
			if(isNaN(snow_frequency.value)==true)
			{
				alert("Please enter the snow frequency as numeric value.");
				snow_frequency.focus();
				return false;
			}
			if(trim(snow_maxspeed.value)=="" || trim(snow_maxspeed.value)==null)
				{
				alert("Please enter the snow maxspeed.");
				snow_maxspeed.focus();
				return false;
				}
			else if(space(snow_maxspeed.value)==false){			
				snow_maxspeed.focus();
				return false;
			}
			if(isNaN(snow_maxspeed.value)==true)
			{
				alert("Please enter the snow maxspeed as numeric value.");
				snow_maxspeed.focus();
				return false;
			}
			
		}
		if(trim(nickname.value)=="" || trim(nickname.value)==null)
			{
			alert("Please enter the nickname.");
			nickname.focus();
			return false;
			}
		else if(space(nickname.value)==false){			
				nickname.focus();
				return false;
			}
	return true; 
	}
}
//leveleditvalidate end



//occuraddvalidate Start
function occuraddvalidate(field)
{	
	with (field)
	{				
	 if(snowflake_id.value=="" || snowflake_id.value==null)
			{
			alert("Please select the snowflake.");
			snowflake_id.focus();
			return false;
			}	
	 if(level_id.value=="" || level_id.value==null)
			{
			alert("Please select the level.");
			level_id.focus();
			return false;
			}	
		if(occurrence.value=="" || occurrence.value==null)
			{
			alert("Please enter the occurrence.");
			occurrence.focus();
			return false;
			}
		  else if(space(occurrence.value)==false){			
			occurrence.focus();
			return false;
			}
		/* if(isNaN(occurrence.value)==true)
			{
			alert("Please enter the occurrence as numeric value.");
			occurrence.focus();
			return false;
		}*/
	return true; 
	}
}
//occuraddvalidate end


//occureditvalidate Start
function occureditvalidate(field)
{	
	with (field)
	{				
	 if(snowflake_id.value=="" || snowflake_id.value==null)
			{
			alert("Please select the snowflake.");
			snowflake_id.focus();
			return false;
			}	
	 if(level_id.value=="" || level_id.value==null)
			{
			alert("Please select the level.");
			level_id.focus();
			return false;
			}	
		if(trim(occurrence.value)=="" || trim(occurrence.value)==null)
			{
			alert("Please enter the occurrence.");
			occurrence.focus();
			return false;
			}
		 else if(space(occurrence.value)==false){			
			occurrence.focus();
			return false;
			}
		 /*if(isNaN(occurrence.value)==true)
			{
			alert("Please enter the occurrence as numeric value.");
			occurrence.focus();
			return false;
		}*/
	return true; 
	}
}
//occureditvalidate end




//fallingpathaddvalidate Start
function fpaddvalidate(field)
{	
	with (field)
	{				
		 if(degree.value=="" || degree.value==null)
			{
			alert("Enter the degree.");
			degree.focus();
			return false;
			}	
		 else if(space(degree.value)==false){			
			degree.focus();
			return false;
			}			
		if(degree.value > 360)
			{
			alert("Please enter the degree below or equal to 360 degrees.");
			degree.focus();
			return false;
			}	
		 
		 if(isNaN(degree.value)==true)
			{
			alert("Please enter the degree as numeric value.");
			degree.focus();
			return false;
		}
		
		 if(occurrence.value=="" || occurrence.value==null)
			{
			alert("Enter the occurrence.");
			occurrence.focus();
			return false;
			}
		 else if(space(occurrence.value)==false){			
			occurrence.focus();
			return false;
			}
		 if(isNaN(occurrence.value)==true)
			{
			alert("Please enter the occurrence as numeric value.");
			occurrence.focus();
			return false;
		}
	return true; 
	}
}
//fallingpathaddvalidate end

//fallingpatheditvalidate Start
function fpeditvalidate(field)
{	
	with (field)
	{				
		 if(trim(degree.value)=="" || trim(degree.value)==null)
			{
			alert("Enter the degree.");
			degree.focus();
			return false;
			}		
		 else if(space(degree.value)==false){			
			degree.focus();
			return false;
			}
		if(degree.value > 360)
			{
			alert("Please enter the degree below or equal to 360 degrees.");
			degree.focus();
			return false;
			}	
		 if(isNaN(degree.value)==true)
			{
			alert("Please enter the degree as numeric value.");
			degree.focus();
			return false;
		}		
		 if(trim(occurrence.value)=="" || trim(occurrence.value)==null)
			{
			alert("Enter the occurrence.");
			occurrence.focus();
			return false;
			}
		 else if(space(occurrence.value)==false){			
			occurrence.focus();
			return false;
			}
		 if(isNaN(occurrence.value)==true)
			{
			alert("Please enter the occurrence as numeric value.");
			occurrence.focus();
			return false;
		}
	return true; 
	}
}
//fallingpathaddvalidate end


//adminuservalidate Start
function adminregvalidate(field)
{	
	with (field)
	{		
		var pass = adpass.value;
		
		if(adname.value=="" || adname.value==null)
			{
			alert("Enter your username.");
			adname.focus();
			return false;
			}
		else if(space(adname.value)==false){			
			adname.focus();
			return false;
			}
		
		if(adpass.value=="" || adpass.value==null )
			{
			alert("Enter your password.");
			adpass.focus();
			return false;
			}
		else if(space(adpass.value)==false){			
			adpass.focus();
			return false;
			}			
		if((pass.length)<"6")
			{
			alert("your password is less than 6 charectors.");
		    adpass.focus();
			return false;
			}
		
		if ((ademail.value==null)||(ademail.value=="")){
			alert("Please enter your e-mail id.");
			ademail.focus();
			return false;
		}
		
		if(ademail.value.search(/^(\w+(?:\.\w+)*)@((?:\w+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i))
		{
			alert("Please enter valid e-mail");
			ademail.focus();
			return false;
		}
		
		else if(space(ademail.value)==false){			
			ademail.focus();
			return false;
			}
		
		if ((admobile.value==null)||(admobile.value=="")){
				alert("Please enter your mobile Number.");
				admobile.focus();
				return false;
		}
		else if(space(admobile.value)==false){			
			admobile.focus();
			return false;
			}

          if(isNaN(admobile.value)==true)
			{
			alert("Please enter the mobile number as numeric value.");
			admobile.focus();
			return false;
		}
		
		if((admobile.value.length < 10) || (admobile.value.length > 10))
			{
			alert("Enter the 10 digit mobile number.");
			admobile.focus();
			return false;
		}	
   
	return true; 
	}
}
//adminuservalidate End


//adminusereditvalidate Start
function adminregvalidateedit(field)
{
	with (field)
	{
		var pass = adpass.value;
				
		 if(trim(adname.value)=="" || trim(adname.value)==null)
			{
			alert("Enter your username.");
			adname.focus();
			return false;
			}		
		else if(space(adname.value)==false){			
			adname.focus();
			return false;
			}
		
		if(trim(adpass.value)=="" || trim(adpass.value)==null )
			{
			alert("Enter your password.");
			adpass.focus();
			return false;
			}
		else if(space(adpass.value)==false){			
			adpass.focus();
			return false;
			}
		
		if((pass.length)<"6")
			{
			alert("your password is less then 6 charectors.");
		    adpass.focus();
			return false;
			}   
		
         if ((ademail.value==null)||(ademail.value=="")){
				alert("Please enter your e-mail id.");
				ademail.focus();
				return false;
			}
		
		else if(space(ademail.value)==false){			
			ademail.focus();
			return false;
			}
		if(ademail.value.search(/^(\w+(?:\.\w+)*)@((?:\w+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i))
		{
			alert("Please enter valid e-mail");
			ademail.focus();
			return false;
		}
		  if ((admobile.value==null)||(admobile.value=="")){
				alert("Please enter the mobile number.");
				admobile.focus();
				return false;
			}
		else if(space(admobile.value)==false){			
			admobile.focus();
			return false;
			}
		
          if(isNaN(admobile.value)==true)
			{
			alert("Please enter the mobile number as Numeric value.");
			admobile.focus();
			return false;
		}		
		if((admobile.value.length < 10) || (admobile.value.length > 10))
			{
			alert("Enter the 10 digit mobile number.");
			admobile.focus();
			return false;
		}		
		
	return true; 
	}
}
//adminusereditvalidate End


//User ajax start
function usersetauthenticate(userid)
{
	var a = confirm("Do you really want to authenticate this user? If so all the details related to this user will get authenticated.");
	if(a)
	{
		xmlHttp=GetXmlHttpObject()
		if (xmlHttp==null)
		{
		alert ("Browser does not support HTTP Request")
		return
		} 
		var url="changeuserstatus.php?userid="+userid+"&status=set";
//alert(url);
		xmlHttp.onreadystatechange=function()
      {
          
	 	if( xmlHttp.readyState < 4 || xmlHttp.readyState!="Complete")
			{
			}

		if (xmlHttp.readyState==4 || xmlHttp.readyState=="Complete")
			{ 
		var newurl = "viewusers.php";
		window.location= newurl;		
		
				} 
      }
		
		xmlHttp.open("GET",url,true)
		xmlHttp.send(null)	
	}
	
	
}

function userunsetauthenticate(userid)
{
	var a = confirm("Do you really want to unauthenticate this user? If so all the details related to this user wil get unauthenticated.");
	if(a)
	{
		xmlHttp=GetXmlHttpObject()
		if (xmlHttp==null)
		{
		alert ("Browser does not support HTTP Request")
		return
		} 
		var url="changeuserstatus.php?userid="+userid+"&status=unset";	
		//alert(url);
		xmlHttp.onreadystatechange=function()
      {
     
	 	if( xmlHttp.readyState < 4 || xmlHttp.readyState!="Complete")
			{
			}

		if (xmlHttp.readyState==4 || xmlHttp.readyState=="Complete")
			{ 
		var newurl = "viewusers.php";
		window.location= newurl;			
			} 
      }
		xmlHttp.open("GET",url,true)
		xmlHttp.send(null)	
	}
}

//User ajax end



//imageshow starts

function imageshow()
{
	var imageval = document.getElementById('noncam_bg_path')[document.getElementById('noncam_bg_path').selectedIndex].innerHTML;
	var image_path1="<img src=\'images/noncambg/"+imageval + "\' width='20' height='20'/>";	
	document.getElementById('image_div').innerHTML = image_path1;
}


//imageshow end

function extension_check(value)
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
			
			var image_file = document.sf.image_path.value;
			
			var image_length = document.sf.image_path.value.length;
			
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

