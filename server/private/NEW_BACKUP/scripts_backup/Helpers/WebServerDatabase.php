<?php

namespace App\Helpers;

/*
 * This helper represents the web server database.
 */
class WebServerDatabase extends \App\Helpers\Database {
	
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
	 * Deletes the idle sessions.
	 * 
	 * It receives the time in seconds that a session can live without activity
	 * (i.e., its idle lifetime).
	 */
	public function deleteIdleSessions($idleLifetime) {
		// Defines the statement
		$statement = '
			DELETE
			FROM sessions
			WHERE last_edition_datetime < DATE_SUB(UTC_TIMESTAMP(), INTERVAL :idleLifetime SECOND)
		';
		
		// Sets the parameters
		$parameters = [
			':idleLifetime' => $idleLifetime
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
		// Defines the fields and their aliases
		$fieldsAndAliases = [
			'id' => 'id',
			'creation_datetime' => 'creationDatetime',
			'last_edition_datetime' => 'lastEditionDatetime',
			'data' => 'data'
		];
		
		// Gets and returns the entity
		return $this->getEntity('sessions', $fieldsAndAliases, $id);
	}
	
	/*
	 * Returns a user. If it doesn't exist, null is returned.
	 * 
	 * It receives the user's ID.
	 */
	public function getUser($id) {
		// Defines the fields and their aliases
		$fieldsAndAliases = [
			'id' => 'id',
			'creation_datetime' => 'creationDatetime',
			'last_edition_datetime' => 'lastEditionDatetime',
			'password_hash' => 'passwordHash',
			'salt' => 'salt',
			'key_derivation_iterations' => 'keyDerivationIterations',
			'first_name' => 'firstName',
			'last_name' => 'lastName',
			'gender' => 'gender',
			'email_address' => 'emailAddress',
			'role' => 'role'
		];
		
		// Gets and returns the entity
		return $this->getEntity('users', $fieldsAndAliases, $id);
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
		$webServerDatabase = $parameters['webServerDatabase'];
		$dsn = $webServerDatabase['dsn'];
		$username = $webServerDatabase['username'];
		$password = $webServerDatabase['password'];
		
		// Creates and returns the PDO instance
		return new \PDO($dsn, $username, $password);
	}
	
}
