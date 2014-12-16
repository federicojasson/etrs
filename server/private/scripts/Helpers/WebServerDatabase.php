<?php

/*
 * This helper represents the web server database.
 */
class WebServerDatabase extends Database {
	
	/*
	 * Deletes the expired sessions.
	 * 
	 * It receives the time in minutes that the sessions can live without activity (i.e.,
	 * their idle lifetime).
	 */
	public function deleteExpiredSessions($sessionIdleLifetime) {
		// Defines the statement
		$statement = '
			DELETE
			FROM sessions
			WHERE last_access_datetime < DATE_SUB(UTC_TIMESTAMP(), INTERVAL :sessionIdleLifetime MINUTE)
		';
		
		// Sets the parameters
		$parameters = [
			':sessionIdleLifetime' => $sessionIdleLifetime
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Deletes a session.
	 * 
	 * It receives the session's ID.
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
	 * Inserts (or updates) a session.
	 * 
	 * It receives the session's ID and the values to insert/update the row.
	 */
	public function insertOrUpdateSession($sessionId, $sessionData) {
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
	 * Selects and returns a session.
	 * 
	 * It receives the session's ID.
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
		// Gets the configuration of the database
		$configuration = $this->app->configurations->get('webServerDatabase');
		$dsn = $configuration['dsn'];
		$username = $configuration['username'];
		$password = $configuration['password'];
		
		// Creates and returns a PDO instance
		return new PDO($dsn, $username, $password);
	}
	
}
