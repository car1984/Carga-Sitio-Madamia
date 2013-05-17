<?php
/**
 * Class that operate on table 'institucionales_novedades'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2013-05-15 22:01
 */
class InstitucionalesNovedadesMySqlDAO implements InstitucionalesNovedadesDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return InstitucionalesNovedadesMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM institucionales_novedades WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM institucionales_novedades';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM institucionales_novedades ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param institucionalesNovedade primary key
 	 */
	public function delete($id){
		$sql = 'DELETE FROM institucionales_novedades WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param InstitucionalesNovedadesMySql institucionalesNovedade
 	 */
	public function insert($institucionalesNovedade){
		$sql = 'INSERT INTO institucionales_novedades (idInstitucionales, novedad) VALUES (?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($institucionalesNovedade->idInstitucionales);
		$sqlQuery->set($institucionalesNovedade->novedad);

		$id = $this->executeInsert($sqlQuery);	
		$institucionalesNovedade->id = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param InstitucionalesNovedadesMySql institucionalesNovedade
 	 */
	public function update($institucionalesNovedade){
		$sql = 'UPDATE institucionales_novedades SET idInstitucionales = ?, novedad = ? WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($institucionalesNovedade->idInstitucionales);
		$sqlQuery->set($institucionalesNovedade->novedad);

		$sqlQuery->setNumber($institucionalesNovedade->id);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM institucionales_novedades';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByIdInstitucionales($value){
		$sql = 'SELECT * FROM institucionales_novedades WHERE idInstitucionales = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByNovedad($value){
		$sql = 'SELECT * FROM institucionales_novedades WHERE novedad = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByIdInstitucionales($value){
		$sql = 'DELETE FROM institucionales_novedades WHERE idInstitucionales = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByNovedad($value){
		$sql = 'DELETE FROM institucionales_novedades WHERE novedad = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return InstitucionalesNovedadesMySql 
	 */
	protected function readRow($row){
		$institucionalesNovedade = new InstitucionalesNovedade();
		
		$institucionalesNovedade->id = $row['id'];
		$institucionalesNovedade->idInstitucionales = $row['idInstitucionales'];
		$institucionalesNovedade->novedad = $row['novedad'];

		return $institucionalesNovedade;
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
	 * @return InstitucionalesNovedadesMySql 
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