<?php
/**
 * Class that operate on table 'precio_producto'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2013-04-22 18:33
 */
class PrecioProductoMySqlDAO implements PrecioProductoDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return PrecioProductoMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM precio_producto WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM precio_producto';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM precio_producto ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param precioProducto primary key
 	 */
	public function delete($id){
		$sql = 'DELETE FROM precio_producto WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param PrecioProductoMySql precioProducto
 	 */
	public function insert($precioProducto){
		$sql = 'INSERT INTO precio_producto (IdProducto, Nombre, Valor) VALUES (?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($precioProducto->idProducto);
		$sqlQuery->set($precioProducto->nombre);
		$sqlQuery->set($precioProducto->valor);

		$id = $this->executeInsert($sqlQuery);	
		$precioProducto->id = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param PrecioProductoMySql precioProducto
 	 */
	public function update($precioProducto){
		$sql = 'UPDATE precio_producto SET IdProducto = ?, Nombre = ?, Valor = ? WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($precioProducto->idProducto);
		$sqlQuery->set($precioProducto->nombre);
		$sqlQuery->set($precioProducto->valor);

		$sqlQuery->setNumber($precioProducto->id);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM precio_producto';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByIdProducto($value){
		$sql = 'SELECT * FROM precio_producto WHERE IdProducto = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByNombre($value){
		$sql = 'SELECT * FROM precio_producto WHERE Nombre = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByValor($value){
		$sql = 'SELECT * FROM precio_producto WHERE Valor = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByIdProducto($value){
		$sql = 'DELETE FROM precio_producto WHERE IdProducto = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByNombre($value){
		$sql = 'DELETE FROM precio_producto WHERE Nombre = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByValor($value){
		$sql = 'DELETE FROM precio_producto WHERE Valor = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return PrecioProductoMySql 
	 */
	protected function readRow($row){
		$precioProducto = new PrecioProducto();
		
		$precioProducto->id = $row['id'];
		$precioProducto->idProducto = $row['IdProducto'];
		$precioProducto->nombre = $row['Nombre'];
		$precioProducto->valor = $row['Valor'];

		return $precioProducto;
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
	 * @return PrecioProductoMySql 
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