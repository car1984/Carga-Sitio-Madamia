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

        //Notificacion
        notificacion('Producto Actualizado Correctamente', $NOTI_SUCCESS);
        
        verItems();
        

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
        $producto = new Producto();
        $producto->idSeccion = $_POST['cboSeccion'];
        $producto->idAlbum = $_POST['cboAlbum'];
        $producto->idTipoProducto = $_POST['cboTipoProducto'];
        $producto->populate=0;
        $producto->nombreEsp = $_POST['txtNomProEsp'];
        $producto->nombreIng = "#";
        $producto->descripcionEsp=$_POST['txtProdEsp'];
        $producto->descripcionIng= "#";
        $producto->top10=$_POST['top10'];


        $transaction = new Transaction();
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
            
            //Notificacion
            notificacion('Producto Agregado Correctamente', $NOTI_SUCCESS);
            
            //Muestro Los Items
            verItems();
        }

    }
    else{ 
        //Notificacion
        notificacion($error_msg, $NOTI_SUCCESS);
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
                <h2><span>Productos Disponibles</span></h2>
            <div class="module-table-body">
                <form action="">
                    <table id="myTable" class="tablesorter" cellpadding="0" cellspacing="0">
                   <thead>
                        <tr>
                            <th style="width:10%">Tipo Producto</th>
                            <th style="width:10%">Seccion</th>
                            <th style="width:10%">Nombre </th>
                            <th style="width:15%">Descripcion</th>
                            <th style="width:5%">Editar</th>
                            <th style="width:5%">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $tablaconsulta = DAOFactory::getProductoDAO()->queryAll();
                        for($fila=0;$fila<count($tablaconsulta);$fila ++)
                        {
                            $row = $tablaconsulta[$fila];
                            
                            echo "<tr height='40px'><td>".DAOFactory::getTipoProductoDAO()->load($row->idTipoProducto)->nombre."</td>";
                            echo "<td>".DAOFactory::getSeccionDAO()->load($row->idSeccion)->nombre."</td>";
                            echo "<td>".$row->nombreEsp."</td>";
                            echo "<td>".$row->descripcionEsp."</td>";
                            echo "<td align='center'>".linkModificar('addproductos.php',$row->id)."</td>";
                            echo "<td align='center'>".linkEliminar('productos.php',$row->id)."</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                </form>
                <div id="pager" class="pager">
                    <form>
                            <img src="../resources/img/pager/first.png" class="first"/>
                            <img src="../resources/img/pager/prev.png" class="prev"/>
                            <input type="text" class="pagedisplay"/>
                            <img src="../resources/img/pager/next.png" class="next"/>
                            <img src="../resources/img/pager/last.png" class="last"/>
                            <select class="pagesize">
                                    <option selected="selected"  value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="30">30</option>
                                    <option value="40">40</option>
                            </select>
                    </form>
                </div>
            </div>
        </div>
<?php
   return "";
}//Fin funtion Grilla Productos


function executeComand()
{
    $ExecuteComand ='select';
    
    if($_POST){
        $ExecuteComand= $_POST['execute'];
    }else if($_GET){
        $ExecuteComand= $_GET['execute'];
    }
    
    switch ($ExecuteComand)
    {
        case 'insert':
            agregarItem();
            break;
        
        case 'update':
            actualizarItem();
            break;
        
        case 'delete':
            eliminarItem();
            break;
        case 'select':
            verItems();
            break;
        
        default :
            verItems();
    }
}

if ( !isset($_SESSION['username']) && !isset($_SESSION['userid']) )
{
    header('Location: ./');
}
else
{
    Cabecera('PRODUCTOS');
    
    ?>
<div>
    <fieldset>
        <legend>Produtos</legend>
        <br>
        <?php echo linkAgregar("addproductos.php", 0, 'Nuevo Producto'); ?>
        <br>
        <br>
        <div id="contenido">
        <?php executeComand();?>
        </div>
    </fieldset>
</div>
<?php
    pie();
}

