<?php
require_once '../global/include.php';
require_once('funciones.php');	

ini_set("display_errors", $DISPLAY_ERROR);


if ( !isset($_SESSION['username']) && !isset($_SESSION['userid']) )
{
    header('Location: ./');
}
   


function actualizarItem()
{

    global $NOTI_ERROR;
    global $NOTI_SUCCESS;
    
    $error_msg = '';
    
    if($_POST['NomUsuario']=='')
    {
        $error_msg = $error_msg.'Falta el Nombre de Usuario<br>';
    }

    if($_POST['PassUsuario']=='')
    {
        $error_msg = $error_msg . 'Falta Contraseña<br>';
    }

    if($_POST['EmailUsuario']=='')
    {
        $error_msg = $error_msg . 'Falta Correo Electonico<br>';
    }


    if($error_msg == '')
    {
        $transaction = new Transaction();
 
        $oUser = new Usuario();
        $oUser->id      =$_POST['IdUsuario'];
        $oUser->idRol   =$_POST['cboRol'];
        $oUser->idAlbum =$_POST['IdALbum'];
        $oUser->usuario =$_POST['NomUsuario'];
        $oUser->clave   =$_POST['PassUsuario'];
        $oUser->mail    =$_POST['EmailUsuario'];
        
        DAOFactory::getUsuarioDAO()->update($oUser);
        
        
        $transaction->commit();

        $strNotificacion  = '<b>Usuario Actualizado Correctamente</b>';
        $strNotificacion .= '<br><br><a href="javascript:parent.jQuery.fancybox.close();">Cerrar Ventana</a>';

        //Notificacion
        notificacion($strNotificacion, $NOTI_SUCCESS);

        $popUp = 0;

        //Muestro Los Items
        //verItems();

        
        //verItems();
        

    }
    else
    {
        //Notificacion
        notificacion($error_msg, $NOTI_ERROR);
    }
    //GrillaProductos();
    
}//En Function Actualizar Producto


function agregarItem()
{    
    global $NOTI_ERROR;
    global $NOTI_SUCCESS;
    

    $tabla = DAOFactory::getUsuarioDAO()->queryAllOrderBy('id');

    if(count($tabla)>0)
    {
        $row = $tabla[count($tabla)-1];
        $ultimo = $row->id;
    }
    else
    {
        $ultimo=0;
    }

    $error_msg = '';
    if($_POST['NomUsuario']=='')
    {
        $error_msg = $error_msg.'Falta el Nombre de Usuario<br>';
    }

    if($_POST['PassUsuario']=='')
    {
        $error_msg = $error_msg . 'Falta Contraseña<br>';
    }

    if($_POST['EmailUsuario']=='')
    {
        $error_msg = $error_msg . 'Falta Correo Electonico<br>';
    }

    if($error_msg == '')
    {
        
        $transaction = new Transaction();
        
        //Se Crea un Nuevo Album
        $nuevo =$ultimo+1;
        
        $objAlbum = new Album();
        $objAlbum->nombre   = "Usuario".$nuevo; 
        $objAlbum->fecha    = date("Y/m/d");
        $objAlbum->mostrar  = 1;
        
        DAOFactory::getAlbumDAO()->insert($objAlbum);
        
        $oUser = new Usuario();
        $oUser->idRol   =$_POST['cboRol'];
        $oUser->idAlbum =$objAlbum->id;
        $oUser->usuario =$_POST['NomUsuario'];
        $oUser->clave   =$_POST['PassUsuario'];
        $oUser->mail    =$_POST['EmailUsuario'];
        
        DAOFactory::getUsuarioDAO()->insert($oUser);
        
        if($oUser->id > $ultimo)
        {

            $transaction->commit();
            
            $strNotificacion  = '<b>Usuario Agregado Correctamente</b>';
            $strNotificacion .= '<br><br><a href="javascript:parent.jQuery.fancybox.close();">Cerrar Ventana</a>';
            
            //Notificacion
            notificacion($strNotificacion, $NOTI_SUCCESS);
            
            $popUp = 0;
            
            //Muestro Los Items
            //verItems();
        }

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
        $IdUsuario = $_GET['Id'];
        DAOFactory::getUsuarioDAO()->delete($IdUsuario);
        notificacion("Usuario Eliminado",$NOTI_SUCCESS );
    }
    else{
        notificacion("Error Eliminando Usuario",$NOTI_ERROR );
    }
    
    verModulo();
    
    return "";
    
}//En Function Eliminar Producto


function verItems()
{
    ?>

      <form action="">
            <table id="myTable"  cellpadding="2" cellspacing="2">
                <?php


                $tablaconsulta = DAOFactory::getUsuarioDAO()->queryAll();
                for($fila=0;$fila<count($tablaconsulta);$fila ++)
                {
                    $row = $tablaconsulta[$fila];

                    echo "<tr height='40px'><td width='100px' style='background-color:#DAB0C8; color:#7C1147;font-family: Arial, Helvetica, sans-serif;'>".  DAOFactory::getRolDAO()->load($row->idRol)->nombre."</td>";
                    echo "<td width='100px' style='background-color:#DAB0C8; color:#7C1147;font-family: Arial, Helvetica, sans-serif;'>".$row->usuario."</td>";
                    echo "<td width='500px' style='background-color:#DAB0C8; color:#7C1147;font-family: Arial, Helvetica, sans-serif;'>".$row->mail."</td>";
                    echo "<td align='center' class='tablaAdmin'>".linkAbrirFoto('Fotos.php', $row->idAlbum, 'Foto', 1)."</td>";
                    echo "<td align='center' class='tablaAdmin'>".linkModificar('addUsuarios.php',$row->id,"Editar",1)."</td>";
                    echo "<td align='center' class='tablaAdmin'>".linkEliminar('usuarios.php',$row->id,"Borrar",0)."</td></tr>";

                }
                ?>

            </table>
        </form>

            
        
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
    <div class="tituloAdmin">Modulo Usuario</div>
    </td>
    <td align="left" width="15%"><p>&nbsp;</p>      
	<?php 
	echo linkAgregar("addUsuarios.php", 0, "Nuevo",1); 
	?>			

    </td>
  </tr>
</table>

<?php
}

    Cabecera('USUARIOS');
    
?>


  <div id="contenido">
    <?php executeComand();?>
  </div>



