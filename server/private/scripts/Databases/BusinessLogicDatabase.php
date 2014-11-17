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
	public function getUser($id) {
		// Defines the statement
		// TODO: query in XML file?
		$statement = '
			SELECT id, role, first_name, last_name, gender
			FROM not_erased_users
			WHERE id LIKE BINARY :id
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id
		];
		
		// Executes the statement
		$rows = $this->executePreparedStatement($statement, $parameters);
		
		if (count($rows) === 0) {
			// The query didn't return any value
			return null;
		}
		
		// Returns the query result
		return $rows[0];
	}
	
}
