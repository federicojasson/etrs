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
	 */
	public function commitTransaction() {
		$this->pdo->commit();
	}
	
	/*
	 * Rolls back the current transaction.
	 */
	public function rollBackTransaction() {
		$this->pdo->rollBack();
	}
	
	/*
	 * Starts a new transaction.
	 */
	public function startTransaction() {
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
		// Prepares and executes the statement
		$preparedStatement = $this->pdo->prepare($statement);
		$preparedStatement->execute($parameters);
		
		// Fetches and returns the results
		return $preparedStatement->fetchAll();
	}
	
	/*
	 * Returns the first result of a query, or null if the query didn't produce
	 * any.
	 * 
	 * It receives an array of query results.
	 */
	protected function getFirstResultOrNull($results) {
		if (count($results) === 0) {
			// The query didn't produce any result
			return null;
		}
		
		// Returns the first result
		return $results[0];
	}
	
	/*
	 * Performs initialization tasks.
	 */
	protected function initialize() {
		// Connects to the database
		$pdo = $this->connect();

		// Configures the PDO instance
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$this->pdo = $pdo;
	}
	
}
