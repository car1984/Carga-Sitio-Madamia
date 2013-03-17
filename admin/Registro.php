<?php
require_once '../global/include.php';
require_once('funciones.php');	

ini_set("display_errors", $DISPLAY_ERROR);


function actualizarItem()
{

    global $NOTI_ERROR;
    global $NOTI_SUCCESS;

    $error_msg = '';
    if($_POST['txtNombre']=='')
    {
        $error_msg = $error_msg.'Falta el Nombre <br>';
    }
    if($_POST['txtApellido']=='')
    {
        $error_msg = $error_msg.'Falta el Apellido<br>';
    }
    if($_POST['txtEmail']=='')
    {
        $error_msg = $error_msg.'Falta el Correo<br>';
    }
    

    
    if($error_msg == '')
    {
        
        $transaction = new Transaction();
                
        //Se crea el contenido
        $objRegistro = new Registro();
        $objRegistro->id        = $_POST['IdRegistro'];
        $objRegistro->nombre    = $_POST['txtNombre'];
        $objRegistro->apellido  = $_POST['txtApellido'];
        $objRegistro->cedula    = $_POST['txtCedula'];
        $objRegistro->email     = $_POST['txtEmail'];
        $objRegistro->telefono  = $_POST['txtTelefono'];
        $objRegistro->dia       = $_POST['txtDia'];
        $objRegistro->mes       = $_POST['txtMes'];
        $objRegistro->ano       = $_POST['txtAnio'];
                
        DAOFactory::getRegistroDAO()->update($objRegistro);
        
        $transaction->commit();

                     
        $strNotificacion  = '<b>Registro Actualizado Correctamente</b>';
        $strNotificacion .= '<br><br><a href="javascript:parent.jQuery.fancybox.close();">Cerrar Ventana</a>';

        //Notificacion
        notificacion($strNotificacion, $NOTI_SUCCESS);

        $popUp = 0;

        //Muestro Los Items
        //verItems();


    }
    else{ 
        //Notificacion
        notificacion($error_msg, $NOTI_ERROR);
    }
    //GrillaProductos();
    
}//En Function Actualizar Producto


function agregarItem()
{    
    global $NOTI_ERROR;
    global $NOTI_SUCCESS;
    

    $error_msg = '';
    if($_POST['txtNombre']=='')
    {
        $error_msg = $error_msg.'Falta el Nombre <br>';
    }
    if($_POST['txtApellido']=='')
    {
        $error_msg = $error_msg.'Falta el Apellido<br>';
    }
    if($_POST['txtEmail']=='')
    {
        $error_msg = $error_msg.'Falta el Correo<br>';
    }
    
    if($error_msg == '')
    {
        
        $transaction = new Transaction();

        $objRegistro = new Registro();

        $objRegistro->nombre    = $_POST['txtNombre'];
        $objRegistro->apellido  = $_POST['txtApellido'];
        $objRegistro->cedula    = $_POST['txtCedula'];
        $objRegistro->email     = $_POST['txtEmail'];
        $objRegistro->telefono  = $_POST['txtTelefono'];
        $objRegistro->dia       = $_POST['txtDia'];
        $objRegistro->mes       = $_POST['txtMes'];
        $objRegistro->ano       = $_POST['txtAnio'];
                
        DAOFactory::getRegistroDAO()->insert($objRegistro);
        
        $transaction->commit();

                      
        $strNotificacion  = '<b>Regitro Agregado Correctamente</b>';
        $strNotificacion .= '<br><br><a href="javascript:parent.jQuery.fancybox.close();">Cerrar Ventana</a>';

        //Notificacion
        notificacion($strNotificacion, $NOTI_SUCCESS);

        $popUp = 0;

        //Muestro Los Items
        //verItems();

    }
    else{ 
        //Notificacion
        notificacion($error_msg, $NOTI_ERROR);
    }
    //GrillaProductos();
    
}//En Function Agregar Producto


function eliminarItem()
{
    global $NOTI_ERROR;
    global $NOTI_SUCCESS;
    
    if($_GET){
        $IdRegistro = $_GET['Id'];
        DAOFactory::getRegistroDAO()->delete($IdRegistro);
        notificacion("Registro Eliminado",$NOTI_SUCCESS );
    }
    else{
        notificacion("Error Eliminando el Registor",$NOTI_ERROR );
    }
    
    verModulo();
    
    return "";
    
}//En Function Eliminar Producto


function verItems()
{
    ?>

    <div class="module">

            <div class="module-table-body">
              <form action="">
                    <table id="myTable"  cellpadding="2" cellspacing="2">
                    </thead>
                    <tbody>
                        <?php
                       
                        $tablaconsulta = DAOFactory::getRegistroDAO()->queryAll();
                        for($fila=0;$fila<count($tablaconsulta);$fila ++)
                        {
                            $row = $tablaconsulta[$fila];
                            
                            echo "<tr height='30px'>";
                            echo "<td width='200px' style='background-color:#DAB0C8; color:#7C1147;font-family: Arial, Helvetica, sans-serif;'>Nombre: ".$row->nombre."</td>";
                            echo "<td width='200px' style='background-color:#DAB0C8; color:#7C1147;font-family: Arial, Helvetica, sans-serif;'>Apellido: ".$row->apellido."</td>";
                            echo "<td width='200px' style='background-color:#DAB0C8; color:#7C1147;font-family: Arial, Helvetica, sans-serif;'>Mail: ".$row->email."</td>";
                            echo "<td width='200px' style='background-color:#DAB0C8; color:#7C1147;font-family: Arial, Helvetica, sans-serif;'>Tel: ".$row->telefono."</td>";;
                            echo "<td width='50px' align='center' class='tablaAdmin'>".linkModificar('addRegistro.php',$row->id,"Editar",1)."</td>";
                            echo "<td width='50px' align='center' class='tablaAdmin'>".linkEliminar('Registro.php',$row->id,"Borrar",0)."</td></tr>";

                        }
                        ?>
                    </tbody>
                </table>
                </form>

            </div>
        </div>
<?php
   return "";
}//Fin funtion Grilla Productos

function verModulo()
{
    verHeader();
    verItems();
    
    return "";
}

function verHeader()
{
?>

 <table border="0" width="100%">
  <tr>
    <td width="85%">
    <div class="tituloAdmin">Registro</div>
    </td>
    <td align="left" width="15%"><p>&nbsp;</p>      
	<?php 
	echo linkAgregar("addRegistro.php", 0, "Nuevo",1); 
	?>			

    </td>
  </tr>
</table>

<?php
}

    Cabecera('INICIO');
    
?>


  <div id="contenido">
    <?php executeComand();?>
  </div>



