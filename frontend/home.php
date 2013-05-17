<?php
    require_once '../global/include.php';
    
    ini_set("display_errors", $DISPLAY_ERROR);
	
	if($_POST)
	{
            if(isset($_POST['BtnGuardar']))
            {
                $objRegistro = new Registro(); 
                
                $objRegistro->nombre    = $_POST['txtNombre'];
                $objRegistro->apellido  = $_POST['txtApellido'];
                $objRegistro->cedula    = $_POST['txtCedula'];
                $objRegistro->email     = $_POST['txtEmail'];
                $objRegistro->telefono  = $_POST['txtTelefono'];
                $objRegistro->dia       = $_POST['txtDia'];
                $objRegistro->mes       = $_POST['txtMes'];
                $objRegistro->ano       = $_POST['txtAnio'];
                
                DAOFactory::getRegistroDAO()->insert($objRegistro);
            }
	}
    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>


<!-- Estilos Madamia -->
<link rel="stylesheet" type="text/css" href="../resources/css/madamiaMenu.css" />
<link rel="stylesheet" type="text/css" href="../resources/css/madamiaStyle.css" />
<link rel="stylesheet" href="../resources/css/madamiaCarousel.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="../resources/plugins/Treeview/jquery.treeview/jquery.treeview.css" />
<link rel="stylesheet" type="text/css" href="../resources/plugins/Lightbox/fancybox/source/jquery.fancybox.css" media="screen" />
 
<!-- jQuery library -->
<script type="text/javascript" src="../resources/plugins/Lightbox/fancybox/lib/jquery-1.8.2.min.js"></script>

<!-- jQuery FancyBox main -->
<script type="text/javascript" src="../resources/plugins/Lightbox/fancybox/source/jquery.fancybox.js" ></script>

<!-- jQuery Slides -->
<script type="text/javascript" src="../resources/plugins/Carousel/Slides/examples/Linking/js/slides.min.jquery.js" ></script>

<!-- jQuery Slides Min-->
<script type="text/javascript" src="../resources/js/jquery.slides.min.js" ></script>

<!-- jQuery Cycle -->
<script type="text/javascript" src="../resources/plugins/Carousel/jcycle/jquery.cycle.all.js"></script>

<!-- jQuery TabSlideOut -->
<script src="../resources/plugins/TabSlideOut/tabSlideOut/js/jquery.tabSlideOut.v1.3.js" ></script>

<!-- jQuery TreeView -->
<script type="text/javascript" src="../resources/plugins/Treeview/jquery.treeview/lib/jquery.cookie.js" ></script>
<script type="text/javascript" src="../resources/plugins/Treeview/jquery.treeview/jquery.treeview.js" ></script>
<script type="text/javascript" src="../resources/plugins/Treeview/jquery.treeview/demo/demo.js" ></script>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<script>
        $(function(){
                // Set starting slide to 1
                var startSlide = 1;
                // Get slide number if it exists
                if (window.location.hash) {
                        startSlide = window.location.hash.replace('#','');
                }
                // Initialize Slides
                $('#slides_productos').slidesjs({
						generateNextPrev: false,
						width: 250,
        				height: 250,
						play: {
						  active: true,
						  auto: true,
						  interval: 30000,
						  swap: true
						},
						pagination: {
						  active: false,
							// [boolean] Create pagination items.
							// You cannot use your own pagination. Sorry.
						  effect: "slide"
							// [string] Can be either "slide" or "fade".
    					}
                });
                
                   // Initialize Slides
                $('#slides_novedades').slides({
                        preload: true,
                        preloadImage: '../resources/img/General/loading.gif',
                        generatePagination: false,
                        play: 5000,
                        pause: 2500,
                        hoverPause: false,
                        // Get the starting slide
                        start: startSlide,
                        animationComplete: function(current){
                                // Set the slide number as a hash
                                window.location.hash = '#' + current;
                        }
                });
                
  
                
                
        });
        
        $(document).ready(function() {
			 $('#slides_ninios').cycle({
                        fx:    'zoom', 
                        sync:  false, 
                        delay: -2000,
						speed: 400,
						timeout: 4000  
    					 
            });
			

        });

