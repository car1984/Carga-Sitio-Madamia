<?php
/**
 * Class that operate on table 'directorio'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2013-04-22 18:33
 */
class DirectorioMySqlDAO implements DirectorioDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return DirectorioMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM directorio WHERE Id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM directorio';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM directorio ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param directorio primary key
 	 */
	public function delete($Id){
		$sql = 'DELETE FROM directorio WHERE Id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($Id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param DirectorioMySql directorio
 	 */
	public function insert($directorio){
		$sql = 'INSERT INTO directorio (IdSeccion, Nombre, Telefono, Mail) VALUES (?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($directorio->idSeccion);
		$sqlQuery->set($directorio->nombre);
		$sqlQuery->set($directorio->telefono);
		$sqlQuery->set($directorio->mail);

		$id = $this->executeInsert($sqlQuery);	
		$directorio->id = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param DirectorioMySql directorio
 	 */
	public function update($directorio){
		$sql = 'UPDATE directorio SET IdSeccion = ?, Nombre = ?, Telefono = ?, Mail = ? WHERE Id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($directorio->idSeccion);
		$sqlQuery->set($directorio->nombre);
		$sqlQuery->set($directorio->telefono);
		$sqlQuery->set($directorio->mail);

		$sqlQuery->setNumber($directorio->id);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM directorio';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByIdSeccion($value){
		$sql = 'SELECT * FROM directorio WHERE IdSeccion = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByNombre($value){
		$sql = 'SELECT * FROM directorio WHERE Nombre = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByTelefono($value){
		$sql = 'SELECT * FROM directorio WHERE Telefono = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByMail($value){
		$sql = 'SELECT * FROM directorio WHERE Mail = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByIdSeccion($value){
		$sql = 'DELETE FROM directorio WHERE IdSeccion = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByNombre($value){
		$sql = 'DELETE FROM directorio WHERE Nombre = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByTelefono($value){
		$sql = 'DELETE FROM directorio WHERE Telefono = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByMail($value){
		$sql = 'DELETE FROM directorio WHERE Mail = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return DirectorioMySql 
	 */
	protected function readRow($row){
		$directorio = new Directorio();
		
		$directorio->id = $row['Id'];
		$directorio->idSeccion = $row['IdSeccion'];
		$directorio->nombre = $row['Nombre'];
		$directorio->telefono = $row['Telefono'];
		$directorio->mail = $row['Mail'];

		return $directorio;
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
	 * @return DirectorioMySql 
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