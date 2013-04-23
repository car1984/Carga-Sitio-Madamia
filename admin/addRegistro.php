<?php
require_once '../global/include.php';
require_once('funciones.php');	

ini_set("display_errors", $DISPLAY_ERROR);


if ( !isset($_SESSION['username']) && !isset($_SESSION['userid']) )
{
    header('Location: ./');
}


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
                $("#FrmRegistro").validate({

                    rules: {
                        txtNombre:"required",
                        txtApellido:"required",
                        txtEmail:{ required: true, email: true },
                        txtDia:{ number: true}
                    },
                    messages:{
                        txtNombre:"Requerido",
                        txtApellido:"Requerido",
                        txtEmail:{required:"Requerido", email: 'Correo Invalido' },
                        txtDia:"Solo Número"  
                    }
                   
                });
                
                // add the rule here
                $.validator.addMethod("valueNotEquals", function(value, element, arg){
                  return arg != value;
                 }, "Value must not equal arg.");
                
        });
        
 
        function closeME() {
            if ($("#FrmRegistro").valid()){
                event.preventDefault();
                parent.$.fancybox.close();
                $('#FrmRegistro').submit();
            }
        }
 
    </script>

    <?php

    
    //Variables Generales
    $objRegistro = new Registro(); 
    $contPrecio = 0;
    
    $action = null;
    
    if(isComandCreate())
    {
        //Action To Execute When do POST 
        $action = 'insert';
        
        $objRegistro->id        = 0  ;        
        $objRegistro->nombre    = " ";
        $objRegistro->apellido  = " ";
        $objRegistro->cedula    = " ";
        $objRegistro->email     = " ";
        $objRegistro->telefono  = " ";
        $objRegistro->dia       = " ";
        $objRegistro->mes       = " ";
        $objRegistro->ano       = " ";
    }
    else
    {
        //Action To Execute When do POST 
        $action = 'update';
        
        $objRegistro=DAOFactory::getRegistroDAO()->load($_GET['Id']);
    }
    
    ?>
    
    <div>
        
            <form action="Registro.php" method="post" enctype="multipart/form-data" id="FrmRegistro">
                <div class="tituloAdmin">Registro Usuarios</div>
                <input type="hidden" value="<?php echo $action;?>" id="execute" name="execute" />
                <input type="hidden" value="<?php echo $objRegistro->id ;?>" id="IdRegistro" name="IdRegistro" />
                
                
                <table id="tabla" cellpadding="0" cellspacing="0" border="0" width="90%">
                <tr>
                    <td colspan="4"><br />
                        <div id="error" class="error" style="background-color: #ffc6ca;
                                                              border-color: #efb9c3;
                                                              border-style: solid solid solid solid;
                                                              border-width: 2px;
                                                              padding: 5px;
                                                              visibility:hidden;"></div>
                    </td>
                </tr>
                  <tr>
                      <td></br><label>Nombre</label></td>
                    <td>
                        </br><input class="left" type="text"  name="txtNombre" value="<?php echo $objRegistro->nombre; ?>"/>
                    </td>
                    <td></br><label>Apellido</label></td>
                    <td>
                       </br><input type="text"  name="txtApellido" value="<?php echo $objRegistro->apellido; ?>" />
                    </td>
                  </tr>
                  <tr>
                      <td></br><label>Cedula</label></td>
                    <td>
                      </br><input type="text" name="txtCedula" value="<?php echo $objRegistro->cedula ?>"/>
                    </td>
                    <td></br><label>E-Mail</label></td>
                    <td>
                    </br><input type="text"  name="txtEmail" value="<?php echo $objRegistro->email ?>" />
                    </td>
                  </tr>
                  <tr>
                        <td >
                            </br><label>Telefono</label>
                        </td>
                        <td colspan="3" >
                            </br><input type="text"  name="txtTelefono" value="<?php echo $objRegistro->email ?>"/>
                        </td>
                  </tr>
                  <tr>
                      <td colspan="4"></br><label>Fecha de Cumpleaños</label></td>
                  </tr>
                  <tr>
                    <td colspan="4" valign="top">
                     </br>
                     <label>Dia (dd) </label>   
                     <input type="text" class="fecha" name="txtDia" maxlength="2" value="<?php echo $objRegistro->dia ?>"/>
                     <label>Mes (mm)</label> 
                     <input type="text" class="fecha" name="txtMes" maxlength="2" value="<?php echo $objRegistro->mes ?>"/>
                      <label>Año (aaaa)</label> 
                     <input type="text" class="fecha" name="txtAnio" maxlength="4" value="<?php echo $objRegistro->ano ?>"/>
                     
                    </td>
                  </tr>
                  <tr>
                    <td colspan="4" align="right"> <br>
                        <button class="BtnGuardar" onclick="closeME();">
                            <span></span>
                        </button>
                    </td>
                  </tr>
                </table>
                        
                    </tr>
                </table>
            </form>

    </div>
