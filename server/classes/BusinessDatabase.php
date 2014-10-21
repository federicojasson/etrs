<?php

/*
 * TODO
 */
class BusinessDatabase extends Database {
	
	/*
	 * TODO
	 */
	public function getUserAuthenticationData($id) {
		// Defines the statement
		$statement = '
			SELECT password_hash, salt
			FROM users
			WHERE id LIKE BINARY :id
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id
		];
		
		// Executes the statement
		$rows = $this->connection->executePreparedStatement($statement, $parameters);
		
		if (count($rows) === 0)
			// The query didn't return any value
			return null;
		
		// Returns a user data object with the query result
		return new UserDataObject($rows[0]);
	}
	
	/*
	 * TODO
	 */
	public function getUserData($id) {
		// Defines the statement
		$statement = '
			SELECT id, role
			FROM users
			WHERE id LIKE BINARY :id
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id
		];
		
		// Executes the statement
		$rows = $this->connection->executePreparedStatement($statement, $parameters);
		
		if (count($rows) === 0)
			// The query didn't return any value
			return null;
		
		// Returns a user data object with the query result
		return new UserDataObject($rows[0]);
	}
	
}
