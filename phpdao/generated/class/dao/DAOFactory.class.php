<?php

/**
 * DAOFactory
 * @author: http://phpdao.com
 * @date: ${date}
 */
class DAOFactory{
	
	/**
	 * @return TipoProductoDAO
	 */
	public static function getTipoProductoDAO(){
		return new TipoProductoMySqlExtDAO();
	}

	/**
	 * @return AlbumDAO
	 */
	public static function getAlbumDAO(){
		return new AlbumMySqlExtDAO();
	}

	/**
	 * @return CategoriaDAO
	 */
	public static function getCategoriaDAO(){
		return new CategoriaMySqlExtDAO();
	}

	/**
	 * @return CelendarioDAO
	 */
	public static function getCelendarioDAO(){
		return new CelendarioMySqlExtDAO();
	}

	/**
	 * @return ContenidoDAO
	 */
	public static function getContenidoDAO(){
		return new ContenidoMySqlExtDAO();
	}

	/**
	 * @return DirectorioDAO
	 */
	public static function getDirectorioDAO(){
		return new DirectorioMySqlExtDAO();
	}

	/**
	 * @return DocumentosDAO
	 */
	public static function getDocumentosDAO(){
		return new DocumentosMySqlExtDAO();
	}

	/**
	 * @return FotoDAO
	 */
	public static function getFotoDAO(){
		return new FotoMySqlExtDAO();
	}

	/**
	 * @return InstitucionalesDAO
	 */
	public static function getInstitucionalesDAO(){
		return new InstitucionalesMySqlExtDAO();
	}

	/**
	 * @return InstitucionalesCategoriasDAO
	 */
	public static function getInstitucionalesCategoriasDAO(){
		return new InstitucionalesCategoriasMySqlExtDAO();
	}

	/**
	 * @return InstitucionalesNovedadesDAO
	 */
	public static function getInstitucionalesNovedadesDAO(){
		return new InstitucionalesNovedadesMySqlExtDAO();
	}

	/**
	 * @return LinkDAO
	 */
	public static function getLinkDAO(){
		return new LinkMySqlExtDAO();
	}

	/**
	 * @return ListaContenidoDAO
	 */
	public static function getListaContenidoDAO(){
		return new ListaContenidoMySqlExtDAO();
	}

	/**
	 * @return PrecioProductoDAO
	 */
	public static function getPrecioProductoDAO(){
		return new PrecioProductoMySqlExtDAO();
	}

	/**
	 * @return ProductoDAO
	 */
	public static function getProductoDAO(){
		return new ProductoMySqlExtDAO();
	}

	/**
	 * @return PromocionesDAO
	 */
	public static function getPromocionesDAO(){
		return new PromocionesMySqlExtDAO();
	}

	/**
	 * @return RegistroDAO
	 */
	public static function getRegistroDAO(){
		return new RegistroMySqlExtDAO();
	}

	/**
	 * @return RolDAO
	 */
	public static function getRolDAO(){
		return new RolMySqlExtDAO();
	}

	/**
	 * @return SeccionDAO
	 */
	public static function getSeccionDAO(){
		return new SeccionMySqlExtDAO();
	}

	/**
	 * @return TipoSeccionDAO
	 */
	public static function getTipoSeccionDAO(){
		return new TipoSeccionMySqlExtDAO();
	}

	/**
	 * @return UsuarioDAO
	 */
	public static function getUsuarioDAO(){
		return new UsuarioMySqlExtDAO();
	}


}
?>