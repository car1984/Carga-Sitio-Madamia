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
    Cabecera('Contenidos');
    ?>
    <script type="text/javascript">
        
tinyMCE.init({
        // General options
        mode : "textareas",
        theme : "advanced",
        plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

        // Theme options
        theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,link,unlink,anchor,image,cleanup,help,code",
        theme_advanced_buttons2 : "styleselect,formatselect,fontselect,fontsizeselect",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing :true,

        // Skin options
        skin : "o2k7",
        skin_variant : "silver"

      
});


        $().ready(function() {
                // validate the comment form when it is submitted
                $("#FrmSeccion").validate({

                    rules: {
                        TxtNameEsp:"required",
                        TxtNameIng:"required",
                        TxtContEsp:"required",
                        TxtContIng:"required"
                    },
                    messages:{
                        TxtNameEsp:"Falta Nombre En Español",
                        TxtNameIng:"Falta Nombre En Ingles",
                        TxtContEsp:"Falta Contenido En Español",
                        TxtContIng:"Falta Contenido En Ingles"
                    },
                    errorLabelContainer:$("#FrmSeccion div.error")
                });
        });
    </script>
    <p>&nbsp;</p>
    <div>
        <fieldset>
            <legend>Contenidos</legend>
            
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
                        if(isset ($_POST['BtnEnviar'])) Formulario(0);
                    }
                    else
                    {
                        Formulario(0);
                    }
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
        $ObjAux = new Contenido();
        $ObjAux->albumId='';
        if(!isset ($_POST['BtnEnviar']))
        {    
            $ObjAux->id = $aux;
            $ObjAux->idLista=0;
            $ObjAux->nombreEsp='';
            $ObjAux->nombreIng='';
            $ObjAux->contenidoEsp='';
            $ObjAux->contenidoIng='';
            $ObjAux->urlGoogleMaps='';
            
        }
        else
        {
            $ObjAux->id = $_POST['TxtAux'];
            $ObjAux->idLista=$_POST['ListContenido'];
            $ObjAux->nombreEsp=$_POST['TxtNameEsp'];
            $ObjAux->nombreIng=$_POST['TxtNameIng'];
            $ObjAux->contenidoEsp=$_POST['TxtContEsp'];
            $ObjAux->contenidoIng=$_POST['TxtContIng'];
            $ObjAux->urlGoogleMaps=$_POST['TxtGoogleMaps'];
        }
    }
    else
    {
        $ObjAux = DAOFactory::getContenidoDAO()->load($aux);
    }

    ?>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" id ="FrmLista">
            <table id="tabla" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td width="80%" colspan="2">
                            <input type="hidden" name ="TxtAux" value="<?php echo $ObjAux->id ?>">
                            <label>Lista De Contenido:</label><br />
                            <select name="ListContenido" id="ListContenido">
                                <?php ComboLista($ObjAux->idLista); ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td width="40%">
                            <label>Nombre En Español:</label><br />
                            <input type="text" name="TxtNameEsp" size="50" value="<?php echo $ObjAux->nombreEsp ?>">
                        </td>
                        <td width="40%">
                            <label>Nombre En Ingles:</label><br />
                            <input type="text" name="TxtNameIng" size="50" value="<?php echo $ObjAux->nombreIng ?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label>Contenido En Español:</label><br />
                            <textarea name="TxtContEsp" id="TxtContEsp" cols="90" rows="20"><?php echo $ObjAux->contenidoEsp ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label>Contenido En Ingles:</label><br />
                            <textarea name="TxtContIng" id="TxtContIng" cols="90" rows="20"><?php echo $ObjAux->contenidoIng ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label>HTML Google Maps:</label><br />
                            <textarea name="TxtGoogleMaps" id="TxtGoogleMaps" cols="50" rows="20"><?php echo $ObjAux->urlGoogleMaps ?></textarea>
                            
                        </td>
                    </tr>
                    <?php
                        if(!isset ($_POST['BtnEnviar']))
                        {
                        ?>
                            <tr>
                                <td colspan="2" align="left">
                                    <br></br>
                                    <input class="submit-green" name="BtnEnviar" type="submit" value="Enviar" /> 
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                     <?php
                    if(isset ($_POST['BtnEnviar']))
                    {
                        $Opc =DAOFactory::getListaContenidoDAO()->load($_POST['ListContenido']);
                        if($Opc->fotos==1)
                        {
                    ?>
                                <tr>
                                    <td colspan="2">
                                        <label>Album A Mostrar:</label><br />
                                        <?php echo $ObjAux->albumId; ?>
                                        <select name="ListAlbum" id="ListAlbum">
                                            <?php
                                                $idAlbum = DAOFactory::getContenidoDAO()->load($ObjAux->id)->albumId;
                                                ComboAlbum($idAlbum); 
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                    <?php
                        }
                    ?>
                                <tr>
                                    <td width="50%" align="center"><input class="submit-green" name="BtnGuardar" type="submit" value="Guardar" /> </td>
                                    <td width="50%" align="center"><input class="submit-green" name="BtnCancelar" type="submit" value="Cancelar" /> </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <div class="error"></div>
                                    </td>
                                </tr>
                    <?php
                    }
                    ?>
            </table>
        </form>
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
                                    <th style="width:10%">Lista De Contenido</th>
                                    <th style="width:35%">Nombre Español</th>
                                    <th style="width:35%">Nombre Ingles</th>
                                    <th style="width:10%">Editar</th>
                                    <th style="width:10%">Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $tablaconsulta = DAOFactory::getContenidoDAO()->queryAllOrderBy('idLista');
                                for($fila=0;$fila<count($tablaconsulta);$fila ++)
                                {
                                    ?>
                                        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" id ="<?php echo 'Sel'.$fila?>">
                                    <?php
                                        $row = $tablaconsulta[$fila];
                                        echo "<tr><td>"."<input type='hidden' name ='Id' value='".$row->id."'>".DAOFactory::getListaContenidoDAO()->load($row->idLista)->nombre."</td>";
                                        echo "<td>".$row->nombreEsp."</td>";
                                        echo "<td>".$row->nombreIng."</td>";
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
    $tabla = DAOFactory::getContenidoDAO()->queryAllOrderBy('id');

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
    if($_POST['TxtNameEsp']=='')
    {
        $error_msg = $error_msg.'Falta el Nombre En Español<br>';
    }
    if($_POST['TxtNameIng']=='')
    {
        $error_msg = $error_msg.'Falta el Nombre En Ingles<br>';
    }

    if($_POST['TxtContEsp']=='')
    {
        $error_msg = $error_msg.'Falta el Contenido En Español<br>';
    }
    if($_POST['TxtContIng']=='')
    {
        $error_msg = $error_msg.'Falta el Contenido En Ingles<br>';
    }

    if($error_msg == '')
    {
        $seccion = new Contenido();
        $seccion->nombreEsp=$_POST['TxtNameEsp'];
        $seccion->nombreIng=$_POST['TxtNameIng'];
        $seccion->contenidoEsp=$_POST['TxtContEsp'];
        $seccion->contenidoIng=$_POST['TxtContIng'];
        $seccion->idLista=$_POST['ListContenido'];
        $seccion->urlGoogleMaps=$_POST['TxtGoogleMaps'];
        if (isset ($_POST['ListAlbum'])) $seccion->albumId=$_POST['ListAlbum'];
        else $seccion->albumId = NULL;
        DAOFactory::getContenidoDAO()->insert($seccion);
        if($seccion->id > $ultimo)
        {
            echo '<span class="notification n-success">Contenido Guardado.</span>';
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

    if($_POST['TxtNameEsp']=='')
    {
        $error_msg = $error_msg.'Falta el Nombre En Español<br>';
    }
    if($_POST['TxtNameIng']=='')
    {
        $error_msg = $error_msg.'Falta el Nombre En Ingles<br>';
    }

    if($_POST['TxtContEsp']=='')
    {
        $error_msg = $error_msg.'Falta el Contenido En Español<br>';
    }
    if($_POST['TxtContIng']=='')
    {
        $error_msg = $error_msg.'Falta el Contenido En Ingles<br>';
    }

    if($error_msg == '')
    {
        $seccion = new Contenido();
        $seccion->id=$int;
        $seccion->nombreEsp=$_POST['TxtNameEsp'];
        $seccion->nombreIng=$_POST['TxtNameIng'];
        $seccion->contenidoEsp=$_POST['TxtContEsp'];
        $seccion->contenidoIng=$_POST['TxtContIng'];
        $seccion->idLista=$_POST['ListContenido'];
        $seccion->urlGoogleMaps=$_POST['TxtGoogleMaps'];
        if (isset ($_POST['ListAlbum'])) $seccion->albumId=$_POST['ListAlbum'];
        else $seccion->albumId = NULL;
        DAOFactory::getContenidoDAO()->update($seccion);
        echo '<span class="notification n-success">Lista Actualizada.</span>';
    }
    else
    {
        echo '<span class="notification n-error">'.$error_msg.'</span>';
    }
    return "";

}

function DeleteInfo($int)
{
    DAOFactory::getContenidoDAO()->delete($int);
    echo '<span class="notification n-success">Contenido Eliminado.</span>';
    return "";
}

?>
