<?php

/*
  * This class represents the application's business logic database.
 */
class BusinessLogicDatabase extends Database {
	
	/*
	 * Creates an instance of this class.
	 */
	public function __construct() {
		// TODO: get dsn, user and password from config file
		
		parent::__construct('', '', '');
	}
	
	/*
	 * TODO
	 */
	public function getUser($userId) {
		// TODO
	}
	
}
