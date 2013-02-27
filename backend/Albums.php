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
    Cabecera('Album');
    ?>
    <script type="text/javascript">
        $().ready(function() {
                // validate the comment form when it is submitted
                $("#FrmSeccion").validate({

                    rules: {
                        TxtSeccion:"required"
                    },
                    messages:{
                        TxtSeccion:"El Album Debe Tener Un Nombre"
                    },
                    errorLabelContainer:$("#FrmSeccion div.error")
                });
        });
    </script>
    <p>&nbsp;</p>
    <div>
        <fieldset>
            <legend>Albums</legend>
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
        $ObjAux = new Album();
        $ObjAux->id = $aux;
        $ObjAux->nombre='';
        $ObjAux->fecha='';
        $ObjAux->mostrar = 1;
    }
    else
    {
        $ObjAux = DAOFactory::getAlbumDAO()->load($aux);
    }

    ?>
                <table id="tabla" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td width="50%">
                            <input type="hidden" name ="TxtAux" value="<?php echo $ObjAux->id ?>">
                            <label>Nombre Del Album:</label><br />
                            <input type="text" name="TxtSeccion" size="50" value="<?php echo $ObjAux->nombre ?>">
                        </td>
                        <td>
                            <label>Se Visualiza en la Galeria:</label><br />
                            <select id="cmbselector" name="cmbselector">

                                <option  <?php if($ObjAux->mostrar==1) echo 'selected="selected"';?>  value="1">SI</option>
                                <option <?php if($ObjAux->mostrar==0) echo 'selected="selected"';?> value="0">NO</option>
                            </select>
                        </td>
                        <td align="center"><?php echo btnCrear();?> </td>
                        <td align="center"><?php echo btnCancelar();?></td>
                    </tr>
                    <tr>
                        <td colspan="4">
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
                <h2><span>Albunes Registradas</span></h2>
            <div class="module-table-body">
                            <table id="myTable" class="tablesorter" cellpadding="0" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width:5%;">Id</th>
                                    <th style="width:40%">Album</th>
                                    <th style="width:15%">Mostrar en Galeria</th>
                                    <th style="width:10%"></th>
                                    <th style="width:10%"></th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $tablaconsulta = DAOFactory::getAlbumDAO()->queryAllOrderBy('id');
                                for($fila=0;$fila<count($tablaconsulta);$fila ++)
                                {
                                    ?>
                                        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" id ="<?php echo 'Sel'.$fila?>">
                                    <?php
                                        $row = $tablaconsulta[$fila];
                                        echo "<tr><td>"."<input type='hidden' name ='Id' value='".$row->id."'>".($fila + 1)."</td>";
                                        echo "<td>".$row->nombre."</td>";
                                        echo "<td style='text-align: center;'>";
                                            if($row->mostrar == 1)
                                                 echo "SI" ;
                                             else echo "NO";
                                        echo "</td>";
                                        echo "<td>".btnModificar()."</td>";
                                        echo "<td>".btnEliminar()."</td></tr>";
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
    $tabla = DAOFactory::getAlbumDAO()->queryAllOrderBy('id');

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
        $error_msg = $error_msg.'Falta el Nombre del Album<br>';
    }

    $VarAux =DAOFactory::getAlbumDAO()->queryByNombre($_POST['TxtSeccion']);

    if(isset($VarAux[0]))
    {
         $error_msg = $error_msg.'Ya Existe Un Album Con Este Nombre<br>';
    }
    
    if($error_msg == '')
    {
        $seccion = new Album();
        $seccion->nombre = $_POST['TxtSeccion'];
        $seccion->fecha = date("Y/m/d");
        $seccion->mostrar = $_POST["cmbselector"];
        DAOFactory::getAlbumDAO()->insert($seccion);
        if($seccion->id > $ultimo)
        {
            echo '<span class="notification n-success">Album Guardado.</span>';
            
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
        $error_msg = $error_msg.'Falta el Nombre del Album<br>';
    }

    $VarAux = DAOFactory::getAlbumDAO()->queryByNombre($_POST['TxtSeccion']);

    if(isset($VarAux[0]))
    {
         $error_msg = $error_msg.'Ya Existe Un Album Con Este Nombre<br>';
    }
    
    if($error_msg == '')
    {
        $seccion = new Album();
        $seccion->id = $int;
        $seccion->nombre=$_POST['TxtSeccion'];
        $seccion->fecha=date("Y/m/d");
        $seccion->mostrar = $_POST["cmbselector"];
        DAOFactory::getAlbumDAO()->update($seccion);
        echo '<span class="notification n-success">Album Actualizado.</span>';
    }
    else
    {
        echo '<span class="notification n-error">'.$error_msg.'</span>';
    }
    return "";

}

function DeleteInfo($int)
{
    DAOFactory::getAlbumDAO()->delete($int);
    echo '<span class="notification n-success">Album Eliminada.</span>';
    return "";
}
?>