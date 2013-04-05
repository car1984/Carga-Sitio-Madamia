<?php
require_once '../global/include.php';
require_once('funciones.php');	

ini_set("display_errors", $DISPLAY_ERROR);

Cabecera('Fotos');

?>
<script type="text/javascript">
    $().ready(function() {
            // validate the comment form when it is submitted
            $("#FrmSeccion").validate({

                rules: {
                        DescripEsp:"required",
                        DescripIng:"required",
                        fileimg:"required"
                    },
                    messages:{
                        DescripEsp:"Se necesita la Descripcion en Español<br>",
                        DescripIng:"Se nececita la Descripcion en Ingles<br>",
                        fileimg:"Debe seleccionar una Imagen<br>"
                    },
                    errorLabelContainer:$("#frmupload div.error")
            });
    });
</script>
<script type="text/javascript">
    tinyMCE.init({
        mode : "textareas",
        theme : "simple"
//            theme_advanced_buttons1 : "bold, italic, underline, separator, justifyleft, justifycenter, justifyright, justifyfull ",
//            theme_advanced_buttons2 : "bullist,numlist,separator,outdent,indent,separator,undo,redo",
//            theme_advanced_buttons3 : "",
//            theme_advanced_toolbar_location: "top",
//            theme_advanced_toolbar_align: "left"
    });
</script>
    <script language="Javascript">  
            function mostrar(nombreCapa){  
            document.getElementById(nombreCapa).style.visibility="visible";  
            }  
            function ocultar(nombreCapa){  
            document.getElementById(nombreCapa).style.visibility="hidden";  
            }  
</script>
<p>&nbsp;</p>
<div style="width:880px; border:2px">
  <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" id ="FrmSeccion" enctype="multipart/form-data">
  
        <?php executeComand();?>
      
  </form>

</div>

<?php

function verItems()
{
    global $PATH_ALBUM;
    
?>

    <div class="capaTabla">
            
        <table id="myTable" cellpadding="2" cellspacing="2" border="0" width="440px">

            <tbody>
                <?php
                $albumpost = $_SESSION['IdAlbum'];
                
                $tablaconsulta = DAOFactory::getFotoDAO()->queryByIdAlbun($albumpost);
                
                for($fila=0;$fila<count($tablaconsulta);$fila ++)
                {
                    ?>
                        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" id ="<?php echo 'Sel'.$fila?>">
                    <?php
                        $row = $tablaconsulta[$fila];

                        echo "<tr height='50px'>";
                        echo "<td width='80px' align='center' style='background-color:#DAB0C8; color:#7C1147;font-family: Arial, Helvetica, sans-serif;'><img src='".$row->imagen."' width='50px'/></td>";
                        echo "<td width='240px' style='background-color:#DAB0C8; color:#7C1147;font-family: Arial, Helvetica, sans-serif;'>".$row->descripcionEsp."</td>";
                        echo "<td width='60px' align='center' class='tablaAdmin'>".linkModificar('Fotos.php',$row->id,"Editar",0)."</td>";
                        echo "<td width='60px' align='center' class='tablaAdmin'>".linkEliminar('Fotos.php',$row->id,"Borrar",0)."</td></tr>";
                    ?>
                        </form>
                    <?php
                }
                ?>
            </tbody>
        </table>

    </div>

<?php
   return "";
}

