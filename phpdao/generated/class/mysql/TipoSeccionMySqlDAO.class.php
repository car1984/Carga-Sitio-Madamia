<?php
/**
 * Class that operate on table 'tipo_seccion'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2013-03-04 20:00
 */
class TipoSeccionMySqlDAO implements TipoSeccionDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return TipoSeccionMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM tipo_seccion WHERE Id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM tipo_seccion';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM tipo_seccion ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param tipoSeccion primary key
 	 */
	public function delete($Id){
		$sql = 'DELETE FROM tipo_seccion WHERE Id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($Id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param TipoSeccionMySql tipoSeccion
 	 */
	public function insert($tipoSeccion){
		$sql = 'INSERT INTO tipo_seccion (Descripcion, URL_Usuraio, Popup) VALUES (?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($tipoSeccion->descripcion);
		$sqlQuery->set($tipoSeccion->uRLUsuraio);
		$sqlQuery->setNumber($tipoSeccion->popup);

		$id = $this->executeInsert($sqlQuery);	
		$tipoSeccion->id = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param TipoSeccionMySql tipoSeccion
 	 */
	public function update($tipoSeccion){
		$sql = 'UPDATE tipo_seccion SET Descripcion = ?, URL_Usuraio = ?, Popup = ? WHERE Id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($tipoSeccion->descripcion);
		$sqlQuery->set($tipoSeccion->uRLUsuraio);
		$sqlQuery->setNumber($tipoSeccion->popup);

		$sqlQuery->setNumber($tipoSeccion->id);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM tipo_seccion';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByDescripcion($value){
		$sql = 'SELECT * FROM tipo_seccion WHERE Descripcion = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByURLUsuraio($value){
		$sql = 'SELECT * FROM tipo_seccion WHERE URL_Usuraio = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByPopup($value){
		$sql = 'SELECT * FROM tipo_seccion WHERE Popup = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByDescripcion($value){
		$sql = 'DELETE FROM tipo_seccion WHERE Descripcion = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByURLUsuraio($value){
		$sql = 'DELETE FROM tipo_seccion WHERE URL_Usuraio = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByPopup($value){
		$sql = 'DELETE FROM tipo_seccion WHERE Popup = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return TipoSeccionMySql 
	 */
	protected function readRow($row){
		$tipoSeccion = new TipoSeccion();
		
		$tipoSeccion->id = $row['Id'];
		$tipoSeccion->descripcion = $row['Descripcion'];
		$tipoSeccion->uRLUsuraio = $row['URL_Usuraio'];
		$tipoSeccion->popup = $row['Popup'];

		return $tipoSeccion;
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
	 * @return TipoSeccionMySql 
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