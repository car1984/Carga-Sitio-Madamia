<?php
    require_once '../global/include.php';

    //Importamos la función PHP class.phpmailer
    require("../resources/plugins/PHPMailer/class.phpmailer.php");
    
    //Para visualizar errores
    ini_set("display_errors", $DISPLAY_ERROR);
    
     if ($_POST) {
    
        if ($_POST['action'] == "send") {
            
            $body_mail ="<table  border='0' cellpadding='0' cellspacing='0' align='center'>";
            $body_mail.="<tr >";
            $body_mail.="<td colspan ='4' valign='top'>";
            $body_mail.="<div class='textoTitulo'>Trabaje con Nosotros</div>";
            $body_mail.="</div>";
            $body_mail.="<br />";
            $body_mail.="</td>";
            $body_mail.="</tr>";
            $body_mail.="<tr>";
            $body_mail.="<td width='241' >";
            $body_mail.="<div class ='textoformulario' > Nombre</div>";
            $body_mail.="</td>";
            $body_mail.="<td width='229' >".$_POST['txtNombre']."</td>";
            $body_mail.="<td width='229' ><div class ='textoformulario' >Experiencia</div></td>";
            $body_mail.="<td width='229' ></td>";
            $body_mail.="<tr>";
            $body_mail.="<td >";
            $body_mail.="<div class ='textoformulario' >Edad</div>";
            $body_mail.="</td>";
            $body_mail.="<td >".$_POST['txtEdad']."</td>";
            $body_mail.="<td ><div class ='textoformulario' >Tiempo</div></td>";
            $body_mail.="<td >".$_POST['txtTiempo']."</td>";
            $body_mail.="<tr>";
            $body_mail.="<td >";
            $body_mail.="<div class ='textoformulario' >Fecha deNacto</div>";
            $body_mail.="</td>";
            $body_mail.="<td >";
            $body_mail.=$_POST['txtDia']."/";
            $body_mail.=$_POST['txtMes']."/";
            $body_mail.=$_POST['txtAno'];
            $body_mail.="</td>";
            $body_mail.="<td ><div class ='textoformulario' >Empresa</div></td>";
            $body_mail.="<td >".$_POST['txtEmpresa']."</td>";
            $body_mail.="<tr>";
            $body_mail.="<td >";
            $body_mail.="<div class ='textoformulario' >Cedula</div>";
            $body_mail.="</td>";
            $body_mail.="<td >".$_POST['txtCedula']."</td>";
            $body_mail.="<td ><div class ='textoformulario' >Cargo</div></td>";
            $body_mail.="<td >".$_POST['txtCargo']."</td>";
            $body_mail.="</tr>";
            $body_mail.="<tr>";
            $body_mail.="<td >";
            $body_mail.="<div class ='textoformulario' >Dirección</div>";
            $body_mail.="</td>";
            $body_mail.="<td >".$_POST['txtDir']."</td>";
            $body_mail.="<td ><div class ='textoformulario' >Permanencia</div></td>";
            $body_mail.="<td >".$_POST['txtPermanencia']."</td>";
            $body_mail.="</tr>";
            $body_mail.="<tr>";
            $body_mail.="<td ><div class ='textoformulario' >Telefono</div></td>";
            $body_mail.="<td >".$_POST['txtTel']."</td>";
            $body_mail.="<td ><div class ='textoformulario' >Motivo Retiro</div></td>";
            $body_mail.="<td >".$_POST['txtRetiro']."</td>";
            $body_mail.="</tr>";
            $body_mail.="<tr>";
            $body_mail.="<td ><div class ='textoformulario' >Ceular</div></td>";
            $body_mail.="<td >".$_POST['txtCel']."</td>";
            $body_mail.="<td >&nbsp;</td>";
            $body_mail.="<td >&nbsp;</td>";
            $body_mail.="</tr>";
            $body_mail.="<tr>";
            $body_mail.="<td ><div class ='textoformulario' >Nivel Educativo</div></td>";
            $body_mail.="<td >".$_POST['txtEdu']."</td>";
            $body_mail.="<td >&nbsp;</td>";
            $body_mail.="<td >&nbsp;</td>";
            $body_mail.="</tr>";
            $body_mail.="<tr>";
            $body_mail.="<td ><div class='textoformulario'>Foto</div></td>";
            $body_mail.="<td >".$_POST['txtFoto']."</td>";
            $body_mail.="<td >&nbsp;</td>";
            $body_mail.="<td >&nbsp;</td>";
            $body_mail.="</tr>";
            $body_mail.="</table>";
            
            $mail = new PHPMailer();

            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "ssl";
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 465;
            $mail->Username = "car1984@gmail.com";
            $mail->Password = "xz840205";
            $mail->From = "no-reply@web.com";
            $mail->FromName = "Madamia";
            $mail->Subject = "Trabaje con Nosotros";
            $mail->AltBody = "TEST";
            $mail->MsgHTML('CORREO');
        
            $mail->AddAddress("car1984@gmail.com");
            $mail->Body = $body_mail;
            $mail->IsHTML(true);
            
            if (!$mail->Send()) {
                echo "Error: " . $mail->ErrorInfo;
            }
            
            echo "Mail enviado....";


        }
     }
    
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
    <table width="960px"  border="0" cellpadding="0" cellspacing="0" align="center">
          <tr >
            <td colspan ='4' valign="top"> 
              <div class="fondoTituloLigthBox">
                   <div class='textoTitulo'>Trabaje con Nosotros</div>
          		</div>
                <br /><br />
            </td>
          </tr>
          <tr>
            <td width="241" > 
              <div class ="textoformulario" > Nombre</div>
            </td>
            <td width="229" ><input type="text" class="txtContactenos" name="txtNombre" /></td>
            <td width="229" ><div class ="textoformulario" >Experiencia</div></td>
            <td width="229" ></td>
          <tr>
            <td > 
              <div class ="textoformulario" >Edad</div>
            </td>
            <td ><input type="text" class="txtFechas" name="txtEdad" /></td>
            <td ><div class ="textoformulario" >Tiempo</div></td>
            <td ><input type="text" class="txtContactenos" name="txtTiempo" /></td>
           <tr>
            <td > 
              <div class ="textoformulario" >Fecha deNacto</div>
            </td>
            <td >
            <input type="text" class="txtFechas" name="txtDia" />
            <input type="text" class="txtFechas" name="txtMes" />
            <input type="text" class="txtFechas" name="txtAno" />
            </td>
            <td ><div class ="textoformulario" >Empresa</div></td>
            <td ><input type="text" class="txtContactenos" name="txtEmpresa" /></td>
           <tr>
            <td > 
              <div class ="textoformulario" >Cedula</div>
            </td>
            <td ><input type="text" class="txtContactenos" name="txtCedula" /></td>
            <td ><div class ="textoformulario" >Cargo</div></td>
            <td ><input type="text" class="txtContactenos" name="txtCargo" /></td>
          </tr>
          <tr>
            <td > 
              <div class ="textoformulario" >Dirección</div>
            </td>
            <td ><input type="text" class="txtContactenos" name="txtDir" /></td>
            <td ><div class ="textoformulario" >Permanencia</div></td>
            <td ><input type="text" class="txtContactenos" name="txtPermanencia" /></td>
          </tr>
          <tr>
            <td ><div class ="textoformulario" >Telefono</div></td>
            <td ><input type="text" class="txtContactenos" name="txtTel" /></td>
            <td ><div class ="textoformulario" >Motivo Retiro</div></td>
            <td ><input type="text" class="txtContactenos" name="txtRetiro" /></td>
          </tr>
          <tr>
            <td ><div class ="textoformulario" >Ceular</div></td>
            <td ><input type="text" class="txtContactenos" name="txtCel" /></td>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
          </tr>
          <tr>
            <td ><div class ="textoformulario" >Nivel Educativo</div></td>
            <td ><input type="text" class="txtContactenos" name="txtEdu" /></td>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
          </tr>
          <tr>
            <td ><div class="textoformulario">Foto</div></td>
            <td ><input type="text" class="txtContactenos" name="txtFoto" /></td>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
          </tr>
          <tr>
            <td > 
              <div class ="textoformulario" ></div>
            </td>
            <td >&nbsp;</td>
            <td ><div class ="textoformulario" >&nbsp;</div></td>
            <td >
                <input type="submit" class="botonContactenos" value="" title="" />
                <input type="hidden" name="action" value="send" />
            </td>
          </tr>
          <tr >
            <td colspan ='4' valign="top" align="right"> 
              <p>&nbsp;</p></td>
          </tr>
    </table>
</div>
</form>
</body>
</html>