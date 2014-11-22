<?php

/*
 * This class represents the application's web server database.
 */
class WebServerDatabase extends Database {
	
	/*
	 * Creates an instance of this class.
	 */
	public function __construct() {
		$app = \Slim\Slim::getInstance();
		
		// Gets the database configuration
		$databaseConfiguration = $app->configurations->getDatabaseConfigurations()['webServer'];
		
		// Gets the connection parameters
		$dsn = $databaseConfiguration['dsn'];
		$username = $databaseConfiguration['username'];
		$password = $databaseConfiguration['password'];
		
		parent::__construct($dsn, $username, $password);
	}
	
	/*
	 * TODO
	 */
	public function deleteExpiredSessions($idleLifetime) {
		// TODO
	}
	
	/*
	 * Deletes a session.
	 * 
	 * It receives the session's ID.
	 */
	public function deleteSession($id) {
		// Defines the statement
		$statement = '
			DELETE
			FROM sessions
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
