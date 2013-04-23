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

        $(document).ready(function(){	
                // validate the comment form when it is submitted
                $("#FrmLinks").validate({

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
            if ($("#FrmLinks").valid()){
                event.preventDefault();
                parent.$.fancybox.close();
                $('#FrmLinks').submit();
            }else{
                
                var div = document.getElementById('error');
                //div.style.visibility = 'visible';
            }
        }
 
    </script>

    <?php
   
    
    //Variables Generales
    $olink    = new Link();    
    $action   = null;
    
    if(isComandCreate())
    {
        //Action To Execute When do POST 
        $action = 'insert';
        
        $olink->id              =0;
        $olink->idTipoSeccion   =0;
        $olink->nombre          =" ";
        $olink->descripcion     =" ";
        $olink->link            =" ";
    }
    else
    {
        //Action To Execute When do POST 
        $action = 'update';
        
        $olink=DAOFactory::getLinkDAO()->load($_GET['Id']);
    }
    
    ?>
    
    <div>
        
            <form action="links.php" method="post" enctype="multipart/form-data" id="FrmLinks">
                
                <div class="tituloAdmin">Links</div>
                
                <input type="hidden" value="<?php echo $action;?>" id="execute" name="execute" />
                <input type="hidden" value="<?php echo $olink->id;?>" id="IdLink" name="IdLink" />

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
                        <td ><label>Tipo Sección:</label></td>
                        <td>
                            <select name="cboTipoSeccion" title="Seleccione Tipo Seccion" id="cboTipoSeccion" >
                                <?php ComboTipoSeccion($olink->idTipoSeccion); ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td width="200px">
                            <label>Nombre Link:</label>
                        </td>
                        <td width="250px"><input type="text" name="txtNombre" id="txtNombre" size="50" value="<?php echo $olink->nombre ?>"></td>
                    </tr>
                    
                    <tr>
                        <td><label>Descripción:</label> </td>
                        <td><textarea name="txtDescripcion" id="txtDescripcion" size="60" rows="8"><?php echo $olink->descripcion; ?></textarea></td>
                    </tr>
                    <tr>
                        <td><label>Link:</label> </td>
                        <td><textarea name="txtLink" id="txtLink" size="60" rows="8"><?php echo $olink->link; ?></textarea></td>
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