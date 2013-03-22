<?php
    require_once '../global/include.php';

    //Importamos la función PHP class.phpmailer
    require("../resources/plugins/PHPMailer/class.phpmailer.php");
    
    //Para visualizar errores
    ini_set("display_errors", $DISPLAY_ERROR);
    
    
    if ($_POST) {
    
        if ($_POST['action'] == "send") {


            $str_mail ="<table border='0' cellpadding='0' cellspacing='0' align='center'>";
            $str_mail.="<tr >";
            $str_mail.="<td colspan ='3' valign='top'>";
            $str_mail.="<div class='textoTitulo'> Contactenos </div>";
            $str_mail.="</div>";
            $str_mail.="</td>";
            $str_mail.="</tr>";
            $str_mail.="<tr>";
            $str_mail.="<td>";
            $str_mail.="<h4> Nombre</h4>";
            $str_mail.="</td>";
            $str_mail.="<td>";
            $str_mail.= $_POST['txtNombre'];
            $str_mail.="</td>";
            $str_mail.="</tr>";
            $str_mail.="<tr>";
            $str_mail.="<td >";
            $str_mail.="<h4>Apellido</h4>";
            $str_mail.="</td>";
            $str_mail.="<td >";
            $str_mail.=$_POST['txtApellido'];
            $str_mail.="</td>";
            $str_mail.="<tr>";
            $str_mail.="<td >";
            $str_mail.="<h4>Ciudad</h4>";
            $str_mail.="</td>";
            $str_mail.="<td >";
            $str_mail.= $_POST['txtCiudad'];
            $str_mail.="</td>";
            $str_mail.="<tr>";
            $str_mail.="<td >";
            $str_mail.="<h4>Direccion</h4>";
            $str_mail.="</td>";
            $str_mail.="<td >";
            $str_mail.=$_POST['txtDireccion'];
            $str_mail.="</td>";
            $str_mail.="</tr>";
            $str_mail.="<tr>";
            $str_mail.="<td >";
            $str_mail.="<h4>E-mail</h4>";
            $str_mail.="</td>";
            $str_mail.="<td >";
            $str_mail.=$_POST['txtEmail'];
            $str_mail.="</td>";
            $str_mail.="</tr>";
            $str_mail.="<tr>";
            $str_mail.="<td >";
            $str_mail.="<h4>Telefono</h4>";
            $str_mail.="</td>";
            $str_mail.="<td >";
            $str_mail.=$_POST['txtTelefono'];
            $str_mail.="</td>";
            $str_mail.="</tr>";
            $str_mail.="<tr>";
            $str_mail.="<td '><h4>Fecha de Cumpleaños</h4></td>";
            $str_mail.="<td colspan ='2' align='center' valign='top'>";
            $str_mail.=$_POST['txtDia'] . '/';
            $str_mail.=$_POST['txtMes'] . '/';
            $str_mail.=$_POST['txtAnio'];
            $str_mail.="</td>";
            $str_mail.="</tr>";
            $str_mail.="<tr>";
            $str_mail.="<td >";
            $str_mail.="<h4>Mensaje:</h4>";
            $str_mail.="</td>";
            $str_mail.="<td >";
            $str_mail.=$_POST['txtarea'];
            $str_mail.="</td>";
            $str_mail.="</tr>";
            $str_mail.="</table>";
            
            //echo $str_mail;
            //$str_mail="Saludo";
            
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
            $mail->Subject = "Mensaje Contactenos";
            $mail->AltBody = "TEST";
            $mail->MsgHTML('CORREO');
        
            /*
            $mail->Host = "localhost";
            $mail->From = "xxxwarfare@msn.com";
            $mail->FromName = "Madamia";
            $mail->Subject ='Correo Automatico Madamia';
            */
            $mail->AddAddress("car1984@gmail.com");
            $mail->Body = $str_mail;
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
              <div class ="textoformulario" >Nombre</div>
            </td>
            <td width="215px" > 
              <input type="text" class="txtContactenos" name="txtNombre" />
            </td>
            <td width="510" rowspan="8" align="right">
              <textarea id="txtarea" name="txtarea" rows="22" cols="40"  onblur="if(this.value=='') this.value='Escribanos su mensaje...';" onFocus="if(this.value=='Escribanos su mensaje...') this.value='';">Escribanos su mensaje...</textarea></td>
          <tr>
            <td > 
              <div class ="textoformulario" >Apellido</div>
            </td>
            <td > 
              <input type="text" class="txtContactenos" name="txtApellido" />
            </td>
           <tr>
            <td > 
              <div class ="textoformulario" >Ciudad</div>
            </td>
            <td > 
              <input type="text" class="txtContactenos" name="txtCiudad" />
            </td>
           <tr>
            <td > 
              <div class ="textoformulario" >Direccion</div>
            </td>
            <td > 
              <input type="text" class="txtContactenos" name="txtDireccion" />
            </td>
          </tr>
          <tr>
            <td > 
              <div class ="textoformulario" >E-mail</div>
            </td>
            <td > 
              <input type="text" class="txtContactenos" name="txtEmail" />
            </td>
          </tr>
          <tr>
            <td > 
              <div class ="textoformulario" >Telefono</div>
            </td>
            <td > 
              <input type="text" class="txtContactenos" name="txtTelefono" />
            </td>
          </tr>
          <tr>
            <td colspan ='2'>
            <div class ="textoformulario" >Fecha de Cumpleaños</div>
            </td>
          </tr>
          <tr>
            <td colspan ='2' align="center" valign="top">
                     <div id="contenedorFlecha">
                     	<div style="float:left">
                     	<input type="text" class="txtFecha" name="txtDia" /></div>
						<div class="flecha"></div>
                        <div style="float:left">
						<input type="text" class="txtFecha" name="txtMes" /></div>
						<div class="flecha"></div>
                        <div style="float:left">
              			<input type="text" class="txtFecha" name="txtAnio" /></div>
                     <div class="flecha"></div>
                  
                  </div>
            </td>
          </tr>
          <tr >
            <td colspan ='3' valign="top" align="right"> 
              <br />
                <input type="submit" class="botonContactenos" value="" title="" /> 
                <input type="hidden" name="action" value="send" />
            </td>
          </tr>
    </table>
</div>
</form>
</body>
</html>