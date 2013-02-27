<?php
require_once('../include_dao.php');
require_once('funciones.php');
if ( !isset($_SESSION['username']) && !isset($_SESSION['userid']) )
{
    header('Location: ./');
}
else
{
    Cabecera('Eventos');
    ?>
    <script type="text/javascript">
        $().ready(function() {
                // validate the comment form when it is submitted
                $("#FrmSeccion").validate({

                    rules: {
                        DesEspanol:"required",
                        DesIngles:"required",
                        TxtEspanol:"required",
                        TxtIngles:"required",
                        FechaIni:"required",
                        FechaFin:"required"
                    },
                    messages:{
                        DesEspanol:"Falta La Descipcion En Español",
                        DesIngles:"Falta La Descipcion En Ingles",
                        TxtEspanol:"Falta El Titulo En Español",
                        TxtIngles:"Falta El Titulo En Ingles",
                        FechaIni:"Falta La Fecha Inicial",
                        FechaFin:"Falta La Fecha Final"
                    },
                    errorLabelContainer:$("#FrmSeccion div.error")
                });
        });
    </script>
    <p>&nbsp;</p>
    <div>
        <fieldset>
            <legend>Calendario</legend>
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
        $ObjAux = new Celendario();
        $ObjAux->id = $aux;
        $ObjAux->descripcionEsp='';
        $ObjAux->descripcionIng='';
        $ObjAux->tituloEsp='';
        $ObjAux->tituloIng='';
        $ObjAux->fechaInicial='';
        $ObjAux->fechaFinal='';
        $ObjAux->horaInical='';
        $ObjAux->horaFinal='';
        $ObjAux->idSeccion='';
    }
    else
    {
        $ObjAux = DAOFactory::getCelendarioDAO()->load($aux);
    }
    
    ?>
                <table id="tabla" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name ="TxtAux" value="<?php echo $ObjAux->id ?>">
                            <label>Tipo Seccion</label><br />
                            <select name="ListSeccion" id="ListSeccion">
                                <?php ComboSeccion($ObjAux->idSeccion); ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td width="50%">
                            <label>Titulo Español:</label><br />
                            <input type="text" name="TxtEspanol" size="50" value="<?php echo $ObjAux->tituloEsp ?>">
                        </td>
                        <td width="50%">
                            <label>Titulo Ingles:</label><br />
                            <input type="text" name="TxtIngles" size="50" value="<?php echo $ObjAux->tituloIng ?>">
                        </td>
                    </tr>
                    <tr>
                        <td width="50%">
                            <label>Descripcion Español:</label><br />
                            <input type="text" name="DesEspanol" size="70" value="<?php echo $ObjAux->descripcionEsp ?>">
                        </td>
                        <td width="50%">
                            <label>Descripcion Ingles:</label><br />
                            <input type="text" name="DesIngles" size="70" value="<?php echo $ObjAux->descripcionIng ?>">
                        </td>
                    </tr>
                    <tr>
                        <td width="50%">
                            <label>Fecha Inicial:</label><br />
                            <input type="text" id="FechaIni" name="FechaIni" size="20" value="<?php echo $ObjAux->fechaInicial." ".$ObjAux->horaInical ?>">
                            <img src="../resources/img/images2/cal.gif" onclick='NewCssCal("FechaIni","yyyyMMdd","arrow",true,24,false);' style="cursor:pointer"/>
                            
                        </td>
                        <td width="50%">
                            <label>Facha Final:</label><br />
                            <input type="text" id="FechaFin" name="FechaFin" size="20" value="<?php echo $ObjAux->fechaFinal." ".$ObjAux->horaFinal ?>">
                            <img src="../resources/img/images2/cal.gif" onclick='NewCssCal("FechaFin","yyyyMMdd","arrow",true,24,false);' style="cursor:pointer"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="center"><input class="submit-green" name="BtnGuardar" type="submit" value="Guardar" /> </td>
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

