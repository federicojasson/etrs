<?php

namespace App\Helpers;

/*
 * This helper represents the web server database.
 */
class WebServerDatabase extends \App\Helpers\Database {
	
	/*
	 * Connects to the database.
	 * 
	 * It returns the PDO instance representing the connection.
	 */
	protected function connect() {
		$app = $this->app;
		
		// Gets the database's parameters
		$parameters = $app->parameters->get('webServerDatabase');
		$dsn = $parameters['dsn'];
		$username = $parameters['username'];
		$password = $parameters['password'];
		
		// Creates and returns the PDO instance
		return new PDO($dsn, $username, $password);
	}
	
}
