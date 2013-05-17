<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2013-05-15 22:01
 */
interface CelendarioDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Celendario 
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
 	 * @param celendario primary key
 	 */
	public function delete($Id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Celendario celendario
 	 */
	public function insert($celendario);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Celendario celendario
 	 */
	public function update($celendario);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByIdSeccion($value);

	public function queryByFechaInicial($value);

	public function queryByFechaFinal($value);

	public function queryByHoraInical($value);

	public function queryByHoraFinal($value);

	public function queryByDescripcionEsp($value);

	public function queryByDescripcionIng($value);

	public function queryByTituloEsp($value);

	public function queryByTituloIng($value);


	public function deleteByIdSeccion($value);

	public function deleteByFechaInicial($value);

	public function deleteByFechaFinal($value);

	public function deleteByHoraInical($value);

	public function deleteByHoraFinal($value);

	public function deleteByDescripcionEsp($value);

	public function deleteByDescripcionIng($value);

	public function deleteByTituloEsp($value);

	public function deleteByTituloIng($value);


}
?>