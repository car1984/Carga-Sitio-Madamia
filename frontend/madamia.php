<?php
    require_once '../global/include.php';
	
    ini_set("display_errors", $DISPLAY_ERROR);
    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<link rel="stylesheet" href="../resources/css/madamiaStyle.css" type="text/css" />

<link rel="stylesheet" href="../resources/plugins/Carousel/Slides/examples/Linking/css/global.css" />
	
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
				hoverPause: true,
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
<?php
if($_GET)
{
    $IdSeccion ;
    $listaContenidos;
    $contenidos;
    $aMadamia;
    $aMision;
    $aVision;
    
    $contenido;
    
    if(isset ($_GET["IdSeccion"])){
        
        $IdSeccion = $_GET["IdSeccion"];

        $listaContenidos = DAOFactory::getListaContenidoDAO()->queryByIdSeccion($IdSeccion);
 
        $contenidos = DAOFactory::getContenidoDAO()->queryByIdLista($listaContenidos[0]->id);
        
        $contenido = $contenidos[0];
        
    }else if(isset ($_GET["IdContenido"])){
        
        $IdContenido = $_GET["IdContenido"];
        
        $contenido = DAOFactory::getContenidoDAO()->load($IdContenido);
        
        $contenidos =  DAOFactory::getContenidoDAO()->queryByIdLista($contenido->idLista);
    }
	
    $listaFotos = DAOFactory::getFotoDAO()->queryByIdAlbun($contenido->albumId); 

    $aMadamia = 'madamia.php?IdContenido='.$contenidos[0]->id;
    $aMision  = 'madamia.php?IdContenido='.$contenidos[1]->id;
    $aVision  = 'madamia.php?IdContenido='.$contenidos[2]->id;
?>


<div style = "	margin: 0;
                border: 0 none;
                padding: 0;
                background-image:url(<?PHP echo $listaFotos[0]->imagen; ?>);
                width:975px;
                height: 680px;
                float:none;
                top: 0px;"> 

    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
          <tr>
            <td valign="top" > 
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="540px" height="10px">&nbsp;</td>
    <td width="140px" height="10px" align="left">
        <a href="<?php echo $aMadamia; ?>">
     <img class="sm-img" src="../resources/img/LightBoxMadamia/PestaniaMadamia.png"/>
  	                   </a>
    </td>
    <td width="140px" height="10px" align="left">
        <a href="<?php echo $aMision; ?>">
          <img class="sm-img" src="../resources/img/LightBoxMadamia/PestaniaMision.png" />
        </a>
    </td>
    <td width="140px" height="10px" align="left">
        <a href="<?php echo $aVision; ?>">
         <img class="sm-img" src="../resources/img/LightBoxMadamia/PestaniaVision.png"/>
        </a>
    </td>
  </tr>
</table>

    			<div class="fondoTituloLigthBox">
                	<div class="textoTitulo">
                    Madamia
                    </div>
                </div>
                
                <div class="capaTituloMadamia">
            	<?php 
                  echo Idioma($contenido->nombreEsp, $contenido->nombreIng);
                 ?>
                </div>
                
          <div class="capaTextoMadamia">
                	<div class="textoDescripcion">
                	
                <?php 
                       
                    echo Idioma($contenido->contenidoEsp, $contenido->contenidoIng);
                 ?>
               	  </div> 
              </div>
                
                
               
            </td>
          </tr>
    </table>
<?php
}
?>
</div> 
</body>
</html>