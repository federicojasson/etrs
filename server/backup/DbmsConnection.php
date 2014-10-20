<?php

/*
 * This class offers services to interact with a DBMS.
 */
class DbmsConnection {
	
	/*
	 * TODO
	 */
	private $pdo;
	
	/*
	 * TODO
	 */
	public function __construct($dsn, $userName, $password) {
		$pdo = new PDO($dsn, $userName, $password);
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$this->pdo = $pdo;
	}
	
	/*
	 * TODO
	 */
	public function commitTransaction() {
		$this->pdo->commit();
	}
	
	/*
	 * TODO
	 */
	public function executePreparedStatement($statement, $parameters) {
		$preparedStatement = $this->pdo->prepare($statement);
		$preparedStatement->execute($parameters);
		
		return $preparedStatement->fetchAll();
	}
	
	/*
	 * TODO
	 */
	public function rollBackTransaction() {
		$this->pdo->rollBack();
	}
	
	/*
	 * TODO
	 */
	public function startTransaction() {
		$this->pdo->beginTransaction();
	}
	
}
