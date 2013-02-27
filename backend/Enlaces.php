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
    Cabecera('Enlaces');
    ?>
    <script type="text/javascript">
        $().ready(function() {
                // validate the comment form when it is submitted
                $("#FrmSeccion").validate({

                    rules: {
                        TxtNombre:"required",
                        TxtUrl:"required"
                    },
                    messages:{
                        TxtNombre:"El Enlace Debe Tener Un Nombre",
                        TxtUrl:"Debe Existir La URL De Destino"
                    },
                    errorLabelContainer:$("#FrmSeccion div.error")
                });
        });
    </script>
    <p>&nbsp;</p>
    <div>
        <fieldset>
            <legend>Enlaces</legend>
            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" id ="FrmSeccion">
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
                verGrillaSeccion();
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
        $ObjAux = new TipoSeccion();
        $ObjAux->id = $aux;
        $ObjAux->descripcion='';
        $ObjAux->uRLUsuraio='';
        $ObjAux->popup=0;
    }
    else
    {
        $ObjAux = DAOFactory::getTipoSeccionDAO()->load($aux);
    }
    
    ?>
                <table id="tabla" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td width="50%">
                            <input type="hidden" name ="TxtAux" value="<?php echo $ObjAux->id ?>">
                            <label>Nombre del enlace:</label><br />
                            <input type="text" name="TxtNombre" size="50" value="<?php echo $ObjAux->descripcion ?>">
                        </td>
                        <td width="50%">
                            <label>Url Destino:</label><br />
                            <input type="text" name="TxtUrl" size="50" value="<?php echo $ObjAux->uRLUsuraio ?>">
                        </td>
                    </tr>
                    <tr>
                        <td align="center"><input class="submit-green" name="BtnGuardar" type="submit" value="Guardar" /> </td>
                        <td align="center"><input class="submit-green" name="BtnCancelar" type="submit" value="Cancelar" /> </td>
                    </tr>
                    <tr>
                        <td colspan="2">
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
                                    <th style="width:50%">Nombre</th>
                                    <th style="width:20%">URL Destino</th>
                                    <th style="width:10%"></th>
                                    <th style="width:10%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $tablaconsulta = DAOFactory::getTipoSeccionDAO()->queryByPopup(0);
                                for($fila=0;$fila<count($tablaconsulta);$fila ++)
                                {
                                    ?>
                                        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" id ="<?php echo 'Sel'.$fila?>">    
                                    <?php
                                        $row = $tablaconsulta[$fila];
                                        echo "<tr><td>"."<input type='hidden' name ='Id' value='".$row->id."'>".$row->descripcion."</td>";
                                        echo "<td>".$row->uRLUsuraio."</td>";
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

function GuardarInfo()
{
    $tabla = DAOFactory::getTipoSeccionDAO()->queryAllOrderBy('id');

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
    if($_POST['TxtNombre']=='')
    {
        $error_msg = $error_msg.'Falta el Nombre del Enlace<br>';
    }
    if($_POST['TxtUrl']=='')
    {
        $error_msg = $error_msg.'Falta URL Del Destino<br>';
    }

    if($error_msg == '')
    {
                $seccion = new TipoSeccion();
                $seccion->descripcion=$_POST['TxtNombre'];
                $seccion->uRLUsuraio=$_POST['TxtUrl'];
                $seccion->popup=0;
                DAOFactory::getTipoSeccionDAO()->insert($seccion);
                if($seccion->id > $ultimo)
                {
                    echo '<span class="notification n-success">Enlace Guardado.</span>';
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
    if($_POST['TxtNombre']=='')
    {
        $error_msg = $error_msg.'Falta el Nombre del Enlace<br>';
    }
    if($_POST['TxtUrl']=='')
    {
        $error_msg = $error_msg.'Falta URL Del Destino<br>';
    }

    if($error_msg == '')
    {
                $seccion = new TipoSeccion();
                $seccion->id=$int;
                $seccion->descripcion=$_POST['TxtNombre'];
                $seccion->uRLUsuraio=$_POST['TxtUrl'];
                $seccion->popup=0;
                DAOFactory::getTipoSeccionDAO()->update($seccion);
                echo '<span class="notification n-success">Enlace Actualizado.</span>';
    }
    else
    {
        echo '<span class="notification n-error">'.$error_msg.'</span>';
    }
    return "";
    
}

function DeleteInfo($int)
{
    $seccion = new TipoSeccion();
    DAOFactory::getTipoSeccionDAO()->delete($int);
    echo '<span class="notification n-success">Enlace Eliminado.</span>';
    return "";
}
?>

