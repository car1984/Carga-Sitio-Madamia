<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2013-04-22 18:33
 */
interface LinkDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Link 
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
 	 * @param link primary key
 	 */
	public function delete($id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Link link
 	 */
	public function insert($link);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Link link
 	 */
	public function update($link);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByIdTipoSeccion($value);

	public function queryByNombre($value);

	public function queryByDescripcion($value);

	public function queryByLink($value);


	public function deleteByIdTipoSeccion($value);

	public function deleteByNombre($value);

	public function deleteByDescripcion($value);

	public function deleteByLink($value);


}
?>