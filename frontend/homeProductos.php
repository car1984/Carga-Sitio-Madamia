<?php
    require_once '../global/include.php';
	
    ini_set("display_errors", $DISPLAY_ERROR);
    
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<link rel="stylesheet" href="../resources/css/menu/style.css" type="text/css" />
<link rel="stylesheet" href="../resources/css/madamiaStyle.css" type="text/css" />

<link rel="stylesheet" href="../resources/plugins/Treeview/jquery.treeview/jquery.treeview.css" />
 

  <!-- Add jQuery library -->
<script type="text/javascript" src="../resources/plugins/Lightbox/fancybox/lib/jquery-1.8.2.min.js"></script>

	<script src="../resources/plugins/Treeview/jquery.treeview/lib/jquery.cookie.js" type="text/javascript"></script>
	<script src="../resources/plugins/Treeview/jquery.treeview/jquery.treeview.js" type="text/javascript"></script>
    
    <script type="text/javascript" src="../resources/plugins/Treeview/jquery.treeview/demo/demo.js"></script>
    


<!-- Add fancyBox main JS and CSS files -->
<script type="text/javascript" src="../resources/plugins/Lightbox/fancybox/source/jquery.fancybox.js"></script>
<link rel="stylesheet" type="text/css" href="../resources/plugins/Lightbox/fancybox/source/jquery.fancybox.css" media="screen" />
  
  <script>
	
	$(document).ready(function(){	
	
		 $('.fancybox').fancybox({"padding": 2,
			 		"width": 1000,
                    "height": 700,
                    "autoScale": false,
                    "transitionIn": "elastic",
                    "transitionOut": "none", 
                    "type": "iframe"});	 		 
		 
	 });
	 

 </script>  
</head>
<body> 

<table width="1024" border="0" cellpadding="0" cellspacing="0" align="center">
      <tr>
        <td valign="top">
        
            <ul id="menu">
                            
            <?php
           
                displayMenu($RAIZ_MENU);
            
            ?>
          
            </ul>
            
        </td>
      </tr>
      <tr>
      <td valign="top">    
	  <div class="fondoPrincipal">
        
<div class="fondoNinia">
				
            <div class="logoMadamia">
        	</div>
            
            
       	  <div class="marcoAzul">   
        	</div>
        
           
           <div class="capaTreeProductos">
              <div class="treeProductos">
       				
                    <ul id="navigation">
		
                    <?php
           
                    if($_GET)
                    {
                        $IdSeccion = $_GET["IdSeccion"];
                        displayMenu($IdSeccion);
                                               
                    }
            
                     ?>
                    </ul>   	
    
    	      </div>
            </div>
              
           <div class="capaRedesSociales">

				<div class="social_nav">
          
            		<ul class="sm-icons">
            
               		 <li class="social">
                		<a href="http://www.facebook.com/" target="_blank">
                		<img class="sm-img" src="../resources/img/Home/LogoFacebook.png" alt="facebook"/>
  	                   </a>
                	 </li>
                
                    <li class="social">
                       <a href="http://www.twiter.com/" target="_blank">
          		  <img src="../resources/img/Home/LogoTwiter.png" alt="twitter"/>
              	       </a>
                   </li>
              </ul>
              
          	</div>
            
		</div>   

 		<div class="capaBuscador">
            <table border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td><img src="../resources/img/Home/CarritoCompras.png" /></td>
                <td><img src="../resources/img/Home/Ingreso.png"/> ></td>
              </tr>
            </table>	 	
        </div>
        
			
        </div>
        </div>
        </td>
      </tr>
      <td valign="top"> 
		<div class="fondoPie">
		</div>
        
        </td>
      </tr>
    </table>

</body>
</html>