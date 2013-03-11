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


        $(document).ready(function(){	
                // validate the comment form when it is submitted
                $("#FrmProductos").validate({

                    rules: {
                        cboCategoria:"required",
                        txtNomProEsp:"required",
                        txtNomProIng:"required",
                        txtPrecio: {
                            required:true,
                            minlength:3,
                            maxlength:6,
                            number:true
                        },
                        txtProdEsp:"required",
                        txtProdIng:"required",
                        imgproducto:"required"
                    },
                    messages:{
                        cboCategoria:"Debe seleccionar Categoria<br>",
                        txtNomProEsp:"Se necesita nombre en Español<br>",
                        txtNomProIng:"Se necesita nombre en Ingles<br>",
                        txtPrecio:"Se necesita el precio<br>",
                        txtProdEsp:"Se necesita la descripcion corta en Español<br>",
                        txtProdIng:"Se necesita la descripcion corta en Ingles<br>",
                        imgproducto:"Necesita una Imagen para Cargar<br>"
                    },
                    errorLabelContainer:$("#FrmProductos div.error")
                });
                
            $("#FrmProductos").submit(function(){
                parent.fancyBoxClose();
            });


        });
        
 
        
        function closeME() {
            event.preventDefault();
            parent.$.fancybox.close();
            $('#FrmProductos').submit();
        }
 
    </script>

    <?php
   
    //Se determina el Tipo de producto 
    $idTipoProducto  = $_SESSION['idTipoProducto'];
    $objTipoProducto = DAOFactory::getTipoProductoDAO()->load($idTipoProducto);
    
    //Variables Generales
    $oContenido   = new Contenido();
    
    $action = null;
    
    if(isComandCreate())
    {
        //Action To Execute When do POST 
        $action = 'insert';
        
        $oContenido->id = 0;
        $oContenido->idLista=0;
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
        
            <form action="Contenido.php" method="post" enctype="multipart/form-data" id="FrmProductos">
                <div class="tituloAdmin">Contenido</div>
                <input type="hidden" value="<?php echo $action;?>" id="execute" name="execute" />
                <input type="hidden" value="<?php echo $oContenido->id;?>" id="Idcontenido" name="Idcontenido" />
                <input type="hidden" value="#" name="TxtContIng" />
                <input type="hidden" value="#" name="TxtNameIng" />
    
            <table id="tabla" cellpadding="0" cellspacing="0" width="100%">
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
                    <tr>
                        <td colspan="3">
                            <div class="error"></div>
                        </td>
                    </tr>


            </table>
            </form>

    </div>
