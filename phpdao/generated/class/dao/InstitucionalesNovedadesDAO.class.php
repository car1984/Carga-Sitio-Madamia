<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2013-05-15 22:01
 */
interface InstitucionalesNovedadesDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return InstitucionalesNovedades 
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
 	 * @param institucionalesNovedade primary key
 	 */
	public function delete($id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param InstitucionalesNovedades institucionalesNovedade
 	 */
	public function insert($institucionalesNovedade);
	
	/**
 	 * Update record in table
 	 *
 	 * @param InstitucionalesNovedades institucionalesNovedade
 	 */
	public function update($institucionalesNovedade);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByIdInstitucionales($value);

	public function queryByNovedad($value);


	public function deleteByIdInstitucionales($value);

	public function deleteByNovedad($value);


}
?>