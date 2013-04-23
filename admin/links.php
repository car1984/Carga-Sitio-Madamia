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
    if($_POST['txtNombre']=='')
    {
        $error_msg = $error_msg.'Falta el Nombre del Link<br>';
    }

    if($_POST['txtLink']=='')
    {
        $error_msg = $error_msg . 'Falta el Link<br>';
    }
    if($_POST['cboTipoSeccion']==-1)
    {
        $error_msg = $error_msg . 'Falta Seleccionar el Tipo de Sección<br>';
    }

    if($error_msg == '')
    {
        $transaction = new Transaction();
 
        $olink= new Link();
        $olink->id              =$_POST['IdLink'];
        $olink->idTipoSeccion   =$_POST['cboTipoSeccion'];
        $olink->nombre          =$_POST['txtNombre'];
        $olink->descripcion     =$_POST['txtDescripcion'];
        $olink->link            =$_POST['txtLink'];
        
        DAOFactory::getLinkDAO()->update($olink);
        
        
        $transaction->commit();

        $strNotificacion  = '<b>Link Actualizado Correctamente</b>';
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
    

    $tabla = DAOFactory::getLinkDAO()->queryAllOrderBy('id');

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
    if($_POST['txtNombre']=='')
    {
        $error_msg = $error_msg.'Falta el Nombre del Link<br>';
    }

    if($_POST['txtLink']=='')
    {
        $error_msg = $error_msg . 'Falta el Link<br>';
    }
    if($_POST['cboTipoSeccion']==-1)
    {
        $error_msg = $error_msg . 'Falta Seleccionar el Tipo de Sección<br>';
    }

    if($error_msg == '')
    {
        
        $transaction = new Transaction();

        
        $olink= new Link();
        $olink->idTipoSeccion   =$_POST['cboTipoSeccion'];
        $olink->nombre          =$_POST['txtNombre'];
        $olink->descripcion     =$_POST['txtDescripcion'];
        $olink->link            =$_POST['txtLink'];
        
        DAOFactory::getLinkDAO()->insert($olink);
        
        if($olink->id > $ultimo)
        {

            $transaction->commit();
            
            $strNotificacion  = '<b>Link Agregado Correctamente</b>';
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
        $Idlink = $_GET['Id'];
        DAOFactory::getLinkDAO()->delete($Idlink);
        notificacion("Link Eliminado",$NOTI_SUCCESS );
    }
    else{
        notificacion("Error Eliminando Link",$NOTI_ERROR );
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


                $tablaconsulta = DAOFactory::getLinkDAO()->queryAll();
                for($fila=0;$fila<count($tablaconsulta);$fila ++)
                {
                    $row = $tablaconsulta[$fila];

                    echo "<tr height='40px'><td width='100px' style='background-color:#DAB0C8; color:#7C1147;font-family: Arial, Helvetica, sans-serif;'>".  DAOFactory::getTipoSeccionDAO()->load($row->idTipoSeccion)->descripcion."</td>";
                    echo "<td width='100px' style='background-color:#DAB0C8; color:#7C1147;font-family: Arial, Helvetica, sans-serif;'>".$row->nombre."</td>";
                    echo "<td width='350px' style='background-color:#DAB0C8; color:#7C1147;font-family: Arial, Helvetica, sans-serif;'>".$row->descripcion."</td>";
                    echo "<td width='300px' style='background-color:#DAB0C8; color:#7C1147;font-family: Arial, Helvetica, sans-serif;'>".$row->link."</td>";
                    echo "<td align='center' class='tablaAdmin'>".linkModificar('addLinks.php',$row->id,"Editar",1)."</td>";
                    echo "<td align='center' class='tablaAdmin'>".linkEliminar('links.php',$row->id,"Borrar",0)."</td></tr>";

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
    <div class="tituloAdmin">Modulo Links</div>
    </td>
    <td align="left" width="15%"><p>&nbsp;</p>      
	<?php 
	echo linkAgregar("addLinks.php", 0, "Nuevo",1); 
	?>			

    </td>
  </tr>
</table>

<?php
}

    Cabecera('LINKS');
    
?>


  <div id="contenido">
    <?php executeComand();?>
  </div>



