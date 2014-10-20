<?php

/*
 * This class offers services to interact with the business database.
 */
class BusinessDatabase {
	
	/*
	 * Represents the connection with the DBMS.
	 */
	private $dbmsConnection;
	
	/*
	 * TODO
	 */
	public function connect($userName, $password) {
		// Creates a connection with the DBMS
		$this->dbmsConnection = new DbmsConnection(BUSINESS_DATABASE_DSN, $userName, $password);
	}
	
	/*
	 * TODO
	 */
	public function getUserAuthenticationData($id) {
		$statement = '
			SELECT password_hash, salt
			FROM users
			WHERE id LIKE BINARY :id
			LIMIT 1
		';
		
		$parameters = [
			':id' => $id
		];
		
		$rows = $this->dbmsConnection->executePreparedStatement($statement, $parameters);
		
		if (count($rows) === 0)
			return null;
		
		return new UserData($rows[0]);
	}
	
}
