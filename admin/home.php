<?php

require_once '../global/include.php';
require_once('funciones.php');	

ini_set("display_errors", $DISPLAY_ERROR);


if ( !isset($_SESSION['username']) && !isset($_SESSION['userid']) )
{
    header('Location: ./');
}
    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>

    <title>.:: Madamia Admin::.</title>

<link rel="stylesheet" href="../resources/css/madamiaMenu.css" type="text/css" />
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
<body background="../resources/img/Home/FondoLaterales.png">

<table width="1024px" height="600px" border="0" cellpadding="0" cellspacing="0" align="center">
      <tr>
        <td valign="top" height="20px">
            
            <ul id="menu">
                <li>
                    <a target='adminContain' href='Contenido.php?idListaContenido=3&execute=open'>Inicio</a>
                    <ul>
                      <li><a target='adminContain' href="Contenido.php?idListaContenido=3&execute=open">Banner Principal</a></li>  
                      <li><a target='adminContain' href="Registro.php?execute=open">Registros</a></li>
                    </ul>
                </li>
                <li>
                    <a target='adminContain' href="productos.php?IdTipoProducto=1&IdSeccion=5&execute=open">Productos</a>
                    <ul>
                    <?php
                      displayMenuAdmin(5,1,false);
                    ?>
                    </ul>
                </li>
                <li>
                    <a target='adminContain' href="productos.php?IdTipoProducto=2&IdSeccion=6&execute=open">Institucionales</a>
                    <ul>
                    <?php
                      displayMenuAdmin(6,2,false);
                    ?>
                    </ul>
                </li>
                <li>
                    <a target='adminContain' href="productos.php?IdTipoProducto=3&IdSeccion=7&execute=open">Especiales</a>
                    <ul>
                    <?php
                      displayMenuAdmin(7,3,false);
                    ?>
                    </ul>
                </li>
                <li><a target='adminContain' href="Contenido.php?idListaContenido=2&execute=open">Puntos Venta</a></li>
                <li><a target='adminContain' href="Contenido.php?idListaContenido=1&execute=open">Madamia</a></li>
                <li><a href="#">Administraci&oacute;n</a>
                    <ul>
                      <li><a target='adminContain' href="usuarios.php?execute=open">Usuarios</a></li>
                      <li><a target='adminContain' href="links.php?execute=open">Links</a></li>
                    </ul>
                </li>
                <li><a href="logout.php">Salir</a></li>
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
                      src="Contenido.php?idListaContenido=3&execute=open">
                            
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
   