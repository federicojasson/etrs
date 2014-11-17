<?php

/*
 * This class represents a database. It offers convenient methods to execute
 * database actions.
 * 
 * Subclasses must define the connection parameters and implement the specific
 * queries.
 */
abstract class Database {
	
	/*
	 * The PDO instance.
	 * 
	 * It represents a connection between the application and the database.
	 */
	private $pdo;
	
	/*
	 * Creates an instance of this class.
	 * 
	 * It receives the DSN and the database user's name and password.
	 */
	protected function __construct($dsn, $username, $password) {
		// Creates a PDO instance
		$pdo = new PDO($dsn, $username, $password);
		
		// Configures the PDO to use associative arrays to fetch the results
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		
		// Configures the PDO to use exceptions to handle errors
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		// Assigns the PDO as an instance attribute
		$this->pdo = $pdo;
	}
	
	/*
	 * Commits the current transaction.
	 * TODO: remove if not used
	 */
	public function commitTransaction() {
		$this->pdo->commit();
	}
	
	/*
	 * Rolls back the current transaction.
	 * TODO: remove if not used
	 */
	public function rollBackTransaction() {
		$this->pdo->rollBack();
	}
	
	/*
	 * Starts a new transaction.
	 * TODO: remove if not used
	 */
	public function startTransaction() {
		$this->pdo->beginTransaction();
	}
	
	/*
	 * Executes a prepared statement.
	 * 
	 * It receives the statement and the parameters to prepare it.
	 */
	protected function executePreparedStatement($statement, $parameters) {
		// Prepares and executes the statement
		$preparedStatement = $this->pdo->prepare($statement);
		$preparedStatement->execute($parameters);
		
		// Fetches and returns the results
		return $preparedStatement->fetchAll();
	}
	
}
