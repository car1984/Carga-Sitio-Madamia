<?php
require_once '../global/include.php';
require_once('funciones.php');	

ini_set("display_errors", $DISPLAY_ERROR);

if ( !isset($_SESSION['username']) && !isset($_SESSION['userid']) )
{
    header('Location: ./');
}
else
{
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
    <div>
        <fieldset>
            <legend>Fotos</legend>
            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" id ="FrmSeccion" enctype="multipart/form-data">
                <?php
                    if ($_POST)
                    {
                        if(isset ($_POST['BtnGuardar']))
                        {
                            if($_POST['TxtAux'] == '0') GuardarInfo();
                            else UpdateInfo($_POST['TxtAux']);
                            Formulario(0);
                        }
                        if(isset ($_POST['BtnUpdate'])) Formulario($_POST['Id']);
                        if(isset ($_POST['BtnEliminar']))
                        {
                            DeleteInfo($_POST['Id']);
                            Formulario(0);
                        }
                        if(isset ($_POST['BtnCancelar'])||isset($_POST['BtnConsultar'])) 
                        {
                            Formulario(0);
                        }
                    }
                    else
                    {
                        Formulario(0); 
                    }
                    
                    verFiltro();
                ?>
            </form>
            <?php

                verGrilla($PATH_ALBUM);
            ?>
        </fieldset>
    </div>
    <?php

}

function Formulario($aux)
{
    global $PATH_ALBUM;
    
    $ObjAux = null;
    if($aux==0)
    {
        $ObjAux = new Foto();
        $ObjAux->id = $aux;
        $ObjAux->idAlbun='';
        $ObjAux->imagen='';
        $ObjAux->descripcionEsp='';
        $ObjAux->descripcionIng='';
		
        $mostrarImg = 'hidden';
        $mostrarUpl = 'visible'; 
    }
    else
    {
        $ObjAux = DAOFactory::getFotoDAO()->load($aux);
		
	$mostrarImg = 'visible';
        $mostrarUpl = 'hidden';
    }

    ?>
    <fieldset title="Cargar Foto">
        <legend>Formulario Fotos</legend>
                <table id="tabla" cellpadding="0" cellspacing="0" width="900">
                    <tr>
                      <td width="200" rowspan="3">
                      <div id ="capaImagen" style="visibility:<?php echo $mostrarImg; ?>; font-size: 9px; font-size: 12px; font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; color: #096;">
                            <img src='<?php echo $ObjAux->imagen; ?>' height='150' width='150'/> <a onclick="mostrar('capaILoad')"> <br />Cambiar Imagen</a> 
                            <input type="hidden" name ="fileImage" value="<?php echo $ObjAux->imagen ?>">
                            </div>
                      </td>
                        <td width="350">
                            <input type="hidden" name ="TxtAux" value="<?php echo $ObjAux->id ?>">
                            <label>Album:</label><br />
                            <select name="ListAlbum" id="ListAlbum">
                                <?php ComboAlbum($ObjAux->idAlbun); ?>
                            </select>
                        </td>
                        <td width="350">
                        </td>
                    </tr>
                    <tr>
                      <td>
                      <div id ="capaILoad" style="visibility:<?php echo $mostrarUpl; ?>">
                            <label>Imagen:</label><br/>
                            <input name="fileimg"size="50" type="file" value="Examinar">
                            </div>
                      </td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td >
                          <label>Descripcion Español:</label><br/>
                          <input type="text" name="DescripEsp" size="50" value="<?php echo $ObjAux->descripcionEsp ?>">

                        </td>
                        <td >
                            <label>Descripcion Ingles:</label><br/>
                            <input type="text" name="DescripIng" size="50" value="<?php echo $ObjAux->descripcionIng ?>">
                        </td>
                    </tr>
                    <tr>
                      <td colspan="3" align="right"><input class="submit-green" name="BtnGuardar" type="submit" value="Guardar" />
                      <input class="submit-green" name="BtnCancelar" type="submit" value="Cancelar" /></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div class="error"></div>
                        </td>
                    </tr>
                </table>
    </fieldset>
    <?php

    return "";
}

