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
    if($_POST['TxtSeccion']=='')
    {
        $error_msg = $error_msg.'Falta el Nombre de la Seccion<br>';
    }
    if($_POST['TxtEspanol']=='')
    {
        $error_msg = $error_msg.'Falta el Titulo en Español<br>';
    }
    if($_POST['TxtIngles']=='')
    {
        $error_msg = $error_msg.'Falta el Titulo en Ingles<br>';
    }   
    $aux = 0;
    if($_POST['TxtPosicion']=='')
    {
        $error_msg = $error_msg.'Falta la Posicion de Inicio<br>';
    }
    else
    {
        $aux = $_POST['TxtPosicion'];
    }
    if( !is_numeric($aux) )
    {
        $error_msg = $error_msg.'La Posicion debe ser Numerico<br>';
    }

    if($error_msg == '')
    {
        $transaction = new Transaction();
 
        $auxIPadre = $_POST['cboSeccion'];
        if($_POST['cboSeccion']=='-1')
            $auxIPadre= "0";
        
        $seccion = new Seccion();
        $seccion->id         =$_POST['IdSeccion'];
        $seccion->idPapa     =$auxIPadre;
        $seccion->nombre     =$_POST['TxtSeccion'];
        $seccion->tipoSeccion=$_POST['ListTipoSeccion'];
        $seccion->posicion   =$_POST['TxtPosicion'];
        $seccion->tituloEsp  =$_POST['TxtEspanol'];
        $seccion->tituloEng  =$_POST['TxtIngles'];
        $seccion->imagen     =$_POST['fileImage'];

        $guardar=true;

        if($_FILES['fileimg']['name']!=''){

            $nombre_archivo = quitar_caracteres_raros($_FILES['fileimg']['name']);
            $tipo_archivo   = $_FILES['fileimg']['type'];
            $tamano_archivo = $_FILES['fileimg']['size'];
            $ruta_archivo   = $_FILES['fileimg']['tmp_name'];
            if(!is_dir("../resources/csm/img/Seccion/"))
            {
                mkdir("../resources/csm/img/Seccion/");
            }
            $destination = '../resources/csm/img/Seccion/';
            
            if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "jpg")|| strpos($tipo_archivo, "png")) && ($tamano_archivo < (500 * 1024) )))
            {
                echo '<span class="notification n-error">La extensión o el tamaño del fichero no es correcta.</span>';
            } 
            else if(move_uploaded_file($ruta_archivo, $destination.$nombre_archivo))
            {
                $seccion->imagen='../resources/csm/img/Seccion/'.$nombre_archivo;
            }
            else{
                notificacion("Error Al Subir La Imagen", $NOTI_ERROR);
                $guardar = false;
            }
        }

        //Se valida si debe proceder a guardar la seccion
        if($guardar){
            DAOFactory::getSeccionDAO()->update($seccion);
            
            $transaction->commit();

            $strNotificacion  = '<b>Seccion Actualizada Correctamente</b>';
            $strNotificacion .= '<br><br><a href="javascript:parent.jQuery.fancybox.close();">Cerrar Ventana</a>';

            //Notificacion
            notificacion($strNotificacion, $NOTI_SUCCESS);

            $popUp = 0;
            
            
        }
        
        

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
    

    $tabla = DAOFactory::getSeccionDAO()->queryAllOrderBy('id');

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
    if($_POST['TxtSeccion']=='')
    {
        $error_msg = $error_msg.'Falta el Nombre de la Seccion<br>';
    }
    if($_POST['TxtEspanol']=='')
    {
        $error_msg = $error_msg.'Falta el Titulo en Español<br>';
    }
    if($_POST['TxtIngles']=='')
    {
        $error_msg = $error_msg.'Falta el Titulo en Ingles<br>';
    }
    if($_FILES['fileimg']['name']=='')
    {
        $error_msg = $error_msg.'Falta la Ruta De Imagen<br>';
    }
    $aux = 0;
    if($_POST['TxtPosicion']=='')
    {
        $error_msg = $error_msg.'Falta la Posicion de Inicio<br>';
    }
    else
    {
        $aux = $_POST['TxtPosicion'];
    }
    if( !is_numeric($aux) )
    {
        $error_msg = $error_msg.'La Posicion debe ser Numerico<br>';
    }

    if($error_msg == '')
    {
        
        $transaction = new Transaction();

        
        $nombre_archivo = quitar_caracteres_raros($_FILES['fileimg']['name']);
        $tipo_archivo = $_FILES['fileimg']['type'];
        $tamano_archivo = $_FILES['fileimg']['size'];
        $ruta_archivo=$_FILES['fileimg']['tmp_name'];
        if(!is_dir("../resources/csm/img/Seccion/"))
        {
            mkdir("../resources/csm/img/Seccion/");
        }
        $destination = '../resources/csm/img/Seccion/';
        if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "jpg")|| strpos($tipo_archivo, "png")) && ($tamano_archivo < (500 * 1024) )))
        {
            echo '<span class="notification n-error">La extensión o el tamaño del fichero no es correcta.</span>';
        }
        else
        {       
            
            if(move_uploaded_file($ruta_archivo, $destination.$nombre_archivo)){

                $seccion = new Seccion();
                $seccion->nombre     =$_POST['TxtSeccion'];
                $seccion->tipoSeccion=$_POST['ListTipoSeccion'];
                $seccion->posicion   =$_POST['TxtPosicion'];
                $seccion->tituloEsp  =$_POST['TxtEspanol'];
                $seccion->tituloEng  =$_POST['TxtIngles'];
                $seccion->idPapa     =$_POST['cboSeccion'];
                $seccion->imagen     ='resources/img_cms/general/Seccion/'.$nombre_archivo;

                DAOFactory::getSeccionDAO()->insert($seccion);

                if($seccion->id > $ultimo){
                    
                   $transaction->commit();
                   
                   $strNotificacion  = '<b>Seccion Agregado Correctamente</b>';
                   $strNotificacion .= '<br><br><a href="javascript:parent.jQuery.fancybox.close();">Cerrar Ventana</a>';
            
                   //Notificacion
                   notificacion($strNotificacion, $NOTI_SUCCESS);
            
                   $popUp = 0;
                   
                }
            }
            else{
                //Notificacion
                notificacion("Error al subir la imagen", $NOTI_ERROR);
            }
            
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
        $IdSeccion = $_GET['Id'];
        DAOFactory::getSeccionDAO()->delete($IdSeccion);
        notificacion("Seccion Eliminada",$NOTI_SUCCESS );
    }
    else{
        notificacion("Error Eliminando la Seccion",$NOTI_ERROR );
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


                $tablaconsulta = DAOFactory::getSeccionDAO()->queryAllOrderBy('IdPapa');
                for($fila=0;$fila<count($tablaconsulta);$fila ++)
                {
                    $row = $tablaconsulta[$fila];

                    echo "<tr height='40px'><td width='50px' style='background-color:#DAB0C8; color:#7C1147;font-family: Arial, Helvetica, sans-serif;'>".$row->posicion."</td>";
                    echo "<td width='250px' style='background-color:#DAB0C8; color:#7C1147;font-family: Arial, Helvetica, sans-serif;'>".DAOFactory::getTipoSeccionDAO()->load($row->tipoSeccion)->descripcion."</td>";
                    echo "<td width='300px' style='background-color:#DAB0C8; color:#7C1147;font-family: Arial, Helvetica, sans-serif;'>Seccion: ".$row->nombre."</td>";
                    $auxPadre = "raiz";
                    if(DAOFactory::getSeccionDAO()->load($row->idPapa))
                      $auxPadre=DAOFactory::getSeccionDAO()->load($row->idPapa)->nombre;
                    echo "<td width='300px' style='background-color:#DAB0C8; color:#7C1147;font-family: Arial, Helvetica, sans-serif;'>Seccion Padre: ".$auxPadre."</td>";
                    echo "<td align='center' class='tablaAdmin'>".linkModificar('addSecciones.php',$row->id,"Editar",1)."</td>";
                    echo "<td align='center' class='tablaAdmin'>".linkEliminar('secciones.php',$row->id,"Borrar",0)."</td></tr>";

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
    <div class="tituloAdmin">Modulo Secciones</div>
    </td>
    <td align="left" width="15%"><p>&nbsp;</p>      
	<?php 
	echo linkAgregar("addSecciones.php", 0, "Nuevo",1); 
	?>			

    </td>
  </tr>
</table>

<?php
}

    Cabecera('SECCIONES');
    
?>


  <div id="contenido">
    <?php executeComand();?>
  </div>



