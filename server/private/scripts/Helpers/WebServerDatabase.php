<?php

/*
 * This helper represents the web server database.
 */
class WebServerDatabase extends Database {
	
	/*
	 * Deletes the expired sessions.
	 * 
	 * It receives the time in minutes that the sessions can live without
	 * activity (i.e., their idle lifetime).
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
	 * TODO: comments
	 */
	public function deleteUserPasswordRecoveryRequests($userId) {
		// Defines the statement
		$statement = '
			DELETE
			FROM password_recovery_requests
			WHERE user = :userId
		';
		
		// Sets the parameters
		$parameters = [
			':userId' => $userId
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Inserts a log.
	 * 
	 * It receives the values to insert.
	 */
	public function insertLog($logId, $logType, $logMessage) {
		// Defines the statement
		$statement = '
			INSERT INTO logs (
				id,
				creation_datetime,
				type,
				message
			)
			VALUES (
				:logId,
				UTC_TIMESTAMP(),
				:logType,
				:logMessage
			)
		';
		
		// Sets the parameters
		$parameters = [
			':logId' => $logId,
			':logType' => $logType,
			':logMessage' => $logMessage
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Inserts or updates a session.
	 * 
	 * It receives the values to insert/update the row.
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
	 * Inserts a password recovery request.
	 * 
	 * It receives the values to insert.
	 */
	public function insertPasswordRecoveryRequest($id, $user, $passwordHash, $passwordSalt, $passwordIterations) {
		// Defines the statement
		$statement = '
			INSERT INTO password_recovery_requests (
				id,
				user,
				creation_datetime,
				password_hash,
				password_salt,
				password_iterations
			)
			VALUES (
				:id,
				:user,
				UTC_TIMESTAMP(),
				:passwordHash,
				:passwordSalt,
				:passwordIterations
			)
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':user' => $user,
			':passwordHash' => $passwordHash,
			':passwordSalt' => $passwordSalt,
			':passwordIterations' => $passwordIterations
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Determines whether a log exists.
	 * 
	 * It receives the log's ID.
	 */
	public function logExists($logId) {
		// Defines the statement
		$statement = '
			SELECT 0
			FROM logs
			WHERE id = :logId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':logId' => $logId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the result
		return count($results) === 1;
	}
	
	/*
	 * Determines whether a password recovery request exists.
	 * 
	 * It receives the password recovery request's ID.
	 */
	public function passwordRecoveryRequestExists($passwordRecoveryRequestId) {
		// Defines the statement
		$statement = '
			SELECT 0
			FROM password_recovery_requests
			WHERE id = :passwordRecoveryRequestId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':passwordRecoveryRequestId' => $passwordRecoveryRequestId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the result
		return count($results) === 1;
	}
	
	/*
	 * Selects and returns a session. If it doesn't exist, null is returned.
	 * 
	 * It receives the session's ID.
	 */
	public function selectSession($sessionId) {
		// Defines the statement
		$statement = '
			SELECT
				id AS id,
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
		return getFirstElementOrNull($results);
	}
	
	/*
	 * Connects to the database.
	 * 
	 * It returns the PDO instance representing the connection.
	 */
	protected function connect() {
		// Gets the database configuration
		$configuration = $this->app->configurations->get('webServerDatabase');
		
		$dsn = $configuration['dsn'];
		$username = $configuration['username'];
		$password = $configuration['password'];
		
		// Creates and returns a PDO instance
		return new PDO($dsn, $username, $password);
	}
	
}
