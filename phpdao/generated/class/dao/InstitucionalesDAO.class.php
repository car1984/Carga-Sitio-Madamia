<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2013-05-15 22:01
 */
interface InstitucionalesDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Institucionales 
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
 	 * @param institucionale primary key
 	 */
	public function delete($id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Institucionales institucionale
 	 */
	public function insert($institucionale);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Institucionales institucionale
 	 */
	public function update($institucionale);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByIdSeccion($value);

	public function queryByIdCategoria($value);

	public function queryByIdAlbum($value);

	public function queryByNombre($value);


	public function deleteByIdSeccion($value);

	public function deleteByIdCategoria($value);

	public function deleteByIdAlbum($value);

	public function deleteByNombre($value);


}
?>