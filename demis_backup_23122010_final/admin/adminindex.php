<?php include("header.php"); ?>          
                    
<?PHP 
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

include("dbs.php");

//exit;
?>                    
                    
    <div class="center_content">  
      <div class="one-row_content" style="min-height:200px">            
        <h5 align="right">Hello <?PHP echo ucfirst($_SESSION['admin_name']); ?>! </h5> 
    <?PHP if($_GET['bk']=="1") { ?> <div class="valid_box">Database backup has been taken successfully.</div><?PHP } ?>      
    <h2 align="center"><i>Welcome to Webcam Admin Panel</i></h2>   
     
     
     
     </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->               
                    
                    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    
  <?php include("footer.php") ?>


