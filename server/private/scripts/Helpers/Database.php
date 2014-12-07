<?php

/*
 * This helper represents a database and offers convenient methods to
 * communicate with it.
 * 
 * Subclasses must define the connection parameters and implement the queries.
 */
abstract class Database extends Helper {
	
	/*
	 * The PDO instance.
	 * 
	 * It represents a connection between the application and the database.
	 */
	private $pdo;
	
	/*
	 * Commits the current transaction.
	 * TODO: remove if not used
	 */
	public function commitTransaction() {
		// Tests the connection
		$this->testConnection();
		
		// Commits the current transaction
		$this->pdo->commit();
	}
	
	/*
	 * Rolls back the current transaction.
	 * TODO: remove if not used
	 */
	public function rollBackTransaction() {
		// Tests the connection
		$this->testConnection();
		
		// Rolls back the current transaction
		$this->pdo->rollBack();
	}
	
	/*
	 * Starts a new transaction.
	 * TODO: remove if not used
	 */
	public function startTransaction() {
		// Tests the connection
		$this->testConnection();
		
		// Starts a new transaction
		$this->pdo->beginTransaction();
	}
	
	/*
	 * Connects to the database.
	 * 
	 * It returns the PDO instance representing the connection.
	 */
	protected abstract function connect();
	
	/*
	 * Executes a prepared statement.
	 * 
	 * It receives the statement and the parameters to prepare it.
	 */
	protected function executePreparedStatement($statement, $parameters) {
		// Tests the connection
		$this->testConnection();
		
		// Prepares and executes the statement
		$preparedStatement = $this->pdo->prepare($statement);
		$preparedStatement->execute($parameters);
		
		// Fetches and returns the results
		return $preparedStatement->fetchAll();
	}
	
	/*
	 * Tests the connection with the database. If it hasn't been established
	 * yet, it does it.
	 */
	private function testConnection() {
		if (is_null($this->pdo)) {
			// The connection has not been established yet
			
			// Connects to the database
			$this->pdo = $this->connect();
			
			// Configures the PDO instance
			$this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
	}
	
}
