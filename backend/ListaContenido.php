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
    Cabecera('Lista De Contenidos');
    ?>
    <script type="text/javascript">
        $().ready(function() {
                // validate the comment form when it is submitted
                $("#FrmSeccion").validate({

                    rules: {
                        TxtSeccion:"required",
                        TxtFondo:"required"
                    },
                    messages:{
                        TxtSeccion:"La Lista Debe Tener Un Nombre",
                        TxtFondo:"Falta la Ruta De Imagen De Fondo"
                    },
                    errorLabelContainer:$("#FrmSeccion div.error")
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
    <p>&nbsp;</p>
    <div>
        <fieldset>
            <legend>Lista De Contenidos</legend>
            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" id ="FrmSeccion"  enctype="multipart/form-data">
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
                        if(isset ($_POST['BtnCancelar'])) Formulario(0);
                    }
                    else
                    {
                        Formulario(0);
                    }
                ?>
            </form>
            <?php
                verGrilla();
            ?>
        </fieldset>
    </div>
    <?php

}

function Formulario($aux)
{
    $ObjAux = null;
    if($aux==0)
    {
        $ObjAux = new ListaContenido();
        $ObjAux->id = $aux;
        $ObjAux->nombre='';
        $ObjAux->idSeccion='';
        $ObjAux->fondo='';
        $ObjAux->fotos='';
    }
    else
    {
        $ObjAux = DAOFactory::getListaContenidoDAO()->load($aux);
    }

    ?>
                <table id="tabla" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td width="50%">
                            <input type="hidden" name ="TxtAux" value="<?php echo $ObjAux->id ?>">
                            <label>Nombre De La Lista:</label><br />
                            <input type="text" name="TxtSeccion" size="50" value="<?php echo $ObjAux->nombre ?>">
                        </td>
                        <td width="50%">
                            <label>Seccion:</label><br />
                            <select name="ListSeccion" id="ListSeccion">
                                <?php ComboSeccion($ObjAux->idSeccion); ?>
                            </select>
                        </td>
                        <td align="center"><input class="submit-green" name="BtnGuardar" type="submit" value="Guardar" /> </td>
                    </tr>
                    <tr>
                        <td width="50%">
                            <label>Fondo:</label><br />
                            <input name="TxtFondo" id="TxtFondo" size="50" type="file" value="Examinar">
                        </td>
                        <td width="50%">
                            <label>Galeria De Imagenes:</label><br />
                            <table width="200">
                              <tr>
                                <td><label><input type="radio" name="OpGaleria" value="Si" id="OpGaleria_0" <?php if($ObjAux->fotos==1) echo "checked='checked'" ?> />Si</label></td>
                                <td><label><input name="OpGaleria" type="radio" id="OpGaleria_1" value="No" <?php if($ObjAux->fotos==0)echo "checked='checked'" ?> />No</label></td>
                              </tr>
                            </table>
                        </td>
                        <td align="center"><input class="submit-green" name="BtnCancelar" type="submit" value="Cancelar" /> </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div class="error"></div>
                        </td>
                    </tr>
                </table>
    <?php

    return "";
}

function verGrilla()
{
    ?>

    <div class="module">
                <h2><span>Listas De Contenidos Registradas Registradas</span></h2>
            <div class="module-table-body">
                            <table id="myTable" class="tablesorter" cellpadding="0" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width:10%">Seccion</th>
                                    <th style="width:50%">Lista De Contenido</th>
                                    <th style="width:20%">Galeria De Imagenes </th>
                                    <th style="width:10%"></th>
                                    <th style="width:10%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $tablaconsulta = DAOFactory::getListaContenidoDAO()->queryAllOrderBy('id');
                                for($fila=0;$fila<count($tablaconsulta);$fila ++)
                                {
                                    ?>
                                        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" id ="<?php echo 'Sel'.$fila?>">
                                    <?php
                                        $row = $tablaconsulta[$fila];
                                        echo "<tr><td>"."<input type='hidden' name ='Id' value='".$row->id."'>".DAOFactory::getSeccionDAO()->load($row->idSeccion)->nombre."</td>";
                                        echo "<td>".$row->nombre."</td>";
                                        if($row->fotos) echo "<td>SI</td>";
                                        else echo "<td>No</td>";
                                        echo "<td><input class='submit-green' type='submit' name='BtnUpdate' value='Modificar' /></td>";
                                        echo "<td>".isDisabled()."</td>";
                                    ?>
                                        </form>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
            </div>
        </div>

<?php
   return "";
}


function GuardarInfo()
{
    $tabla = DAOFactory::getListaContenidoDAO()->queryAllOrderBy('id');

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
    if($_POST['TxtSeccion']=='')
    {
        $error_msg = $error_msg.'Falta el Nombre de la Lista<br>';
    }
    if($_FILES['TxtFondo']['name']=='')
    {
        $error_msg = $error_msg.'Falta la Ruta De Imagen De Fondo<br>';
    }

    $aux = $_POST['ListSeccion'];

    $VarAux = DAOFactory::getListaContenidoDAO()->queryByIdSeccion($aux);

    if (isset($VarAux[0]))
    {
        $error_msg = $error_msg.'Esta Seccion Ya Tiene Una Lista, Favor Editar O Eliminarla La Lista<br>';
    }

    if($error_msg == '')
    {
        $nombre_archivo = quitar_caracteres_raros($_FILES['TxtFondo']['name']);
        $tipo_archivo = $_FILES['TxtFondo']['type'];
        $tamano_archivo = $_FILES['TxtFondo']['size'];
        $ruta_archivo=$_FILES['TxtFondo']['tmp_name'];
        if(!is_dir('../resources/img_cms/albums/Lista/'))
        {
            mkdir('../resources/img_cms/albums/Lista/');
        }
        $destination = '../resources/img_cms/albums/Lista/';
        if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "jpg")|| strpos($tipo_archivo, "png")) && ($tamano_archivo < (500 * 1024) )))
        {
            echo '<span class="notification n-error">La extensión o el tamaño del fichero no es correcta.</span>';
        }
        else
        {
            if(move_uploaded_file($ruta_archivo, $destination.$nombre_archivo))
            {
                $seccion = new ListaContenido();
                $seccion->nombre=$_POST['TxtSeccion'];
                $seccion->idSeccion=$aux;
                $seccion->fondo=$destination.$nombre_archivo;
                if($_POST['OpGaleria']=='Si') $seccion->fotos=1;
                else $seccion->fotos=0;
                DAOFactory::getListaContenidoDAO()->insert($seccion);
                if($seccion->id > $ultimo)
                {
                    echo '<span class="notification n-success">Lista Guardada.</span>';
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
    $error_msg = '';
    if($_POST['TxtSeccion']=='')
    {
        $error_msg = $error_msg.'Falta el Nombre de la Lista<br>';
    }
    if($_FILES['TxtFondo']['name']=='')
    {
        $error_msg = $error_msg.'Falta la Ruta De Imagen De Fondo<br>';
    }

    $aux = $_POST['ListSeccion'];

    $VarAux = DAOFactory::getListaContenidoDAO()->load($aux);

    if (isset($VarAux[0]) && ($VarAux[0]->id != $int))
    {
        $error_msg = $error_msg.'Esta Seccion Ya Tiene Una Lista, Favor Editar O Eliminarla La Lista<br>';
    }

    if($error_msg == '')
    {
        $nombre_archivo = quitar_caracteres_raros($_FILES['TxtFondo']['name']);
        $tipo_archivo = $_FILES['TxtFondo']['type'];
        $tamano_archivo = $_FILES['TxtFondo']['size'];
        $ruta_archivo=$_FILES['TxtFondo']['tmp_name'];
        if(!is_dir('../resources/img_cms/albums/Lista/'))
        {
            mkdir('../resources/img_cms/albums/Lista/');
        }
        $destination = '../resources/img_cms/albums/Lista/';
        if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "jpg")|| strpos($tipo_archivo, "png")) && ($tamano_archivo < (500 * 1024) )))
        {
            echo '<span class="notification n-error">La extensión o el tamaño del fichero no es correcta.</span>';
        }
        else
        {
            if(move_uploaded_file($ruta_archivo, $destination.$nombre_archivo))
            {
                $seccion = new ListaContenido();
                $seccion->nombre=$_POST['TxtSeccion'];
                $seccion->idSeccion=$aux;
                $seccion->fondo=$destination.$nombre_archivo;
                if($_POST['OpGaleria']=='Si') $seccion->fotos=1;
                else $seccion->fotos=0;
                DAOFactory::getListaContenidoDAO()->update($seccion);
                echo '<span class="notification n-success">Lista Actualizada.</span>';
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

function DeleteInfo($int)
{
    DAOFactory::getListaContenidoDAO()->delete($int);
    echo '<span class="notification n-success">Lista Eliminada.</span>';
    return "";
}

?>

