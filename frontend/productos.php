<?php
    require_once '../global/include.php';
	
    ini_set("display_errors", $DISPLAY_ERROR);
    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<link rel="stylesheet" href="../resources/css/madamiaStyle.css" type="text/css" />

<script type="text/javascript" src="../resources/plugins/Carousel/jquery.jcarousel/js/jquery-1.6.2.js"></script>
<script type="text/javascript" src="../resources/plugins/Carousel/jquery.jcarousel/js/jquery.jcarousel.js"></script>
<script type="text/javascript" src="../resources/plugins/Carousel/jquery.jcarousel/js/captify.tiny.js"></script>
<link rel="stylesheet" type="text/css" href="../resources/plugins/Carousel/jquery.jcarousel/css/tango/skin.css" />


<script type="text/javascript" >
	$(document).ready(function(){
	
			jQuery('#mycarousel').jcarousel({
              wrap: 'circular',
              visible: 4
            });
	});
	
	//Captify
	$(document).ready(function(){
		$('img.captify').captify({
		// all of these options are... optional
		// speed of the mouseover effect
		speedOver: 'fast',
		// speed of the mouseout effect
		speedOut: 'normal',
		// how long to delay the hiding of the caption after mouseout (ms)
		hideDelay: 500,
		// 'fade', 'slide', 'always-on'
		animation: 'slide',
		// text/html to be placed at the beginning of every caption
		prefix: '',
		// opacity of the caption on mouse over
		opacity: '0.7',
		// the name of the CSS class to apply to the caption box
		className: 'caption-bottom',
		// position of the caption (top or bottom)
		position: 'bottom',
		// caption span % of the image
		spanWidth: '100%'
		});
	});
	
</script>

</head>
<body> 
    <table width="975px"  border="0" cellpadding="0" cellspacing="0" align="center">
          <tr height="217px">
            <td valign="top">
            <div class="fondoCarrete">
            
            	<ul class="jcarousel-skin-tango" id="mycarousel">
                  <?php
                    
                    $IdSeccion =0;
                    $IdProducto=0;
                    
                    if($_GET)
                    {
                        if (isset ($_GET["IdSeccion"]))
                            $IdSeccion = $_GET["IdSeccion"];
                        
                        if (isset ($_GET["IdProducto"]))
                            $IdProducto = $_GET["IdProducto"];
                        
                        
                        
                        //Se obtienen los productos de la sección
                        $productos = DAOFactory::getProductoDAO()->queryByIdSeccion($IdSeccion);

                        if ($productos)
                        {
                            //Se hace un recorrido
                            for ($i = 0 ;$i<count($productos);$i++)
                            {
                                //Se obtiene el album del producto
                                $album = DAOFactory::getAlbumDAO()->load($productos[$i]->idAlbum);

                                //Se obtienen las fotos pertenecientes al album del Producto
                                $fotos = DAOFactory::getFotoDAO()->queryByIdAlbun($album->id);

                                $tmpPathImg =$fotos[0]->imagen;

                                $url = 'productosContain.php?IdProducto='.$productos[$i]->id."&IdSeccion=".$IdSeccion;

                                echo "<li>";
                                echo "<a href='".$url."' target='producto'>";
                                echo "<img width='120' height='120' src='".$tmpPathImg."' id='".$fotos[0]->id."' alt='".$productos[$i]->nombreEsp."' class='captify' />";
                                echo "</a>";

                                echo "</li>";
                            }
                        }
                        else
                        {
                            //Se realiza la busqueda de las Secciones Hijas
                            $seccionesHijas = DAOFactory::getSeccionDAO()->queryByIdPapa($IdSeccion);
                            
                            //Se hace un recorrido de las secciones hijas
                            for ($i = 0 ;$i<count($seccionesHijas);$i++)
                            {
                                $tmpPathImg =$seccionesHijas[$i]->imagen;

                                $url = 'productos.php?IdSeccion='.$seccionesHijas[$i]->id;

                                echo "<li>";
                                echo "<a href='".$url."' >";
                                echo "<img width='120' height='120' src='".$tmpPathImg."' id='".$seccionesHijas[$i]->id."' alt='".$seccionesHijas[$i]->nombre."' class='captify'/>";
                                echo "</a>";

                                echo "</li>";
                            }
                        }
                    }
                    
                    ?>

                    
                </ul>
            </div>


                         
	
             <div class="capaImagenSeccionProductos">
              <?php
                //Se selecciona la seccion pertienente
                $seccion = DAOFactory::getSeccionDAO()->load($IdSeccion);
              ?>
           	    <img src="<?php echo $seccion->imagen;?>" width="150" height="150" />
             </div>
                
            </td>
          </tr>
          <tr height="440px">
           <td valign="top"> 
	      <iframe name="producto" 
                      id="producto" 
                      height="440px" 
                      width="100%"  
                      frameborder="0" 
                      src="productosContain.php?IdSeccion=<?php echo $IdSeccion; ?>&IdProducto=<?php echo $IdProducto; ?>" >
                            
              </iframe>
            </td>
          </tr>
    </table>

</body>
</html>