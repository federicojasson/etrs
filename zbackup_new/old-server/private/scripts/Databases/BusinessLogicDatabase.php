<?php

/*
 * This class represents the application's business logic database.
 */
class BusinessLogicDatabase extends Database {
	
	/*
	 * Creates an instance of this class.
	 */
	public function __construct() {
		$app = \Slim\Slim::getInstance();
		
		// Gets the database configuration
		$databaseConfiguration = $app->configurations->getDatabaseConfigurations()['businessLogic'];
		
		// Gets the connection parameters
		$dsn = $databaseConfiguration['dsn'];
		$username = $databaseConfiguration['username'];
		$password = $databaseConfiguration['password'];
		
		parent::__construct($dsn, $username, $password);
	}
	
	/*
	 * Returns a user's authentication data.
	 * 
	 * It receives the user's ID.
	 */
	public function getUserAuthenticationData($id) {
		// Defines the statement
		$statement = '
			SELECT *
			FROM users_authentication_data
			WHERE id = :id
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id
		];
		
		// Executes the statement
		$rows = $this->executePreparedStatement($statement, $parameters);
		
		if (count($rows) === 0) {
			// The query didn't return any value
			return null;
		}
		
		// Returns the query result
		return $rows[0];
	}
	
	/*
	 * Returns a user's data.
	 * 
	 * It receives the user's ID.
	 */
	public function getUserData($id) {
		// Defines the statement
		$statement = '
			SELECT *
			FROM users_data
			WHERE id = :id
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id
		];
		
		// Executes the statement
		$rows = $this->executePreparedStatement($statement, $parameters);
		
		if (count($rows) === 0) {
			// The query didn't return any value
			return null;
		}
		
		// Returns the query result
		return $rows[0];
	}
	
}
