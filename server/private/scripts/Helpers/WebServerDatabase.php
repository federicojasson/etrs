<?php

/*
 * This helper represents the web server database.
 */
class WebServerDatabase extends Database {
	
	/*
	 * TODO
	 */
	public function deleteExpiredSessions($sessionIdleLifetime) {
		// TODO
	}
	
	/*
	 * TODO
	 */
	public function deleteSession($sessionId) {
		// TODO
	}
	
	/*
	 * TODO
	 */
	public function insertOrUpdateSession($sessionId, $sessionData) {
		// TODO
	}
	
	/*
	 * TODO
	 */
	public function selectSession($sessionId) {
		// TODO
	}
	
	/*
	 * Connects to the database.
	 * 
	 * It returns the PDO instance representing the connection.
	 */
	protected function connect() {
		// Gets the configuration of the database
		$configuration = $this->app->configurations->get('webServerDatabase');
		$dsn = $configuration['dsn'];
		$password = $configuration['password'];
		$username = $configuration['username'];
		
		// Creates and returns a PDO instance
		return new PDO($dsn, $username, $password);
	}
	
}
