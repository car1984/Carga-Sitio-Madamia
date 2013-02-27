<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2013-01-15 22:13
 */
interface CategoriaDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Categoria 
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
 	 * @param categoria primary key
 	 */
	public function delete($Id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Categoria categoria
 	 */
	public function insert($categoria);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Categoria categoria
 	 */
	public function update($categoria);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByTituloEsp($value);

	public function queryByTituloIng($value);


	public function deleteByTituloEsp($value);

	public function deleteByTituloIng($value);


}
?>