function verFormulario()
{
    global $PATH_ALBUM;

    $action = null;
    $ObjAux = null;
    
    if (isComandEdit()) {
        
        ///Action To Execute When do POST 
        $action = 'update';
        
        $aux;
        
        if($_POST){
            $aux= $_POST['Id'];
        }else if($_GET){
            $aux= $_GET['Id'];
        }
        
        
        $ObjAux = DAOFactory::getFotoDAO()->load($aux);
		
	$mostrarImg = 'visible';
        $mostrarUpl = 'hidden';
    }
    else
    {
        
        //Action To Execute When do POST 
        $action = 'insert';
        
        $ObjAux = new Foto();
        
        $ObjAux->id = 0;
        $ObjAux->idAlbun= $_SESSION['IdAlbum'];
        $ObjAux->imagen='';
        $ObjAux->descripcionEsp='';
        $ObjAux->descripcionIng='';
		
        $mostrarImg = 'hidden';
        $mostrarUpl = 'visible'; 

    }

    ?>
    <div class="capaFormulario">
        <fieldset title="Cargar Foto">
            <legend>Formulario Fotos</legend>
                <table id="tabla" cellpadding="0" cellspacing="0" border="0" width="300px">
                <tr>
                        <td colspan="2">
                            <div id ="capaILoad" style="visibility:<?php echo $mostrarUpl; ?>">
                            <label>Imagen:</label><br/>
                            <input name="fileimg" type="file" >
                            </div>
                        </td>
                    </tr>
                      <tr>
                        <td colspan="2">
                          <label>Nombre:</label><br/>
                          <input type="text" name="DescripEsp" value="<?php echo $ObjAux->descripcionEsp ?>">
                         </td>
                    </tr>
                    <tr>
                      <td width="150px" rowspan="3">
                      <div id ="capaImagen" style="visibility:<?php echo $mostrarImg; ?>; font-size: 9px; font-size: 12px; font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; color: #096;">
                            <img src='<?php echo $ObjAux->imagen; ?>' height='150' width='150'/> <a onclick="mostrar('capaILoad')"> <br />Cambiar Imagen</a> 
                            <input type="hidden" name ="fileImage" value="<?php echo $ObjAux->imagen ?>">
                            </div>
                      </td>
                        <td width="150px">
                            <input type="hidden" name ="Id" value="<?php echo $ObjAux->id ?>">
                            <input type="hidden" name ="ListAlbum" value="<?php echo $ObjAux->idAlbun ?>">
                            <input type="hidden" value="<?php echo $action;?>" id="execute" name="execute" />                            
                        </td>
                        
                    </tr>
                    <tr>
                      <td width="150px">

                      </td>
                      
                    </tr>
                    <tr>
                      <td width="150px">
                      <?php echo btnCrear(); ?>

                    </td>
                        
                    </tr>
                </table>
    
        </fieldset>
    
    </div>
    <?php

    return "";
}

function verFiltro()
{
    $albumpost = 0;
    
    $albumpost = $_POST['ListAlbumFiltro'];
 ?>
    <br>    
    
        <label>Filtro Album:</label>
         <select name="ListAlbumFiltro" id="ListAlbum">
              <?php 
                ComboAlbum($albumpost); 
              ?>
         </select>
        <input class="submit-green" name="BtnConsultar" type="submit" value="Consultar" />
     

 <?php
 
 return "";
}


function agregarItem()
{
    global $NOTI_ERROR;
    global $NOTI_SUCCESS;
    global $PATH_ALBUM;
    
    $tabla = DAOFactory::getFotoDAO()->queryAllOrderBy('id');

    if(count($tabla)>0)
    {
        $row = $tabla[count($tabla)-1];
        $ultimo = $row->id;
    }
    else
    {
        $ultimo=0;
    }

    $error_msg = '';
    if($_POST['DescripEsp']=='')
    {
        $error_msg = $error_msg.'Falta La Descripcion<br>';
    }
    if($_FILES['fileimg']['name']=='')
    {
        $error_msg = $error_msg.'Falta Imagen<br>';
    }
    
    if($error_msg == '')
    {
        $albumpost          = $_POST['ListAlbum'];
        $nombre_archivo     = quitar_caracteres_raros($_FILES['fileimg']['name']);
        $tipo_archivo       = $_FILES['fileimg']['type'];
        $tamano_archivo     = $_FILES['fileimg']['size'];
        $ruta_archivo       = $_FILES['fileimg']['tmp_name'];
        if(!is_dir($PATH_ALBUM.$albumpost.'/'))
        {
            mkdir($PATH_ALBUM.$albumpost.'/');
        }
        $destination = $PATH_ALBUM.$albumpost.'/';
        if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "jpg")|| strpos($tipo_archivo, "png")) ))
        {
            notificacion('La extensión o el tamaño del fichero no es correcta.', $NOTI_ERROR);
        }
        else
        {
            if(move_uploaded_file($ruta_archivo, $destination.$nombre_archivo))
            {
                $foto = new Foto();
                $foto->idAlbun = $albumpost;
                $foto->imagen = $destination.$nombre_archivo;
                $foto->descripcionEsp = $_POST['DescripEsp'];
                $foto->descripcionIng = '#';
                $resultado = DAOFactory::getFotoDAO()->insert($foto);
                if($resultado)
                {
                    notificacion('Foto Guardada.', $NOTI_SUCCESS);
                }
            }
            else
            {
                notificacion('Error Al Subir La Imagen.', $NOTI_ERROR);
            }
        }
    }
    else
    {
        notificacion($error_msg, $NOTI_ERROR);   
    }
    
    verModulo();
}

