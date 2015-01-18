<?php

namespace App\Helpers;

/*
 * This helper represents the business logic database.
 */
class BusinessLogicDatabase extends \App\Helpers\Database {
	
	/*
	 * Erases a medication.
	 * 
	 * It receives the medication's ID.
	 */
	public function eraseMedication($id) {
		// Defines the statement
		$statement = '
			UPDATE medications
			SET is_erased = TRUE
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
	 * Determines whether a non-erased medication exists.
	 * 
	 * It receives the medication's ID.
	 */
	public function nonErasedMedicationExists($id) {
		// Defines the statement
		$statement = '
			SELECT 0
			FROM non_erased_medications
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
	 * Connects to the database.
	 * 
	 * It returns a PDO instance representing the connection.
	 */
	protected function connect() {
		$app = $this->app;
		
		// Gets the database's parameters
		$parameters = $app->parameters->get('businessLogicDatabase');
		$dsn = $parameters['dsn'];
		$username = $parameters['username'];
		$password = $parameters['password'];
		
		// Creates and returns the PDO instance
		return new \PDO($dsn, $username, $password);
	}
	
}
