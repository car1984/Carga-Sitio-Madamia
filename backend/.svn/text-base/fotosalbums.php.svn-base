<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../include_dao.php');
require_once('funciones.php');
if ( !isset($_SESSION['username']) && !isset($_SESSION['userid']) )
{
    header('Location: ./');
}
else
{
    Cabecera('Albums');
?>
<script type="text/javascript">

   $(document).ready(function () {
       $("a#em4c").click(function () {
        // a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
        $( "#dialog:ui-dialog" ).dialog("destroy");

        $("#dialog-modal").dialog({
                height: 350,
                width:700,
                modal: true /*,
                buttons:
                    {
                    Cancel: function() {
                        $( this ).dialog( "close" );
                        }
                    },
                close: function() {
                allFields.val( "" ).removeClass( "ui-state-error" );
        }*/

        });
      });
   });

   $(function(){
       $("#dialog-modal").css("display","none");
   });

   $().ready(function() {
            // validate the comment form when it is submitted
            $("#FrmAlbums").validate({

                rules: {
                    nomAlbumesp:"required",
                    nomAlbuming:"required"
                },
                messages:{
                    nomAlbumesp:"Se necesita el Nombre en Español<br>",
                    nomAlbuming:"Se nececita el Nombre en Ingles<br>"
                },
                errorLabelContainer:$("#FrmAlbums div.error")
            });
    });
</script>
<?php
    if($_GET)
    {
        if($_GET['id']!='')
        {
            $albumid = $_GET['id'];
            $albummodifica=DAOFactory::getAlbumDAO()->load($albumid);

            if($albummodifica)
            {
                $listaFotos = DAOFactory::getFotoDAO()->queryByIdAlbun($albumid);
                pintaformulario($albummodifica, $albumid, $listaFotos);
            }
            else
            {
                echo '<span class="notification n-error">No existe Album</span>';
            }
        }
    }
    elseif($_POST)
    {
        if(!isset($_POST['nomAlbumesp']) && !isset($_POST['nomAlbuming']) && !isset($_POST['hidalbum']))
        {

        }
        else
        {
            $albumid = $_POST['hidalbum'];
            $albummodifica=DAOFactory::getAlbumDAO()->load($albumid);
            if($albummodifica)
            {
                 echo '<span class="notification n-success">hay Acceso a esta pagina para modificar</span>';
                 $Album = new Album();
                 $Album->id = $albumid;
                 $Album->nombreEsp = $_POST['nomAlbumesp'];
                 $Album->nombreIng = $_POST['nomAlbuming'];

                 DAOFactory::getAlbumDAO()->update($Album);
                 $listaFotos = DAOFactory::getFotoDAO()->queryByIdAlbun($albumid);
                 pintaformulario($Album, $albumid, $listaFotos);
            }
        }
    }
    else
    {
        echo '<span class="notification n-error">No hay Acceso a esta pagina </span>';
    }

//    pie();
//}

function pintaformulario($objetoAlbum, $albumid, $listaFotos)
{
?>
        <div style="width: 100%;">
            <ul id="menuSuperior">
                <li><a href ="#">Secciones</a></li>
                <li><a href ="<?php echo $_SERVER['PHP_SELF']?>">Albums y Fotos</a></li>
            </ul>
        </div>
        <p>&nbsp;</p>
        <div>
            <fieldset>
                <legend>Seccion Albums y Fotos</legend>
                <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" id ="FrmAlbums">
                    <table id="tabla" cellpadding="0" cellspacing="0" width="100%" border="0">
                        <tr>
                            <td valign="top" width="35%" ><label>Nombre del Album en Español:</label><br>
                                <input type="text" name="nomAlbumesp" size="35" value="<?php echo $objetoAlbum->nombreEsp; ?>"></td>
                            <td valign="top" width="35%"><label>Nombre del Album en Ingles:</label> <br>
                                <input type="text" name="nomAlbuming" size="35" value="<?php echo $objetoAlbum->nombreIng; ?>"></td>
                            <td width="15%"><input class="submit-green" type="submit" value="Modificar" style="width:100px" /> </td>
                            <td width="15%"><input class="submit-gray" type="submit" value="Eliminar" style="width:100px"/> </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <div class="error"></div>
                                <input type="hidden" name="hidalbum" value="<?php echo $albumid;?>">
                            </td>
                        </tr>
                    </table>
                </form>
                <br>



                <a id="em4c" class="btnGuardar">Subir Imagen</a>
                <br>
                <div id="dialog-modal" title="Subir Imagenes">
                    <iframe class="Frmframe"  src="Fotos.php?id=<?php echo $albumid;?>" id="iframe" width="650" height="320">

                    </iframe>
                </div>
                <br>
                <div id="GrillaImagenesSubidas"><?php grillaImagenes($listaFotos); ?></div>

             </fieldset>
        </div>

    <?php
}
function grillaImagenes($listaFotos)
{
    if(count($listaFotos)>0)
    {
        ?>
         <div class="module">
                <h2><span>Albunes Disponibles</span></h2>
            <div class="module-table-body">
                <form action="">
                    <table id="myTable" class="tablesorter" cellpadding="0" cellspacing="0">
                   <thead>
                        <tr>
                            <th style="width:10%">IMAGEN</th>
                            <th style="width:40%">DESCRIPCION ESPAÑOL</th>
                            <th style="width:40%">DESCRIPCION INGLES</th>
                            <th style="width:10%" colspan="2">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for($i=0;$i<count($listaFotos);$i++)
                        {
                            $row = $listaFotos[$i];
                            echo'<tr>
                                        <td><img src="'.$row->imagen.'" alt="" width="100px"/></td>
                                        <td>'.$row->descripcionEsp.'</td>
                                        <td>'.$row->descripcionIng.'</td>
                                        <td align="center" valign="middle"><a id="Foto'.$row->id.'" class="btnAplicar" href="Allfotos.php?option=Edit&idfoto='.$row->id.'">&nbsp;</a></td>
                                        <td align="center" valign="baseline"><a class="bEliminar" href="#">&nbsp;</a></td>
                                    </tr>';
                        }
                       ?>
                      </tbody>
                </table>
                </form>
                <div class="pager" id="pager">
                    <form action="">
                        <div>
                        <img class="first" src="../resources/img/arrow-stop-180.gif" alt="first"/>
                        <img class="prev" src="../resources/img/arrow-180.gif"  alt="prev"/>
                        <input type="text" class="pagedisplay input-short align-center"/>
                        <img class="next" src="../resources/img/arrow.gif"  alt="next"/>
                        <img class="last" src="../resources/img/arrow-stop.gif"  alt="last"/>
                        <select class="pagesize input-short align-center">
                            <option value="10" selected="selected">10</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                            <option value="40">40</option>
                        </select>
                        </div>
                    </form>
                </div>
            </div>
         </div>
        <?php
    }
    return "";
    }
}
?>