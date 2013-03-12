<?php
    require_once '../global/include.php';
	
    ini_set("display_errors", $DISPLAY_ERROR);
    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<link rel="stylesheet" href="../resources/css/madamiaStyle.css" type="text/css" />

<link rel="stylesheet" href="../resources/plugins/Carousel/Slides/examples/Linking/css/global.css"/>
	
<script src="../resources/js/jquery-1.8.2.min.js"></script>
<script src="../resources/plugins/Carousel/Slides/examples/Linking/js/slides.min.jquery.js"></script>
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
                        generatePagination: true,
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
</script>
</head>
<body> 
<div class="fondoProductos">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
          <tr >
            <td valign="top"> 
                <?php

                
                if($_GET)
                {
                    $producto;
                    $seccion;
                    $isSeccion = false;
                    
                    $IdSeccion = $_GET["IdSeccion"];
                    
                    //Se selecciona la seccion pertienente
                    $seccion = DAOFactory::getSeccionDAO()->load($IdSeccion);
                    
                    if (isset ($_GET["IdProducto"])&&$_GET["IdProducto"]!=0)
                    {
                      $IdProducto = $_GET["IdProducto"];
                      
                      //Se obtienen el producto seleccionado
                      $producto = DAOFactory::getProductoDAO()->load($IdProducto);
                      
                      //Se aumenta en uno para contar la cantidad de visitas
                      $producto->populate = $producto->populate+1;
                      
                      //Se actuliza el producto
                      DAOFactory::getProductoDAO()->update($producto);
                    }
                    else
                    {
                        
                        //Se consultan todos los productos de la sección
                        $listaProdutos = DAOFactory::getProductoDAO()->queryByIdSeccion($IdSeccion);
                        
                        if($listaProdutos){    
                           //Se obtiene el primer producto por defecto
                           $producto = $listaProdutos[0];
                        
                           
                        }else{
                           //Se identifica que se va ha trabajar con la seccion
                           $isSeccion = true; 
                           
                        }
                        
                    }

                      
                 ?> 

                <div class="fondoTituloTortas">
                    <?php 
                    if($isSeccion)
                       echo "<div class='textoTitulo'>".Idioma($seccion->tituloEsp, $seccion->tituloEng)."</div>";  
                    else
                       echo "<div class='textoTitulo'>".Idioma($producto->nombreEsp, $producto->nombreIng)."</div>";
                    ?>
                </div>
                
                <div id="container">
                    <div id="example">
                        <div id="slides">
                            <div class="slides_container">
                                
                                    
                             <?php
                             
                             if(!$isSeccion)
                             {
				//Se obtiene el album del producto
                            	$album = DAOFactory::getAlbumDAO()->load($producto->idAlbum);
                                
                                //Se obtienen las fotos pertenecientes al album del Producto
                            	$fotos = DAOFactory::getFotoDAO()->queryByIdAlbun($album->id);
				
                                //Se recorren las fotos encontradas
                                for ($i=0;$i<count ($fotos);$i++)
                                {
                                        $tmpPathImg =$fotos[$i]->imagen;

                                        echo "<div class='slide'>";
                                        echo "<img  height='250px' height='250px'src='".$tmpPathImg."'/>";
                                        echo "</div>";
                                }
                             }                
                              
                             ?>

                              
                            </div>
                        </div>
                    </div>              
                </div>
                
                <div class="capaSeccionProductos">
           	    <img src="<?php echo $seccion->imagen;?>" width="200" height="200" />
                </div>
                
                <div class="capaTextoProductos">
                	<div class="textoDescripcionProducto">
                	
                <?php 
                   if(!$isSeccion) 
                    echo Idioma($producto->descripcionEsp, $producto->descripcionIng);
                 ?>
                 	</div> 
                </div>
                
                
                <?php
                    
                 }
                    
                 ?>
            </td>
          </tr>
    </table>
</div>

</body>
</html>