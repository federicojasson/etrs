<?php

namespace App\Helpers;

/*
 * This helper represents the business logic database.
 */
class BusinessLogicDatabase extends \App\Helpers\Database {
	
	/*
	 * Creates an experiment.
	 * 
	 * It receives the experiment's data.
	 */
	public function createExperiment($id, $creator, $lastEditor, $name, $commandLine) {
		// Defines the statement
		$statement = '
			INSERT INTO experiments (
				id,
				is_erased,
				creator,
				last_editor,
				creation_datetime,
				last_edition_datetime,
				name,
				command_line
			)
			VALUES (
				:id,
				FALSE,
				:creator,
				:lastEditor,
				UTC_TIMESTAMP(),
				UTC_TIMESTAMP(),
				:name,
				:commandLine
			)
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':creator' => $creator,
			':lastEditor' => $lastEditor,
			':name' => $name,
			':commandLine' => $commandLine
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Creates a medication.
	 * 
	 * It receives the medication's data.
	 */
	public function createMedication($id, $creator, $lastEditor, $name) {
		// Defines the statement
		$statement = '
			INSERT INTO medications (
				id,
				is_erased,
				creator,
				last_editor,
				creation_datetime,
				last_edition_datetime,
				name
			)
			VALUES (
				:id,
				FALSE,
				:creator,
				:lastEditor,
				UTC_TIMESTAMP(),
				UTC_TIMESTAMP(),
				:name
			)
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':creator' => $creator,
			':lastEditor' => $lastEditor,
			':name' => $name
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Edits an experiment.
	 * 
	 * It receives the experiment's data.
	 */
	public function editExperiment($id, $lastEditor, $name, $commandLine) {
		// Defines the statement
		$statement = '
			UPDATE experiments
			SET
				last_editor = :lastEditor,
				last_edition_datetime = UTC_TIMESTAMP(),
				name = :name,
				command_line = :commandLine
			WHERE id = :id
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':lastEditor' => $lastEditor,
			':name' => $name,
			':commandLine' => $commandLine
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Edits a medication.
	 * 
	 * It receives the medication's data.
	 */
	public function editMedication($id, $lastEditor, $name) {
		// Defines the statement
		$statement = '
			UPDATE medications
			SET
				last_editor = :lastEditor,
				last_edition_datetime = UTC_TIMESTAMP(),
				name = :name
			WHERE id = :id
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':lastEditor' => $lastEditor,
			':name' => $name
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Erases an experiment.
	 * 
	 * It receives the experiment's ID.
	 */
	public function eraseExperiment($id) {
		// Defines the statement
		$statement = '
			UPDATE experiments
			SET is_erased = TRUE
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
	 * Erases the files of an experiment.
	 * 
	 * It receives the experiment's ID.
	 */
	public function eraseExperimentFiles($id) {
		// Defines the statement
		$statement = '
			UPDATE files
			INNER JOIN experiments_files ON files.id = experiments_files.file
			SET files.is_erased = TRUE
			WHERE experiments_files.experiment = :id
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Erases a medication.
	 * 
	 * It receives the medication's ID.
	 */
	public function eraseMedication($id) {
		// Defines the statement
		$statement = '
			UPDATE medications
			SET is_erased = TRUE
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
	 * Determines whether an experiment exists.
	 * 
	 * It receives the experiment's ID.
	 */
	public function experimentExists($id) {
		// Defines the statement
		$statement = '
			SELECT 0
			FROM experiments
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
	 * Gets the non-erased files of an experiment.
	 * 
	 * It receives the experiment's ID.
	 */
	public function getExperimentNonErasedFiles($id) {
		// Defines the statement
		$statement = '
			SELECT file AS id
			FROM experiments_non_erased_files
			WHERE experiment = :id
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		return $results;
	}
	
	/*
	 * Gets a non-erased experiment. If it doesn't exist, null is returned.
	 * 
	 * It receives the experiment's ID.
	 */
	public function getNonErasedExperiment($id) {
		// Defines the statement
		$statement = '
			SELECT
				id AS id,
				creator AS creator,
				last_editor AS lastEditor,
				creation_datetime AS creationDatetime,
				last_edition_datetime AS lastEditionDatetime,
				name AS name,
				command_line AS commandLine
			FROM non_erased_experiments
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
	 * Gets a non-erased medication. If it doesn't exist, null is returned.
	 * 
	 * It receives the medication's ID.
	 */
	public function getNonErasedMedication($id) {
		// Defines the statement
		$statement = '
			SELECT
				id AS id,
				creator AS creator,
				last_editor AS lastEditor,
				creation_datetime AS creationDatetime,
				last_edition_datetime AS lastEditionDatetime,
				name AS name
			FROM non_erased_medications
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
	 * Gets a non-erased patient. If it doesn't exist, null is returned.
	 * 
	 * It receives the patient's ID.
	 */
	public function getNonErasedPatient($id) {
		// Defines the statement
		$statement = '
			SELECT
				id AS id,
				creator AS creator,
				last_editor AS lastEditor,
				creation_datetime AS creationDatetime,
				last_edition_datetime AS lastEditionDatetime,
				first_name AS firstName,
				last_name AS lastName,
				gender AS gender,
				birth_date AS birthDate,
				education_years AS educationYears
			FROM non_erased_patients
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
	 * Determines whether a medication exists.
	 * 
	 * It receives the medication's ID.
	 */
	public function medicationExists($id) {
		// Defines the statement
		$statement = '
			SELECT 0
			FROM medications
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
	 * Determines whether a non-erased experiment exists.
	 * 
	 * It receives the experiment's ID.
	 */
	public function nonErasedExperimentExists($id) {
		// Defines the statement
		$statement = '
			SELECT 0
			FROM non_erased_experiments
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
	 * Determines whether a non-erased medication exists.
	 * 
	 * It receives the medication's ID.
	 */
	public function nonErasedMedicationExists($id) {
		// Defines the statement
		$statement = '
			SELECT 0
			FROM non_erased_medications
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
	 * Performs a full-text search and returns non-erased experiments.
	 * 
	 * It receives an expression, an ORDER BY clause, the limit of rows to
	 * return and an offset.
	 */
	public function searchNonErasedExperiments($expression, $orderByClause, $limit, $offset) {
		// Defines the statement
		$statement = '
			SELECT SQL_CALC_FOUND_ROWS id AS id
			FROM non_erased_experiments
			WHERE
				MATCH(name)
				AGAINST(:expression IN BOOLEAN MODE)
			ORDER BY ' . $orderByClause . '
			LIMIT :limit OFFSET :offset
		';
		
		// Sets the parameters
		$parameters = [
			':expression' => $expression,
			':limit' => $limit,
			':offset' => $offset
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		return $results;
	}
	
	/*
	 * Performs a full-text search and returns non-erased medications.
	 * 
	 * It receives an expression, an ORDER BY clause, the limit of rows to
	 * return and an offset.
	 */
	public function searchNonErasedMedications($expression, $orderByClause, $limit, $offset) {
		// Defines the statement
		$statement = '
			SELECT SQL_CALC_FOUND_ROWS id AS id
			FROM non_erased_medications
			WHERE
				MATCH(name)
				AGAINST(:expression IN BOOLEAN MODE)
			ORDER BY ' . $orderByClause . '
			LIMIT :limit OFFSET :offset
		';
		
		// Sets the parameters
		$parameters = [
			':expression' => $expression,
			':limit' => $limit,
			':offset' => $offset
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		return $results;
	}
	
	/*
	 * Performs a full-text search and returns non-erased patients.
	 * 
	 * It receives an expression, an ORDER BY clause, the limit of rows to
	 * return and an offset.
	 */
	public function searchNonErasedPatients($expression, $orderByClause, $limit, $offset) {
		// Defines the statement
		$statement = '
			SELECT SQL_CALC_FOUND_ROWS id AS id
			FROM non_erased_patients
			WHERE
				MATCH(first_name, last_name)
				AGAINST(:expression IN BOOLEAN MODE)
			ORDER BY ' . $orderByClause . '
			LIMIT :limit OFFSET :offset
		';
		
		// Sets the parameters
		$parameters = [
			':expression' => $expression,
			':limit' => $limit,
			':offset' => $offset
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		return $results;
	}
	
	/*
	 * Connects to the database.
	 * 
	 * It returns a PDO instance representing the connection.
	 */
	protected function connect() {
		$app = $this->app;
		
		// Gets the database's parameters
		$parameters = $app->parameters->get('businessLogicDatabase');
		$dsn = $parameters['dsn'];
		$username = $parameters['username'];
		$password = $parameters['password'];
		
		// Creates and returns the PDO instance
		return new \PDO($dsn, $username, $password);
	}
	
}
