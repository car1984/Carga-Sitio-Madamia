<?php
    
    session_start();    

    // --------------------------------------------------------------------
    // Variables Globales del Sistema
    // --------------------------------------------------------------------

    //Variable para mostrar los errores 
    static $DISPLAY_ERROR = true;

    //Variables globales para el manejo del Idioma

    static $IDIOMA_ESP = 'ES';
    static $IDIOMA_ING = 'EN';
    static $IDIOMA_AVAIBLE = false;
    static $IDIOMA_DEFAULT = 'ES';

    //Variables globales para el administrador de contenido
    static $PATH_ALBUM = '../resources/csm/album/album';

    static $NOTI_ERROR      = 'ERROR';
    static $NOTI_SUCCESS    = 'SUCCESS'; 

    // --------------------------------------------------------------------
    //Variables de Madamia
    // --------------------------------------------------------------------

    static $RAIZ_MENU        = 0;
    static $RAIZ_PRODUCTO    = 5;
    static $ALBUM_B_PRINCIPAL= 13;
    statiC $ALBUM_B_PRODUCTOS= 14;
    statiC $ALBUM_B_NOVEDADES= 15;

    //Se realiza la valición para el manejo del idioma
    if($IDIOMA_AVAIBLE){
        if (!isset($_SESSION['_IDIOMA'])){
          $_SESSION['_IDIOMA'] = $IDIOMA_DEFAULT;       
        } else if(isset($_GET['_IDIOMA'])){
          $_SESSION['_IDIOMA'] = $_GET['_IDIOMA'];
        }
    }else {
        $_SESSION['_IDIOMA'] = $IDIOMA_DEFAULT;
    }


        
    // --------------------------------------------------------------------
    // Funciones Render del sistema
    // --------------------------------------------------------------------
    
    /**
     * Funcion encargada de armar de imprimir un String del Menu Basado 
     * en la seccion deseada
     * @param type $IdPapa 
     */
    function displayMenu($IdPapa)
    {
        $SeccionesPapa  = DAOFactory::getSeccionDAO()->queryByIdPapa($IdPapa);

        for ($i = 0; $i< count($SeccionesPapa) ;$i++)
        {
            echo '<li>';
            hrefMenu($SeccionesPapa[$i]);
            $SeccionesHijo  = DAOFactory::getSeccionDAO()->queryByIdPapa($SeccionesPapa[$i]->id);

            if(count($SeccionesHijo) > 0)
              echo '<ul>';

            for ($x = 0; $x< count($SeccionesHijo) ;$x++)
            { 
                 echo '<li>';
                 hrefMenu($SeccionesHijo[$x]);

                 $SeccionesNieto  = DAOFactory::getSeccionDAO()->queryByIdPapa($SeccionesHijo[$x]->id);

                 if(count($SeccionesNieto) > 0)
                    echo '<ul>';

                 for ($y = 0; $y < count($SeccionesNieto) ;$y++)
                 {
                     echo '<li>';
                     hrefMenu($SeccionesNieto[$y]);
                     echo '</li>';
                 }

                 if(count($SeccionesNieto) > 0)
                    echo '</ul>';

                 echo '</li>';

            }

            if(count($SeccionesHijo) > 0)
                echo '</ul>';

            echo '</li>';
        }

    }

    /**
     * Funcion encargada de armar un string href de la seccion determinando 
     * si debe generar un ligthbox
     * @param type $seccion 
     */
    function hrefMenu($seccion)
    {
        $tipoSeccion = DAOFactory::getTipoSeccionDAO()->load($seccion->tipoSeccion);

        $url = $tipoSeccion->uRLUsuraio."?IdSeccion=".$seccion->id;

        if($tipoSeccion->popup){
            echo '<a class="fancybox fancybox.iframe" href="'.$url.'">'.$seccion->nombre.'</a>';
        }else{
            echo '<a href="'.$url.'">'.$seccion->nombre.'</a>';
        }

    }

    /**
     * Funcion encargada de determinar si se habilita o no basado en el Rol
     * @return string 
     */
    function isDisabled(){
         if($_SESSION['username']=="admin")
             return "<input class='bEliminar' type='submit' name='BtnEliminar' value='' />";
         else
             return '';
    }
    
    function btnEliminar(){
        if(permisosRol('Eliminar'))
             return "<input class='BtnEliminar' type='submit' name='BtnEliminar' value='' />";
         else
             return '';
    }
    
    function btnModificar(){
        if(permisosRol('Modificar'))
             return "<input class='BtnModificar' type='submit' name='BtnModificar' value='' />";
         else
             return '';
    }
    
    function btnCrear(){
        if(permisosRol('insert'))
             return "<input class='BtnGuardar' type='submit' name='BtnGuardar' value='' />";
         else
             return '';
    }
    
    function btnConsultar(){
        if(permisosRol('Consultar'))
             return "<input class='BtnConsultar' type='submit' name='BtnConsultar' value='' />";
         else
             return '';
    }
    
    function btnCancelar(){
        if(permisosRol('Cancelar'))
             return "<input class='BtnCancelar' type='submit' name='BtnCancelar' value='' />";
         else
             return '';
    }
    
    function linkModificar($url, $id,$texto, $popUp){
        if(permisosRol('edit'))
            return buildLink($url, $id, $texto, $popUp,'BtnModificar','edit'); 
         else
             return '';
    }
    
    function linkEliminar($url, $id,$texto,$popUp){
        if(permisosRol('delete'))
            return buildLink($url, $id, $texto, $popUp,'BtnEliminar','delete'); 
         else
             return '';
    }
    
    function linkAgregar($url, $id, $texto, $popUp){
        if(permisosRol('create'))
            return buildLink($url, $id, $texto, $popUp,'BtnAgregar','create');
        else
           return ''; 
        
             
    }
    
    function linkAbrirFoto($url, $id, $texto, $popUp){
        if(permisosRol('select'))
            return buildLink($url, $id, $texto, $popUp,'BtnAddImage','open');
        else
           return '';       
    }
    
    function buildLink($url, $id, $texto, $popUp, $class, $execute)
    {
        if($popUp==1)
        {
            $strPopUp = "<a class='fancybox fancybox.iframe' href='".$url."?Id=".$id."&execute=".$execute."'>";
            $strPopUp.= "<div class='".$class."'>".$texto."</div></a>";

            return $strPopUp;
         }
         else
         {
             return "<a class='".$class."' href='".$url."?Id=".$id."&execute=".$execute."'>".$texto."</a>";
         }
    }
    
    function notificacion($texto, $notificacion)
    {
        if($notificacion=='SUCCESS')
            echo '<span class="notification n-success">'.$texto.'</span>';
        else if($notificacion=='ERROR')
            echo '<span class="notification n-error">'.$texto.'</span>';
    }

    function ComboGenerico($tablaconsulta,$id)
    {
        echo '<option value="-1">--Seleccionar--</option>';
        
        for($fila=0;$fila<count($tablaconsulta);$fila ++)
        {
            $row = $tablaconsulta[$fila];
            
            if ($row->id==$id) 
                echo "<option value='".$row->id."' SELECTED >".$row->nombre."</option>";
            else 
                echo "<option value='".$row->id."'>".$row->nombre."</option>";
        }
        return "";
    }
    
    
    // --------------------------------------------------------------------
    // Funciones Generales del Sistema
    // --------------------------------------------------------------------

    /**
     * Funcion encargada de determinar si el Idioma a imprimir en el Texto
     * @return string 
     */
    function Idioma($esp, $ing){
        if($_SESSION['_IDIOMA']=="ES")
            return $esp;
        else
            return $ing;
    }
    function permisosRol($permiso)
    {
        return true;
    }
    
    function executeComand()
    {
        $ExecuteComand =getComand();


        switch ($ExecuteComand)
        {
            case 'open':
                verModulo();
                break;
            
            case 'create':
                verModulo();
                break;
            
            case 'edit':
                verModulo();
                break;
            
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
                verHeader();
                verItems();
                break;

            default :
                verModulo();
        }
    }

    function getComand(){
        
        $ExecuteComand ='select';

        if($_POST){
            $ExecuteComand= $_POST['execute'];
        }else if($_GET){
            $ExecuteComand= $_GET['execute'];
        }
        
        return $ExecuteComand;
    }
    
    function isComandOpen(){       
        $iscomand = false;
        if(getComand()=='open')
            $iscomand = true;
        
        return $iscomand;
    }
    
    function isComandEdit(){       
        $iscomand = false;
        if(getComand()=='edit')
            $iscomand = true;
        
        return $iscomand;
    }
    
    function isComandCreate(){       
        $iscomand = false;
        if(getComand()=='create')
            $iscomand = true;
        
        return $iscomand;
    }
    
    function isComandInsert(){       
        $iscomand = false;
        if(getComand()=='insert')
            $iscomand = true;
        
        return $iscomand;
    }
    
    function isComandSelect(){       
        $iscomand = false;
        if(getComand()=='select')
            $iscomand = true;
        
        return $iscomand;
    }
    
    function isComandDelete(){       
        $iscomand = false;
        if(getComand()=='delete')
            $iscomand = true;
        
        return $iscomand;
    }
    
    function isComandUpdate(){       
        $iscomand = false;
        if(getComand()=='update')
            $iscomand = true;
        
        return $iscomand;
    }
    // --------------------------------------------------------------------
    // Funciones De Madamia
    // --------------------------------------------------------------------

    
    function ComboTipoProducto($id){
        $tablaconsulta = DAOFactory::getTipoProductoDAO()->queryAllOrderBy('id');
        ComboGenerico($tablaconsulta,$id);  
    }
    
    function ComboSeccion($id){
        $tablaconsulta = DAOFactory::getSeccionDAO()->queryAllOrderBy('id');
        ComboGenerico($tablaconsulta,$id);  
    }
    
    function ComboSeccionTipoSeccion($idSeccion,$idTipoSeccion){
        $tablaconsulta = DAOFactory::getSeccionDAO()->queryByTipoSeccion($idTipoSeccion);
        ComboGenerico($tablaconsulta,$idSeccion);  
    }
    
    function ComboAlbum($id){
        $tablaconsulta = DAOFactory::getAlbumDAO()->queryAllOrderBy('id');
        ComboGenerico($tablaconsulta,$id);   
    }
    
    function ComboLista($id){
        $tablaconsulta = DAOFactory::getListaContenidoDAO()->queryAllOrderBy("id");
        ComboGenerico($tablaconsulta,$id); 
    }
    function ComboPrecio($id){
        $tablaconsulta = DAOFactory::getPrecioProductoDAO()->queryAllOrderBy('id');
        ComboGenerico($tablaconsulta,$id);   
    }

    function ComboPrecioProducto($id){
        $tablaconsulta = DAOFactory::getPrecioProductoDAO()->queryByIdProducto($id);
        ComboGenerico($tablaconsulta,$id);   
    }
   
    
?>