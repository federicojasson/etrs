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
	
}
