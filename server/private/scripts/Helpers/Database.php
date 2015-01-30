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
			// Commits the current transaction
			$this->pdo->exec('COMMIT');
		} catch (\PDOException $exception) {
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
			// Rolls back the current transaction
			$this->pdo->exec('ROLLBACK');
		} catch (\PDOException $exception) {
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
			// Starts a read-only transaction
			$this->pdo->exec('START TRANSACTION READ ONLY');
		} catch (\PDOException $exception) {
			// A PDO exception was thrown
			$app->error($exception);
		}
	}
	
	/*
	 * Starts a read-write transaction.
	 */
	public function startReadWriteTransaction() {
		$app = $this->app;
		
		try {
			// Starts a read-write transaction
			$this->pdo->exec('START TRANSACTION READ WRITE');
		} catch (\PDOException $exception) {
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
	 * Deletes an entity.
	 * 
	 * It receives the entity's table and its ID.
	 */
	protected function deleteEntity($table, $id) {
		// Defines the statement
		$statement = '
			DELETE
			FROM ' . $table . '
			WHERE id = :id
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Determines whether an entity exists.
	 * 
	 * It receives the entity's table and its ID.
	 */
	protected function entityExists($table, $id) {
		// Defines the statement
		$statement = '
			SELECT 0
			FROM ' . $table . '
			WHERE id = :id
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the result
		return count($results) === 1;
	}
	
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
		} catch (\PDOException $exception) {
			// A PDO exception was thrown
			$app->error($exception);
		}
	}
	
	/*
	 * Returns an entity. If it doesn't exist, null is returned.
	 * 
	 * It receives the entity's table, the fields and their aliases, and its ID.
	 */
	protected function getEntity($table, $fieldsAndAliases, $id) {
		// Gets the SELECT clause
		$selectClause = getSelectClause($fieldsAndAliases);
		
		// Defines the statement
		$statement = '
			SELECT ' . $selectClause . '
			FROM ' . $table . '
			WHERE id = :id
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the first result, or null if there is none
		return getFirstElementOrNull($results);
	}
	
	/*
	 * Performs initialization tasks.
	 */
	protected function initialize() {
		$app = $this->app;
		
		try {
			// Connects to the database
			$this->pdo = $this->connect();

			// Configures the PDO
			$this->pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
			$this->pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
			$this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			
			// Sets the isolation level for the transactions
			$this->pdo->exec('SET SESSION TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		} catch (\PDOException $exception) {
			// A PDO exception was thrown
			$app->error($exception);
		}
	}
	
}
