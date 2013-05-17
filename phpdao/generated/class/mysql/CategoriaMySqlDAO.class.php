<?php
/**
 * Class that operate on table 'categoria'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2013-05-15 22:01
 */
class CategoriaMySqlDAO implements CategoriaDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return CategoriaMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM categoria WHERE Id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM categoria';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM categoria ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param categoria primary key
 	 */
	public function delete($Id){
		$sql = 'DELETE FROM categoria WHERE Id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($Id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param CategoriaMySql categoria
 	 */
	public function insert($categoria){
		$sql = 'INSERT INTO categoria (Titulo_Esp, Titulo_Ing) VALUES (?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($categoria->tituloEsp);
		$sqlQuery->set($categoria->tituloIng);

		$id = $this->executeInsert($sqlQuery);	
		$categoria->id = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param CategoriaMySql categoria
 	 */
	public function update($categoria){
		$sql = 'UPDATE categoria SET Titulo_Esp = ?, Titulo_Ing = ? WHERE Id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($categoria->tituloEsp);
		$sqlQuery->set($categoria->tituloIng);

		$sqlQuery->setNumber($categoria->id);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM categoria';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByTituloEsp($value){
		$sql = 'SELECT * FROM categoria WHERE Titulo_Esp = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByTituloIng($value){
		$sql = 'SELECT * FROM categoria WHERE Titulo_Ing = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByTituloEsp($value){
		$sql = 'DELETE FROM categoria WHERE Titulo_Esp = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByTituloIng($value){
		$sql = 'DELETE FROM categoria WHERE Titulo_Ing = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return CategoriaMySql 
	 */
	protected function readRow($row){
		$categoria = new Categoria();
		
		$categoria->id = $row['Id'];
		$categoria->tituloEsp = $row['Titulo_Esp'];
		$categoria->tituloIng = $row['Titulo_Ing'];

		return $categoria;
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
	 * @return CategoriaMySql 
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