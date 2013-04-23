<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2013-04-22 18:33
 */
interface PrecioProductoDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return PrecioProducto 
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
 	 * @param precioProducto primary key
 	 */
	public function delete($id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param PrecioProducto precioProducto
 	 */
	public function insert($precioProducto);
	
	/**
 	 * Update record in table
 	 *
 	 * @param PrecioProducto precioProducto
 	 */
	public function update($precioProducto);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByIdProducto($value);

	public function queryByNombre($value);

	public function queryByValor($value);


	public function deleteByIdProducto($value);

	public function deleteByNombre($value);

	public function deleteByValor($value);


}
?>