function actualizarItem()
{
    global $NOTI_ERROR;
    global $NOTI_SUCCESS;
    global $PATH_ALBUM;
    
    $error_msg = '';
    if($_POST['DescripEsp']=='')
    {
        $error_msg = $error_msg.'Falta La Descripcion <br>';
    }

    if($error_msg == '')
    {
        $albumpost          = $_POST['ListAlbum'];
        
        $foto = new Foto();
        $foto->id               = $_POST['Id'];
        $foto->idAlbun          = $_POST['ListAlbum'];
        $foto->imagen           = $_POST['fileImage']; //$destination.$nombre_archivo;
        $foto->descripcionEsp   = $_POST['DescripEsp'];
        $foto->descripcionIng   = '#';
        
        $guardar = true;
        
        if($_FILES['fileimg']['name']!=''){

            $nombre_archivo = quitar_caracteres_raros($_FILES['fileimg']['name']);
            $tipo_archivo   = $_FILES['fileimg']['type'];
            $tamano_archivo = $_FILES['fileimg']['size'];
            $ruta_archivo   = $_FILES['fileimg']['tmp_name'];

            if(!is_dir($PATH_ALBUM.$albumpost.'/'))
            {
                mkdir($PATH_ALBUM.$albumpost.'/');
            }
            $destination = $PATH_ALBUM.$albumpost.'/';

            
            if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "jpg")|| strpos($tipo_archivo, "png")) && ($tamano_archivo < (500 * 1024) )))
            {
                echo '<span class="notification n-error">La extensión o el tamaño del fichero no es correcta.</span>';
                $guardar = false;
            }
            else if(move_uploaded_file($ruta_archivo, $destination.$nombre_archivo)){
                $foto->imagen = $destination.$nombre_archivo;
            }  
            else {
                $guardar = false;
            }

            
            //Se valida si debe proceder a guardar la seccion
            if($guardar){
                $resultado = DAOFactory::getFotoDAO()->update($foto);

                if($resultado)
                   notificacion('Foto Actualizada.', $NOTI_SUCCESS);
            }
            

        }
        else
        {
           $resultado = DAOFactory::getFotoDAO()->update($foto);

            if($resultado)
                notificacion('Foto Actualizada.', $NOTI_SUCCESS);
                 
        }
    }   
    else
    {
        notificacion($error_msg, $NOTI_ERROR);
    }
    
 
    verModulo();
}

function verHeader()
{
    if(isComandOpen())
        $_SESSION['IdAlbum'] = $_GET['Id'];
?>
  <div>
     <table border="0" width="100%">
      <tr>
        <td width="75%">
        <div class="tituloAdmin">Fotos</div>
        </td>
        <td align="left" width="15%"><p>&nbsp;</p>      
	<?php 
        $idAlbum = $_SESSION['IdAlbum'];
	echo linkAgregar("Fotos.php", $idAlbum, "Nuevo",0); 
	?>			

        </td>
      </tr>
    </table>
 </div>

<?php
}


function verModulo()
{
    verHeader();
    echo "<br><br><div id='contenedor'>";
    verItems();
    verFormulario();
    echo "</div>";
    pie(); 
}


function eliminarItem()
{
    global $NOTI_ERROR;
    global $NOTI_SUCCESS;
    
    if($_GET){
        $IdFoto = $_GET['Id'];
        DAOFactory::getFotoDAO()->delete($IdFoto);
        notificacion("Foto Eliminada.",$NOTI_SUCCESS );
    }else{
        notificacion("Error Eliminando la Foto.",$NOTI_ERROR );
    }   
    verModulo();
}
?>
