var AjaxObj;
var dates = new Date();

function CreateAjaxObj()
{	
	try
	{
		AjaxObj = new ActiveXObject("Msxml2.XMLHTTP");
	}
	catch(e) 
	{
		try
		{
			AjaxObj = new ActiveXObject("Microsoft.XMLHTTP");
		} 
		catch(oc)
		{
			AjaxObj = null;
		}
	}	
	if(!AjaxObj && typeof XMLHttpRequest != "undefined") 
	{
		AjaxObj = new XMLHttpRequest();
	}
	
}

var gcontentarea = '';
var gflag = '';
var gid = '';

function ajaxgetxmlcontent(url, choice, id, contentarea,page)
{
	gflag = choice;
	gid = id;
	gcontentarea = contentarea;

	if(choice=="viewmediaoptions")
	{
	document.getElementById('copies').style.display='none';
	}
	document.getElementById(gcontentarea).innerHTML = '&nbsp;<img src="images/loading.gif"><font size=1 face=verdana>Loading...'; 

	var strTS = new Date().toString().replace(/(\s|\:|\+)/gi,"");
	var requestUrl = url+"?choice="+choice+"&filter="+id + "&strTS=" + strTS+"&page="+page;	
	
	CreateAjaxObj();
		
	if(AjaxObj) {
		AjaxObj.onreadystatechange = StateChangeHandler;	
		AjaxObj.open("GET", requestUrl, true);				
		AjaxObj.send(null);		
		return false
	}			
	return false
}

function StateChangeHandler()
{
	var res;	
	if(AjaxObj.readyState == 4){		
		if(AjaxObj.status == 200){	
		
		document.getElementById(gcontentarea).innerHTML = AjaxObj.responseText; 
			
		}
		else{
			alert("problem retrieving data from the server, status code: "  + AjaxObj.status);
		}
	}
	return false
}