</script>
 
<script>
	
	$(document).ready(function(){	
	
		 $('.fancybox').fancybox({
                    "padding": 2,
                    "width": 1000,
                    "height": 700,
                    "autoScale": false,
                    "transitionIn": "elastic",
                    "transitionOut": "none", 
                    "type": "iframe"});
	
		 
		  $('.slide-out-registrese').tabSlideOut({
			 tabHandle: '.handleRegistrese',                              //class of the element that will be your tab
			 pathToTabImage: '../resources/img/Home/PestaniaRegistrese.png',          //path to the image for the tab (optionaly can be set using css)
			 imageHeight: '150px',                               //height of tab image
			 imageWidth: '41px',                               //width of tab image    
			 tabLocation: 'right',                               //side of screen where tab lives, top, right, bottom, or left
			 speed: 300,                                        //speed of animation
			 action: 'click',                                   //options: 'click' or 'hover', action to trigger animation
			 topPos: '160px',                                   //position from the top
			 
			 fixedPosition: false                               //options: true makes it stick(fixed position) on scroll
		 });
		 		 		 
	 });
	 

 </script>  
  
</head>
<body bgcolor="#FFFFFF"> 
  <div class="fondoPrincipal">
<table width="1024px" border="0" cellpadding="0" cellspacing="0" align="center">
      <tr>
        <td valign="top" >

            <ul id="menu">
	   <?php
           
            displayMenu($RAIZ_MENU);
            
           ?>
            </ul>

 
        </td>
      </tr>
      <tr height="627px">
      <td valign="top" >    
	
    <div class="capaLogo">
    </div>
    <div class="logoMadamia">
    </div>
    
     <div id="container_productos">
         <div id="slides_productos">
          	<div class="slides_container">
           <?php

               //Se obtienen las fotos pertenecientes al album del Productos
               $fotosBannerP = DAOFactory::getFotoDAO()->queryByIdAlbun($ALBUM_B_PRODUCTOS);
			   
               //Se recorren las fotos encontradas
                for ($i=0;$i<count ($fotosBannerP);$i++){
					
					$var_aux = $i+1;
					$class_name = "mianimacion".$var_aux;
					 
                    echo "<div >";
                    //Se coloca las imagenes que contenga el Album
                    echo "<img  height='250px' src='" . $fotosBannerP[$i]->imagen . "' class='".$class_name."'/>";

                    echo "</div >";
                }
                ?>
           </div>
         </div>
     </div>

				
     <div id="container_ninios">
         <div id="slides_ninios">

                    <?php

                    //Se obtiene el album del producto
                    $album = DAOFactory::getAlbumDAO()->load($ALBUM_B_PRINCIPAL);

                    //Se obtienen las fotos pertenecientes al album del Producto
                    $fotos = DAOFactory::getFotoDAO()->queryByIdAlbun($album->id);

                    //Se recorren las fotos encontradas
                    for ($i=0;$i<count ($fotos);$i++)
                    {
                            $tmpPathImg =$fotos[$i]->imagen;
                            echo "<img  height='500px' height='500px'src='".$tmpPathImg."'/>";
                    }

                    ?>    


          </div>
        
     </div>
          
        <div id="container_novedades">
            <div id="slides_novedades">
                <div class="slides_container">
                    <?php
				
              //Se obtienen las fotos pertenecientes al album del Productos
               $fotosBannerN = DAOFactory::getFotoDAO()->queryByIdAlbun($ALBUM_B_NOVEDADES);

                           for ($i=0;$i<count($fotosBannerN);$i++)
                           {


                               $tmpPathImg =$fotosBannerN[$i]->imagen;

                               echo "<div >";

                               echo "<img  height='250px' height='250px' src='".$tmpPathImg."'/>";

                              
                               echo "</div>";


                           }

                   ?>
                </div>
            </div>
       </div>
          
       
           <div class="capaRedesSociales">

               <?php
                   $urlFacebook = DAOFactory::getLinkDAO()->load($LINK_FACEBOOK);
                   $urlTwitter  = DAOFactory::getLinkDAO()->load($LINK_TWITTER);
                ?>
                <div class="social_nav">
          
                    <ul class="sm-icons">
            
                        <li class="social">
                            <a href="<?php echo $urlFacebook->link;?>" target="_blank">
                		<img class="sm-img" src="../resources/img/Home/LogoFacebook.png" alt="facebook"/>
  	                   </a>
                	</li>
                
                        <li class="social">

                           <a href="<?php echo $urlTwitter->link;?>" target="_blank">
                                <img src="../resources/img/Home/LogoTwiter.png" alt="twitter"/>
                           </a>
                       </li>
                        
                    </ul>
              
          	</div>
            
	  </div>   

 		<div class="capaBuscador">
          <form action="../admin/index.php" method="post" enctype="multipart/form-data"> 
            <table border="0" cellpadding="0" cellspacing="0">
              <tr valign="middle" align="center">
                <td>
                <img src="../resources/img/Home/CarritoCompras.png" />
                
                </td>
                <td>
                <img src="../resources/img/Home/ingresoTexto.png" />
                </td>
                <td>
                   <input type="text" class="txtIngreso" name="txtTelefono" />
                </td>
                <td>
                 <input type="submit" name='btnIngreso' class="botonIngreso" value="" title="" /> 
                </td>
                <td>
                </td>
              </tr>
            </table>
            </form>	 	
        </div>

        <div class="capaTituloNovedades">
        <img src="../resources/img/Home/TituloNovedades.png" width="175" height="63" />
        </div>
            
        <div class="slide-out-registrese">
