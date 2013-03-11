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
        
        
        
        function removeElement(divNum) {
          
          var d = document.getElementById('myDivAdd');
          d.removeChild(divNum);
        }
        
        function addPrecio() {
          var ni = document.getElementById('myDivAdd');
          var numi = document.getElementById('theValue');
          var num = (document.getElementById('theValue').value -1)+ 2;
          numi.value = num;
          var newdiv = document.createElement('div');
          var divIdName = 'my'+num+'DivAdd';
          newdiv.setAttribute('id',divIdName);
          
          strHTML = "<label>Nombre:</label>";
          strHTML +="<input type='text' name='txtNomPrecio"+num+"' size='30' class='required ui-widget-content'>";
          strHTML +="<label>Precio:</label>"
          strHTML +="<input type='text' name='txtPrecio"+num+"' size='10' class='required ui-widget-content'>";
          strHTML +='<a href=\'javascript:;\' onclick=\'removeElement('+divIdName+')\'>Borrar</a>';
          
          newdiv.innerHTML = strHTML; 
          ni.appendChild(newdiv);
        }
        
        
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
    $producto   = new Producto();
    $contPrecio = 0;
    
    $action = null;
    
    if(isComandCreate())
    {
        //Action To Execute When do POST 
        $action = 'insert';
        
        $producto->id = 0;
        $producto->nombreIng     = "#";
        $producto->descripcionIng= "#";
        $producto->populate      = 0;
        $producto->top10         = 1;
    }
    else
    {
        //Action To Execute When do POST 
        $action = 'update';
        
        $producto=DAOFactory::getProductoDAO()->load($_GET['Id']);
        
        $listaPrecios = DAOFactory::getPrecioProductoDAO()->queryByIdProducto($_GET['Id']);
        
        $contPrecio = count($listaPrecios);
    }
    
    ?>
    
    <div>
        
            <form action="productos.php" method="post" enctype="multipart/form-data" id="FrmProductos">
                <div class="tituloAdmin"><?php echo $objTipoProducto->nombre;?></div>
                <input type="hidden" value="<?php echo $action;?>" id="execute" name="execute" />
                <input type="hidden" value="<?php echo $producto->id;?>" id="IdProducto" name="IdProducto" />
                <input type="hidden" value="<?php echo $producto->populate;?>" id="Populate" name="Populate" />
                
                <table id="tabla" cellpadding="0" cellspacing="0" width="100%" >
                    <tr>
                        <td width="50%"><label><br />
                        Tipo Producto:</label><br>
                            <select name="cboTipoProducto" title="Seleccione Tipo Producto" id="cboTipoProducto" class="required ui-widget-content">
                                
                                <?php ComboTipoProducto($objTipoProducto->id); ?>
                            </select>
                        </td>
                        <td width="50%"><label><br />
                        Sección:</label> <br>
                            
                            <select name="cboSeccion" title="Seleccione una Seccion" id="cboSeccion"  class="required ui-widget-content">
                                <?php ComboSeccionTipoSeccion($producto->idSeccion,3);?>
                            </select>
                        
                        </td>
                    </tr>
                    <tr>
                        <td >
                            <input type="hidden" value="<?php echo $producto->idAlbum;?>" id="cboAlbum" name="cboAlbum" />
                            <label><br />
                            Nombre:</label><br>
                            <input type="text" name="txtNomProEsp" size="50" value="<?php echo $producto->nombreEsp;?>" class="required ui-widget-content"><br>
                        </td>
                        <td ><label><br />
                        Top 10:</label><br>
                            
                            <?php 
                                $CHECKED_SI='checked';
                                $CHECKED_NO='checked';
                                
                                if ($producto->top10==1){
                                    $CHECKED_SI = 'checked';
                                    $CHECKED_NO = '';
                                }
                                else{
                                    $CHECKED_SI = '';
                                    $CHECKED_NO = 'checked';
                                }
 
                            ?>
                            <input type="radio" name="top10" id="top10" value="1" <?php echo $CHECKED_SI; ?> />
                            <label for="top10">Si</label>
                            <input type="radio" name="top10" id="top10" value="0" <?php echo $CHECKED_NO; ?>/>
                            <label for="top10">No</label>
      
                        </td>
                    </tr>
                    <tr>
                        <td valign="top">
                            <label><br />
                          Descripcion:</label><br>
                            <textarea name="txtProdEsp" rows="10" cols="30" class="required ui-widget-content">
                             <?php echo $producto->descripcionEsp;?>
                            </textarea>
                        </td>
                        <td valign="top">
                            <p>
                              <input type="hidden" value="<?php echo $contPrecio;?>" id="theValue" name="contPrecio" />
                            </p>
                            <p>&nbsp;</p>
                            <p><a href="javascript:;" onclick="addPrecio();">Agregar precio</a></br>
                              
                            </p>
                            <div id="myDivAdd"> 
                                <?php
                                for($i=0;$i<$contPrecio;$i++)
                                {
                                    $auxI = $i+1;
                                    $idDIV = 'myDiv'.$auxI.'Add';

                                    echo "<div id='".$idDIV."'>";
                                    echo "<label>Nombre:</label>";
                                    echo "<input type='text' name='txtNomPrecio".$auxI."' size='30' value ='".$listaPrecios[$i]->nombre."'>";
                                    echo "<label>Precio:</label>";
                                    echo "<input type='text' name='txtPrecio".$auxI."' size='10' value ='".$listaPrecios[$i]->valor."' >";
                                    echo "<a href='javascript:;' onclick='removeElement(".$idDIV.")'>Borrar</a>";
                                    echo "</div>";
                                }                            
                                ?>
                            </div>
                           
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
