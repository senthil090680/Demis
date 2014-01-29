var xmlHttp

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
