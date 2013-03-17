<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2013-03-16 20:04
 */
interface ProductoDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Producto 
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
 	 * @param producto primary key
 	 */
	public function delete($Id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Producto producto
 	 */
	public function insert($producto);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Producto producto
 	 */
	public function update($producto);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByIdSeccion($value);

	public function queryByIdAlbum($value);

	public function queryByNombreEsp($value);

	public function queryByNombreIng($value);

	public function queryByDescripcionEsp($value);

	public function queryByDescripcionIng($value);

	public function queryByIdTipoProducto($value);

	public function queryByPopulate($value);

	public function queryByTop10($value);


	public function deleteByIdSeccion($value);

	public function deleteByIdAlbum($value);

	public function deleteByNombreEsp($value);

	public function deleteByNombreIng($value);

	public function deleteByDescripcionEsp($value);

	public function deleteByDescripcionIng($value);

	public function deleteByIdTipoProducto($value);

	public function deleteByPopulate($value);

	public function deleteByTop10($value);


}
?>