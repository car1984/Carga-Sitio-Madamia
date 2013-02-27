<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2013-01-15 22:13
 */
interface TipoSeccionDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return TipoSeccion 
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
 	 * @param tipoSeccion primary key
 	 */
	public function delete($Id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param TipoSeccion tipoSeccion
 	 */
	public function insert($tipoSeccion);
	
	/**
 	 * Update record in table
 	 *
 	 * @param TipoSeccion tipoSeccion
 	 */
	public function update($tipoSeccion);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByDescripcion($value);

	public function queryByURLUsuraio($value);

	public function queryByPopup($value);


	public function deleteByDescripcion($value);

	public function deleteByURLUsuraio($value);

	public function deleteByPopup($value);


}
?>