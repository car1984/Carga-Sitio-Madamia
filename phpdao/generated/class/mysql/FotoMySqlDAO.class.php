<?php
/**
 * Class that operate on table 'foto'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2013-03-16 20:04
 */
class FotoMySqlDAO implements FotoDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return FotoMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM foto WHERE Id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM foto';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM foto ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param foto primary key
 	 */
	public function delete($Id){
		$sql = 'DELETE FROM foto WHERE Id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($Id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param FotoMySql foto
 	 */
	public function insert($foto){
		$sql = 'INSERT INTO foto (IdAlbun, Imagen, Descripcion_Esp, Descripcion_Ing) VALUES (?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($foto->idAlbun);
		$sqlQuery->set($foto->imagen);
		$sqlQuery->set($foto->descripcionEsp);
		$sqlQuery->set($foto->descripcionIng);

		$id = $this->executeInsert($sqlQuery);	
		$foto->id = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param FotoMySql foto
 	 */
	public function update($foto){
		$sql = 'UPDATE foto SET IdAlbun = ?, Imagen = ?, Descripcion_Esp = ?, Descripcion_Ing = ? WHERE Id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($foto->idAlbun);
		$sqlQuery->set($foto->imagen);
		$sqlQuery->set($foto->descripcionEsp);
		$sqlQuery->set($foto->descripcionIng);

		$sqlQuery->setNumber($foto->id);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM foto';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByIdAlbun($value){
		$sql = 'SELECT * FROM foto WHERE IdAlbun = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByImagen($value){
		$sql = 'SELECT * FROM foto WHERE Imagen = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByDescripcionEsp($value){
		$sql = 'SELECT * FROM foto WHERE Descripcion_Esp = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByDescripcionIng($value){
		$sql = 'SELECT * FROM foto WHERE Descripcion_Ing = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByIdAlbun($value){
		$sql = 'DELETE FROM foto WHERE IdAlbun = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByImagen($value){
		$sql = 'DELETE FROM foto WHERE Imagen = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByDescripcionEsp($value){
		$sql = 'DELETE FROM foto WHERE Descripcion_Esp = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByDescripcionIng($value){
		$sql = 'DELETE FROM foto WHERE Descripcion_Ing = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return FotoMySql 
	 */
	protected function readRow($row){
		$foto = new Foto();
		
		$foto->id = $row['Id'];
		$foto->idAlbun = $row['IdAlbun'];
		$foto->imagen = $row['Imagen'];
		$foto->descripcionEsp = $row['Descripcion_Esp'];
		$foto->descripcionIng = $row['Descripcion_Ing'];

		return $foto;
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
	 * @return FotoMySql 
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