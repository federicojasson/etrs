<?php

namespace App\Helpers;

/*
 * This helper represents the web server database.
 */
class WebServerDatabase extends \App\Helpers\SpecializedDatabase {
	
	/*
	 * Returns a session. If it doesn't exist, null is returned.
	 * 
	 * It receives the session's ID.
	 */
	public function getSession($id) {
		// Defines the columns to select
		$columnsToSelect = [
			'id AS id',
			'creation_datetime AS creationDatetime',
			'last_edition_datetime AS lastEditionDatetime',
			'data AS data'
		];
		
		// Gets and returns the entity
		return $this->getEntity('sessions', $columnsToSelect, $id);
	}
	
	/*
	 * Connects to the database.
	 * 
	 * It returns a PDO instance representing the connection.
	 */
	protected function connect() {
		$app = $this->app;
		
		// Gets the database's parameters
		$parameters = $app->parameters->get(PARAMETERS_DATABASES);
		$webServerDatabase = $parameters['webServerDatabase'];
		$dsn = $webServerDatabase['dsn'];
		$username = $webServerDatabase['username'];
		$password = $webServerDatabase['password'];
		
		// Creates and returns the PDO instance
		return new \PDO($dsn, $username, $password);
	}
	
}
