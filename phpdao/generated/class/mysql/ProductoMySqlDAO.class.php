<?php
/**
 * Class that operate on table 'producto'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2013-04-22 18:33
 */
class ProductoMySqlDAO implements ProductoDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return ProductoMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM producto WHERE Id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM producto';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM producto ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param producto primary key
 	 */
	public function delete($Id){
		$sql = 'DELETE FROM producto WHERE Id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($Id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param ProductoMySql producto
 	 */
	public function insert($producto){
		$sql = 'INSERT INTO producto (IdSeccion, IdAlbum, Nombre_Esp, Nombre_Ing, Descripcion_Esp, Descripcion_Ing, IdTipoProducto, populate, top10) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($producto->idSeccion);
		$sqlQuery->setNumber($producto->idAlbum);
		$sqlQuery->set($producto->nombreEsp);
		$sqlQuery->set($producto->nombreIng);
		$sqlQuery->set($producto->descripcionEsp);
		$sqlQuery->set($producto->descripcionIng);
		$sqlQuery->setNumber($producto->idTipoProducto);
		$sqlQuery->setNumber($producto->populate);
		$sqlQuery->setNumber($producto->top10);

		$id = $this->executeInsert($sqlQuery);	
		$producto->id = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param ProductoMySql producto
 	 */
	public function update($producto){
		$sql = 'UPDATE producto SET IdSeccion = ?, IdAlbum = ?, Nombre_Esp = ?, Nombre_Ing = ?, Descripcion_Esp = ?, Descripcion_Ing = ?, IdTipoProducto = ?, populate = ?, top10 = ? WHERE Id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($producto->idSeccion);
		$sqlQuery->setNumber($producto->idAlbum);
		$sqlQuery->set($producto->nombreEsp);
		$sqlQuery->set($producto->nombreIng);
		$sqlQuery->set($producto->descripcionEsp);
		$sqlQuery->set($producto->descripcionIng);
		$sqlQuery->setNumber($producto->idTipoProducto);
		$sqlQuery->setNumber($producto->populate);
		$sqlQuery->setNumber($producto->top10);

		$sqlQuery->setNumber($producto->id);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM producto';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByIdSeccion($value){
		$sql = 'SELECT * FROM producto WHERE IdSeccion = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByIdAlbum($value){
		$sql = 'SELECT * FROM producto WHERE IdAlbum = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByNombreEsp($value){
		$sql = 'SELECT * FROM producto WHERE Nombre_Esp = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByNombreIng($value){
		$sql = 'SELECT * FROM producto WHERE Nombre_Ing = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByDescripcionEsp($value){
		$sql = 'SELECT * FROM producto WHERE Descripcion_Esp = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByDescripcionIng($value){
		$sql = 'SELECT * FROM producto WHERE Descripcion_Ing = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByIdTipoProducto($value){
		$sql = 'SELECT * FROM producto WHERE IdTipoProducto = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByPopulate($value){
		$sql = 'SELECT * FROM producto WHERE populate = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByTop10($value){
		$sql = 'SELECT * FROM producto WHERE top10 = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByIdSeccion($value){
		$sql = 'DELETE FROM producto WHERE IdSeccion = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByIdAlbum($value){
		$sql = 'DELETE FROM producto WHERE IdAlbum = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByNombreEsp($value){
		$sql = 'DELETE FROM producto WHERE Nombre_Esp = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByNombreIng($value){
		$sql = 'DELETE FROM producto WHERE Nombre_Ing = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByDescripcionEsp($value){
		$sql = 'DELETE FROM producto WHERE Descripcion_Esp = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByDescripcionIng($value){
		$sql = 'DELETE FROM producto WHERE Descripcion_Ing = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByIdTipoProducto($value){
		$sql = 'DELETE FROM producto WHERE IdTipoProducto = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByPopulate($value){
		$sql = 'DELETE FROM producto WHERE populate = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByTop10($value){
		$sql = 'DELETE FROM producto WHERE top10 = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return ProductoMySql 
	 */
	protected function readRow($row){
		$producto = new Producto();
		
		$producto->id = $row['Id'];
		$producto->idSeccion = $row['IdSeccion'];
		$producto->idAlbum = $row['IdAlbum'];
		$producto->nombreEsp = $row['Nombre_Esp'];
		$producto->nombreIng = $row['Nombre_Ing'];
		$producto->descripcionEsp = $row['Descripcion_Esp'];
		$producto->descripcionIng = $row['Descripcion_Ing'];
		$producto->idTipoProducto = $row['IdTipoProducto'];
		$producto->populate = $row['populate'];
		$producto->top10 = $row['top10'];

		return $producto;
	}
	
	protected function getList($sqlQuery){
		$tab = QueryExecutor::execute($sqlQuery);
		$ret = array();
		for($i=0;$i<count($tab);$i++){
			$ret[$i] = $this->readRow($tab[$i]);
		}
		return $ret;
	}
	
	/**
	 * Get row
	 *
	 * @return ProductoMySql 
	 */
	protected function getRow($sqlQuery){
		$tab = QueryExecutor::execute($sqlQuery);
		if(count($tab)==0){
			return null;
		}
		return $this->readRow($tab[0]);		
	}
	
	/**
	 * Execute sql query
	 */
	protected function execute($sqlQuery){
		return QueryExecutor::execute($sqlQuery);
	}
	
		
	/**
	 * Execute sql query
	 */
	protected function executeUpdate($sqlQuery){
		return QueryExecutor::executeUpdate($sqlQuery);
	}

	/**
	 * Query for one row and one column
	 */
	protected function querySingleResult($sqlQuery){
		return QueryExecutor::queryForString($sqlQuery);
	}

	/**
	 * Insert row to table
	 */
	protected function executeInsert($sqlQuery){
		return QueryExecutor::executeInsert($sqlQuery);
	}
}
?>