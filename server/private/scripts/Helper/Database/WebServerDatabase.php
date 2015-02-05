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
	 * Creates a user.
	 * 
	 * It receives the user's data.
	 */
	public function createUser($id, $passwordHash, $salt, $keyDerivationIterations, $role, $firstName, $lastName, $gender, $emailAddress) {
		// Defines the statement
		$statement = '
			INSERT INTO users (
				id,
				creation_datetime,
				last_edition_datetime,
				password_hash,
				salt,
				key_derivation_iterations,
				role,
				first_name,
				last_name,
				gender,
				email_address
			)
			VALUES (
				:id,
				UTC_TIMESTAMP(),
				UTC_TIMESTAMP(),
				:passwordHash,
				:salt,
				:keyDerivationIterations,
				:role,
				:firstName,
				:lastName,
				:gender,
				:emailAddress
			)
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':passwordHash' => $passwordHash,
			':salt' => $salt,
			':keyDerivationIterations' => $keyDerivationIterations,
			':role' => $role,
			':firstName' => $firstName,
			':lastName' => $lastName,
			':gender' => $gender,
			':emailAddress' => $emailAddress
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
	 * Returns a recover password permission. If it doesn't exist, null is
	 * returned.
	 * 
	 * It receives the recover password permission's ID.
	 */
	public function getRecoverPasswordPermission($id) {
		// Defines the columns to select
		$columnsToSelect = [
			'id',
			'user',
			'creation_datetime',
			'password_hash',
			'salt',
			'key_derivation_iterations'
		];
		
		// Gets and returns the entity
		return $this->getEntity('recover_password_permissions', $columnsToSelect, $id);
	}
	
	/*
	 * Returns a session. If it doesn't exist, null is returned.
	 * 
	 * It receives the session's ID.
	 */
	public function getSession($id) {
		// Defines the columns to select
		$columnsToSelect = [
			'id',
			'creation_datetime',
			'last_edition_datetime',
			'data'
		];
		
		// Gets and returns the entity
		return $this->getEntity('sessions', $columnsToSelect, $id);
	}
	
	/*
	 * Returns a sign up permission. If it doesn't exist, null is returned.
	 * 
	 * It receives the sign up permission's ID.
	 */
	public function getSignUpPermission($id) {
		// Defines the columns to select
		$columnsToSelect = [
			'id',
			'creator',
			'creation_datetime',
			'password_hash',
			'salt',
			'key_derivation_iterations',
			'role'
		];
		
		// Gets and returns the entity
		return $this->getEntity('sign_up_permissions', $columnsToSelect, $id);
	}
	
	/*
	 * Returns a user. If it doesn't exist, null is returned.
	 * 
	 * It receives the user's ID.
	 */
	public function getUser($id) {
		// Defines the columns to select
		$columnsToSelect = [
			'id',
			'creation_datetime',
			'last_edition_datetime',
			'password_hash',
			'salt',
			'key_derivation_iterations',
			'role',
			'first_name',
			'last_name',
			'gender',
			'email_address'
		];
		
		// Gets and returns the entity
		return $this->getEntity('users', $columnsToSelect, $id);
	}
	
	/*
	 * Determines whether a user exists.
	 * 
	 * It receives the user's ID.
	 */
	public function userExists($id) {
		return $this->entityExists('users', $id);
	}
	
	/*
	 * Connects to the database.
	 * 
	 * It returns a PDO instance representing the connection.
	 */
	protected function connect() {
		$app = $this->app;
		
		// Gets the database's parameters
		$parameters = $app->parameters->databases['webServerDatabase'];
		$dsn = $parameters['dsn'];
		$username = $parameters['username'];
		$password = $parameters['password'];
		
		// Creates and returns the PDO instance
		return new \PDO($dsn, $username, $password);
	}
	
}
