<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2013-05-15 22:01
 */
interface InstitucionalesCategoriasDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return InstitucionalesCategorias 
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
 	 * @param institucionalesCategoria primary key
 	 */
	public function delete($id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param InstitucionalesCategorias institucionalesCategoria
 	 */
	public function insert($institucionalesCategoria);
	
	/**
 	 * Update record in table
 	 *
 	 * @param InstitucionalesCategorias institucionalesCategoria
 	 */
	public function update($institucionalesCategoria);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByNombre($value);

	public function queryByDescripcion($value);


	public function deleteByNombre($value);

	public function deleteByDescripcion($value);


}
?>