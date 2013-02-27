<?php
require_once('../include_dao.php');
if ( !isset($_SESSION['username']) && !isset($_SESSION['userid']) )
{
    header('Location: ./');
}

$RegistrosAMostrar=10;

//estos valores los recibo por GET
if(isset($_GET['pag'])){
    $RegistrosAEmpezar=($_GET['pag']-1)*$RegistrosAMostrar;
    $PagAct=$_GET['pag'];
    $RegistrosAMostrar=10;
//caso contrario los iniciamos
}else{
    $RegistrosAEmpezar=0;
    $PagAct=1;
    $RegistrosAMostrar=10;
}

GrillaAlbums($RegistrosAEmpezar, $RegistrosAMostrar);

$NroRegistros = count(DAOFactory::getAlbumDAO()->queryAll());
$PagAnt=$PagAct-1;
$PagSig=$PagAct+1;
$PagUlt=$NroRegistros/$RegistrosAMostrar;

//verificamos residuo para ver si llevará decimales
$Res=$NroRegistros%$RegistrosAMostrar;
// si hay residuo usamos funcion floor para que me
// devuelva la parte entera, SIN REDONDEAR, y le sumamos
// una unidad para obtener la ultima pagina
if($Res>0) $PagUlt=floor($PagUlt)+1;

//desplazamiento
echo "<a onclick=\"Pagina('1')\">Primero</a> ";
if($PagAct>1) echo "<a onclick=\"Pagina('$PagAnt')\">Anterior</a> ";
echo "<strong>Pagina ".$PagAct."/".$PagUlt."</strong>";
if($PagAct<$PagUlt)  echo " <a onclick=\"Pagina('$PagSig')\">Siguiente</a> ";
echo "<a onclick=\"Pagina('$PagUlt')\">Ultimo</a>";


function PoblarGrillas($opcion)
{
    $RegistrosAMostrar=10;
    //estos valores los recibo por GET
    if(isset($_GET['pag'])){
        $RegistrosAEmpezar=($_GET['pag']-1)*$RegistrosAMostrar;
        $PagAct=$_GET['pag'];
        $RegistrosAMostrar=10;
    //caso contrario los iniciamos
    }else{
        $RegistrosAEmpezar=0;
        $PagAct=1;
        $RegistrosAMostrar=10;
    }

    //// CORE del negocio 
    switch ($opcion)
    {
        case 'Album':
            GrillaAlbums($RegistrosAEmpezar, $RegistrosAMostrar);
            $NroRegistros = count(DAOFactory::getAlbumDAO()->queryAll());
            break;
        case 'Fotos':
            $NroRegistros = count(DAOFactory::getFotoDAO()->queryByIdAlbun($value));
            break;
    }

    ////
    $PagAnt=$PagAct-1;
    $PagSig=$PagAct+1;
    $PagUlt=$NroRegistros/$RegistrosAMostrar;

    //verificamos residuo para ver si llevará decimales
    $Res=$NroRegistros%$RegistrosAMostrar;
    // si hay residuo usamos funcion floor para que me
    // devuelva la parte entera, SIN REDONDEAR, y le sumamos
    // una unidad para obtener la ultima pagina
    if($Res>0) $PagUlt=floor($PagUlt)+1;

    //desplazamiento
    echo "<a onclick=\"Pagina('1')\">Primero</a> ";
    if($PagAct>1) echo "<a onclick=\"Pagina('$PagAnt')\">Anterior</a> ";
    echo "<strong>Pagina ".$PagAct."/".$PagUlt."</strong>";
    if($PagAct<$PagUlt)  echo " <a onclick=\"Pagina('$PagSig')\">Siguiente</a> ";
    echo "<a onclick=\"Pagina('$PagUlt')\">Ultimo</a>";
}

function GrillaAlbums($RegistrosAEmpezar, $RegistrosAMostrar)
{
    ?>
<div class="module">
            <h2><span>Albumnes Disponibles</span></h2>
            <div class="module-table-body">
                    	<form action="">
                            <table id="myTable" class="tablesorter" cellpadding="0" cellspacing="0">
                           <thead>
                                <tr>
                                    <th style="width:5%">#</th>
                                    <th style="width:35%">Titulo en Español</th>
                                    <th style="width:35%">Titulo en Ingles</th>
                                    <th style="width:25%">Fecha Creacion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //$tablaconsulta = DAOFactory::getAlbumDAO()->queryAllOrderBy('id');
                                $tablaconsulta=DAOFactory::getAlbumDAO()->queryPaginar($RegistrosAEmpezar, $RegistrosAMostrar);
                                for($fila=0;$fila<count($tablaconsulta);$fila ++)
                                {
                                    $row = $tablaconsulta[$fila];
                                    echo "<tr><td class='align-center'>".($fila+1)."</td>";
                                    echo "<td><a href='fotosalbums.php?id=".$row->id."'>".$row->nombreEsp."</a></td>";
                                    echo "<td>".$row->nombreIng."</td>";
                                    echo "<td><a href='fotosalbums.php?id=".$row->id."'>Seleccionar</a></td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        </form>
            </div>

        </div>

<?php
}
?>
