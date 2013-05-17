<?php
/**
 * Class that operate on table 'seccion'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2013-05-15 22:01
 */
class SeccionMySqlDAO implements SeccionDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return SeccionMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM seccion WHERE Id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM seccion';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM seccion ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param seccion primary key
 	 */
	public function delete($Id){
		$sql = 'DELETE FROM seccion WHERE Id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($Id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param SeccionMySql seccion
 	 */
	public function insert($seccion){
		$sql = 'INSERT INTO seccion (IdPapa, Tipo_Seccion, Nombre, Imagen, Titulo_Esp, Titulo_Eng, Posicion) VALUES (?, ?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($seccion->idPapa);
		$sqlQuery->setNumber($seccion->tipoSeccion);
		$sqlQuery->set($seccion->nombre);
		$sqlQuery->set($seccion->imagen);
		$sqlQuery->set($seccion->tituloEsp);
		$sqlQuery->set($seccion->tituloEng);
		$sqlQuery->setNumber($seccion->posicion);

		$id = $this->executeInsert($sqlQuery);	
		$seccion->id = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param SeccionMySql seccion
 	 */
	public function update($seccion){
		$sql = 'UPDATE seccion SET IdPapa = ?, Tipo_Seccion = ?, Nombre = ?, Imagen = ?, Titulo_Esp = ?, Titulo_Eng = ?, Posicion = ? WHERE Id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($seccion->idPapa);
		$sqlQuery->setNumber($seccion->tipoSeccion);
		$sqlQuery->set($seccion->nombre);
		$sqlQuery->set($seccion->imagen);
		$sqlQuery->set($seccion->tituloEsp);
		$sqlQuery->set($seccion->tituloEng);
		$sqlQuery->setNumber($seccion->posicion);

		$sqlQuery->setNumber($seccion->id);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM seccion';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByIdPapa($value){
		$sql = 'SELECT * FROM seccion WHERE IdPapa = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByTipoSeccion($value){
		$sql = 'SELECT * FROM seccion WHERE Tipo_Seccion = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByNombre($value){
		$sql = 'SELECT * FROM seccion WHERE Nombre = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByImagen($value){
		$sql = 'SELECT * FROM seccion WHERE Imagen = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByTituloEsp($value){
		$sql = 'SELECT * FROM seccion WHERE Titulo_Esp = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByTituloEng($value){
		$sql = 'SELECT * FROM seccion WHERE Titulo_Eng = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByPosicion($value){
		$sql = 'SELECT * FROM seccion WHERE Posicion = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByIdPapa($value){
		$sql = 'DELETE FROM seccion WHERE IdPapa = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByTipoSeccion($value){
		$sql = 'DELETE FROM seccion WHERE Tipo_Seccion = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByNombre($value){
		$sql = 'DELETE FROM seccion WHERE Nombre = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByImagen($value){
		$sql = 'DELETE FROM seccion WHERE Imagen = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByTituloEsp($value){
		$sql = 'DELETE FROM seccion WHERE Titulo_Esp = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByTituloEng($value){
		$sql = 'DELETE FROM seccion WHERE Titulo_Eng = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByPosicion($value){
		$sql = 'DELETE FROM seccion WHERE Posicion = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return SeccionMySql 
	 */
	protected function readRow($row){
		$seccion = new Seccion();
		
		$seccion->id = $row['Id'];
		$seccion->idPapa = $row['IdPapa'];
		$seccion->tipoSeccion = $row['Tipo_Seccion'];
		$seccion->nombre = $row['Nombre'];
		$seccion->imagen = $row['Imagen'];
		$seccion->tituloEsp = $row['Titulo_Esp'];
		$seccion->tituloEng = $row['Titulo_Eng'];
		$seccion->posicion = $row['Posicion'];

		return $seccion;
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
	 * @return SeccionMySql 
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