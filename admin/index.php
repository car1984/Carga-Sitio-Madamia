<?php
    require_once '../global/include.php';
    
    ini_set("display_errors", $DISPLAY_ERROR);
    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>

    <title>.:: Madamia Admin::.</title>

<link rel="stylesheet" href="../resources/css/menu/style.css" type="text/css" />
<link rel="stylesheet" href="../resources/css/madamiaStyle.css" type="text/css" />

  <!-- Add jQuery library -->
<script type="text/javascript" src="../resources/plugins/Lightbox/fancybox/lib/jquery-1.8.2.min.js"></script>
   
<script src="../resources/plugins/TabSlideOut/tabSlideOut/js/jquery.tabSlideOut.v1.3.js" type="text/javascript"></script>

 
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

<table width="1024px" height="600px" border="0" cellpadding="0" cellspacing="0" align="center">
      <tr>
        <td valign="top" height="20px">
            
            <ul id="menu">
                <li><a target='adminContain' href="productos.php?idTipoProducto=1&execute=open">Productos</a></li>
                <li><a target='adminContain' href="productos.php?idTipoProducto=2&execute=open">Institucionales</a></li>
                <li><a target='adminContain' href="productos.php?idTipoProducto=3&execute=open">Especiales</a></li>
                <li><a target='adminContain' href="puntosVenta.php">Puntos Venta</a></li>
                <li><a target='adminContain' href="puntosVenta.php">Madamia</a></li>
            </ul>
 
        </td>
      </tr>
      <tr>
        <td valign="top" height="560px">    
         <iframe name="adminContain" 
                      id="producto" 
                      height="560px" 
                      width="100%"  
                      frameborder="0" 
                      src="productos.php?idTipoProducto=1&execute=open">
                            
              </iframe>
	
       </td>
      </tr>
      <td valign="top" height="20px"> 
		<div class="fondoPie">
		</div>
        
        </td>
      
    </table>

</body>
</html>
   