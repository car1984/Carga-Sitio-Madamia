<?php
/**
 * Class that operate on table 'contenido'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2013-05-15 22:01
 */
class ContenidoMySqlDAO implements ContenidoDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return ContenidoMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM contenido WHERE Id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM contenido';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM contenido ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param contenido primary key
 	 */
	public function delete($Id){
		$sql = 'DELETE FROM contenido WHERE Id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($Id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param ContenidoMySql contenido
 	 */
	public function insert($contenido){
		$sql = 'INSERT INTO contenido (IdLista, Nombre_Esp, Nombre_Ing, Contenido_Esp, Contenido_Ing, Album_Id, Url_GoogleMaps) VALUES (?, ?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($contenido->idLista);
		$sqlQuery->set($contenido->nombreEsp);
		$sqlQuery->set($contenido->nombreIng);
		$sqlQuery->set($contenido->contenidoEsp);
		$sqlQuery->set($contenido->contenidoIng);
		$sqlQuery->setNumber($contenido->albumId);
		$sqlQuery->set($contenido->urlGoogleMaps);

		$id = $this->executeInsert($sqlQuery);	
		$contenido->id = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param ContenidoMySql contenido
 	 */
	public function update($contenido){
		$sql = 'UPDATE contenido SET IdLista = ?, Nombre_Esp = ?, Nombre_Ing = ?, Contenido_Esp = ?, Contenido_Ing = ?, Album_Id = ?, Url_GoogleMaps = ? WHERE Id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($contenido->idLista);
		$sqlQuery->set($contenido->nombreEsp);
		$sqlQuery->set($contenido->nombreIng);
		$sqlQuery->set($contenido->contenidoEsp);
		$sqlQuery->set($contenido->contenidoIng);
		$sqlQuery->setNumber($contenido->albumId);
		$sqlQuery->set($contenido->urlGoogleMaps);

		$sqlQuery->setNumber($contenido->id);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM contenido';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByIdLista($value){
		$sql = 'SELECT * FROM contenido WHERE IdLista = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByNombreEsp($value){
		$sql = 'SELECT * FROM contenido WHERE Nombre_Esp = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByNombreIng($value){
		$sql = 'SELECT * FROM contenido WHERE Nombre_Ing = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByContenidoEsp($value){
		$sql = 'SELECT * FROM contenido WHERE Contenido_Esp = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByContenidoIng($value){
		$sql = 'SELECT * FROM contenido WHERE Contenido_Ing = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByAlbumId($value){
		$sql = 'SELECT * FROM contenido WHERE Album_Id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByUrlGoogleMaps($value){
		$sql = 'SELECT * FROM contenido WHERE Url_GoogleMaps = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByIdLista($value){
		$sql = 'DELETE FROM contenido WHERE IdLista = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByNombreEsp($value){
		$sql = 'DELETE FROM contenido WHERE Nombre_Esp = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByNombreIng($value){
		$sql = 'DELETE FROM contenido WHERE Nombre_Ing = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByContenidoEsp($value){
		$sql = 'DELETE FROM contenido WHERE Contenido_Esp = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByContenidoIng($value){
		$sql = 'DELETE FROM contenido WHERE Contenido_Ing = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByAlbumId($value){
		$sql = 'DELETE FROM contenido WHERE Album_Id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByUrlGoogleMaps($value){
		$sql = 'DELETE FROM contenido WHERE Url_GoogleMaps = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return ContenidoMySql 
	 */
	protected function readRow($row){
		$contenido = new Contenido();
		
		$contenido->id = $row['Id'];
		$contenido->idLista = $row['IdLista'];
		$contenido->nombreEsp = $row['Nombre_Esp'];
		$contenido->nombreIng = $row['Nombre_Ing'];
		$contenido->contenidoEsp = $row['Contenido_Esp'];
		$contenido->contenidoIng = $row['Contenido_Ing'];
		$contenido->albumId = $row['Album_Id'];
		$contenido->urlGoogleMaps = $row['Url_GoogleMaps'];

		return $contenido;
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
	 * @return ContenidoMySql 
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