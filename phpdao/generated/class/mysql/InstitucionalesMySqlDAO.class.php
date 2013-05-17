<?php
/**
 * Class that operate on table 'institucionales'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2013-05-15 22:01
 */
class InstitucionalesMySqlDAO implements InstitucionalesDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return InstitucionalesMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM institucionales WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM institucionales';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM institucionales ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param institucionale primary key
 	 */
	public function delete($id){
		$sql = 'DELETE FROM institucionales WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param InstitucionalesMySql institucionale
 	 */
	public function insert($institucionale){
		$sql = 'INSERT INTO institucionales (idSeccion, idCategoria, idAlbum, nombre) VALUES (?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($institucionale->idSeccion);
		$sqlQuery->setNumber($institucionale->idCategoria);
		$sqlQuery->setNumber($institucionale->idAlbum);
		$sqlQuery->set($institucionale->nombre);

		$id = $this->executeInsert($sqlQuery);	
		$institucionale->id = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param InstitucionalesMySql institucionale
 	 */
	public function update($institucionale){
		$sql = 'UPDATE institucionales SET idSeccion = ?, idCategoria = ?, idAlbum = ?, nombre = ? WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($institucionale->idSeccion);
		$sqlQuery->setNumber($institucionale->idCategoria);
		$sqlQuery->setNumber($institucionale->idAlbum);
		$sqlQuery->set($institucionale->nombre);

		$sqlQuery->setNumber($institucionale->id);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM institucionales';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByIdSeccion($value){
		$sql = 'SELECT * FROM institucionales WHERE idSeccion = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByIdCategoria($value){
		$sql = 'SELECT * FROM institucionales WHERE idCategoria = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByIdAlbum($value){
		$sql = 'SELECT * FROM institucionales WHERE idAlbum = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByNombre($value){
		$sql = 'SELECT * FROM institucionales WHERE nombre = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByIdSeccion($value){
		$sql = 'DELETE FROM institucionales WHERE idSeccion = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByIdCategoria($value){
		$sql = 'DELETE FROM institucionales WHERE idCategoria = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByIdAlbum($value){
		$sql = 'DELETE FROM institucionales WHERE idAlbum = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByNombre($value){
		$sql = 'DELETE FROM institucionales WHERE nombre = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return InstitucionalesMySql 
	 */
	protected function readRow($row){
		$institucionale = new Institucionale();
		
		$institucionale->id = $row['id'];
		$institucionale->idSeccion = $row['idSeccion'];
		$institucionale->idCategoria = $row['idCategoria'];
		$institucionale->idAlbum = $row['idAlbum'];
		$institucionale->nombre = $row['nombre'];

		return $institucionale;
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
	 * @return InstitucionalesMySql 
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