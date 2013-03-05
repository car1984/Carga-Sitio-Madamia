<?php
/**
 * Class that operate on table 'lista_contenido'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2013-03-04 20:00
 */
class ListaContenidoMySqlDAO implements ListaContenidoDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return ListaContenidoMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM lista_contenido WHERE Id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM lista_contenido';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM lista_contenido ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param listaContenido primary key
 	 */
	public function delete($Id){
		$sql = 'DELETE FROM lista_contenido WHERE Id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($Id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param ListaContenidoMySql listaContenido
 	 */
	public function insert($listaContenido){
		$sql = 'INSERT INTO lista_contenido (IdSeccion, Nombre, Fondo, Fotos) VALUES (?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($listaContenido->idSeccion);
		$sqlQuery->set($listaContenido->nombre);
		$sqlQuery->set($listaContenido->fondo);
		$sqlQuery->setNumber($listaContenido->fotos);

		$id = $this->executeInsert($sqlQuery);	
		$listaContenido->id = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param ListaContenidoMySql listaContenido
 	 */
	public function update($listaContenido){
		$sql = 'UPDATE lista_contenido SET IdSeccion = ?, Nombre = ?, Fondo = ?, Fotos = ? WHERE Id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($listaContenido->idSeccion);
		$sqlQuery->set($listaContenido->nombre);
		$sqlQuery->set($listaContenido->fondo);
		$sqlQuery->setNumber($listaContenido->fotos);

		$sqlQuery->setNumber($listaContenido->id);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM lista_contenido';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByIdSeccion($value){
		$sql = 'SELECT * FROM lista_contenido WHERE IdSeccion = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByNombre($value){
		$sql = 'SELECT * FROM lista_contenido WHERE Nombre = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByFondo($value){
		$sql = 'SELECT * FROM lista_contenido WHERE Fondo = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByFotos($value){
		$sql = 'SELECT * FROM lista_contenido WHERE Fotos = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByIdSeccion($value){
		$sql = 'DELETE FROM lista_contenido WHERE IdSeccion = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByNombre($value){
		$sql = 'DELETE FROM lista_contenido WHERE Nombre = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByFondo($value){
		$sql = 'DELETE FROM lista_contenido WHERE Fondo = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByFotos($value){
		$sql = 'DELETE FROM lista_contenido WHERE Fotos = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return ListaContenidoMySql 
	 */
	protected function readRow($row){
		$listaContenido = new ListaContenido();
		
		$listaContenido->id = $row['Id'];
		$listaContenido->idSeccion = $row['IdSeccion'];
		$listaContenido->nombre = $row['Nombre'];
		$listaContenido->fondo = $row['Fondo'];
		$listaContenido->fotos = $row['Fotos'];

		return $listaContenido;
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
	 * @return ListaContenidoMySql 
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