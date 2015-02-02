<?php

namespace App\Helper\Database;

/*
 * This helper represents a database and offers basic operations to communicate
 * with it.
 * 
 * Subclasses must implement the connect function.
 */
abstract class Database extends \App\Helper\Helper {
	// TODO: implement methods
	
	/*
	 * The PDO instance that represents the connection with the database.
	 */
	private $pdo;
	
	/*
	 * Connects to the database.
	 * 
	 * It returns a PDO instance representing the connection.
	 */
	protected abstract function connect();
	
	/*
	 * Performs initialization tasks.
	 */
	protected function initialize() {
		$app = $this->app;
		
		try {
			// Connects to the database
			$pdo = $this->connect();
			
			// Configures the PDO
			$pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
			$pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
			$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			
			// Sets the isolation level for the transactions
			$pdo->exec('SET SESSION TRANSACTION ISOLATION LEVEL SERIALIZABLE');
			
			// Initializes the instance attribute
			$this->pdo = $pdo;
		} catch (\PDOException $exception) {
			// A PDO exception was thrown
			$app->error($exception);
		}
	}
	
}
