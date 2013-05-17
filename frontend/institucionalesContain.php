<?php
    require_once '../global/include.php';
	
    ini_set("display_errors", $DISPLAY_ERROR);
        
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<link rel="stylesheet" href="../resources/css/madamiaStyle.css" type="text/css" />

<link rel="stylesheet" href="../resources/css/madamiaCarousel.css" type="text/css" />
	
<script src="../resources/js/jquery-1.8.2.min.js"></script>
	<script src="../resources/plugins/Carousel/Slides/examples/Linking/js/slides.min.jquery.js"></script>
    <script type="text/javascript" src="../resources/plugins/Carousel/jquery.jcarousel/js/jquery.jcarousel.js"></script>
<script type="text/javascript" src="../resources/plugins/Carousel/jquery.jcarousel/js/captify.tiny.js"></script>
<link rel="stylesheet" type="text/css" href="../resources/plugins/Carousel/jquery.jcarousel/css/tango/skinInstitucionales.css" />
	<script>
		$(function(){
			// Set starting slide to 1
			var startSlide = 1;
			// Get slide number if it exists
			if (window.location.hash) {
				startSlide = window.location.hash.replace('#','');
			}
			// Initialize Slides
			$('#slides_institucionalesContain').slides({
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
    
    <script type="text/javascript" >
	$(document).ready(function(){
	
			jQuery('#mycarousel').jcarousel({
              wrap: 'circular',
              visible: 3
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

<?php
	
	$urlTotas 		= "institucionalesContain.php";
	$urlRegalos 	= "institucionalesContain.php";
	$urlRefrigerios = "institucionalesContain.php";
?>

<div class="fondoLigthBox">

    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
          <tr>
            <td valign="top" > 
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="540px" height="10px">&nbsp;</td>
    <td width="140px" height="10px" align="left">
        <a href="<?php echo $urlTotas; ?>">
     <img class="sm-img" src="../resources/img/LigthBoxInstitucionales/PestaniaTortasInstitucionales.png" width='139px' height='38px'/>
              </a>
    </td>
    <td width="140px" height="10px" align="left">
        <a href="<?php echo $urlRegalos; ?>">
          <img class="sm-img" src="../resources/img/LigthBoxInstitucionales/PestaniaRegalosclientesColaboradores.png" width='139px' height='38px' />
        </a>
    </td>
    <td width="140px" height="10px" align="left">
        <a href="<?php echo $urlRefrigerios; ?>">
         <img class="sm-img" src="../resources/img/LigthBoxInstitucionales/PestaniaRefrigeriosPasabocas.png" width='139px' height='38px'/>
        </a>
    </td>
  </tr>
</table>
     		    <div class="fondoTituloLigthBox">
                
                    <div class="textoTitulo">
                        Instituciones
                    </div>
                </div>
                
                 <div class="inst_logoMadamiaContain">
                 
                 </div>
                 
 
                
   		       <div id="container_institucionalesContain">
                    <div id="slides_institucionalesContain">
                        <div class="slides_container">
                        
                        <div>
  <img src="../resources/img/LigthBoxInstitucionales/Principal.png"  height="570" />
                            
                        </div>
<?php
/*
                           $listaFotos = DAOFactory::getFotoDAO()->queryByIdAlbun($contenido->albumId);

                           for ($i=0;$i<count($listaFotos);$i++)
                           {

                               $tmpPathImg =$listaFotos[0]->imagen;

                               echo "<div >";
                               echo "<img  width='535px' height='535px' src='".$tmpPathImg."'/>";         
                               echo "</div>";


                           }
*/	   
                    ?>

                        </div>  
		   </div>
              </div>  
                
<div class="inst_capaTituloCategoria">
                 	<div class="inst_textoTituloCategoria">
                    
                    Titulo Prueba Categoria (imagen).
                    
                    </div>
                 
                 </div>
                 
                  <div class="inst_capaTitulo">
                 	<div class="inst_textoTitulo">
                    
                    Titulo Prueba Intitucional.
                    
                    </div>
                 
                 </div>
                 
				<div class="inst_capaNodedad">
                	<div class="inst_textoNovedad">
                 		Caja x 6 unidades
                    </div>
                </div>
                
              	<div class="inst_capaNodedadSombra">
                    <div class="inst_textoNovedad">
                 		Caja x 6 unidades
                    </div>
              </div>
                 
                 <div class="inst_capaCarrete">
                 <ul class="jcarousel-skin-tango" id="mycarousel">
                 	<li>
                    	<a href="institucionalesContain.php">
                    	<img height='100' src='../resources/img/LigthBoxInstitucionales/Principal.png' id='1' alt='nom_ima1' class='captify' />
                    	</a>
                        
                    </li>
                    <li>
                    	<a href="institucionalesContain.php">
                    	<img height='100' src='../resources/img/LigthBoxInstitucionales/Principal.png' id='1' alt='nom_ima1' class='captify' />
                    	</a>
                        
                    </li>
                    <li>
                    	<a href="institucionalesContain.php">
                    	<img height='100' src='../resources/img/LigthBoxInstitucionales/Principal.png' id='1' alt='nom_ima1' class='captify' />
                    	</a>
                        
                    </li>

                </ul>
               </div>
               
            </td>
          </tr>
    </table>

</div> 
</body>
</html>