<?php

/*
 * This helper represents the web server database.
 */
class WebServerDatabase extends Database {
	
	/*
	 * TODO: comments
	 */
	public function deleteExpiredSessions($sessionIdleLifetime) {
		// TODO: implement
	}
	
	/*
	 * TODO: comments
	 */
	public function deleteSession($sessionId) {
		// TODO: implement
	}
	
	/*
	 * TODO: comments
	 */
	public function insertOrUpdateSession($sessionId, $sessionData) {
		// TODO: implement
	}
	
	/*
	 * TODO: comments
	 */
	public function selectSession($sessionId) {
		// TODO: implement
	}
	
	/*
	 * Connects to the database.
	 * 
	 * It returns the PDO instance representing the connection.
	 */
	protected function connect() {
		// Gets the configuration of the database
		$configuration = &$this->app->configurations->get('webServerDatabase');
		$dsn = $configuration['dsn'];
		$username = $configuration['username'];
		$password = $configuration['password'];
		
		// Creates and returns a PDO instance
		return new PDO($dsn, $username, $password);
	}
	
}
