<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2013-03-16 20:04
 */
interface ListaContenidoDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return ListaContenido 
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
 	 * @param listaContenido primary key
 	 */
	public function delete($Id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param ListaContenido listaContenido
 	 */
	public function insert($listaContenido);
	
	/**
 	 * Update record in table
 	 *
 	 * @param ListaContenido listaContenido
 	 */
	public function update($listaContenido);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByIdSeccion($value);

	public function queryByNombre($value);

	public function queryByFondo($value);

	public function queryByFotos($value);


	public function deleteByIdSeccion($value);

	public function deleteByNombre($value);

	public function deleteByFondo($value);

	public function deleteByFotos($value);


}
?>