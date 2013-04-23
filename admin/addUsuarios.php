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
                $("#FrmProductos").validate({

                    rules: {
                        cboRol:{ valueNotEquals: "-1" },
                        NomUsuario:"required",
                        PassUsuario:"required",
                        EmailUsuario:{ required: true, email: true }
                    },
                    messages:{
                        cboRol:"Requerido",
                        NomUsuario:"Requerido",
                        PassUsuario:"Requerido",
                        EmailUsuario:{required:"Requerido", email: 'Correo Invalido' }
                        
                    }
                });
                
                // add the rule here
                $.validator.addMethod("valueNotEquals", function(value, element, arg){
                  return arg != value;
                 }, "Value must not equal arg.");
                
        });
        
 
        function closeME() {
            if ($("#FrmProductos").valid()){
                event.preventDefault();
                parent.$.fancybox.close();
                $('#FrmProductos').submit();
            }else{
                
                var div = document.getElementById('error');
                //div.style.visibility = 'visible';
            }
        }
 
    </script>

    <?php
   
    
    //Variables Generales
    $objUser  = new Usuario();    
    $action   = null;
    
    if(isComandCreate())
    {
        //Action To Execute When do POST 
        $action = 'insert';
        
        $objUser->id         = 0;
        $objUser->idRol      = 0;
        $objUser->idAlbum    = 0;
        $objUser->usuario    ='';
        $objUser->clave      ='';
        $objUser->mail       ='';
    }
    else
    {
        //Action To Execute When do POST 
        $action = 'update';
        
        $objUser=DAOFactory::getUsuarioDAO()->load($_GET['Id']);
    }
    
    ?>
    
    <div>
        
            <form action="usuarios.php" method="post" enctype="multipart/form-data" id="FrmProductos">
                
                <div class="tituloAdmin">Usuarios</div>
                
                <input type="hidden" value="<?php echo $action;?>" id="execute" name="execute" />
                <input type="hidden" value="<?php echo $objUser->id;?>" id="IdUsuario" name="IdUsuario" />
                <input type="hidden" value="<?php echo $objUser->idAlbum;?>" id="IdALbum" name="IdALbum" />
                <table id="tabla" cellpadding="2" cellspacing="2" border="0">
                     <tr>
                        <td colspan="2"><br />
                            <div id="error" class="error" style="background-color: #ffc6ca;
                                                                  border-color: #efb9c3;
                                                                  border-style: solid solid solid solid;
                                                                  border-width: 2px;
                                                                  padding: 5px;
                                                                  visibility:hidden;"></div>
                        </td>
                    </tr>
                    <tr>
                        <td ><label>Rol Usuario:</label></td>
                        <td>
                            <select name="cboRol" title="Seleccione Tipo Producto" id="cboRol" >
                                <?php ComboRol($objUser->idRol); ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td width="200px">
                            <label>Nombre de Inicio de sesion:</label>
                        </td>
                        <td width="250px"><input type="text" name="NomUsuario" id="NomUsuario" size="50" value="<?php echo $objUser->usuario ?>"></td>
                    </tr>
                    
                    <tr>
                        <td><label>Contraseña:</label> </td>
                        <td><input type="password" name="PassUsuario" id="PassUsuario" value="<?php echo $objUser->clave; ?>" size="50"></td>
                    </tr>
                    <tr>
                        <td><label>Repetir Contraseña:</label> </td>
                        <td><input type="password" name="Confirm_Pass" id="Confirm_Pass" size="50"></td>
                    </tr>
                    
                    <tr>
                        <td><label>Correo Electronico:</label> </td>
                        <td><input type="text" name="EmailUsuario" id="EmailUsuario" size="50" value="<?php echo $objUser->mail ?>"></td>
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

    <?php  
        pie(); 
    ?> 