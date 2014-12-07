<?php

/*
 * This class represents the application's web server database.
 */
class WebServerDatabase extends Database {
	
	/*
	 * Creates an instance of this class.
	 */
	public function __construct() {
		// TODO: get dsn, user and password from config file
		
		parent::__construct('', '', '');
	}
	
}
