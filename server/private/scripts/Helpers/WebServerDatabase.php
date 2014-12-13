<?php

/*
 * This helper represents the web server database.
 */
class WebServerDatabase extends Database {
	
	/*
	 * TODO: comments
	 */
	public function deleteExpiredSessions($sessionIdleLifetime) {
		// TODO: think what happens when current session is deleted?
		// TODO: WHERE expression
		
		// Defines the statement
		$statement = '
			DELETE
			FROM sessions
			WHERE TODO
		';
		
		// Sets the parameters
		$parameters = [
			':sessionIdleLifetime' => $sessionIdleLifetime
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * TODO: comments
	 */
	public function deleteSession($sessionId) {
		// Defines the statement
		$statement = '
			DELETE
			FROM sessions
			WHERE id = :sessionId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':sessionId' => $sessionId
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * TODO: comments
	 */
	public function insertOrUpdateSession($sessionId, $sessionData) {
		// TODO: careful: placeholder used twice
		
		// Defines the statement
		$statement = '
			INSERT INTO sessions (
				id,
				last_access_datetime,
				data
			)
			VALUES (
				:sessionId,
				UTC_TIMESTAMP(),
				:sessionData
			)
			ON DUPLICATE KEY
			UPDATE
				last_access_datetime = UTC_TIMESTAMP(),
				data = :sessionData

		';
		
		// Sets the parameters
		$parameters = [
			':sessionData' => $sessionData,
			':sessionId' => $sessionId
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * TODO: comments
	 */
	public function selectSession($sessionId) {
		// Defines the statement
		$statement = '
			SELECT
				last_access_datetime AS lastAccessDatetime,
				data AS data
			FROM sessions
			WHERE id = :sessionId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':sessionId' => $sessionId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the first result, or null if there is none
		return $this->getFirstResultOrNull($results);
	}
	
	/*
	 * Connects to the database.
	 * 
	 * It returns the PDO instance representing the connection.
	 */
	protected function connect() {
		$configuration = &$this->app->configurations->get('webServerDatabase');
		
		// Gets the configuration of the database
		$dsn = $configuration['dsn'];
		$username = $configuration['username'];
		$password = $configuration['password'];
		
		$this->app->log->debug('dsn: ' . $dsn);
		$this->app->log->debug('username: ' . $username);
		$this->app->log->debug('password: ' . $password);
		
		// Creates and returns a PDO instance
		return new PDO($dsn, $username, $password);
	}
	
}
