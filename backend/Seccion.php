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
    Cabecera('Secciones');
    ?>
    <script type="text/javascript">
        $().ready(function() {
                // validate the comment form when it is submitted
                $("#FrmSeccion").validate({

                    rules: {
                        TxtSeccion:"required",
                        TxtEspanol:"required",
                        TxtIngles:"required",
                        TxtPosicion:"required"
                    },
                    messages:{
                        TxtSeccion:"La Seccion Debe Tener Un Nombre",
                        TxtEspanol:"La Seccion Debe Tener Un Titulo En Español",
                        TxtIngles:"La Seccion Debe Tener Un Titulo En Ingles",
                        TxtPosicion:"La Seccion Debe Tener Una Posicion"
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
            <legend>Secciones</legend>
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
                        if(isset ($_POST['BtnModificar'])) Formulario($_POST['Id']);
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
                verGrillaSeccion();
            ?>
        </fieldset>
    </div>
    <?php

}

function Formulario($aux)
{
    $mostrarImg = null; 
    $mostrarUpl = null; 
    $ObjAux  = null;
    
    if($aux==0)
    {
        $ObjAux = new Seccion();
        $ObjAux->id = $aux;
        $ObjAux->idPapa ='';
        $ObjAux->nombre='';
        $ObjAux->tipoSeccion='';
        $ObjAux->posicion='';
        $ObjAux->tituloEsp='';
        $ObjAux->tituloIng='';
        $ObjAux->imagen='';
        
        $mostrarImg = 'hidden';
        $mostrarUpl = 'visible'; 
    }
    else
    {
        $ObjAux = DAOFactory::getSeccionDAO()->load($aux);
        $mostrarImg = 'visible';
        $mostrarUpl = 'hidden'; 
        
    }
    
    ?>

                <table id="tabla" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td width="20%" rowspan="4" >
                            <div id ="capaImagen" style="visibility:<?php echo $mostrarImg; ?>; font-size: 9px; font-size: 12px; font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; color: #096;">
                            <img src='<?php echo $ObjAux->imagen; ?>' height='100' width='100'/> <a onclick="mostrar('capaILoad')"> <br />Cambiar Imagen</a> 
                            <input type="hidden" name ="fileImage" value="<?php echo $ObjAux->imagen ?>">
                            </div>
                      </td>
                       <td >
                           <label>Sección Padre:</label>
                            <select name="cboSeccion" title="Seleccione una Seccion" id="cboSeccion"  class="required ui-widget-content">
                                <?php ComboSeccion($ObjAux->idPapa);?>
                            </select>
                       </td>
                    </tr>
                    <tr>
                        <td width="40%">
                            <input type="hidden" name ="TxtAux" value="<?php echo $ObjAux->id ?>">
                            <label>Nombre De La Seccion:</label>
                            <input type="text" name="TxtSeccion" size="50" value="<?php echo $ObjAux->nombre ?>">
                        </td>
                        <td width="40%">
                            <label>Tipo Seccion</label>
                            <select name="ListTipoSeccion" id="ListTipoSeccion" class="required ui-widget-content">
                                <?php ComboTipoSeccion($ObjAux->tipoSeccion); ?>
                            </select>
                        </td>
                        
                    </tr>
                    <tr>
                        <td width="40%">
                            <label>Titulo Español:</label>
                            <input type="text" name="TxtEspanol" size="50" value="<?php echo $ObjAux->tituloEsp ?>">
                        </td>
                        <td width="40%">
                            <label>Titulo Ingles:</label>
                            <input type="text" name="TxtIngles" size="50" value="<?php echo $ObjAux->tituloEng ?>">
                        </td>
                    </tr>
                    <tr>
                        <td width="40%">
                            
                            
                            <div id ="capaILoad" style="visibility:<?php echo $mostrarUpl; ?>"><label>Imagen:</label><br />
                            <input name="fileimg" size="50" type="file" value="Examinar"></div>
                        </td>
                        <td width="40%">
                            <label>Posicion de Inicio:</label><br />
                            <input type="text" name="TxtPosicion" size="10" value="<?php echo $ObjAux->posicion ?>">
                        </td>
                        
                    </tr>
                    <tr>
                        <td colspan="3" align="right"  >
                        <?php
                            echo btnCrear();
                            echo btnCancelar();
                        ?>
                        </td>
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

function verGrillaSeccion()
{
    ?>

<div class="module">
                <h2><span>Secciones Registradas</span></h2>
            <div class="module-table-body">
                            <table id="myTable" class="tablesorter" cellpadding="0" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width:5%">Posicion</th>
                                    <th style="width:50%">Nombre</th>
                                    <th style="width:20%">Tipo de Seccion</th>
                                    <th style="width:10%">Modificar</th>
                                    <th style="width:10%">Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $tablaconsulta = DAOFactory::getSeccionDAO()->queryAllOrderBy('posicion');
                                for($fila=0;$fila<count($tablaconsulta);$fila ++)
                                {
                                    ?>
                                        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" id ="<?php echo 'Sel'.$fila?>">    
                                    <?php
                                        $row = $tablaconsulta[$fila];
                                        echo "<tr><td>"."<input type='hidden' name ='Id' value='".$row->id."'>".$row->posicion."</td>";
                                        echo "<td>".$row->nombre."</td>";
                                        $aux=DAOFactory::getTipoSeccionDAO()->load($row->tipoSeccion);
                                        echo "<td>".$aux->descripcion."</td>";
                                        echo "<td align='center'>".btnModificar()."</td>";
                                        echo "<td align='center'>".btnEliminar()."</td>";
                                    ?>
                                        </form>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <div id="pager" class="pager">
                            <form>
                                    <img src="../resources/img/pager/first.png" class="first"/>
                                    <img src="../resources/img/pager/prev.png" class="prev"/>
                                    <input type="text" class="pagedisplay"/>
                                    <img src="../resources/img/pager/next.png" class="next"/>
                                    <img src="../resources/img/pager/last.png" class="last"/>
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

function ComboTipoSeccion($aux)
{

    $tablaconsulta = DAOFactory::getTipoSeccionDAO()->queryAllOrderBy('id');
    for($fila=0;$fila<count($tablaconsulta);$fila ++)
    {
        $row = $tablaconsulta[$fila];
        if ($row->id==$aux) echo "<option value='".$row->id."' SELECTED >".$row->descripcion."</option>";
        else echo "<option value='".$row->id."'>".$row->descripcion."</option>";
    }
    return "";
}

function GuardarInfo()
{
    $tabla = DAOFactory::getSeccionDAO()->queryAllOrderBy('id');

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
        $error_msg = $error_msg.'Falta el Nombre de la Seccion<br>';
    }
    if($_POST['TxtEspanol']=='')
    {
        $error_msg = $error_msg.'Falta el Titulo en Español<br>';
    }
    if($_POST['TxtIngles']=='')
    {
        $error_msg = $error_msg.'Falta el Titulo en Ingles<br>';
    }
    if($_FILES['fileimg']['name']=='')
    {
        $error_msg = $error_msg.'Falta la Ruta De Imagen<br>';
    }
    $aux = 0;
    if($_POST['TxtPosicion']=='')
    {
        $error_msg = $error_msg.'Falta la Posicion de Inicio<br>';
    }
    else
    {
        $aux = $_POST['TxtPosicion'];
    }
    if( !is_numeric($aux) )
    {
        $error_msg = $error_msg.'La Posicion debe ser Numerico<br>';
    }
    if ($aux > 12)
    {
        $error_msg = $error_msg.'La Posicion debe ser Menor a 12<br>';
    }

    $VarAux = DAOFactory::getSeccionDAO()->queryByPosicion($aux);
    if (isset($VarAux[0]))
    {
        $error_msg = $error_msg.'Esta Posicion Ya esta Ocupada, Favor Editarla O Eliminarla<br>';
    }

    if($error_msg == '')
    {
        $nombre_archivo = quitar_caracteres_raros($_FILES['fileimg']['name']);
        $tipo_archivo = $_FILES['fileimg']['type'];
        $tamano_archivo = $_FILES['fileimg']['size'];
        $ruta_archivo=$_FILES['fileimg']['tmp_name'];
        if(!is_dir("../resources/csm/img/Seccion/"))
        {
            mkdir("../resources/csm/img/Seccion/");
        }
        $destination = '../resources/csm/img/Seccion/';
        if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "jpg")|| strpos($tipo_archivo, "png")) && ($tamano_archivo < (500 * 1024) )))
        {
            echo '<span class="notification n-error">La extensión o el tamaño del fichero no es correcta.</span>';
        }
        else
        {       
            
            if(move_uploaded_file($ruta_archivo, $destination.$nombre_archivo)){

                $seccion = new Seccion();
                $seccion->nombre     =$_POST['TxtSeccion'];
                $seccion->tipoSeccion=$_POST['ListTipoSeccion'];
                $seccion->posicion   =$_POST['TxtPosicion'];
                $seccion->tituloEsp  =$_POST['TxtEspanol'];
                $seccion->tituloEng  =$_POST['TxtIngles'];
                $seccion->idPapa     =$_POST['cboSeccion'];
                $seccion->imagen     ='resources/img_cms/general/Seccion/'.$nombre_archivo;

                DAOFactory::getSeccionDAO()->insert($seccion);

                if($seccion->id > $ultimo){
                   echo '<span class="notification n-success">Seccion Guardada.</span>';
                }
            }
            else{
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
        $error_msg = $error_msg.'Falta el Nombre de la Seccion<br>';
    }
    if($_POST['TxtEspanol']=='')
    {
        $error_msg = $error_msg.'Falta el Titulo en Español<br>';
    }
    if($_POST['TxtIngles']=='')
    {
        $error_msg = $error_msg.'Falta el Titulo en Ingles<br>';
    }   
    $aux = 0;
    if($_POST['TxtPosicion']=='')
    {
        $error_msg = $error_msg.'Falta la Posicion de Inicio<br>';
    }
    else
    {
        $aux = $_POST['TxtPosicion'];
    }
    if( !is_numeric($aux) )
    {
        $error_msg = $error_msg.'La Posicion debe ser Numerico<br>';
    }
    //if ($aux > 12)
    //{
    //    $error_msg = $error_msg.'La Posicion debe ser Menor a 12<br>';
    //}

    //$VarAux = DAOFactory::getSeccionDAO()->queryByPosicion($aux);
    //if (isset($VarAux[0]) && ($VarAux[0]->id != $int))
    //{
    //    $error_msg = $error_msg.'Esta Posicion Ya esta Ocupada, Favor Editarla O Eliminarla<br>';
    //}

    if($error_msg == '')
    { 
        $seccion = new Seccion();
        $seccion->id         =$int;
        $seccion->idPapa     =$_POST['cboSeccion'];
        $seccion->nombre     =$_POST['TxtSeccion'];
        $seccion->tipoSeccion=$_POST['ListTipoSeccion'];
        $seccion->posicion   =$_POST['TxtPosicion'];
        $seccion->tituloEsp  =$_POST['TxtEspanol'];
        $seccion->tituloEng  =$_POST['TxtIngles'];
        $seccion->idPapa     =$_POST['cboSeccion'];
        $seccion->imagen     =$_POST['fileImage'];

        $guardar=true;

        if($_FILES['fileimg']['name']!=''){

            $nombre_archivo = quitar_caracteres_raros($_FILES['fileimg']['name']);
            $tipo_archivo   = $_FILES['fileimg']['type'];
            $tamano_archivo = $_FILES['fileimg']['size'];
            $ruta_archivo   = $_FILES['fileimg']['tmp_name'];
            if(!is_dir("../resources/csm/img/Seccion/"))
            {
                mkdir("../resources/csm/img/Seccion/");
            }
            $destination = '../resources/csm/img/Seccion/';
            
            if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "jpg")|| strpos($tipo_archivo, "png")) && ($tamano_archivo < (500 * 1024) )))
            {
                echo '<span class="notification n-error">La extensión o el tamaño del fichero no es correcta.</span>';
            } 
            else if(move_uploaded_file($ruta_archivo, $destination.$nombre_archivo))
            {
                $seccion->imagen='../resources/csm/img/Seccion/'.$nombre_archivo;
            }
            else{
                echo '<span class="notification n-error">Error Al Subir La Imagen.</span>';
                $guardar = false;
            }
        }

        //Se valida si debe proceder a guardar la seccion
        if($guardar){
            DAOFactory::getSeccionDAO()->update($seccion);
            echo '<span class="notification n-success">Seccion Actualizada.</span>';
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
    $seccion = new Seccion();
    DAOFactory::getSeccionDAO()->delete($int);
    echo '<span class="notification n-success">Seccion Eliminada.</span>';
    return "";
}
?>

