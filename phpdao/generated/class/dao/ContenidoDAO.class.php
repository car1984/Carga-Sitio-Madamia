<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2013-05-15 22:01
 */
interface ContenidoDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Contenido 
	 */
	public function load($id);

	/**
	 * Get all records from table
	 */
	public function queryAll();
	
	/**
	 * Get all records from table ordered by field
	 * @Param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn);
	
	/**
 	 * Delete record from table
 	 * @param contenido primary key
 	 */
	public function delete($Id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Contenido contenido
 	 */
	public function insert($contenido);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Contenido contenido
 	 */
	public function update($contenido);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByIdLista($value);

	public function queryByNombreEsp($value);

	public function queryByNombreIng($value);

	public function queryByContenidoEsp($value);

	public function queryByContenidoIng($value);

	public function queryByAlbumId($value);

	public function queryByUrlGoogleMaps($value);


	public function deleteByIdLista($value);

	public function deleteByNombreEsp($value);

	public function deleteByNombreIng($value);

	public function deleteByContenidoEsp($value);

	public function deleteByContenidoIng($value);

	public function deleteByAlbumId($value);

	public function deleteByUrlGoogleMaps($value);


}
?>