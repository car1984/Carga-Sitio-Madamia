<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2013-01-15 22:13
 */
interface SeccionDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Seccion 
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
 	 * @param seccion primary key
 	 */
	public function delete($Id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Seccion seccion
 	 */
	public function insert($seccion);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Seccion seccion
 	 */
	public function update($seccion);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByIdPapa($value);

	public function queryByTipoSeccion($value);

	public function queryByNombre($value);

	public function queryByImagen($value);

	public function queryByTituloEsp($value);

	public function queryByTituloEng($value);

	public function queryByPosicion($value);


	public function deleteByIdPapa($value);

	public function deleteByTipoSeccion($value);

	public function deleteByNombre($value);

	public function deleteByImagen($value);

	public function deleteByTituloEsp($value);

	public function deleteByTituloEng($value);

	public function deleteByPosicion($value);


}
?>