<?php

/*
 * This class offers an interface to interact with the server database.
 */
class ServerDatabase extends Database {
	
	/*
	 * TODO
	 */
	public function deleteExpiredSessions($lifetime) {
		// Defines the statement
		$statement = '
			CALL delete_expired_sessions (
				:lifetime
			)
		';
		
		// Sets the parameters
		$parameters = [
			':lifetime' => $lifetime
		];
		
		// Executes the statement
		$this->connection->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * TODO
	 */
	public function deleteSession($id) {
		// Defines the statement
		$statement = '
			CALL delete_session (
				:id
			)
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id
		];
		
		// Executes the statement
		$this->connection->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * TODO
	 */
	public function getSessionData($id) {
		// Defines the statement
		$statement = '
			SELECT data
			FROM sessions
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
		
		// Returns a session data object with the query result
		return new SessionDataObject($rows[0]);
	}
	
	/*
	 * TODO
	 */
	public function insertOrUpdateSession($id, $data) {
		// Defines the statement
		$statement = '
			CALL insert_or_update_session (
				:id,
				:data
			)
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':data' => $data
		];
		
		// Executes the statement
		$this->connection->executePreparedStatement($statement, $parameters);
	}
	
}
