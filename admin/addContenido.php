<?php
require_once '../global/include.php';
require_once('funciones.php');	

ini_set("display_errors", $DISPLAY_ERROR);


    Cabecera('Productos');
    ?>
    <script language="javascript" type="text/javascript">
        tinyMCE.init({
                mode : "textareas",
                theme : "advanced",
                theme_advanced_buttons1 : "bold, italic, underline, separator, justifyleft, justifycenter, justifyright, justifyfull,|,formatselect,fontselect,fontsizeselect ",
                theme_advanced_buttons2 : "bullist,numlist,separator,outdent,indent,separator,undo,redo",
                theme_advanced_toolbar_location: "top",
                theme_advanced_toolbar_align: "left"
        });


        $().ready(function() {
            // validate the comment form when it is submitted
            $("#FrmContenido").validate({

                rules: {
                    TxtNameEsp:"required",
                    TxtContEsp:"required"
                },
                messages:{
                    TxtNameEsp:"Falta Diligenciar el Nombre En Español. <br>",
                    TxtContEsp:"Falta Diligenciar el Contenido En Español"
                },
                errorLabelContainer:$("#FrmContenido div.error")
                
                
            });
        });
                            
 
        
        function closeME() {
            if ($("#FrmContenido").valid()){
                event.preventDefault();
                parent.$.fancybox.close();
                $('#FrmContenido').submit();
            }else{
                
                var div = document.getElementById('error');
                div.style.visibility = 'visible';
            }
        }
 
 

    </script>

    <?php
    
    //Variables Generales
    $oContenido   = new Contenido();
    
    $action = null;
    
    if(isComandCreate())
    {
        //Action To Execute When do POST 
        $action = 'insert';
        
        $oContenido->id = 0;
        $oContenido->idLista= $_SESSION['idListaContenido'];
        $oContenido->albumId=0;
        $oContenido->nombreEsp='';
        $oContenido->nombreIng='';
        $oContenido->contenidoEsp='';
        $oContenido->contenidoIng='';
        $oContenido->urlGoogleMaps='';
    }
    else
    {
        //Action To Execute When do POST 
        $action = 'update';
        
        $oContenido=DAOFactory::getContenidoDAO()->load($_GET['Id']);
    }
    
    ?>
    
    <div>
        
            <form action="Contenido.php" method="post" enctype="multipart/form-data" id="FrmContenido">
                <div class="tituloAdmin">Contenido</div>
                <input type="hidden" value="<?php echo $action;?>" id="execute" name="execute" />
                <input type="hidden" value="<?php echo $oContenido->id;?>" id="Idcontenido" name="Idcontenido" />
                <input type="hidden" value="<?php echo $oContenido->albumId;?>" id="IdALbum" name="IdALbum" />
                <input type="hidden" value="#" name="TxtContIng" />
                <input type="hidden" value="#" name="TxtNameIng" />
            <table id="tabla" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td colspan="3"><br />
                            <div id="error" class="error" style="background-color: #ffc6ca;
                                                                  border-color: #efb9c3;
                                                                  border-style: solid solid solid solid;
                                                                  border-width: 2px;
                                                                  padding: 5px;
                                                                  visibility:hidden;"></div>
                        </td>
                    </tr>
                    <tr>
                        <td >
                            <input type="hidden" name ="TxtAux" value="<?php echo $oContenido->id ?>">
                            <br /><label>Lista De Contenido:</label>
                            <select name="ListContenido" id="ListContenido">
                                <?php ComboLista($oContenido->idLista); ?>
                            </select>
                        </td>
                        <td >
                            <br /><label>Nombre:</label>
                            <input type="text" name="TxtNameEsp" size="50" value="<?php echo $oContenido->nombreEsp ?>">
                        </td>
                    </tr>
                    <tr>
                        <td >
                            <br /><label>Contenido:</label><br />
                            <textarea name="TxtContEsp" id="TxtContEsp" cols="90" rows="20"><?php echo $oContenido->contenidoEsp ?></textarea>
                        </td>
                        <td >
                            <br /><label>HTML Google Maps:</label><br />
                            <textarea name="TxtGoogleMaps" id="TxtGoogleMaps" cols="10" rows="20"><?php echo $oContenido->urlGoogleMaps ?></textarea>
                            
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="right"> <br>

                            <button class="BtnGuardar" onclick="closeME();">
                                <span></span>
                            </button>
                        </td>
                    </tr>

            </table>
            </form>

    </div>
