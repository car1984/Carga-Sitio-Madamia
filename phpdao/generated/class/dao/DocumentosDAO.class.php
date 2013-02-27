<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2013-01-15 22:13
 */
interface DocumentosDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Documentos 
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
 	 * @param documento primary key
 	 */
	public function delete($Id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Documentos documento
 	 */
	public function insert($documento);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Documentos documento
 	 */
	public function update($documento);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByIdSeccion($value);

	public function queryByNombre($value);

	public function queryByTelefono($value);

	public function queryByMail($value);

	public function queryByFechaRegistro($value);


	public function deleteByIdSeccion($value);

	public function deleteByNombre($value);

	public function deleteByTelefono($value);

	public function deleteByMail($value);

	public function deleteByFechaRegistro($value);


}
?>