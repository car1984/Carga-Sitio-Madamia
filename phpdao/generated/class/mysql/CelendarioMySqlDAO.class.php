<?php
/**
 * Class that operate on table 'celendario'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2013-03-04 20:00
 */
class CelendarioMySqlDAO implements CelendarioDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return CelendarioMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM celendario WHERE Id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM celendario';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM celendario ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param celendario primary key
 	 */
	public function delete($Id){
		$sql = 'DELETE FROM celendario WHERE Id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($Id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param CelendarioMySql celendario
 	 */
	public function insert($celendario){
		$sql = 'INSERT INTO celendario (IdSeccion, Fecha_Inicial, Fecha_Final, Hora_Inical, Hora_Final, Descripcion_Esp, Descripcion_Ing, Titulo_Esp, Titulo_Ing) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($celendario->idSeccion);
		$sqlQuery->set($celendario->fechaInicial);
		$sqlQuery->set($celendario->fechaFinal);
		$sqlQuery->set($celendario->horaInical);
		$sqlQuery->set($celendario->horaFinal);
		$sqlQuery->set($celendario->descripcionEsp);
		$sqlQuery->set($celendario->descripcionIng);
		$sqlQuery->set($celendario->tituloEsp);
		$sqlQuery->set($celendario->tituloIng);

		$id = $this->executeInsert($sqlQuery);	
		$celendario->id = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param CelendarioMySql celendario
 	 */
	public function update($celendario){
		$sql = 'UPDATE celendario SET IdSeccion = ?, Fecha_Inicial = ?, Fecha_Final = ?, Hora_Inical = ?, Hora_Final = ?, Descripcion_Esp = ?, Descripcion_Ing = ?, Titulo_Esp = ?, Titulo_Ing = ? WHERE Id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($celendario->idSeccion);
		$sqlQuery->set($celendario->fechaInicial);
		$sqlQuery->set($celendario->fechaFinal);
		$sqlQuery->set($celendario->horaInical);
		$sqlQuery->set($celendario->horaFinal);
		$sqlQuery->set($celendario->descripcionEsp);
		$sqlQuery->set($celendario->descripcionIng);
		$sqlQuery->set($celendario->tituloEsp);
		$sqlQuery->set($celendario->tituloIng);

		$sqlQuery->setNumber($celendario->id);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM celendario';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByIdSeccion($value){
		$sql = 'SELECT * FROM celendario WHERE IdSeccion = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByFechaInicial($value){
		$sql = 'SELECT * FROM celendario WHERE Fecha_Inicial = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByFechaFinal($value){
		$sql = 'SELECT * FROM celendario WHERE Fecha_Final = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByHoraInical($value){
		$sql = 'SELECT * FROM celendario WHERE Hora_Inical = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByHoraFinal($value){
		$sql = 'SELECT * FROM celendario WHERE Hora_Final = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByDescripcionEsp($value){
		$sql = 'SELECT * FROM celendario WHERE Descripcion_Esp = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByDescripcionIng($value){
		$sql = 'SELECT * FROM celendario WHERE Descripcion_Ing = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByTituloEsp($value){
		$sql = 'SELECT * FROM celendario WHERE Titulo_Esp = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByTituloIng($value){
		$sql = 'SELECT * FROM celendario WHERE Titulo_Ing = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByIdSeccion($value){
		$sql = 'DELETE FROM celendario WHERE IdSeccion = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByFechaInicial($value){
		$sql = 'DELETE FROM celendario WHERE Fecha_Inicial = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByFechaFinal($value){
		$sql = 'DELETE FROM celendario WHERE Fecha_Final = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByHoraInical($value){
		$sql = 'DELETE FROM celendario WHERE Hora_Inical = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByHoraFinal($value){
		$sql = 'DELETE FROM celendario WHERE Hora_Final = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByDescripcionEsp($value){
		$sql = 'DELETE FROM celendario WHERE Descripcion_Esp = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByDescripcionIng($value){
		$sql = 'DELETE FROM celendario WHERE Descripcion_Ing = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByTituloEsp($value){
		$sql = 'DELETE FROM celendario WHERE Titulo_Esp = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByTituloIng($value){
		$sql = 'DELETE FROM celendario WHERE Titulo_Ing = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return CelendarioMySql 
	 */
	protected function readRow($row){
		$celendario = new Celendario();
		
		$celendario->id = $row['Id'];
		$celendario->idSeccion = $row['IdSeccion'];
		$celendario->fechaInicial = $row['Fecha_Inicial'];
		$celendario->fechaFinal = $row['Fecha_Final'];
		$celendario->horaInical = $row['Hora_Inical'];
		$celendario->horaFinal = $row['Hora_Final'];
		$celendario->descripcionEsp = $row['Descripcion_Esp'];
		$celendario->descripcionIng = $row['Descripcion_Ing'];
		$celendario->tituloEsp = $row['Titulo_Esp'];
		$celendario->tituloIng = $row['Titulo_Ing'];

		return $celendario;
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
	 * @return CelendarioMySql 
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