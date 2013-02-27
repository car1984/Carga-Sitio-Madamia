<?php
/**
 * Class that operate on table 'TipoProducto'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2013-01-15 22:13
 */
class TipoProductoMySqlDAO implements TipoProductoDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return TipoProductoMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM TipoProducto WHERE Id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM TipoProducto';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM TipoProducto ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param tipoProducto primary key
 	 */
	public function delete($Id){
		$sql = 'DELETE FROM TipoProducto WHERE Id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($Id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param TipoProductoMySql tipoProducto
 	 */
	public function insert($tipoProducto){
		$sql = 'INSERT INTO TipoProducto (Nombre, Descripcion) VALUES (?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($tipoProducto->nombre);
		$sqlQuery->set($tipoProducto->descripcion);

		$id = $this->executeInsert($sqlQuery);	
		$tipoProducto->id = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param TipoProductoMySql tipoProducto
 	 */
	public function update($tipoProducto){
		$sql = 'UPDATE TipoProducto SET Nombre = ?, Descripcion = ? WHERE Id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($tipoProducto->nombre);
		$sqlQuery->set($tipoProducto->descripcion);

		$sqlQuery->setNumber($tipoProducto->id);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM TipoProducto';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByNombre($value){
		$sql = 'SELECT * FROM TipoProducto WHERE Nombre = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByDescripcion($value){
		$sql = 'SELECT * FROM TipoProducto WHERE Descripcion = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByNombre($value){
		$sql = 'DELETE FROM TipoProducto WHERE Nombre = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByDescripcion($value){
		$sql = 'DELETE FROM TipoProducto WHERE Descripcion = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return TipoProductoMySql 
	 */
	protected function readRow($row){
		$tipoProducto = new TipoProducto();
		
		$tipoProducto->id = $row['Id'];
		$tipoProducto->nombre = $row['Nombre'];
		$tipoProducto->descripcion = $row['Descripcion'];

		return $tipoProducto;
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
	 * @return TipoProductoMySql 
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