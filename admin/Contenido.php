<?php
require_once '../global/include.php';
require_once('funciones.php');	

ini_set("display_errors", $DISPLAY_ERROR);


function actualizarItem()
{

    global $NOTI_ERROR;
    global $NOTI_SUCCESS;
    
    $tabla = DAOFactory::getProductoDAO()->queryAllOrderBy('id');

    if(count($tabla)>0)
    {
        $row = $tabla[count($tabla)-1];
        $ultimoproducto = $row->id;
    }
    else
    {
        $ultimoproducto=0;
    }

    $error_msg = '';
    if($_POST['txtNomProEsp']=='')
    {
        $error_msg = $error_msg.'Falta el Nombre <br>';
    }


    if($_POST['txtProdEsp']=='')
    {
        $error_msg = $error_msg . 'Falta Descripcion<br>';
    }


    if($error_msg == '')
    {
        $producto = new Producto();

        $producto->id               = $_POST['IdProducto'];
        $producto->idSeccion        = $_POST['cboSeccion'];
        $producto->idAlbum          = $_POST['cboAlbum'];
        $producto->idTipoProducto   = $_POST['cboTipoProducto'];
        $producto->populate         = $_POST['Populate'];
        $producto->nombreEsp        = $_POST['txtNomProEsp'];
        $producto->descripcionEsp   = $_POST['txtProdEsp'];
        $producto->top10            = $_POST['top10'];
        $producto->nombreIng        = "#";
        $producto->descripcionIng   = "#";


        $transaction = new Transaction();
        
        //Se actualiza el procto
        DAOFactory::getProductoDAO()->update($producto);
        
        //Se elimina toda la lista
        DAOFactory::getPrecioProductoDAO()->deleteByIdProducto($producto->id);
        
        
        $cantPrecio = $_POST['contPrecio'];
        
        //Se crean todos los precios
        for ($i=0;$i<$cantPrecio;$i++)
        {
            $precio = new PrecioProducto();

            $Id =$i+1;
            if(isset ($_POST['txtNomPrecio'.$Id]) && 
               isset ($_POST['txtPrecio'.$Id])){
                
                $precio->idProducto=$producto->id;
                $precio->nombre    =$_POST['txtNomPrecio'.$Id];
                $precio->valor     =$_POST['txtPrecio'.$Id];

                DAOFactory::getPrecioProductoDAO()->insert($precio);
            }
        }


        $transaction->commit();

        $strNotificacion  = '<b>Producto Actualizado Correctamente</b>';
        $strNotificacion .= '<br><br><a href="javascript:parent.jQuery.fancybox.close();">Cerrar Ventana</a>';
            
        //Notificacion
        notificacion($strNotificacion, $NOTI_SUCCESS);
        
        $popUp=0;
        
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
    

    $tabla = DAOFactory::getProductoDAO()->queryAllOrderBy('id');

    if(count($tabla)>0)
    {
        $row = $tabla[count($tabla)-1];
        $ultimoproducto = $row->id;
    }
    else
    {
        $ultimoproducto=0;
    }

    $error_msg = '';
    if($_POST['txtNomProEsp']=='')
    {
        $error_msg = $error_msg.'Falta el Nombre en Español<br>';
    }


    if($_POST['txtProdEsp']=='')
    {
        $error_msg = $error_msg . 'Falta Descripcion<br>';
    }

    
    if($error_msg == '')
    {
        
        $transaction = new Transaction();
        
        
        //Se Crea un Nuevo Album
        $nuevoproducto =$ultimoproducto+1;
        
        $objAlbum = new Album();
        $objAlbum->nombre   = "Producto".$nuevoproducto; 
        $objAlbum->fecha    = date("Y/m/d");
        $objAlbum->mostrar  = 1;
        
        DAOFactory::getAlbumDAO()->insert($objAlbum);
        
        //Se crea el producto
        $producto = new Producto();
        $producto->idSeccion = $_POST['cboSeccion'];
        $producto->idAlbum = $objAlbum->id;
        $producto->idTipoProducto = $_POST['cboTipoProducto'];
        $producto->populate=0;
        $producto->nombreEsp = $_POST['txtNomProEsp'];
        $producto->nombreIng = "#";
        $producto->descripcionEsp=$_POST['txtProdEsp'];
        $producto->descripcionIng= "#";
        $producto->top10=$_POST['top10'];

        DAOFactory::getProductoDAO()->insert($producto);

        if($producto->id > $ultimoproducto)
        {

            $cantPrecio = $_POST['contPrecio'];

            for ($i=0;$i<$cantPrecio;$i++)
            {
                $nuevoPrecio = new PrecioProducto();

                $Id =$i+1;
                $nuevoPrecio->idProducto=$producto->id;
                $nuevoPrecio->nombre    =$_POST['txtNomPrecio'.$Id];
                $nuevoPrecio->valor     =$_POST['txtPrecio'.$Id];

                DAOFactory::getPrecioProductoDAO()->insert($nuevoPrecio);
            }


            $transaction->commit();
            
            $strNotificacion  = '<b>Producto Agregado Correctamente</b>';
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
        $IdProducto = $_GET['Id'];
        DAOFactory::getProductoDAO()->delete($IdProducto);
        notificacion("Producto Eliminado",$NOTI_SUCCESS );
    }
    else{
        notificacion("Error Eliminando Producto",$NOTI_ERROR );
    }
    
    verItems();
    
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
                        $_SESSION['idListaContenido'] = $_GET["idListaContenido"];
                        $idListaContenido             = $_GET["idListaContenido"];
                        $tablaconsulta = DAOFactory::getContenidoDAO()->queryByIdLista($idListaContenido);
                        for($fila=0;$fila<count($tablaconsulta);$fila ++)
                        {
                            $row = $tablaconsulta[$fila];
                            
                            echo "<tr height='40px'>";
                            echo "<td width='100px' style='background-color:#DAB0C8; color:#7C1147;font-family: Arial, Helvetica, sans-serif;'>".DAOFactory::getListaContenidoDAO()->load($row->idLista)->nombre."</td>";
                            echo "<td width='400px' style='background-color:#DAB0C8; color:#7C1147;font-family: Arial, Helvetica, sans-serif;'>".$row->nombreEsp."</td>";
                            echo "<td width='50px' align='center' class='tablaAdmin'>".linkAbrirFoto('Fotos.php', $row->albumId, 'Foto', 1)."</td>";
                            echo "<td width='50px' align='center' class='tablaAdmin'>".linkModificar('addContenido.php',$row->id,"Editar",1)."</td>";
                            echo "<td width='50px' align='center' class='tablaAdmin'>".linkEliminar('Contenido.php',$row->id,"Borrar",0)."</td></tr>";

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



