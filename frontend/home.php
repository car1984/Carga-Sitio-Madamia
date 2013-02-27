<?php
    require_once '../global/include.php';
    
    ini_set("display_errors", $DISPLAY_ERROR);
    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>

<link rel="stylesheet" href="../resources/css/menu/style.css" type="text/css" />
<link rel="stylesheet" href="../resources/css/madamiaStyle.css" type="text/css" />

<link rel="stylesheet" href="../resources/plugins/Carousel/Slides/examples/Linking/css/carouselHome.css"/>
  <!-- Add jQuery library -->
<script type="text/javascript" src="../resources/plugins/Lightbox/fancybox/lib/jquery-1.8.2.min.js"></script>
   
<script src="../resources/plugins/TabSlideOut/tabSlideOut/js/jquery.tabSlideOut.v1.3.js" type="text/javascript"></script>

 
<!-- Add fancyBox main JS and CSS files -->
<script type="text/javascript" src="../resources/plugins/Lightbox/fancybox/source/jquery.fancybox.js"></script>
<link rel="stylesheet" type="text/css" href="../resources/plugins/Lightbox/fancybox/source/jquery.fancybox.css" media="screen" />
<script src="../resources/plugins/Carousel/Slides/examples/Linking/js/slides.min.jquery.js"></script>
<script src="../resources/plugins/Carousel/jcycle/jquery.cycle.all.js" ></script>
<script>
        $(function(){
                // Set starting slide to 1
                var startSlide = 1;
                // Get slide number if it exists
                if (window.location.hash) {
                        startSlide = window.location.hash.replace('#','');
                }
                // Initialize Slides
                $('#slides').slides({
                        preload: true,
                        preloadImage: 'img/loading.gif',
                        generatePagination: false,
                        play: 9000,
                        pause: 2500,
                        hoverPause: false,
                        // Get the starting slide
                        start: startSlide,
                        animationComplete: function(current){
                                // Set the slide number as a hash
                                window.location.hash = '#' + current;
                        }
                });
                
                   // Initialize Slides
                $('#slides_novedades').slides({
                        preload: true,
                        preloadImage: 'img/loading.gif',
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
            $('#slideshow1').cycle({
                        speed:    300,
                        timeout:  1000,
                        shuffle:  {left:-300, top:30},
                        clip:     'zoom',
                        fx:       'all',
                        before:   function(c,n,o) {$(o.caption).html(o.currFx);},
                        caption:  '#caption1'
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
			 imageHeight: '131px',                               //height of tab image
			 imageWidth: '39px',                               //width of tab image    
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
      <tr height="630px">
      <td valign="top" >    
	
    <div class="capaLogo">
    </div>
    
     <div id="slideshow1">
        <img src="http://cloud.github.com/downloads/malsup/cycle/beach1.jpg" width="200" height="200" />
        <img src="http://cloud.github.com/downloads/malsup/cycle/beach2.jpg" width="200" height="200" />
        <img src="http://cloud.github.com/downloads/malsup/cycle/beach3.jpg" width="200" height="200" />
     </div>

        <br />
				
     <div id="container">
        <div id="example">
            <div id="slides">
                <div class="slides_container">

                    <?php

                    //Se obtiene el album del producto
                    $album = DAOFactory::getAlbumDAO()->load($ALBUM_B_PRINCIPAL);

                    //Se obtienen las fotos pertenecientes al album del Producto
                    $fotos = DAOFactory::getFotoDAO()->queryByIdAlbun($album->id);

                    //Se recorren las fotos encontradas
                    for ($i=0;$i<count ($fotos);$i++)
                    {
                            $tmpPathImg =$fotos[$i]->imagen;

                            echo "<div class='slide'>";
                            echo "<img  height='600px' height='600px'src='".$tmpPathImg."'/>";
                            echo "</div>";
                    }

                    ?>    


                </div>
            </div>
        </div>              
     </div>
              
       <div id="container_novedades">
            <div id="slides_novedades">
                <div class="slides_container">
                    <?php
				
                           $listaProdutos = DAOFactory::getProductoDAO()->queryByTop10(1);

                           for ($i=0;$i<count($listaProdutos);$i++)
                           {
                               //Se obtiene el album del producto
                               $albumProducto = DAOFactory::getAlbumDAO()->load($listaProdutos[$i]->idAlbum);

                               //Se obtienen las fotos pertenecientes al album del Producto
                               $listaFotos = DAOFactory::getFotoDAO()->queryByIdAlbun($albumProducto->id);

                               $tmpPathImg =$listaFotos[0]->imagen;

                               echo "<div >";

                               echo "<a class='fancybox fancybox.iframe' href='productos.php?IdSeccion=".$listaProdutos[$i]->idSeccion."&IdProducto=".$listaProdutos[$i]->id."' >";
                               echo "<img  height='250px' height='250px'src='".$tmpPathImg."'/>";
                               echo "</a>";
                              
                               echo "</div>";


                           }

                   ?>
                </div>
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
                <td><img src="../resources/img/Home/Ingreso.png" /></td>
              </tr>
            </table>	 	
        </div>

         
            
            <div class="slide-out-registrese">
             
                <a class="handleRegistrese" href="http://link-for-non-js-users">Content</a>
                <br />Registro
                
     	   </div>
			
      
        </td>
      </tr>
      <tr>
      <td valign="top"> 
		<div class="fondoPie">
		</div>
        
        </td>
      </tr>
    </table>
  </div>
</body>
</html>
   