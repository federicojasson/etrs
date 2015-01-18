<?php

namespace App\Helpers;

/*
 * This helper represents a database and offers convenient methods to
 * communicate with it.
 * 
 * Subclasses must implement the connect function and the necessary queries.
 */
abstract class Database extends \App\Helpers\Helper {
	
	/*
	 * The PDO instance that represents the connection with the database.
	 */
	private $pdo;
	
	/*
	 * Commits the current transaction.
	 */
	public function commitTransaction() {
		$app = $this->app;
		
		try {
			// Commits the transaction
			$this->pdo->commit();
		} catch (PDOException $exception) {
			// A PDO exception was thrown
			$app->error($exception);
		}
	}
	
	/*
	 * Returns the number of rows found in the last query.
	 */
	public function getFoundRows() {
		// Defines the statement
		$statement = 'SELECT FOUND_ROWS() AS foundRows';
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement);
		
		// Returns the result
		return $results[0]['foundRows'];
	}
	
	/*
	 * Rolls back the current transaction.
	 */
	public function rollBackTransaction() {
		$app = $this->app;
		
		try {
			// Rolls back the transaction
			$this->pdo->rollBack();
		} catch (PDOException $exception) {
			// A PDO exception was thrown
			$app->error($exception);
		}
	}
	
	/*
	 * Starts a read-only transaction.
	 */
	public function startReadOnlyTransaction() {
		$app = $this->app;
		
		try {
			// Defines the statement
			$statement = 'START TRANSACTION READ ONLY';

			// Executes the statement
			$this->executePreparedStatement($statement);
		} catch (PDOException $exception) {
			// A PDO exception was thrown
			$app->error($exception);
		}
	}
	
	/*
	 * Starts a read-write transaction.
	 */
	public function startReadWiteTransaction() {
		$app = $this->app;
		
		try {
			// Defines the statement
			$statement = 'START TRANSACTION READ WRITE';

			// Executes the statement
			$this->executePreparedStatement($statement);
		} catch (PDOException $exception) {
			// A PDO exception was thrown
			$app->error($exception);
		}
	}
	
	/*
	 * Connects to the database.
	 * 
	 * It returns a PDO instance representing the connection.
	 */
	protected abstract function connect();
	
	/*
	 * Executes a prepared statement and returns the results. If the statement
	 * is not a query, null is returned.
	 * 
	 * It receives the statement and, optionally, the parameters to prepare it.
	 */
	protected function executePreparedStatement($statement, $parameters = null) {
		$app = $this->app;
		
		try {
			// Prepares and executes the statement
			$preparedStatement = $this->pdo->prepare($statement);
			$preparedStatement->execute($parameters);
			
			if ($preparedStatement->columnCount() === 0) {
				// The statement is not a query
				return null;
			}
			
			// Fetches and returns the results
			return $preparedStatement->fetchAll();
		} catch (PDOException $exception) { // TODO: PDOException or \PDOException
			// A PDO exception was thrown
			$app->error($exception);
		}
	}
	
	/*
	 * Performs initialization tasks.
	 */
	protected function initialize() {
		$app = $this->app;
		
		try {
			// Connects to the database
			$pdo = $this->connect();

			// Configures the PDO instance
			$pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
			$pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
			$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION); // TODO: test erros and configure this
			
			// TODO: set isolation level somewhere
			//SET SESSION TRANSACTION ISOLATION LEVEL SERIALIZABLE
			
			// TODO: should one-query operations be in transactions?

			$this->pdo = $pdo;
		} catch (PDOException $exception) {
			// A PDO exception was thrown
			$app->error($exception);
		}
	}
	
}
