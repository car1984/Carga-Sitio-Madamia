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
    <table width="940px" border="0" cellpadding="0" cellspacing="0" align="center">
          <tr >
            <td colspan ='3' valign="top"> 
              <div class="fondoTituloLigthBox">
                   <div class='textoTitulo'> Contactenos </div>
          		</div>
                <br />
                <br />
                <br />
            </td>
          </tr>
          <tr>
            <td width="215px" > 
              <h4> Nombre</h4>
            </td>
            <td width="215px" > 
              <input type="text" class="txtContactenos" name="txtNombre" />
            </td>
            <td width="510" rowspan="8" align="right">
              <textarea id="txtarea" name="txtarea" rows="22" cols="40"  onblur="if(this.value=='') this.value='Escribanos su mensaje...';" onFocus="if(this.value=='Escribanos su mensaje...') this.value='';">Escribanos su mensaje...</textarea></td>
          <tr>
            <td > 
              <h4>Apellido</h4>
            </td>
            <td > 
              <input type="text" class="txtContactenos" name="txtApellido" />
            </td>
           <tr>
            <td > 
              <h4>Ciudad</h4>
            </td>
            <td > 
              <input type="text" class="txtContactenos" name="txtCiudad" />
            </td>
           <tr>
            <td > 
              <h4>Direccion</h4>
            </td>
            <td > 
              <input type="text" class="txtContactenos" name="txtDireccion" />
            </td>
          </tr>
          <tr>
            <td > 
              <h4>E-mail</h4>
            </td>
            <td > 
              <input type="text" class="txtContactenos" name="txtEmail" />
            </td>
          </tr>
          <tr>
            <td > 
              <h4>Telefono</h4>
            </td>
            <td > 
              <input type="text" class="txtContactenos" name="txtTelefono" />
            </td>
          </tr>
          <tr>
            <td colspan ='2'><h4>Fecha de Cumpleaños</h4></td>
          </tr>
          <tr>
            <td colspan ='2' align="center" valign="top">
              <input type="text" class="txtFecha" name="txtDia" />
              <img src="../resources/img/LightBoxContactenos/Flecha-de-Multiseleccion.png" width="21" height="24" />
<input type="text" class="txtFecha" name="txtMes" />
       <img src="../resources/img/LightBoxContactenos/Flecha-de-Multiseleccion.png" width="21" height="24" />
              <input type="text" class="txtFecha" name="txtAnio" />
                     <img src="../resources/img/LightBoxContactenos/Flecha-de-Multiseleccion.png" width="21" height="24" />
            </td>
          </tr>
          <tr >
            <td colspan ='3' valign="top" align="right"> 
              <br />
                <input type="submit" class="botonContactenos" value="" title="" />   
            </td>
          </tr>
    </table>
</div>
</form>
</body>
</html>