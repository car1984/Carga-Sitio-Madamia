<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2013-03-04 20:00
 */
interface RegistroDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Registro 
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
 	 * @param registro primary key
 	 */
	public function delete($id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Registro registro
 	 */
	public function insert($registro);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Registro registro
 	 */
	public function update($registro);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByNombre($value);

	public function queryByApellido($value);

	public function queryByCedula($value);

	public function queryByEmail($value);

	public function queryByTelefono($value);

	public function queryByDia($value);

	public function queryByMes($value);

	public function queryByAno($value);


	public function deleteByNombre($value);

	public function deleteByApellido($value);

	public function deleteByCedula($value);

	public function deleteByEmail($value);

	public function deleteByTelefono($value);

	public function deleteByDia($value);

	public function deleteByMes($value);

	public function deleteByAno($value);


}
?>