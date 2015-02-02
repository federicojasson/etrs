<?php

namespace App\Helper\Database;

/*
 * This helper represents the web server database.
 */
class WebServerDatabase extends SpecializedDatabase {
	// TODO: implement methods
	
	/*
	 * TODO: comments
	 */
	public function createLog($id, $level, $message) {
		// TODO: implement
	}
	
	/*
	 * TODO: comments
	 */
	public function createOrEditSession($id, $data) {
		// TODO: implement
	}
	
	/*
	 * TODO: comments
	 */
	public function deleteInactiveSessions($maximumInactiveTime) {
		// TODO: implement
	}
	
	/*
	 * TODO: comments
	 */
	public function deleteSession($id) {
		// TODO: implement
	}
	
	/*
	 * TODO: comments
	 */
	public function getSession($id) {
		// TODO: implement
	}
	
	/*
	 * TODO: comments
	 */
	public function logExists($id) {
		// TODO: implement
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
		$dsn = $parameters['webServerDatabase']['dsn'];
		$username = $parameters['webServerDatabase']['username'];
		$password = $parameters['webServerDatabase']['password'];
		
		// Creates and returns the PDO instance
		return new \PDO($dsn, $username, $password);
	}
	
}
