<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../include_dao.php');
require_once('funciones.php');
//if ( !isset($_SESSION['username']) && !isset($_SESSION['userid']) )
//{
//    header('Location: ./');
//}
//else
//{
    Cabecera('FOTOS');
    ?>
    <script language="javascript" type="text/javascript">
        tinyMCE.init({
                mode : "textareas",
                theme : "simple"
        });

        $().ready(function() {
                // validate the comment form when it is submitted
                $("#frmUpdate").validate({

                    rules: {
                        DescripEsp:"required",
                        DescripIng:"required"
                    },
                    messages:{
                        DescripEsp:"Se necesita la Descripcion en Español<br>",
                        DescripIng:"Se necesita la Descripcion en Ingles"
                    },
                    errorLabelContainer:$("#frmUpdate div.error")
                });
        });
    </script>
    <?php
    if($_GET)
    {
        $validar=0;
        if($_GET['idfoto']=='')
        {
           $validar = 1;
        }
        if($_GET['option']!='Edit')
        {
            $validar=1;
        }

        if($validar==0)
        {
            $fotoconsulta=DAOFactory::getFotoDAO()->load($_GET['idfoto']);
            if($fotoconsulta)
            {
                ?>
                    <fieldset>
                    <legend>Modificar Descripción Fotos</legend>
                    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" id ="frmUpdate">
                        <table id="tabla" cellpadding="0" cellspacing="0" width="100%" border="0">
                            <tr>
                                <td valign="top" width="22%"><label>FOTO</label></td>
                                <td valign="top" width="34%"><label>Descripción en Español:</label></td>
                                <td valign="top" width="34%"><label>Descripción en Ingles:</label> </td>
                            </tr>
                            <tr>
                                <td rowspan="2" valign="top"><img src="<?php echo $fotoconsulta->imagen;?>" alt="" width="200px"></td>
                                <td valign="top"><textarea name="DescripEsp" rows="10" cols="30"><?php echo $fotoconsulta->descripcionEsp;?></textarea></td>
                                <td valign="top"><textarea name="DescripIng" rows="10" cols="30"><?php echo $fotoconsulta->descripcionIng;?></textarea></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center"><br><input class="submit-green" type="submit" value="Actualizar" style="width:100px" />
                                <input type="hidden" name="hidAlbum" value="<?php echo  $fotoconsulta->idAlbun;?>">
                                <input type="hidden" name="hidFoto" value="<?php echo  $fotoconsulta->id;?>">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <div class="error"></div>
                                </td>
                            </tr>
                        </table>
                    </form>
                </fieldset>
                <?php
            }
        }
        else
        {
            echo '<span class="notification n-error">No se puede mostrar pagina solicitada.</span>';
        }
    }
    elseif($_POST)
    {
        $error='';

        if($_POST['DescripEsp']=='')
        {
            $error=$error.'Se necesita la descripción en Español<br>';
        }

        if($_POST['DescripIng']=='')
        {
            $error=$error.'Se necesita la descripción en Ingles<br>';
        }
        if($error=='')
        {
            $Foto = new Foto();
            $Foto->idAlbun = $_POST['hidAlbum'];
            $Foto->id=$_POST['hidFoto'];
            //$Foto->imagen = $destination.$nombre_archivo;
            $Foto->descripcionEsp = $_POST['DescripEsp'];
            $Foto->descripcionIng = $_POST['DescripIng'];

            $resultado = DAOFactory::getFotoDAO()->update($Foto);
            if($resultado>0)
            {
                 echo '<span class="notification n-success">Descripciones Modificadas</span><br>';
                 echo '<div style="text-align: center; margin: 10px 10px 10px 10px; padding:10px">
                     <a href="fotosalbums.php?id='.$_POST['hidAlbum'].'" class="btnAplicar">Ir al Album</a>
                         </div><br>';
            }
        }
        else
        {
            echo '<span class="notification n-error">'.$error.'</span>';
        }
    }
    else
    {
        echo '<span class="notification n-error">No se puede mostrar pagina solicitada.</span>';
    }
    pie();
//}
?>
