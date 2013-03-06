<?php
    require_once '../global/include.php';
	
    ini_set("display_errors", $DISPLAY_ERROR);
    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<link rel="stylesheet" href="../resources/css/madamiaStyle.css" type="text/css" />

<script type="text/javascript" src="../resources/plugins/Carousel/jquery.jcarousel/js/jquery-1.6.2.js"></script>
<script type="text/javascript" src="../resources/plugins/Carousel/jquery.jcarousel/js/jquery.jcarousel.js"></script>
<link rel="stylesheet" type="text/css" href="../resources/plugins/Carousel/jquery.jcarousel/css/tango/skinProductos.css" />

<script type="text/javascript" >

	$(document).ready(function(){
	
			jQuery('#mycarousel').jcarousel({
              wrap: 'circular',
              visible: 5
            });
	});
	
</script>
</head>
<body>

<form action="" method="post" enctype="multipart/form-data"> 
<?php

if($_GET)
{
    $objContenido;
    $listaContenidos;
    $contenidos;
    
    $IdSeccion   = $_GET["IdSeccion"];
    
     //Se obtiene la lista de contenido que contiene los Puntos de Venta
    $listaContenidos = DAOFactory::getListaContenidoDAO()->queryByIdSeccion($IdSeccion);

    //Se obtienen los contenidos que pertencen a la lista
    $contenidos = DAOFactory::getContenidoDAO()->queryByIdLista($listaContenidos[0]->id);
    
    if(isset ($_GET["IdContenido"])){
        $IdContenido  = $_GET["IdContenido"];
        
        //Se realiza la Consulta del Contenido Seleccionado
        $objContenido = DAOFactory::getContenidoDAO()->load($IdContenido);
    }
    else{
        //Se obtiene el primer contenido por defecto 
        $objContenido = $contenidos[0];
    }
                        
   

}

?>
<div class="fondoLigthBox">
    <table width="960px" border="0"  cellpadding="0" cellspacing="0"  align="center">
    <tr >
            <td colspan ='2' valign="top"> 
              <div class="fondoTituloLigthBox">
                   <div class='textoTitulo'>Puntos de Venta</div>
          		</div>
            </td>
          </tr>
          <tr >
          	<td valign="top" >
            <br /><br /><br />
            <div class="capaTituloMapa">
                <?php
                   echo $objContenido->contenidoEsp;
                ?>
            </div>
           
            <div class="capaFondoMapa">
            	<div class="capaMapa">
                <?php
                   echo $objContenido->urlGoogleMaps;
                ?>
                </div>
            </div>
            </td>
            <td  valign="top" align="right">
                 <div class="capaMarcoPuntoVenta">
                  </div>
            </td>
          </tr>
          <tr>
          	<td co colspan="2" valign="top" >
            <div class="capaCarrucelPV">
            <ul class="jcarousel-skin-tango" id="mycarousel">
              <?php
                    
                    if($_GET)
                    {
                        //Se hace un recorrido
                        for ($i = 0 ;$i<count($contenidos);$i++)
                        {
                            //Se obtiene el album del producto
                            $album = DAOFactory::getAlbumDAO()->load($contenidos[$i]->albumId);
 
                            //Se obtienen las fotos pertenecientes al album del Producto
                            $fotos = DAOFactory::getFotoDAO()->queryByIdAlbun($album->id);
                            
                            $url = 'puntosVenta.php?IdSeccion='.$IdSeccion.'&IdContenido='.$contenidos[$i]->id;
                            
                            echo "<li>";
                            //echo $productos[$i]->nombreEsp;
                            echo "<a href='".$url."'>";
                            echo "<img width='120' height='120' src='".$fotos[0]->imagen."' id='".$fotos[0]->id."' />";
                            echo "</a>";
							
                            echo "</li>";
                        }
                    }
                    
                    ?>
            </ul>
            </div>
            </td>
          </tr>
 
    </table>
</div>
</form>
</body>
</html>