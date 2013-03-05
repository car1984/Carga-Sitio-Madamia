<?php
/**
 * Class that operate on table 'registro'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2013-03-04 20:00
 */
class RegistroMySqlDAO implements RegistroDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return RegistroMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM registro WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM registro';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM registro ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param registro primary key
 	 */
	public function delete($id){
		$sql = 'DELETE FROM registro WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param RegistroMySql registro
 	 */
	public function insert($registro){
		$sql = 'INSERT INTO registro (nombre, apellido, cedula, email, telefono, dia, mes, ano) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($registro->nombre);
		$sqlQuery->set($registro->apellido);
		$sqlQuery->set($registro->cedula);
		$sqlQuery->set($registro->email);
		$sqlQuery->set($registro->telefono);
		$sqlQuery->setNumber($registro->dia);
		$sqlQuery->setNumber($registro->mes);
		$sqlQuery->setNumber($registro->ano);

		$id = $this->executeInsert($sqlQuery);	
		$registro->id = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param RegistroMySql registro
 	 */
	public function update($registro){
		$sql = 'UPDATE registro SET nombre = ?, apellido = ?, cedula = ?, email = ?, telefono = ?, dia = ?, mes = ?, ano = ? WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($registro->nombre);
		$sqlQuery->set($registro->apellido);
		$sqlQuery->set($registro->cedula);
		$sqlQuery->set($registro->email);
		$sqlQuery->set($registro->telefono);
		$sqlQuery->setNumber($registro->dia);
		$sqlQuery->setNumber($registro->mes);
		$sqlQuery->setNumber($registro->ano);

		$sqlQuery->setNumber($registro->id);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM registro';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByNombre($value){
		$sql = 'SELECT * FROM registro WHERE nombre = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByApellido($value){
		$sql = 'SELECT * FROM registro WHERE apellido = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByCedula($value){
		$sql = 'SELECT * FROM registro WHERE cedula = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByEmail($value){
		$sql = 'SELECT * FROM registro WHERE email = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByTelefono($value){
		$sql = 'SELECT * FROM registro WHERE telefono = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByDia($value){
		$sql = 'SELECT * FROM registro WHERE dia = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByMes($value){
		$sql = 'SELECT * FROM registro WHERE mes = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByAno($value){
		$sql = 'SELECT * FROM registro WHERE ano = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByNombre($value){
		$sql = 'DELETE FROM registro WHERE nombre = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByApellido($value){
		$sql = 'DELETE FROM registro WHERE apellido = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByCedula($value){
		$sql = 'DELETE FROM registro WHERE cedula = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByEmail($value){
		$sql = 'DELETE FROM registro WHERE email = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByTelefono($value){
		$sql = 'DELETE FROM registro WHERE telefono = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByDia($value){
		$sql = 'DELETE FROM registro WHERE dia = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByMes($value){
		$sql = 'DELETE FROM registro WHERE mes = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByAno($value){
		$sql = 'DELETE FROM registro WHERE ano = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return RegistroMySql 
	 */
	protected function readRow($row){
		$registro = new Registro();
		
		$registro->id = $row['id'];
		$registro->nombre = $row['nombre'];
		$registro->apellido = $row['apellido'];
		$registro->cedula = $row['cedula'];
		$registro->email = $row['email'];
		$registro->telefono = $row['telefono'];
		$registro->dia = $row['dia'];
		$registro->mes = $row['mes'];
		$registro->ano = $row['ano'];

		return $registro;
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
	 * @return RegistroMySql 
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