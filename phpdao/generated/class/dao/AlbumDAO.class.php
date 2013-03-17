<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2013-03-16 20:04
 */
interface AlbumDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Album 
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
 	 * @param album primary key
 	 */
	public function delete($Id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Album album
 	 */
	public function insert($album);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Album album
 	 */
	public function update($album);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByNombre($value);

	public function queryByFecha($value);

	public function queryByMostrar($value);


	public function deleteByNombre($value);

	public function deleteByFecha($value);

	public function deleteByMostrar($value);


}
?>