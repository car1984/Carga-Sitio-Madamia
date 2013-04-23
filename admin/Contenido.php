<?php
require_once '../global/include.php';
require_once('funciones.php');	

ini_set("display_errors", $DISPLAY_ERROR);


function actualizarItem()
{

    global $NOTI_ERROR;
    global $NOTI_SUCCESS;
    

    $ultimo=0;
    $tabla = DAOFactory::getContenidoDAO()->queryAllOrderBy('id');

    if(count($tabla)>0)
    {
        $row = $tabla[count($tabla)-1];
        $ultimo = $row->id;
    }

    $error_msg = '';
    if($_POST['TxtNameEsp']=='')
    {
        $error_msg = $error_msg.'Falta el Nombre En Español<br>';
    }
    if($_POST['TxtContEsp']=='')
    {
        $error_msg = $error_msg.'Falta el Contenido En Español<br>';
    }

    
    if($error_msg == '')
    {
        
        $transaction = new Transaction();
                
        //Se crea el contenido
        $oContenido = new Contenido();
        $oContenido->id             = $_POST['Idcontenido'];
        $oContenido->idLista        = $_POST['ListContenido'];
        $oContenido->albumId        = $_POST['IdALbum'];
        $oContenido->nombreEsp      = $_POST['TxtNameEsp'];
        $oContenido->nombreIng      = $_POST['TxtNameIng'];
        $oContenido->contenidoEsp   = $_POST['TxtContEsp'];
        $oContenido->contenidoIng   = $_POST['TxtContIng'];
        $oContenido->urlGoogleMaps  = $_POST['TxtGoogleMaps'];

        DAOFactory::getContenidoDAO()->update($oContenido);
        
        $transaction->commit();

        if($oContenido->id > $ultimo)
        {               
            $strNotificacion  = '<b>Contenido Actualizado Correctamente</b>';
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
    
}//En Function Actualizar Producto


function agregarItem()
{    
    global $NOTI_ERROR;
    global $NOTI_SUCCESS;
    

    $ultimo=0;
    $tabla = DAOFactory::getContenidoDAO()->queryAllOrderBy('id');

    if(count($tabla)>0)
    {
        $row = $tabla[count($tabla)-1];
        $ultimo = $row->id;
    }

    $error_msg = '';
    if($_POST['TxtNameEsp']=='')
    {
        $error_msg = $error_msg.'Falta el Nombre En Español<br>';
    }
    if($_POST['TxtContEsp']=='')
    {
        $error_msg = $error_msg.'Falta el Contenido En Español<br>';
    }
    
    if($error_msg == '')
    {
        
        $transaction = new Transaction();
        
        //Se Crea un Nuevo Album
        $nuevo =$ultimo+1;
        
        $objAlbum = new Album();
        $objAlbum->nombre   = "Contenido".$nuevo; 
        $objAlbum->fecha    = date("Y/m/d");
        $objAlbum->mostrar  = 1;
        
        DAOFactory::getAlbumDAO()->insert($objAlbum);
        
        //Se crea el contenido
        $oContenido = new Contenido();
        $oContenido->idLista        = $_POST['ListContenido'];
        $oContenido->albumId        = $objAlbum->id;
        $oContenido->nombreEsp      = $_POST['TxtNameEsp'];
        $oContenido->nombreIng      = $_POST['TxtNameIng'];
        $oContenido->contenidoEsp   = $_POST['TxtContEsp'];
        $oContenido->contenidoIng   = $_POST['TxtContIng'];
        $oContenido->urlGoogleMaps  = $_POST['TxtGoogleMaps'];

        DAOFactory::getContenidoDAO()->insert($oContenido);
        
        $transaction->commit();

        if($oContenido->id > $ultimo)
        {               
            $strNotificacion  = '<b>Contenido Agregado Correctamente</b>';
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
        $IdContenido = $_GET['Id'];
        DAOFactory::getContenidoDAO()->delete($IdContenido);
        notificacion("Contenido Eliminado",$NOTI_SUCCESS );
    }
    else{
        notificacion("Error Eliminando Contenido",$NOTI_ERROR );
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
                $idListaContenido;
                if(isComandDelete()){
                    $idListaContenido = $_SESSION['idListaContenido'];
                }
                else{
                    $_SESSION['idListaContenido'] = $_GET["idListaContenido"];
                    $idListaContenido             = $_GET["idListaContenido"];
                }

                $tablaconsulta = DAOFactory::getContenidoDAO()->queryByIdLista($idListaContenido);
                for($fila=0;$fila<count($tablaconsulta);$fila ++)
                {
                    $row = $tablaconsulta[$fila];

                    echo "<tr height='40px'>";
                    echo "<td width='200px' style='background-color:#DAB0C8; color:#7C1147;font-family: Arial, Helvetica, sans-serif;'>".DAOFactory::getListaContenidoDAO()->load($row->idLista)->nombre."</td>";
                    echo "<td width='500px' style='background-color:#DAB0C8; color:#7C1147;font-family: Arial, Helvetica, sans-serif;'>".$row->nombreEsp."</td>";
                    echo "<td width='50px' align='center' class='tablaAdmin'>".linkAbrirFoto('Fotos.php', $row->albumId, 'Foto', 1)."</td>";
                    echo "<td width='50px' align='center' class='tablaAdmin'>".linkModificar('addContenido.php',$row->id,"Editar",1)."</td>";
                    echo "<td width='50px' align='center' class='tablaAdmin'>".linkEliminar('Contenido.php',$row->id,"Borrar",0)."</td></tr>";

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
    $idListaContenido;
    
    if(isComandDelete())
        $idListaContenido = $_SESSION['idListaContenido'];
    else
        $idListaContenido  = $_GET["idListaContenido"];
    
    $objListaContenido = DAOFactory::getListaContenidoDAO()->load($idListaContenido);
?>

 <table border="0" width="100%">
  <tr>
    <td width="85%">
    <div class="tituloAdmin"><?php echo $objListaContenido->nombre;?></div>
    </td>
    <td align="left" width="15%"><p>&nbsp;</p>      
	<?php 
	echo linkAgregar("addContenido.php", 0, "Nuevo",1); 
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



