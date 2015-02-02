<?php

namespace App\Helper\Database;

/*
 * This helper represents the business logic database.
 */
class BusinessLogicDatabase extends SpecializedDatabase {
	
	/*
	 * Connects to the database.
	 * 
	 * It returns a PDO instance representing the connection.
	 */
	protected function connect() {
		$app = $this->app;
		
		// Gets the database's parameters
		$parameters = $app->parameters->get(PARAMETERS_DATABASES);
		$dsn = $parameters['businessLogicDatabase']['dsn'];
		$username = $parameters['businessLogicDatabase']['username'];
		$password = $parameters['businessLogicDatabase']['password'];
		
		// Creates and returns the PDO instance
		return new \PDO($dsn, $username, $password);
	}
	
	/*
	 * Deletes an entity.
	 * 
	 * It receives the entity's table and ID.
	 */
	protected function deleteEntity($table, $id) {
		// Defines the statement
		$statement = '
			UPDATE ' . $table . '
			SET is_deleted = TRUE
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
	
}
