<?php
    require_once '../global/include.php';
	
    ini_set("display_errors", $DISPLAY_ERROR);
    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<link rel="stylesheet" href="../resources/css/madamiaStyle.css" type="text/css" />

<link rel="stylesheet" href="../resources/plugins/Carousel/Slides/examples/Linking/css/global.css">
	
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
<form action="" method="post" enctype="multipart/form-data"> 
<div class="fondoLigthBox">
    <table width="980px" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr >
            <td colspan ='2' valign="top"> 
              <div class="fondoTituloLigthBox">
                   <h3>Puntos de Venta</h3>
          		</div>
            </td>
          </tr>
          <tr >
          	<td  valign="top" >
            <br /><br /><br /><br />
            <div class="capaTituloMapa">
                   sasdasd<br />
                   asdsads<br />
                   asdasda
        	</div>
           
            <div class="capaFondoMapa">
                   
        	</div>
            </td>
            <td  valign="top" align="right">
                 <div class="capaMarcoPuntoVenta">
                  <p>&nbsp;</p>
                  <p>&nbsp;</p>   
        		</div>
            </td>
          </tr>
          
    </table>
</div>
</form>
</body>
</html>