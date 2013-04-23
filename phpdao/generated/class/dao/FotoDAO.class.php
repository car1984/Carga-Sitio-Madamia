<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2013-04-22 18:33
 */
interface FotoDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Foto 
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
 	 * @param foto primary key
 	 */
	public function delete($Id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Foto foto
 	 */
	public function insert($foto);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Foto foto
 	 */
	public function update($foto);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByIdAlbun($value);

	public function queryByImagen($value);

	public function queryByDescripcionEsp($value);

	public function queryByDescripcionIng($value);


	public function deleteByIdAlbun($value);

	public function deleteByImagen($value);

	public function deleteByDescripcionEsp($value);

	public function deleteByDescripcionIng($value);


}
?>