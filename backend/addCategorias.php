<?php
require_once('../include_dao.php');
require_once('funciones.php');

if ( !isset($_SESSION['username']) && !isset($_SESSION['userid']) )
{
    header('Location: ./');
}
else
{
    Cabecera('Gestion de Categorias');
    ?>

    <script language="javascript" type="text/javascript">

        $().ready(function() {
                // validate the comment form when it is submitted
                $("#FrmCategoria").validate({

                    rules: {
                        txtCateesp:"required",
                        txtCateing:"required"
                    },
                    messages:{
                        txtCateesp:"Se necesita el nombre en Español<br>",
                        txtCateing:"Se necesita el nombre en Ingles"
                    },
                    errorLabelContainer:$("#FrmCategoria div.error")
                });
        });
    </script>

    <div>
        <fieldset>
            <legend>Seccion Categorias</legend>
            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" id ="FrmCategoria">
                <table id="tabla" cellpadding="0" cellspacing="0" width="100%" border="1">
                    <tr>
                        <td width="40%"><label>Nombre de Categoria en Español:</label><br>
                            <input type="text" name="txtCateesp" size="50"></td>
                        <td width="40%"><label>Nombre de Categoria en Ingles:</label> <br>
                            <input type="text" name="txtCateing" size="50"></td>
                        <td><input class="submit-green" type="submit" value="Crear" style="width: 100px;" /> </td>
                        <td><input class="submit-gray" type="reset" value="Cancelar" style="width: 100px;" /> </td>
                    </tr>

                    <tr>
                        <td colspan="4">
                            <div class="error"></div>
                        </td>
                    </tr>
                </table>
            </form>
            <div id="contenido">
            <?php
            if ($_POST)
            {
                $tabla = DAOFactory::getCategoriaDAO()->queryAllOrderBy('id');

                if(count($tabla)>0)
                {
                    $row = $tabla[count($tabla)-1];
                    $ultimaCategoria = $row->id;
                }
                else
                {
                    $ultimaCategoria=0;
                }

                $error_msg = '';
                if($_POST['txtCateesp']=='')
                {
                    $error_msg = $error_msg.'Falta el Nombre de categoria en Español<br>';
                }

                if($_POST['txtCateing']=='')
                {
                    $error_msg = $error_msg . 'Falta el Nombre de categoria en Ingles<br>';
                }

                if($error_msg == '')
                {
                    $categoria = new Categoria();
                    $arr = DAOFactory::getCategoriaDAO()->queryByTituloEsp($_POST['txtCateesp']);
                    if($arr)
                    {

                    }
                    else
                    {
                        $categoria->tituloEsp=$_POST['txtCateesp'];
                        $categoria->tituloIng=$_POST['txtCateing'];
                        DAOFactory::getCategoriaDAO()->insert($categoria);
                        if($categoria->id > $ultimaCategoria)
                        {
                            echo '<span class="notification n-success">Categoria Creada con Exito.</span>';
                            //$nombredirectorio = '../resources/img_cms/albums/ALBUM'.$album->id;
                            //mkdir($nombredirectorio, 0775);
                        }
                    }
                }
                else
                {
                    echo '<span class="notification n-error">'.$error_msg.'</span>';
                }
            }
            elseif ($_GET)
            {

            }else
            {
               
            }
            ?>
            </div>
        </fieldset>
    </div>

    <?php
    pie();
}
?>