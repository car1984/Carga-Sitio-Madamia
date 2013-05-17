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
                $("#FrmSecciones").validate({

                    rules: {
                        ListTipoSeccion:{ valueNotEquals: "-1" },
                        TxtSeccion  :"required",
                        TxtEspanol  :"required",
                        TxtIngles   :"required",
                        TxtPosicion :{ required: true, number: true}
                    },
                    messages:{
                        ListTipoSeccion:"!",
                        TxtSeccion  :"!",
                        TxtEspanol  :"!",
                        TxtIngles   :"!",
                        TxtPosicion :{required:"!", number: 'Solo Número' }
                    }
                });
                
                // add the rule here
                $.validator.addMethod("valueNotEquals", function(value, element, arg){
                  return arg != value;
                 }, "Value must not equal arg.");
                
        });
        
 
        function closeME() {
            if ($("#FrmSecciones").valid()){
                event.preventDefault();
                parent.$.fancybox.close();
                $('#FrmSecciones').submit();
            }else{
                
                var div = document.getElementById('error');
                //div.style.visibility = 'visible';
            }
        }
        
        function mostrar(nombreCapa){  
            document.getElementById(nombreCapa).style.visibility="visible";  
        }  
	
        function ocultar(nombreCapa){  
            document.getElementById(nombreCapa).style.visibility="hidden";  
	}
 
    </script>

    <?php
   
    
    //Variables Generales
    $ObjAux    = new Seccion();    
    $action    = null;
    $mostrarImg = null; 
    $mostrarUpl = null; 
    
    if(isComandCreate())
    {
        //Action To Execute When do POST 
        $action = 'insert';
        
        $ObjAux->id         = $_GET['Id'];
        $ObjAux->idPapa     = 0;
        $ObjAux->nombre     = '';
        $ObjAux->tipoSeccion= '';
        $ObjAux->posicion   = '';
        $ObjAux->tituloEsp  = '';
        $ObjAux->tituloIng  = '';
        $ObjAux->imagen     = '';
        
        $mostrarImg = 'hidden';
        $mostrarUpl = 'visible'; 
    }
    else
    {
        //Action To Execute When do POST 
        $action = 'update';
        
        $ObjAux = DAOFactory::getSeccionDAO()->load($_GET['Id']);
        
        $mostrarImg = 'visible';
        $mostrarUpl = 'hidden'; 
    }
    
    ?>
    
    <div>
        
            <form action="secciones.php" method="post" enctype="multipart/form-data" id="FrmSecciones">
                
                <div class="tituloAdmin">Secciones</div>
                
                <input type="hidden" value="<?php echo $action;?>" id="execute" name="execute" />
                <input type="hidden" value="<?php echo $ObjAux->id;?>" id="IdSeccion" name="IdSeccion" />
<br /><br />
                  <table id="tabla" cellpadding="0" cellspacing="0" width="800">
                    <tr height="60px">
                        <td width="150" rowspan="4" align="center">
                            <div id ="capaImagen" style="visibility:<?php echo $mostrarImg; ?>; font-size: 9px; font-size: 12px; font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; color: #096;">
                            <img src='<?php echo $ObjAux->imagen; ?>' height='150' width='150'/> <a href ='#'onclick="mostrar('capaILoad')"> <br />Cambiar Imagen</a> 
                            <input type="hidden" name ="fileImage" value="<?php echo $ObjAux->imagen ?>">
                            </div>
                      </td>
                       <td width="150">
                           <label>Sección Padre:</label>
                       </td >
                      <td width="200"><p>
                        <select name="cboSeccion" title="Seleccione una Seccion" id="cboSeccion" >
                          <?php ComboSeccion($ObjAux->idPapa);?>
                        </select>
                      </p></td >
                      <td ><label>Tipo Seccion</label></td>
                       <td ><select name="ListTipoSeccion" id="ListTipoSeccion" >
                         <?php ComboTipoSeccion($ObjAux->tipoSeccion); ?>
                       </select></td>
                    </tr>
                    <tr height="60px">
                        <td width="150">
                            <input type="hidden" name ="TxtAux" value="<?php echo $ObjAux->id ?>">
                            <label>Nombre De La Seccion:</label></td>
                        <td width="200"><p>
                          <input type="text" name="TxtSeccion" size="50" value="<?php echo $ObjAux->nombre ?>" />
                        </p></td>
                        <td width="150"><label>Titulo Ingles:</label></td>
                        <td width="200"><input type="text" name="TxtIngles" size="50" value="<?php echo $ObjAux->tituloEng ?>" /></td>
                        
                    </tr>
                    <tr height="60px">
                        <td width="150">
                            <label>Titulo Español:</label></td>
                        <td width="200"><input type="text" name="TxtEspanol" size="50" value="<?php echo $ObjAux->tituloEsp ?>" /></td>
                        <td width="150"><label>Posicion de Inicio:</label></td>
                        <td width="200"><input type="text" name="TxtPosicion" class="fecha" maxlength="4" value="<?php echo $ObjAux->posicion ?>" /></td>
                    </tr>
                    <tr height="60px">
                        <td  colspan="4">
                            
                            
                            <div id ="capaILoad" style="visibility:<?php echo $mostrarUpl; ?>"><label>Imagen:</label>
                            <input name="fileimg" type="file" value="Examinar"></div>
                        </td>
                    </tr>
                    <tr height="60px">
                        <td colspan="5" align="right"  >
                        <button class="BtnGuardar" onclick="closeME();">
                            <span></span>
                        </button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <div class="error"></div>
                        </td>
                    </tr>
                </table>
                
            </form>

    </div>

    <?php  
        pie(); 
    ?> 