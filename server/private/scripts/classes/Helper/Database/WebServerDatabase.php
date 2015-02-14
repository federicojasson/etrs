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
		
		// Defines the parameters
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
				:dataToInsert
			)
			ON DUPLICATE KEY
			UPDATE
				last_edition_datetime = UTC_TIMESTAMP(),
				data = :dataToUpdate
		';
		
		// Defines the parameters
		$parameters = [
			':id' => $id,
			':dataToInsert' => $data,
			':dataToUpdate' => $data
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}

	/*
	 * Creates a recover password permission.
	 * 
	 * It receives the recover password permission's data.
	 */
	public function createRecoverPasswordPermission($id, $user, $passwordHash, $salt, $keyStretchingIterations) {
		// Defines the statement
		$statement = '
			INSERT INTO recover_password_permissions (
				id,
				user,
				creation_datetime,
				password_hash,
				salt,
				key_stretching_iterations
			)
			VALUES (
				:id,
				:user,
				UTC_TIMESTAMP(),
				:passwordHash,
				:salt,
				:keyStretchingIterations
			)
		';
		
		// Defines the parameters
		$parameters = [
			':id' => $id,
			':user' => $user,
			':passwordHash' => $passwordHash,
			':salt' => $salt,
			':keyStretchingIterations' => $keyStretchingIterations
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}

	/*
	 * Creates a sandbox.
	 * 
	 * It receives the sandbox's data.
	 */
	public function createSandbox($id, $creator) {
		// Defines the statement
		$statement = '
			INSERT INTO sandboxes (
				id,
				creator,
				creation_datetime
			)
			VALUES (
				:id,
				:creator,
				UTC_TIMESTAMP()
			)
		';
		
		// Defines the parameters
		$parameters = [
			':id' => $id,
			':creator' => $creator
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}

	/*
	 * Creates a sign up permission.
	 * 
	 * It receives the sign up permission's data.
	 */
	public function createSignUpPermission($id, $creator, $passwordHash, $salt, $keyStretchingIterations, $role) {
		// Defines the statement
		$statement = '
			INSERT INTO sign_up_permissions (
				id,
				creator,
				creation_datetime,
				password_hash,
				salt,
				key_stretching_iterations,
				role
			)
			VALUES (
				:id,
				:creator,
				UTC_TIMESTAMP(),
				:passwordHash,
				:salt,
				:keyStretchingIterations,
				:role
			)
		';
		
		// Defines the parameters
		$parameters = [
			':id' => $id,
			':creator' => $creator,
			':passwordHash' => $passwordHash,
			':salt' => $salt,
			':keyStretchingIterations' => $keyStretchingIterations,
			':role' => $role
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}

	/*
	 * Creates a user.
	 * 
	 * It receives the user's data.
	 */
	public function createUser($id, $creator, $passwordHash, $salt, $keyStretchingIterations, $role, $firstName, $lastName, $gender, $emailAddress) {
		// Defines the statement
		$statement = '
			INSERT INTO users (
				id,
				creator,
				creation_datetime,
				last_edition_datetime,
				password_hash,
				salt,
				key_stretching_iterations,
				role,
				first_name,
				last_name,
				gender,
				email_address
			)
			VALUES (
				:id,
				:creator,
				UTC_TIMESTAMP(),
				UTC_TIMESTAMP(),
				:passwordHash,
				:salt,
				:keyStretchingIterations,
				:role,
				:firstName,
				:lastName,
				:gender,
				:emailAddress
			)
		';
		
		// Defines the parameters
		$parameters = [
			':id' => $id,
			':creator' => $creator,
			':passwordHash' => $passwordHash,
			':salt' => $salt,
			':keyStretchingIterations' => $keyStretchingIterations,
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
	 * Deletes a recover password permission.
	 * 
	 * It receives the recover password permission's ID.
	 */
	public function deleteRecoverPasswordPermission($id) {
		$this->deleteEntity('recover_password_permissions', $id);
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
	 * Deletes a sign up permission.
	 * 
	 * It receives the sign up permission's ID.
	 */
	public function deleteSignUpPermission($id) {
		$this->deleteEntity('sign_up_permissions', $id);
	}
	
	/*
	 * Deletes a user.
	 * 
	 * It receives the user's ID.
	 */
	public function deleteUser($id) {
		$this->deleteEntity('users', $id);
	}
	
	/*
	 * Deletes the recover password permission of a user.
	 * 
	 * It receives the user's ID.
	 */
	public function deleteUserRecoverPasswordPermission($user) {
		// Defines the statement
		$statement = '
			DELETE
			FROM recover_password_permissions
			WHERE user = :user
			LIMIT 1
		';
		
		// Defines the parameters
		$parameters = [
			':user' => $user
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Edits a user.
	 * 
	 * It receives the user's data.
	 */
	public function editUser($id, $passwordHash, $salt, $keyStretchingIterations, $firstName, $lastName, $gender, $emailAddress) {
		// Defines the statement
		$statement = '
			UPDATE users
			SET
				last_edition_datetime = UTC_TIMESTAMP(),
				password_hash = :passwordHash,
				salt = :salt,
				key_stretching_iterations = :keyStretchingIterations,
				first_name = :firstName,
				last_name = :lastName,
				gender = :gender,
				email_address = :emailAddress
			WHERE id = :id
			LIMIT 1
		';
		
		// Defines the parameters
		$parameters = [
			':id' => $id,
			':passwordHash' => $passwordHash,
			':salt' => $salt,
			':keyStretchingIterations' => $keyStretchingIterations,
			':firstName' => $firstName,
			':lastName' => $lastName,
			':gender' => $gender,
			':emailAddress' => $emailAddress
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Returns a log. If it doesn't exist, null is returned.
	 * 
	 * It receives the log's ID.
	 */
	public function getLog($id) {
		// Defines the columns to select
		$columnsToSelect = [
			'id',
			'creation_datetime',
			'level',
			'message'
		];
		
		// Gets and returns the entity
		return $this->getEntity('logs', $columnsToSelect, $id);
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
			'key_stretching_iterations'
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
			'key_stretching_iterations',
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
			'creator',
			'creation_datetime',
			'last_edition_datetime',
			'password_hash',
			'salt',
			'key_stretching_iterations',
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
	 * Searches all logs and returns the results.
	 * 
	 * It receives the page and a sorting.
	 */
	public function searchAllLogs($page, $sorting) {
		// Defines the columns to select
		$columnsToSelect = [
			'id'
		];
		
		// Searches all entities and returns the results
		return $this->searchAllEntities('logs', $columnsToSelect, $page, $sorting);
	}
	
	/*
	 * Searches specific logs and returns the results.
	 * 
	 * It receives an expression, the page and a sorting.
	 */
	public function searchSpecificLogs($expression, $page, $sorting) {
		// Defines the columns to select
		$columnsToSelect = [
			'id'
		];
		
		// Defines the columns to match
		$columnsToMatch = [
			'message'
		];
		
		// Searches specific entities and returns the results
		return $this->searchSpecificEntities('logs', $columnsToSelect, $columnsToMatch, $expression, $page, $sorting);
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
	 * Connects to the database and returns a PDO instance representing the
	 * connection.
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