function verGrillaSeccion()
{
    ?>

    <div class="module">
                <h2><span>Secciones Registradas</span></h2>
            <div class="module-table-body">
                            <table id="myTable" class="tablesorter" cellpadding="0" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width:30%">Titulo Español</th>
                                    <th style="width:30%">Titulo Ingles</th>
                                    <th style="width:20%">Duracion</th>
                                    <th style="width:10%"></th>
                                    <th style="width:10%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $tablaconsulta = DAOFactory::getCelendarioDAO()->queryAllOrderBy('id');
                                for($fila=0;$fila<count($tablaconsulta);$fila ++)
                                {
                                    ?>
                                        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" id ="<?php echo 'Sel'.$fila?>">    
                                    <?php
                                        $row = $tablaconsulta[$fila];
                                        echo "<tr><td>"."<input type='hidden' name ='Id' value='".$row->id."'>".$row->tituloEsp."</td>";
                                        echo "<td>".$row->tituloIng."</td>";
                                        echo "<td>".$row->fechaInicial." ".$row->horaInical." - ".$row->fechaFinal." ".$row->horaFinal."</td>";
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

function ComboSeccion($aux)
{

    $tablaconsulta = DAOFactory::getSeccionDAO()->queryByTipoSeccion(1);
    for($fila=0;$fila<count($tablaconsulta);$fila ++)
    {
        $row = $tablaconsulta[$fila];
        if ($row->id==$aux) echo "<option value='".$row->id."' SELECTED >".$row->nombre."</option>";
        else echo "<option value='".$row->id."'>".$row->nombre."</option>";
    }
    return "";
}

function GuardarInfo()
{
    $tabla = DAOFactory::getCelendarioDAO()->queryAllOrderBy('id');

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

    if($_POST['DesEspanol']=='')
    {
        $error_msg = $error_msg.'Falta la Descripcion En Español<br>';
    }
    if($_POST['DesIngles']=='')
    {
        $error_msg = $error_msg.'Falta la Descripcion En Ingles<br>';
    }
    if($_POST['TxtEspanol']=='')
    {
        $error_msg = $error_msg.'Falta El Titulo En Español<br>';
    }
    if($_POST['TxtIngles']=='')
    {
        $error_msg = $error_msg.'Falta El Tiulo En Ingles<br>';
    }
    if($_POST['FechaIni']=='')
    {
        $error_msg = $error_msg.'Falta la Fecha Inicial<br>';
    }
    if($_POST['FechaFin']=='')
    {
        $error_msg = $error_msg.'Falta la Fecha Final<br>';
    }
    
    if($_POST['FechaIni']!='' && $_POST['FechaFin']!='')
    {
        $DateIni = DateTime::createFromFormat("Y-m-d H:i",$_POST['FechaIni']);
        $DateFin = DateTime::createFromFormat("Y-m-d H:i",$_POST['FechaFin']);
        if ($DateFin<$DateIni)
        {
            $error_msg = $error_msg.'La Fecha Final No Puede Ser Menor A La Fecha De Inicio<br>';
        }
    }
    
    if($error_msg == '')
    {
        $ObjAux = new Celendario();
        $ObjAux->descripcionEsp=$_POST['DesEspanol'];
        $ObjAux->descripcionIng=$_POST['DesIngles'];
        $ObjAux->tituloEsp=$_POST['TxtEspanol'];
        $ObjAux->tituloIng=$_POST['TxtIngles'];
        $ObjAux->fechaInicial=substr($_POST['FechaIni'], 0, 10);
        $ObjAux->fechaFinal=substr($_POST['FechaFin'], 0, 10);
        $ObjAux->horaInical=substr($_POST['FechaIni'], 12);
        $ObjAux->horaFinal=substr($_POST['FechaFin'], 12);
        $ObjAux->idSeccion=$_POST['ListSeccion'];
        DAOFactory::getCelendarioDAO()->insert($ObjAux);
        if($ObjAux->id > $ultimo)
        {
            echo '<span class="notification n-success">Evento Guardado.</span>';
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

    if($_POST['DesEspanol']=='')
    {
        $error_msg = $error_msg.'Falta la Descripcion En Español<br>';
    }
    if($_POST['DesIngles']=='')
    {
        $error_msg = $error_msg.'Falta la Descripcion En Ingles<br>';
    }
    if($_POST['TxtEspanol']=='')
    {
        $error_msg = $error_msg.'Falta El Titulo En Español<br>';
    }
    if($_POST['TxtIngles']=='')
    {
        $error_msg = $error_msg.'Falta El Tiulo En Ingles<br>';
    }
    if($_POST['FechaIni']=='')
    {
        $error_msg = $error_msg.'Falta la Fecha Inicial<br>';
    }
    if($_POST['FechaFin']=='')
    {
        $error_msg = $error_msg.'Falta la Fecha Final<br>';
    }
    
    if($_POST['FechaIni']!='' && $_POST['FechaFin']=='')
    {
        $DateIni = DateTime::createFromFormat("Y-m-d H:i",$_POST['FechaIni']);
        $DateFin = DateTime::createFromFormat("Y-m-d H:i",$_POST['FechaFin']);
        if ($DateFin<$DateIni)
        {
            $error_msg = $error_msg.'La Fecha Final No Puede Ser Menor A La Fecha De Inicio<br>';
        }
    }
    
    if($error_msg == '')
    {
        $ObjAux = new Celendario();
        $ObjAux = $int;
        $ObjAux->descripcionEsp=$_POST['DesEspanol'];
        $ObjAux->descripcionIng=$_POST['DesIngles'];
        $ObjAux->tituloEsp=$_POST['TxtEspanol'];
        $ObjAux->tituloIng=$_POST['TxtIngles'];
        $ObjAux->fechaInicial=substr($_POST['FechaIni'], 0, 10);
        $ObjAux->fechaFinal=substr($_POST['FechaFin'], 0, 10);
        $ObjAux->horaInical=substr($_POST['FechaIni'], 12);
        $ObjAux->horaFinal=substr($_POST['FechaFin'], 12);
        $ObjAux->idSeccion=$_POST['ListSeccion'];
        DAOFactory::getCelendarioDAO()->update($ObjAux);
        echo '<span class="notification n-success">Evento Actualizado.</span>';
    }
    else
    {
        echo '<span class="notification n-error">'.$error_msg.'</span>';
    }
    return "";
    
}

function DeleteInfo($int)
{
    DAOFactory::getCelendarioDAO()->delete($int);
    echo '<span class="notification n-success">Evento Eliminada.</span>';
    return "";
}
?>