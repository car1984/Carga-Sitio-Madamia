<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2013-05-15 22:01
 */
interface DirectorioDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Directorio 
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
 	 * @param directorio primary key
 	 */
	public function delete($Id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Directorio directorio
 	 */
	public function insert($directorio);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Directorio directorio
 	 */
	public function update($directorio);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByIdSeccion($value);

	public function queryByNombre($value);

	public function queryByTelefono($value);

	public function queryByMail($value);


	public function deleteByIdSeccion($value);

	public function deleteByNombre($value);

	public function deleteByTelefono($value);

	public function deleteByMail($value);


}
?>