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
		try {
			$this->pdo->commit();
		} catch (PDOException $exception) {
			// A PDO exception was thrown
			$this->app->error($exception);
		}
	}
	
	/*
	 * Rolls back the current transaction.
	 */
	public function rollBackTransaction() {
		try {
			$this->pdo->rollBack();
		} catch (PDOException $exception) {
			// A PDO exception was thrown
			$this->app->error($exception);
		}
	}
	
	/*
	 * Starts a transaction.
	 */
	public function startTransaction() {
		try {
			$this->pdo->beginTransaction();
		} catch (PDOException $exception) {
			// A PDO exception was thrown
			$this->app->error($exception);
		}
	}
	
	/*
	 * Connects to the database.
	 * 
	 * It returns the PDO instance representing the connection.
	 */
	protected abstract function connect();
	
	/*
	 * Executes a prepared statement and returns the results, or null if the
	 * statement is not a query.
	 * 
	 * It receives the statement and the parameters to prepare it.
	 */
	protected function executePreparedStatement($statement, $parameters) {
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
		} catch (PDOException $exception) {
			// A PDO exception was thrown
			$this->app->error($exception);
		}
	}
	
	/*
	 * Performs initialization tasks.
	 */
	protected function initialize() {
		try {
			// Connects to the database
			$pdo = $this->connect();

			// Configures the PDO instance
			$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // TODO: test erros and configure this

			$this->pdo = $pdo;
		} catch (PDOException $exception) {
			// A PDO exception was thrown
			$this->app->error($exception);
		}
	}
	
}
