// JavaScript Document

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
function GetXmlHttpObject()
{
	var objXMLHttp=null;
	if (window.XMLHttpRequest)
	{
		objXMLHttp=new XMLHttpRequest();
	}
	else if (window.ActiveXObject)
	{
		objXMLHttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
return objXMLHttp;
}




//userforgotvalidate start

/*function userforgotvalidate()
{
	//alert(232);
	var email1 = document.getElementById('email');
	
	if(email1.value=="")
			{
			alert("Please enter the email.");
			email1.focus();
			return false;
			}	
		if(email1.value.search(/^(\w+(?:\.\w+)*)@((?:\w+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i))
		{
			alert("Please enter valid e-mail");
			email1.focus();
			return false;
		}
}*/
//userforgotvalidate end



//useraddvalidate Start
function useraddvalidate(field)
{	
	with (field)
	{				
		 	/*var username1 = document.getElementById('username');
			var password1 = document.getElementById('password');
			var firstname1 = document.getElementById('firstname');
			var lastname1 = document.getElementById('lastname');
			var email1 = document.getElementById('email');
			var gender1 = document.getElementById('gender');
			var user_image1 = document.getElementById('user_image');*/
		 
		 if(username.value=="")
			{
			document.getElementById('error_msg1').innerHTML = "Please enter the username.";
			username.focus();
			return false;
			}
		else if(space(username.value)==false){			
			username.focus();
			return false;
			}
		 if(password.value=="")
			{
			document.getElementById('error_msg1').innerHTML = "Please enter the password.";
			password.focus();
			return false;
			}
		else if(space(password.value)==false){			
			password.focus();
			return false;
			}
		if((password.value.length)<"6")
			{
			document.getElementById('error_msg1').innerHTML = "Your password is less than 6 charectors.";
		    password.focus();
			return false;
			}
		 if(firstname.value=="")
			{
			document.getElementById('error_msg1').innerHTML = "Please enter the firstname.";
			firstname.focus();
			return false;
			}
		 else if(space(firstname.value)==false){			
			firstname.focus();
			return false;
			}
		 if(lastname.value=="")
			{
			document.getElementById('error_msg1').innerHTML = "Please enter the lastname.";
			lastname.focus();
			return false;
			}
		 else if(space(lastname.value)==false){			
			lastname.focus();
			return false;
			}
		if(email.value=="")
			{
			document.getElementById('error_msg1').innerHTML = "Please enter the email.";
			email.focus();
			return false;
			}	
		if(email.value.search(/^(\w+(?:\.\w+)*)@((?:\w+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i))
		{
			document.getElementById('error_msg1').innerHTML = "Please enter valid e-mail";
			email.focus();
			return false;
		}
		if(gender.value=="")
			{
			document.getElementById('error_msg1').innerHTML = "Please select the gender.";
			gender.focus();
			return false;
			}
		if(user_image.value=="")
			{
			document.getElementById('error_msg1').innerHTML = "Please pick the image.";
			user_image.focus();
			return false;
			}
	return true; 
	}
}
//useraddvalidate end


//userloginvalidate Start
function userloginvalidate(field)
{	
	var username1 = document.getElementById('username2');
	var password1 = document.getElementById('password2');
	//alert(password1.value);
		 if(username1.value=="")
			{
			document.getElementById('error_msg2').innerHTML = "Please enter the username.";
			username1.focus();
			return false;
			}
		else if(space(username1.value)==false){			
			username1.focus();
			return false;
			}
		 if(password1.value=="")
			{
			document.getElementById('error_msg2').innerHTML = "Please enter the password.";
			password1.focus();
			return false;
			}
		else if(space(password1.value)==false){			
			password1.focus();
			return false;
			}
		if((password1.value.length)<"6")
			{
			document.getElementById('error_msg2').innerHTML = "Your password is less than 6 charectors.";
		    password1.focus();
			return false;
			}
		
		xmlHttp=GetXmlHttpObject()
		if (xmlHttp==null)
		{
		alert ("Browser does not support HTTP Request")
		return
		} 
		var url="login_register.php?username="+username1.value+"&password="+password1.value+"&submit_login="+3;	
		//alert(url);
		xmlHttp.onreadystatechange=function()
      {
     
	 	if( xmlHttp.readyState < 4 || xmlHttp.readyState!="Complete")
			{
			}

		if (xmlHttp.readyState==4 || xmlHttp.readyState=="Complete")
			{ 
			//alert(xmlHttp.responseText);
				var i = xmlHttp.responseText;
				if(i == 1)
				{
					//alert(i);
					var newurl = "index.php";
					window.location= newurl;
				}
				else if(i == 0)
				{
					var msg = "Please enter correct Username and Password!."
					//alert(msg);
					document.getElementById('error_msg2').innerHTML = msg;
					return false;										
				}
			} 
			
      }
		xmlHttp.open("GET",url,true)
		xmlHttp.send(null)		
}
//userloginvalidate end



//userforgotvalidate start
function userforgotvalidate()
{
	alert(222);
	var email1 = document.getElementById('email').value;
	var email2 = document.getElementById('email');
	alert(email1);
	
	
	if(email1.value=="")
			{
			document.getElementById('error_msg3').innerHTML = "Please enter the email.";
			email2.focus();
			return false;
			}	
		if(email1.value.search(/^(\w+(?:\.\w+)*)@((?:\w+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i))
		{
			document.getElementById('error_msg3').innerHTML = "Please enter valid e-mail";
			email2.focus();
			return false;
		}
		
		
		xmlHttp=GetXmlHttpObject()
		if (xmlHttp==null)
		{
		alert ("Browser does not support HTTP Request")
		return
		} 
		var url="login_register.php?email="+email1.value+"&submit_for="+3;	
		//alert(url);
		xmlHttp.onreadystatechange=function()
      {
     
	 	if( xmlHttp.readyState < 4 || xmlHttp.readyState!="Complete")
			{
			}

		if (xmlHttp.readyState==4 || xmlHttp.readyState=="Complete")
			{ 
			//alert(xmlHttp.responseText);
				var i = xmlHttp.responseText;
				if(i == 0)
				{
					var msg = "Password has not been sent due to some errors";
					document.getElementById('error_msg3').innerHTML = msg;
					return false;										
				}
				else if(i == 1)
				{
					var msg = "Password has been sent to your mail.  Please Check! ";
					//alert(msg);
					document.getElementById('error_msg3').innerHTML = msg;
					return false;										
				}
			} 
			
      }
		xmlHttp.open("GET",url,true)
		xmlHttp.send(null)	
		
}
//userforgotvalidate end


var intTextBox=0;
var intTextBox11=1;
var intTextBox_con=1;  //HIDDEN PLAYER COUNT


//FUNCTION TO ADD TEXT BOX ELEMENT
function addElement()
{
intTextBox = intTextBox + 1;
intTextBox11 = intTextBox11 + 1;
intTextBox_con = intTextBox_con + 1;
var contentID = document.getElementById('content');
var newTBDiv = document.createElement('div');
newTBDiv.setAttribute('id','strText'+intTextBox);

newTBDiv.innerHTML = "<td align='left'>"+intTextBox11+"</td>:&nbsp;<input type='hidden' name='email_con' id='email_con' value="+intTextBox +" /><input type='text' style='width:300px;' id=email_" + intTextBox + " name=email_" + intTextBox +" /></td>&nbsp;<br/><br/>";
document.getElementById('email_count').innerHTML = intTextBox;
contentID.appendChild(newTBDiv);
}

//FUNCTION TO REMOVE TEXT BOX ELEMENT
function removeElement()
{
if(intTextBox != 0)
{
var contentID = document.getElementById('content');
contentID.removeChild(document.getElementById('strText'+intTextBox));
intTextBox = intTextBox-1;
intTextBox11 = intTextBox11-1;
}
}

function postemailvalidate(field)
{
	with (field)
	{				
		var email_con1 = document.getElementById('email_count').innerHTML;
		//alert(email_con1);
		
		for(var i = 0; i <= email_con1; i++)
		{
			var email_val = 'email_'+i;
			//alert(email_val);
			var email_vali = document.getElementById(email_val);
			if(email_vali.value=="" || email_vali.value==null)
			{
			alert("Please enter the email of your friends.");
			email_vali.focus();
			return false;
			}
			
			if(email_vali.value.search(/^(\w+(?:\.\w+)*)@((?:\w+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i))
			{
				alert("Please enter valid e-mail");
				email_vali.focus();
				return false;
			}
		}
		if(subj.value=="" || subj.value==null)
			{
			alert("Please enter the subject.");
			subj.focus();
			return false;
			}
		if(msg.value=="" || msg.value==null)
			{
			alert("Please enter the message.");
			msg.focus();
			return false;
			}
	return true; 
	}	
}


function $m(theVar){
	return document.getElementById(theVar)
}
function remove(theVar){
	var theParent = theVar.parentNode;
	theParent.removeChild(theVar);
}
function addEvent(obj, evType, fn){
	if(obj.addEventListener)
	    obj.addEventListener(evType, fn, true)
	if(obj.attachEvent)
	    obj.attachEvent("on"+evType, fn)
}
function removeEvent(obj, type, fn){
	if(obj.detachEvent){
		obj.detachEvent('on'+type, fn);
	}else{
		obj.removeEventListener(type, fn, false);
	}
}
function isWebKit(){
	return RegExp(" AppleWebKit/").test(navigator.userAgent);
}
function ajaxUpload(form,url_action,id_element,html_show_loading,html_error_http){
			var username1 = document.getElementById('username');
			var password1 = document.getElementById('password');
			var firstname1 = document.getElementById('firstname');
			var lastname1 = document.getElementById('lastname');
			var email1 = document.getElementById('email');
			var gender1 = document.getElementById('gender');
			var user_image1 = document.getElementById('user_image');
		 
		 if(username1.value=="")
			{
			document.getElementById('error_msg1').innerHTML = "Please enter the username.";
			username1.focus();
			return false;
			}
		else if(space(username1.value)==false){			
			username1.focus();
			return false;
			}
		 if(password1.value=="")
			{
			document.getElementById('error_msg1').innerHTML = "Please enter the password.";
			password1.focus();
			return false;
			}
		else if(space(password1.value)==false){			
			password1.focus();
			return false;
			}
		if((password1.value.length)<"6")
			{
			document.getElementById('error_msg1').innerHTML = "Your password is less than 6 charectors.";
		    password1.focus();
			return false;
			}
		 if(firstname1.value=="")
			{
			document.getElementById('error_msg1').innerHTML = "Please enter the firstname.";
			firstname1.focus();
			return false;
			}
		 else if(space(firstname1.value)==false){			
			firstname1.focus();
			return false;
			}
		 if(lastname1.value=="")
			{
			document.getElementById('error_msg1').innerHTML = "Please enter the lastname.";
			lastname1.focus();
			return false;
			}
		 else if(space(lastname1.value)==false){			
			lastname1.focus();
			return false;
			}
		if(email1.value=="")
			{
			document.getElementById('error_msg1').innerHTML = "Please enter the email.";
			email1.focus();
			return false;
			}	
		if(email1.value.search(/^(\w+(?:\.\w+)*)@((?:\w+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i))
		{
			document.getElementById('error_msg1').innerHTML = "Please enter valid e-mail";
			email1.focus();
			return false;
		}
		if(gender1.value=="")
			{
			document.getElementById('error_msg1').innerHTML = "Please select the gender.";
			gender1.focus();
			return false;
			}
		if(user_image1.value=="")
			{
			document.getElementById('error_msg1').innerHTML = "Please pick the image.";
			user_image1.focus();
			return false;
			}
		
	var detectWebKit = isWebKit();
	form = typeof(form)=="string"?$m(form):form;
	var erro="";
	if(form==null || typeof(form)=="undefined"){
		erro += "The form of 1st parameter does not exists.\n";
	}else if(form.nodeName.toLowerCase()!="form"){
		erro += "The form of 1st parameter its not a form.\n";
	}
	if($m(id_element)==null){
		erro += "The element of 3rd parameter does not exists.\n";
	}
	if(erro.length>0){
		//document.getElementById('error_msg1').innerHTML = "Error in call ajaxUpload:\n" + erro;
		return;
	}
	var iframe = document.createElement("iframe");
	iframe.setAttribute("id","ajax-temp");
	iframe.setAttribute("name","ajax-temp");
	iframe.setAttribute("width","0");
	iframe.setAttribute("height","0");
	iframe.setAttribute("border","0");
	iframe.setAttribute("style","width: 0; height: 0; border: none;");
	form.parentNode.appendChild(iframe);
	window.frames['ajax-temp'].name="ajax-temp";
	var doUpload = function(){
		removeEvent($m('ajax-temp'),"load", doUpload);
		var cross = "javascript: ";
		cross += "window.parent.$m('"+id_element+"').innerHTML = document.body.innerHTML; void(0);";
		$m(id_element).innerHTML = html_error_http;
		$m('ajax-temp').src = cross;
		if(detectWebKit){
        	remove($m('ajax-temp'));
        }else{
        	setTimeout(function(){ remove($m('ajax-temp'))}, 250);
        }
    }
	addEvent($m('ajax-temp'),"load", doUpload);
	form.setAttribute("target","ajax-temp");
	form.setAttribute("action",url_action);
	form.setAttribute("method","post");
	form.setAttribute("enctype","multipart/form-data");
	form.setAttribute("encoding","multipart/form-data");
	if(html_show_loading.length > 0){
		$m(id_element).innerHTML = html_show_loading;
	}
	form.submit();
}