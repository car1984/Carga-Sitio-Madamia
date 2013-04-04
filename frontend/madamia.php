<?php
    require_once '../global/include.php';
	
    ini_set("display_errors", $DISPLAY_ERROR);
    
    $urlTituloMI = "../resources/img/LightBoxMadamia/FondoTituloMision.png";
    $urlTituloMA = "../resources/img/LightBoxMadamia/FondoTituloMadamia.png";
    $urlTituloVI = "../resources/img/LightBoxMadamia/FondoTituloVision.png";
    
    $urlFondoMI = "../resources/img/LightBoxMadamia/FondoMision.png";
    $urlFondoMA = "../resources/img/LightBoxMadamia/FondoMadamia.png";
    $urlFondoVI = "../resources/img/LightBoxMadamia/FondoVision.png";
    
    $urlFondo  = $urlFondoMA;
    $urlTitulo = $urlTituloMA;
    
    if (isset ($_GET["token"]))
    {
        if ($_GET["token"]=="MI"){
           $urlFondo  = $urlFondoMI;
           $urlTitulo = $urlTituloMI;
        }
        else if ($_GET["token"]=="VI"){
           $urlFondo  = $urlFondoVI;
           $urlTitulo = $urlTituloVI;
        }
        else {
           $urlFondo  = $urlFondoMA;
           $urlTitulo = $urlTituloMA;
        }
    }
    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<link rel="stylesheet" href="../resources/css/madamiaStyle.css" type="text/css" />

<link rel="stylesheet" href="../resources/css/madamiaCarousel.css" type="text/css" />
	
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
			$('#slides_madamia').slides({
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

    $aMadamia = 'madamia.php?IdContenido='.$contenidos[0]->id.'&token=MA';
    $aMision  = 'madamia.php?IdContenido='.$contenidos[1]->id.'&token=MI';
    $aVision  = 'madamia.php?IdContenido='.$contenidos[2]->id.'&token=VI';
?>


<div style = "	margin: 0;
                border: 0 none;
                padding: 0;
                background-image:url(<?PHP echo $urlFondo;?>);
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
            <div style="
                margin: 0;
                border: 0 none;
                padding: 0;
                background-image:url(<?PHP echo $urlTitulo; ?>);
                width:195px;
                height: 44px;
                float:none;
                top: 0px;">
                
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
              
               <div id="container_madamia">
                    <div id="slides_madamia">
                        <div class="slides_container">

                    <?php

                           $listaFotos = DAOFactory::getFotoDAO()->queryByIdAlbun($contenido->albumId);

                           for ($i=0;$i<count($listaFotos);$i++)
                           {

                               $tmpPathImg =$listaFotos[0]->imagen;

                               echo "<div >";
                               echo "<img  width='535px' height='535px' src='".$tmpPathImg."'/>";         
                               echo "</div>";


                           }
						   
                    ?>

                        </div>  
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