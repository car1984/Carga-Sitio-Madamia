<?php
require_once '../phpdao/generated/include_dao.php';
require_once('funciones.php');	

ini_set("display_errors", $DISPLAY_ERROR);
if ( !isset($_SESSION['username']) && !isset($_SESSION['userid']) )
{
    header('Location: ./');
}
else
{
    Cabecera('Usuarios');
    ?>
    <script type="text/javascript">
        $().ready(function() {
                // validate the comment form when it is submitted
                $("#FrmUsuarios").validate({

                    rules: {
                        NomUsuario:"required",
                        PassUsuario:{required:true, minlength:5},
                        Confirm_Pass:{required:true, minlength:5,equalTo:'#PassUsuario'},
                        EmailUsuario:{required:true, email:true}
                    },
                    messages:{
                        NomUsuario:"Se necesita el Nombre de Usuario<br>",
                        PassUsuario:
                            {
                                required:"Se nececita La Contraseña<br>",
                                minlength:"Necesita por lo menos 5 caracteres<br>"
                            },
                        Confirm_Pass:
                            {
                                required:"Se nececita confirmar Contraseña<br>",
                                minlength:"Necesita por lo menos 5 caracteres<br>",
                                equalTo:"Las Contraseñas no son Iguales<br>"
                            },
                        EmailUsuario:"El correo no tiene el formato Adecuado<br>"
                    },
                    errorLabelContainer:$("#FrmUsuarios div.error")
                });
        });
    </script>
    <p>&nbsp;</p>
    <div>
        <fieldset>
            <legend>Usuarios</legend>
            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" id ="FrmUsuarios">
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
        $ObjAux = new Usuario();
        $ObjAux->id = $aux;
        $ObjAux->usuario='';
        $ObjAux->clave='';
        $ObjAux->mail='';
    }
    else
    {
        $ObjAux = DAOFactory::getUsuarioDAO()->load($aux);
    }

    ?>

                <table id="tabla" cellpadding="2" cellspacing="2" width="90%">
                    <tr>
                        <td width="20%">
                            <input type="hidden" name ="TxtAux" value="<?php echo $ObjAux->id ?>">
                            <label>Nombre de Inicio de sesion:</label>
                        </td>
                        <td width="40%"><input type="text" name="NomUsuario" id="NomUsuario" size="50" value="<?php echo $ObjAux->usuario ?>"></td>
                        <td rowspan="5"><div class="error" style="color: red;"></div></td>
                    </tr>
                    <tr>
                        <td><label>Contraseña:</label> </td>
                        <td><input type="password" name="PassUsuario" id="PassUsuario" size="50"></td>
                    </tr>
                    <tr>
                        <td><label>Repetir Contraseña:</label> </td>
                        <td><input type="password" name="Confirm_Pass" id="Confirm_Pass" size="50"></td>
                    </tr>
                    <tr>
                        <td><label>Correo De Usuario:</label> </td>
                        <td><input type="text" name="EmailUsuario" id="EmailUsuario" size="50" value="<?php echo $ObjAux->mail ?>"></td>
                    </tr>
                    <tr>
                         <td align="center"><input class="submit-green" name="BtnGuardar" type="submit" value="Guardar" /> </td>
                         <td align="center"><input class="submit-green" name="BtnCancelar" type="submit" value="Cancelar" /> </td>
                    </tr>
                </table>
    <?php

    return "";
}

function verGrilla()
{
    ?>

            <div class="module">
            <h2><span>Usuarios Registrados</span></h2>
            <div class="module-table-body">
                            <table id="myTable" class="tablesorter" cellpadding="0" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width:10%">Usuario</th>
                                    <th style="width:50%">Mail</th>
                                    <th style="width:10%"></th>
                                    <th style="width:10%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $tablaconsulta = DAOFactory::getUsuarioDAO()->queryAllOrderBy('id');
                                for($fila=0;$fila<count($tablaconsulta);$fila ++)
                                {
                                    ?>
                                        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" id ="<?php echo 'Sel'.$fila?>">
                                    <?php
                                        $row = $tablaconsulta[$fila];
                                        echo "<tr><td>"."<input type='hidden' name ='Id' value='".$row->id."'>".$row->usuario."</td>";
                                        echo "<td>".$row->mail."</td>";
                                        echo "<td><input class='submit-green' type='submit' name='BtnUpdate' value='Modificar' /></td>";
                                        if ($fila == 0) echo '<td></td>';
                                        else echo "<td>".isDisabled()."</td>";
                                        echo "</tr>"
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
    $tabla = DAOFactory::getUsuarioDAO()->queryAllOrderBy('id');

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
    if($_POST['NomUsuario']=='')
    {
        $error_msg = $error_msg.'Falta el Nombre de Usuario<br>';
    }

    if($_POST['PassUsuario']=='')
    {
        $error_msg = $error_msg . 'Falta Contraseña<br>';
    }

    if($_POST['EmailUsuario']=='')
    {
        $error_msg = $error_msg . 'Falta Correo Electonico<br>';
    }

    if($error_msg == '')
    {
        $seccion = new Usuario();
        $seccion->usuario=$_POST['NomUsuario'];
        $seccion->clave=$_POST['PassUsuario'];
        $seccion->mail=$_POST['EmailUsuario'];
        DAOFactory::getUsuarioDAO()->insert($seccion);
        if($seccion->id > $ultimo)
        {
            echo '<span class="notification n-success">Usuario Guardado.</span>';
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
    if($_POST['NomUsuario']=='')
    {
        $error_msg = $error_msg.'Falta el Nombre de Usuario<br>';
    }

    if($_POST['PassUsuario']=='')
    {
        $error_msg = $error_msg . 'Falta Contraseña<br>';
    }

    if($_POST['EmailUsuario']=='')
    {
        $error_msg = $error_msg . 'Falta Correo Electonico<br>';
    }

    if($error_msg == '')
    {
        $seccion = new Usuario();
        $seccion->id = $int;
        $seccion->usuario=$_POST['NomUsuario'];
        $seccion->clave=$_POST['PassUsuario'];
        $seccion->mail=$_POST['EmailUsuario'];
        DAOFactory::getUsuarioDAO()->update($seccion);
        echo '<span class="notification n-success">Usuario Actualizado.</span>';
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
    echo '<span class="notification n-success">Usuario Eliminado.</span>';
    return "";
}
?>
