<?php

/*
 * TODO
 */
class DatabaseConnection {
	
	/*
	 * TODO
	 */
	private $pdo;
	
	/*
	 * TODO
	 */
	public function __construct($dsn, $user, $password) {
		// Creates a PDO instance
		$pdo = new PDO($dsn, $user, $password);
		
		// Configures the PDO to use associative arrays to fetch the results
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		
		// Configures the PDO to use exceptions to handle errors
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		// Assigns the PDO as an instance attribute
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
		// Prepares and executes the statement
		$preparedStatement = $this->pdo->prepare($statement);
		$preparedStatement->execute($parameters);
		
		// Fetches and returns the results
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
