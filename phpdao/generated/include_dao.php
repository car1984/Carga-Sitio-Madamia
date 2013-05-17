<?php
	//include all DAO files
	require_once('class/sql/Connection.class.php');
	require_once('class/sql/ConnectionFactory.class.php');
	require_once('class/sql/ConnectionProperty.class.php');
	require_once('class/sql/QueryExecutor.class.php');
	require_once('class/sql/Transaction.class.php');
	require_once('class/sql/SqlQuery.class.php');
	require_once('class/core/ArrayList.class.php');
	require_once('class/dao/DAOFactory.class.php');
 	
	require_once('class/dao/TipoProductoDAO.class.php');
	require_once('class/dto/TipoProducto.class.php');
	require_once('class/mysql/TipoProductoMySqlDAO.class.php');
	require_once('class/mysql/ext/TipoProductoMySqlExtDAO.class.php');
	require_once('class/dao/AlbumDAO.class.php');
	require_once('class/dto/Album.class.php');
	require_once('class/mysql/AlbumMySqlDAO.class.php');
	require_once('class/mysql/ext/AlbumMySqlExtDAO.class.php');
	require_once('class/dao/CategoriaDAO.class.php');
	require_once('class/dto/Categoria.class.php');
	require_once('class/mysql/CategoriaMySqlDAO.class.php');
	require_once('class/mysql/ext/CategoriaMySqlExtDAO.class.php');
	require_once('class/dao/CelendarioDAO.class.php');
	require_once('class/dto/Celendario.class.php');
	require_once('class/mysql/CelendarioMySqlDAO.class.php');
	require_once('class/mysql/ext/CelendarioMySqlExtDAO.class.php');
	require_once('class/dao/ContenidoDAO.class.php');
	require_once('class/dto/Contenido.class.php');
	require_once('class/mysql/ContenidoMySqlDAO.class.php');
	require_once('class/mysql/ext/ContenidoMySqlExtDAO.class.php');
	require_once('class/dao/DirectorioDAO.class.php');
	require_once('class/dto/Directorio.class.php');
	require_once('class/mysql/DirectorioMySqlDAO.class.php');
	require_once('class/mysql/ext/DirectorioMySqlExtDAO.class.php');
	require_once('class/dao/DocumentosDAO.class.php');
	require_once('class/dto/Documento.class.php');
	require_once('class/mysql/DocumentosMySqlDAO.class.php');
	require_once('class/mysql/ext/DocumentosMySqlExtDAO.class.php');
	require_once('class/dao/FotoDAO.class.php');
	require_once('class/dto/Foto.class.php');
	require_once('class/mysql/FotoMySqlDAO.class.php');
	require_once('class/mysql/ext/FotoMySqlExtDAO.class.php');
	require_once('class/dao/InstitucionalesDAO.class.php');
	require_once('class/dto/Institucionale.class.php');
	require_once('class/mysql/InstitucionalesMySqlDAO.class.php');
	require_once('class/mysql/ext/InstitucionalesMySqlExtDAO.class.php');
	require_once('class/dao/InstitucionalesCategoriasDAO.class.php');
	require_once('class/dto/InstitucionalesCategoria.class.php');
	require_once('class/mysql/InstitucionalesCategoriasMySqlDAO.class.php');
	require_once('class/mysql/ext/InstitucionalesCategoriasMySqlExtDAO.class.php');
	require_once('class/dao/InstitucionalesNovedadesDAO.class.php');
	require_once('class/dto/InstitucionalesNovedade.class.php');
	require_once('class/mysql/InstitucionalesNovedadesMySqlDAO.class.php');
	require_once('class/mysql/ext/InstitucionalesNovedadesMySqlExtDAO.class.php');
	require_once('class/dao/LinkDAO.class.php');
	require_once('class/dto/Link.class.php');
	require_once('class/mysql/LinkMySqlDAO.class.php');
	require_once('class/mysql/ext/LinkMySqlExtDAO.class.php');
	require_once('class/dao/ListaContenidoDAO.class.php');
	require_once('class/dto/ListaContenido.class.php');
	require_once('class/mysql/ListaContenidoMySqlDAO.class.php');
	require_once('class/mysql/ext/ListaContenidoMySqlExtDAO.class.php');
	require_once('class/dao/PrecioProductoDAO.class.php');
	require_once('class/dto/PrecioProducto.class.php');
	require_once('class/mysql/PrecioProductoMySqlDAO.class.php');
	require_once('class/mysql/ext/PrecioProductoMySqlExtDAO.class.php');
	require_once('class/dao/ProductoDAO.class.php');
	require_once('class/dto/Producto.class.php');
	require_once('class/mysql/ProductoMySqlDAO.class.php');
	require_once('class/mysql/ext/ProductoMySqlExtDAO.class.php');
	require_once('class/dao/PromocionesDAO.class.php');
	require_once('class/dto/Promocione.class.php');
	require_once('class/mysql/PromocionesMySqlDAO.class.php');
	require_once('class/mysql/ext/PromocionesMySqlExtDAO.class.php');
	require_once('class/dao/RegistroDAO.class.php');
	require_once('class/dto/Registro.class.php');
	require_once('class/mysql/RegistroMySqlDAO.class.php');
	require_once('class/mysql/ext/RegistroMySqlExtDAO.class.php');
	require_once('class/dao/RolDAO.class.php');
	require_once('class/dto/Rol.class.php');
	require_once('class/mysql/RolMySqlDAO.class.php');
	require_once('class/mysql/ext/RolMySqlExtDAO.class.php');
	require_once('class/dao/SeccionDAO.class.php');
	require_once('class/dto/Seccion.class.php');
	require_once('class/mysql/SeccionMySqlDAO.class.php');
	require_once('class/mysql/ext/SeccionMySqlExtDAO.class.php');
	require_once('class/dao/TipoSeccionDAO.class.php');
	require_once('class/dto/TipoSeccion.class.php');
	require_once('class/mysql/TipoSeccionMySqlDAO.class.php');
	require_once('class/mysql/ext/TipoSeccionMySqlExtDAO.class.php');
	require_once('class/dao/UsuarioDAO.class.php');
	require_once('class/dto/Usuario.class.php');
	require_once('class/mysql/UsuarioMySqlDAO.class.php');
	require_once('class/mysql/ext/UsuarioMySqlExtDAO.class.php');

?>