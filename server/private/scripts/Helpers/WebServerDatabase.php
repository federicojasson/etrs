<?php

namespace App\Helpers;

/*
 * This helper represents the web server database.
 */
class WebServerDatabase extends \App\Helpers\Database {
	
	/*
	 * Determines whether an account creation request exists.
	 * 
	 * It receives the account creation request's ID.
	 */
	public function accountCreationRequestExists($id) {
		// Defines the statement
		$statement = '
			SELECT 0
			FROM account_creation_requests
			WHERE id = :id
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the result
		return count($results) === 1;
	}
	
	/*
	 * Creates an account creation request.
	 * 
	 * It receives the account creation request's data.
	 */
	public function createAccountCreationRequest($id, $creator, $passwordHash, $salt, $keyDerivationIterations, $role) {
		// Defines the statement
		$statement = '
			INSERT INTO account_creation_requests (
				id,
				creator,
				creation_datetime,
				password_hash,
				salt,
				key_derivation_iterations,
				role
			)
			VALUES (
				:id,
				:creator,
				UTC_TIMESTAMP(),
				:passwordHash,
				:salt,
				:keyDerivationIterations,
				:role
			)
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':creator' => $creator,
			':passwordHash' => $passwordHash,
			':salt' => $salt,
			':keyDerivationIterations' => $keyDerivationIterations,
			':role' => $role
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
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
	 * Creates a password recovery request.
	 * 
	 * It receives the password recovery request's data.
	 */
	public function createPasswordRecoveryRequest($id, $user, $passwordHash, $salt, $keyDerivationIterations) {
		// Defines the statement
		$statement = '
			INSERT INTO password_recovery_requests (
				id,
				user,
				creation_datetime,
				password_hash,
				salt,
				key_derivation_iterations
			)
			VALUES (
				:id,
				:user,
				UTC_TIMESTAMP(),
				:passwordHash,
				:salt,
				:keyDerivationIterations
			)
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':user' => $user,
			':passwordHash' => $passwordHash,
			':salt' => $salt,
			':keyDerivationIterations' => $keyDerivationIterations
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Erases the idle sessions.
	 * 
	 * It receives the time in seconds that a session can live without activity
	 * (i.e., its idle lifetime).
	 */
	public function eraseIdleSessions($idleLifetime) {
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
	 * Erases a session.
	 * 
	 * It receives the session's ID.
	 */
	public function eraseSession($id) {
		// Defines the statement
		$statement = '
			DELETE
			FROM sessions
			WHERE id = :id
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Returns a session. If it doesn't exist, null is returned.
	 * 
	 * It receives the session's ID.
	 */
	public function getSession($id) {
		// Defines the statement
		$statement = '
			SELECT
				id AS id,
				creation_datetime AS creationDatetime,
				last_edition_datetime AS lastEditionDatetime,
				data AS data
			FROM sessions
			WHERE id = :id
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the first result, or null if there is none
		return getFirstElementOrNull($results);
	}
	
	/*
	 * Returns a user. If it doesn't exist, null is returned.
	 * 
	 * It receives the user's ID.
	 */
	public function getUser($id) {
		// Defines the statement
		$statement = '
			SELECT
				id AS id,
				creation_datetime AS creationDatetime,
				last_edition_datetime AS lastEditionDatetime,
				password_hash AS passwordHash,
				salt AS salt,
				key_derivation_iterations AS keyDerivationIterations,
				first_name AS firstName,
				last_name AS lastName,
				gender AS gender,
				email_address AS emailAddress,
				role AS role
			FROM users
			WHERE id = :id
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the first result, or null if there is none
		return getFirstElementOrNull($results);
	}
	
	/*
	 * Determines whether a log exists.
	 * 
	 * It receives the log's ID.
	 */
	public function logExists($id) {
		// Defines the statement
		$statement = '
			SELECT 0
			FROM logs
			WHERE id = :id
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id
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
	public function passwordRecoveryRequestExists($id) {
		// Defines the statement
		$statement = '
			SELECT 0
			FROM password_recovery_requests
			WHERE id = :id
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the result
		return count($results) === 1;
	}
	
	/*
	 * Determines whether a user exists.
	 * 
	 * It receives the user's ID.
	 */
	public function userExists($id) {
		// Defines the statement
		$statement = '
			SELECT 0
			FROM users
			WHERE id = :id
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the result
		return count($results) === 1;
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