<div class="formRegistrese">
              <form action="" method="post" enctype="multipart/form-data"> 
                <a class="handleRegistrese" href="http://link-for-non-js-users">Content</a>
                <br />
                <table border="0" cellspacing="0">
                  <tr>
                    <td width="52">Nombre</td>
                    <td width="129">
                    <input type="text"  class="txtIngreso" name="txtNombre" />
                    </td>
                  </tr>
                  <tr>
                    <td><br /> Apellido</td>
                    <td>
                       <br /><input type="text" class="txtIngreso"  name="txtApellido" />
                    </td>
                  </tr>
                  <tr>
                    <td><br />Cedula</td>
                    <td>
                      <br /><input type="text" class="txtIngreso" name="txtCedula" />
                    </td>
                  </tr>
                  <tr>
                    <td><br />E-Mail</td>
                    <td>
                    <br /><input type="text"  class="txtIngreso" name="txtEmail" />
                    </td>
                  </tr>
                  <tr>
                    <td><br />Telefono</td>
                    <td>
                    <br /><input type="text"  class="txtIngreso" name="txtTelefono" />
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2"><br />Fecha de Cumpleaños</td>
                  </tr>
                  <tr>
                    <td colspan="2" align="center" valign="top">

                     <div id="contenedorFlecha">
                     	<div style="float:left">
                     	<input type="text" class="txtFecha" name="txtDia" /></div>
						<div class="flecha"></div>
                        <div style="float:left">
						<input type="text" class="txtFecha" name="txtMes" /></div>
						<div class="flecha"></div>
                        <div style="float:left">
              			<input type="text" class="txtFecha" name="txtAnio" /></div>
                     <div class="flecha"></div>
                  
                  </div>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" valign="top" align="right">
                     <input type="submit" name='BtnGuardar' class="botonContactenos" value="" title="" />   
                    </td>
                  </tr>
                </table>
                
                </form>
                </div>
     	   </div>
			
      
        </td>
      </tr>
      <tr>
      <td valign="top" height="127px" > 
		<div class="fondoPie">
        	<div class="contenidoPie">
            	<div class="textoPie">
            	Telefono: (57+1) 671-25 50 
            	</div>
            	<div class="textoPie">
            	Bogotá, Colombia
                </div>
                <div class="textoPie">
           		<a href="mailto:info@madamia.com">  E-Mail: info@madamia.com</a>
                </div>

           </div>
            
         </div>
		
        
        </td>
      </tr>
    </table>
  </div>

</body>
</html>
   