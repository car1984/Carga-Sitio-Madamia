<?php
/**
 * Class that operate on table 'promociones'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2013-03-16 20:04
 */
class PromocionesMySqlDAO implements PromocionesDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return PromocionesMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM promociones WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM promociones';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM promociones ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param promocione primary key
 	 */
	public function delete($id){
		$sql = 'DELETE FROM promociones WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param PromocionesMySql promocione
 	 */
	public function insert($promocione){
		$sql = 'INSERT INTO promociones (Seccion_Id, Fecha_Inicio, Fecha_Fin, Desccripcion_Esp, Descripcion_Eng) VALUES (?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($promocione->seccionId);
		$sqlQuery->set($promocione->fechaInicio);
		$sqlQuery->set($promocione->fechaFin);
		$sqlQuery->set($promocione->desccripcionEsp);
		$sqlQuery->set($promocione->descripcionEng);

		$id = $this->executeInsert($sqlQuery);	
		$promocione->id = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param PromocionesMySql promocione
 	 */
	public function update($promocione){
		$sql = 'UPDATE promociones SET Seccion_Id = ?, Fecha_Inicio = ?, Fecha_Fin = ?, Desccripcion_Esp = ?, Descripcion_Eng = ? WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($promocione->seccionId);
		$sqlQuery->set($promocione->fechaInicio);
		$sqlQuery->set($promocione->fechaFin);
		$sqlQuery->set($promocione->desccripcionEsp);
		$sqlQuery->set($promocione->descripcionEng);

		$sqlQuery->setNumber($promocione->id);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM promociones';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryBySeccionId($value){
		$sql = 'SELECT * FROM promociones WHERE Seccion_Id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByFechaInicio($value){
		$sql = 'SELECT * FROM promociones WHERE Fecha_Inicio = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByFechaFin($value){
		$sql = 'SELECT * FROM promociones WHERE Fecha_Fin = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByDesccripcionEsp($value){
		$sql = 'SELECT * FROM promociones WHERE Desccripcion_Esp = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByDescripcionEng($value){
		$sql = 'SELECT * FROM promociones WHERE Descripcion_Eng = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteBySeccionId($value){
		$sql = 'DELETE FROM promociones WHERE Seccion_Id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByFechaInicio($value){
		$sql = 'DELETE FROM promociones WHERE Fecha_Inicio = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByFechaFin($value){
		$sql = 'DELETE FROM promociones WHERE Fecha_Fin = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByDesccripcionEsp($value){
		$sql = 'DELETE FROM promociones WHERE Desccripcion_Esp = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByDescripcionEng($value){
		$sql = 'DELETE FROM promociones WHERE Descripcion_Eng = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return PromocionesMySql 
	 */
	protected function readRow($row){
		$promocione = new Promocione();
		
		$promocione->id = $row['id'];
		$promocione->seccionId = $row['Seccion_Id'];
		$promocione->fechaInicio = $row['Fecha_Inicio'];
		$promocione->fechaFin = $row['Fecha_Fin'];
		$promocione->desccripcionEsp = $row['Desccripcion_Esp'];
		$promocione->descripcionEng = $row['Descripcion_Eng'];

		return $promocione;
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
	 * @return PromocionesMySql 
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