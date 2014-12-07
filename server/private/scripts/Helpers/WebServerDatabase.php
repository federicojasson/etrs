<?php

/*
 * This helper represents the web server database.
 */
class WebServerDatabase extends Database {
	
	/*
	 * Connects to the database.
	 * 
	 * It returns the PDO instance representing the connection.
	 */
	protected function connect() {
		// Gets the configuration of the database
		$configuration = $this->app->configurations->get(CONFIGURATION_ID_WEB_SERVER_DATABASE);
		$dsn = $configuration['dsn'];
		$password = $configuration['password'];
		$username = $configuration['username'];
		
		// Creates and returns a PDO instance
		return new PDO($dsn, $username, $password);
	}
	
}