function verFiltro()
{
    $albumpost = 0;
    
    if (isset($_POST['BtnConsultar']))
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

function verGrilla()
{
    global $PATH_ALBUM;
    
    ?>

<div class="module">
                <h2><span>Fotos Registradas</span></h2>
            <div class="module-table-body">
                            <table id="myTable" class="tablesorter" cellpadding="0" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width:15%">Nombre Album</th>
                                    <th style="width:5%">Imagen</th>
                                    <th style="width:30%">Descripcion ES</th>
                                    <th style="width:30%">Descripcion EN</th>
                                    <th style="width:10%">Modificar</th>
                                    <th style="width:10%">Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $albumpost = 0;
                                if ($_POST)
                                {
                                    if(isset($_POST['BtnConsultar']))
                                        $albumpost = $_POST['ListAlbumFiltro'];
                                    if(isset($_POST['BtnGuardar']))
                                        $albumpost = $_POST['ListAlbum'];
                                }
                                
                                $tablaconsulta = DAOFactory::getFotoDAO()->queryByIdAlbun($albumpost);
                                for($fila=0;$fila<count($tablaconsulta);$fila ++)
                                {
                                    ?>
                                        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" id ="<?php echo 'Sel'.$fila?>">
                                    <?php
                                        $row = $tablaconsulta[$fila];
                                        
                                        echo "<tr><td>"."<input type='hidden' name ='Id' value='".$row->id."'>".DAOFactory::getAlbumDAO()->load($row->idAlbun)->nombre."</td>";
                                        echo "<td><img src='".$row->imagen."' width='70px'/></td>";
                                        echo "<td>".$row->descripcionEsp."</td>";
                                        echo "<td>".$row->descripcionIng."</td>";
                                        echo "<td><input class='submit-green' type='submit' name='BtnUpdate' value='Modificar' /></td>";
                                        echo "<td>".isDisabled()."</td>";
                                    ?>
                                        </form>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <div id="pager" class="pager">
                            <form>
                                    <img src="../resources/img/pager/first.png" class="first" alt ="Primero" />
                                    <img src="../resources/img/pager/prev.png" class="prev" alt ="Anterior"/>
                                    <input type="text" class="pagedisplay"/>
                                    <img src="../resources/img/pager/next.png" class="next" alt ="Siguiente"/>
                                    <img src="../resources/img/pager/last.png" class="last" alt ="Ultimo"/>
                                    <select class="pagesize">
                                            <option selected="selected"  value="10">10</option>
                                            <option value="20">20</option>
                                            <option value="30">30</option>
                                            <option value="40">40</option>
                                    </select>
                            </form>
                        </div>

            </div>
        </div>

<?php
   return "";
}


function GuardarInfo()
{
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
        $error_msg = $error_msg.'Falta La Descripcion En Español<br>';
    }
    if($_POST['DescripIng']=='')
    {
        $error_msg = $error_msg.'Falta La Descripcion En Ingles<br>';
    }
    if($_FILES['fileimg']['name']=='')
    {
        $error_msg = $error_msg.'Falta Imagen<br>';
    }
    
    if($error_msg == '')
    {
        $albumpost = $_POST['ListAlbum'];
        $nombre_archivo = quitar_caracteres_raros($_FILES['fileimg']['name']);
        $tipo_archivo = $_FILES['fileimg']['type'];
        $tamano_archivo = $_FILES['fileimg']['size'];
        $ruta_archivo=$_FILES['fileimg']['tmp_name'];
        if(!is_dir($PATH_ALBUM.$albumpost.'/'))
        {
            mkdir($PATH_ALBUM.$albumpost.'/');
        }
        $destination = $PATH_ALBUM.$albumpost.'/';
        if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "jpg")|| strpos($tipo_archivo, "png")) ))
        {
            echo '<span class="notification n-error">La extensión o el tamaño del fichero no es correcta.</span>';
        }
        else
        {
            if(move_uploaded_file($ruta_archivo, $destination.$nombre_archivo))
            {
                $foto = new Foto();
                $foto->idAlbun = $albumpost;
                $foto->imagen = $destination.$nombre_archivo;
                $foto->descripcionEsp = $_POST['DescripEsp'];
                $foto->descripcionIng = $_POST['DescripIng'];
                $resultado = DAOFactory::getFotoDAO()->insert($foto);
                if($resultado)
                {
                    echo '<span class="notification n-success">Foto Guardada.</span>';
                }
            }
            else
            {
                echo '<span class="notification n-error">Error Al Subir La Imagen.</span>';
            }
        }
    }
    else
    {
        echo '<span class="notification n-error">'.$error_msg.'</span>';
    }
    return "";
}

function UpdateInfo($int)
{
    global $PATH_ALBUM;
    
    $error_msg = '';
    if($_POST['DescripEsp']=='')
    {
        $error_msg = $error_msg.'Falta La Descripcion En Español<br>';
    }
    if($_POST['DescripIng']=='')
    {
        $error_msg = $error_msg.'Falta La Descripcion En Ingles<br>';
    }

    
    if($error_msg == '')
    {
        
        $foto = new Foto();
        $foto->id               = $int;
        $foto->idAlbun          = $_POST['ListAlbum'];
        $foto->imagen           = $_POST['fileImage']; //$destination.$nombre_archivo;
        $foto->descripcionEsp   = $_POST['DescripEsp'];
        $foto->descripcionIng   = $_POST['DescripIng'];
        
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
                   echo '<span class="notification n-success">Foto Actualizada.</span>';
            }

        }
    }
    else
    {
        echo '<span class="notification n-error">'.$error_msg.'</span>';
    }
    return "";

}

function DeleteInfo($int)
{
    DAOFactory::getFotoDAO()->delete($int);
    echo '<span class="notification n-success">Foto Eliminada.</span>';
    return "";
}
?>
