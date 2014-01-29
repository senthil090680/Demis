<?PHP
ob_start();
session_start(); 


function curPageName() {
 return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Webcam - Admin Panel</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/ddaccordion.js"></script>
<script type="text/javascript">
ddaccordion.init({
	headerclass: "submenuheader", //Shared CSS class name of headers group
	contentclass: "submenu", //Shared CSS class name of contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [], //index of content(s) open by default [index1, index2, etc] [] denotes no content
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", ""], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["suffix", "<img src='images/plus.gif' class='statusicon' />", "<img src='images/minus.gif' class='statusicon' />"], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})
</script>

<script type="text/javascript" src="js/jconfirmaction.jquery.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('.ask').jConfirmAction();
	});
</script>

<script language="javascript" type="text/javascript" src="js/niceforms.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="css/niceforms-default.css" />
<link rel="stylesheet" type="text/css" href="css/style2.css" />
<style type="text/css">
a {
color:#333;
text-transform: capitalize;
}
a:hover{
color:#FF00FF;
text-decoration:underline
}
</style> 
</head>
<body>
<div id="main_container">

     

<div class="header">
    <div class="logo"><a href="adminindex.php"><img src="images/webcam.PNG" alt="" title="" border="0" /></a></div>
    
    <div class="right_header">Welcome <?PHP echo $_SESSION['admin_name']; ?>, <a href="../index.php" target="_blank">Visit site&raquo;</a> | <a href="logout.php" class="logout">Logout</a></div>
    <div id="clock_a"></div>
    </div>
     <div class="main_content">
   
     <div class="menu">
                    <ul>                    
                     <li><a href="adminindex.php" <?PHP if(curPageName()=='adminindex.php') { ?> class="current" <?PHP } ?>>Admin Home</a>
                     <li><a href="#" <?PHP if(curPageName()=='adminprofile.php' || curPageName()=='adminregister.php') { ?> class="current" <?PHP } ?>>Admin Profile</a>
                     <ul>                     
                     <li><a href="adminregister.php">Add Admin</a></li>                                                          
                     <li><a href="adminprofile.php">View Admin</a></li>
                    </ul>
                    
                    <li><a href="#" <?PHP if(curPageName()=='viewusers.php') { ?> class="current" <?PHP } ?>>User</a>
                    <ul>
                    <li><a href="viewusers.php">View User</a></li>
                    </ul>
                    </li>
                   
                   <li><a href="#" <?PHP if(curPageName()=='addsnowflake.php' || curPageName()=='viewsnowflakes.php') { ?> class="current" <?PHP } ?>>Snowflakes</a>
                   <ul>
                   <li> <a href="addsnowflake.php" >Add Snowflake</a>  </li>
                     <li><a href="viewsnowflakes.php">View Snowflakes</a></li>                     
                   </ul>
                   </li>
                   
                   <li><a href="#" <?PHP if(curPageName()=='addlevel.php' || curPageName()=='viewlevels.php') { ?> class="current" <?PHP } ?>>Levels</a>
                   <ul>
                   <li> <a href="addlevel.php" >Add Level</a>  </li>
                    <li><a href="viewlevels.php">View Levels</a></li>                     
                   </ul>
                   </li>
                   
                    <li><a href="#" <?PHP if(curPageName()=='addfallingpath.php' || curPageName()=='viewfallingpaths.php') { ?> class="current" <?PHP } ?>>Falling Paths</a>
                   <ul>
                   <li> <a href="addfallingpath.php" >Add Falling Path</a>  </li>
                    <li><a href="viewfallingpaths.php">View Falling Paths</a></li>                     
                   </ul>
                   </li>
                   
                    <li><a href="#" <?PHP if(curPageName()=='addoccurrence.php' || curPageName()=='viewoccurrences.php') { ?> class="current" <?PHP } ?>>Occurrence</a>
                   <ul>
                   <li> <a href="addoccurrence.php" >Add Occurrence</a>  </li>
                    <li><a href="viewoccurrences.php">View Occurrences</a></li>                     
                   </ul>
                   </li>
                   
                    <!--<li><a href="#" <?PHP// if(curPageName()=='viewstats.php') { ?> class="current" <?PHP// } ?>>Stats</a>
                   <ul>
                    <li><a href="viewstats.php">View Statistics</a></li>     
                      <li><a href="#">View Statistics</a></li>             
                   </ul>
                   </li>-->
                   
                   <li><a href="#" <?PHP if(curPageName()=='addbg.php' || curPageName()=='viewbgs.php') { ?> class="current" <?PHP } ?>>BG</a>
                   <ul>
                   <li> <a href="addbg.php" >Add Background</a>  </li>
                    <li><a href="viewbgs.php">View Background</a></li>  
                   <!-- <li> <a href="#" >Add Configuration</a>  </li>
                    <li> <a href="#" >View Configurations</a>  </li>  -->               
                   </ul>
                   </li>
                   
                    <li><a href="#" <?PHP if(curPageName()=='addconfig.php' || curPageName()=='viewconfigs.php') { ?> class="current" <?PHP } ?>>Config</a>
                   <ul>
                   <li> <a href="addconfig.php" >Add Configuration</a>  </li>
                    <li><a href="viewconfigs.php">View Configurations</a></li>  
                   <!-- <li> <a href="#" >Add Configuration</a>  </li>
                    <li> <a href="#" >View Configurations</a>  </li>  -->               
                   </ul>
                   </li>
                   
                   <li><a href="#" <?PHP if(curPageName()=='addmessage.php' || curPageName()=='viewmessage.php') { ?> class="current" <?PHP } ?>>Message</a>
                   <ul>
                   <li> <a href="addmessage.php" >Add Message</a>  </li>
                    <li><a href="viewmessage.php">View Message</a></li>  
                   <!-- <li> <a href="#" >Add Configuration</a>  </li>
                    <li> <a href="#" >View Configurations</a>  </li>  -->               
                   </ul>
                   </li>
                   
                   <li><a href="#">Drop Temp Tables</a>
                    <ul>
                   <li><a href="drop_table.php">Drop Tables</a></li> 
                   </ul>
                   </li>
                   
                   <li><a href="#">Database backup</a>
                    <ul>
                   <li><a href="viewbackup.php">View Backup</a></li> 
                   </ul>
                   </li>
                                      
                    </ul>
                    
                    </div> 