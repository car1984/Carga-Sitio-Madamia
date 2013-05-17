<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2013-05-15 22:01
 */
interface PromocionesDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Promociones 
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
 	 * @param promocione primary key
 	 */
	public function delete($id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Promociones promocione
 	 */
	public function insert($promocione);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Promociones promocione
 	 */
	public function update($promocione);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryBySeccionId($value);

	public function queryByFechaInicio($value);

	public function queryByFechaFin($value);

	public function queryByDesccripcionEsp($value);

	public function queryByDescripcionEng($value);


	public function deleteBySeccionId($value);

	public function deleteByFechaInicio($value);

	public function deleteByFechaFin($value);

	public function deleteByDesccripcionEsp($value);

	public function deleteByDescripcionEng($value);


}
?>