<?php

namespace App\Helper\Database;

/*
 * This helper represents the web server database.
 */
class WebServerDatabase extends SpecializedDatabase {
	
	/*
	 * Creates a log.
	 * 
	 * It receives the log's data.
	 */
	public function createLog($id, $level, $message) {
		// Defines the statement
		$statement = '
			INSERT INTO logs (
				id,
				creation_datetime,
				level,
				message
			)
			VALUES (
				:id,
				UTC_TIMESTAMP(),
				:level,
				:message
			)
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':level' => $level,
			':message' => $message
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Creates or edits a session.
	 * 
	 * It receives the session's data.
	 */
	public function createOrEditSession($id, $data) {
		// Defines the statement
		$statement = '
			INSERT INTO sessions (
				id,
				creation_datetime,
				last_edition_datetime,
				data
			)
			VALUES (
				:id,
				UTC_TIMESTAMP(),
				UTC_TIMESTAMP(),
				:dataForInsert
			)
			ON DUPLICATE KEY
			UPDATE
				last_edition_datetime = UTC_TIMESTAMP(),
				data = :dataForUpdate
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':dataForInsert' => $data,
			':dataForUpdate' => $data
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Deletes the inactive sessions.
	 * 
	 * It receives the maximum time that a session can remain inactive (in
	 * seconds).
	 */
	public function deleteInactiveSessions($maximumInactiveTime) {
		// Defines the statement
		$statement = '
			DELETE
			FROM sessions
			WHERE last_edition_datetime < DATE_SUB(UTC_TIMESTAMP(), INTERVAL :maximumInactiveTime SECOND)
		';
		
		// Sets the parameters
		$parameters = [
			':maximumInactiveTime' => $maximumInactiveTime
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Deletes a session.
	 * 
	 * It receives the session's ID.
	 */
	public function deleteSession($id) {
		$this->deleteEntity('sessions', $id);
	}
	
	/*
	 * Returns a session. If it doesn't exist, null is returned.
	 * 
	 * It receives the session's ID.
	 */
	public function getSession($id) {
		// Defines the columns to select
		$columnsToSelect = [
			'id AS id',
			'creation_datetime AS creationDatetime',
			'last_edition_datetime AS lastEditionDatetime',
			'data AS data'
		];
		
		// Gets and returns the entity
		return $this->getEntity('sessions', $columnsToSelect, $id);
	}
	
	/*
	 * Returns a user. If it doesn't exist, null is returned.
	 * 
	 * It receives the user's ID.
	 */
	public function getUser($id) {
		// Defines the columns to select
		$columnsToSelect = [
			'id AS id',
			'creation_datetime AS creationDatetime',
			'last_edition_datetime AS lastEditionDatetime',
			'password_hash AS passwordHash',
			'salt AS salt',
			'key_derivation_iterations AS keyDerivationIterations',
			'role AS role',
			'first_name AS firstName',
			'last_name AS lastName',
			'gender AS gender',
			'email_address AS emailAddress'
		];
		
		// Gets and returns the entity
		return $this->getEntity('users', $columnsToSelect, $id);
	}
	
	/*
	 * Determines whether a log exists.
	 * 
	 * It receives the log's ID.
	 */
	public function logExists($id) {
		return $this->entityExists('logs', $id);
	}
	
	/*
	 * Connects to the database.
	 * 
	 * It returns a PDO instance representing the connection.
	 */
	protected function connect() {
		$app = $this->app;
		
		// Gets the database's parameters
		$parameters = $app->parameters->get(PARAMETERS_DATABASES);
		$dsn = $parameters['webServerDatabase']['dsn'];
		$username = $parameters['webServerDatabase']['username'];
		$password = $parameters['webServerDatabase']['password'];
		
		// Creates and returns the PDO instance
		return new \PDO($dsn, $username, $password);
	}
	
}
