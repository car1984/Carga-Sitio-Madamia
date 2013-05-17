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
	<script>
		$(function(){
			// Set starting slide to 1
			var startSlide = 1;
			// Get slide number if it exists
			if (window.location.hash) {
				startSlide = window.location.hash.replace('#','');
			}
			// Initialize Slides
			$('#slides_institucionales').slides({
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
                
                 <div class="inst_logoMadamiaHome">
                 
                 </div>
                 
              <div class="inst_capatextoHome">
                 	<div class="inst_textoHome">
                    
                    Nuestra Linea Institucional busca satisfacer las necesidades de su compañia en refrigerios, pasabocas, fechas epeciales, cumpleaños, aniversario de sus colaboradores y clientes.
                    
                    </div>
                 
                 </div>
                 
                
   		       <div id="container_institucionales">
                    <div id="slides_institucionales">
                        <div class="slides_container">
                        
                        <div>
  <img src="../resources/img/LigthBoxInstitucionales/Principal.png" width="465" height="595" />
                            
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
                
               
            </td>
          </tr>
    </table>

</div> 
</body>
</html>