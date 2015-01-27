<?php

namespace App\Helpers;

/*
 * This helper represents the business logic database.
 */
class BusinessLogicDatabase extends \App\Helpers\Database {
	
	/*
	 * Determines whether a background exists.
	 * 
	 * It receives the background's ID.
	 */
	public function backgroundExists($id) {
		// Defines the statement
		$statement = '
			SELECT 0
			FROM backgrounds
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
	 * Determines whether a clinical impression exists.
	 * 
	 * It receives the clinical impression's ID.
	 */
	public function clinicalImpressionExists($id) {
		// Defines the statement
		$statement = '
			SELECT 0
			FROM clinical_impressions
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
	 * Creates a background.
	 * 
	 * It receives the background's data.
	 */
	public function createBackground($id, $creator, $lastEditor, $name) {
		// Defines the statement
		$statement = '
			INSERT INTO experiments (
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
	 * Creates a clinical impression.
	 * 
	 * It receives the clinical impression's data.
	 */
	public function createClinicalImpression($id, $creator, $lastEditor, $name) {
		// Defines the statement
		$statement = '
			INSERT INTO clinical_impressions (
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
	 * Creates an image test.
	 * 
	 * It receives the image test's data.
	 */
	public function createImageTest($id, $creator, $lastEditor, $name, $dataTypeDefinition) {
		// Defines the statement
		$statement = '
			INSERT INTO image_tests (
				id,
				is_erased,
				creator,
				last_editor,
				creation_datetime,
				last_edition_datetime,
				name,
				data_type_definition
			)
			VALUES (
				:id,
				FALSE,
				:creator,
				:lastEditor,
				UTC_TIMESTAMP(),
				UTC_TIMESTAMP(),
				:name,
				:dataTypeDefinition
			)
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':creator' => $creator,
			':lastEditor' => $lastEditor,
			':name' => $name,
			':dataTypeDefinition' => $dataTypeDefinition
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
	 * Creates a patient.
	 * 
	 * It receives the patient's data.
	 */
	public function createPatient($id, $creator, $lastEditor, $firstName, $lastName, $gender, $birthDate, $educationYears) {
		// Defines the statement
		$statement = '
			INSERT INTO patients (
				id,
				is_erased,
				creator,
				last_editor,
				creation_datetime,
				last_edition_datetime,
				first_name,
				last_name,
				gender,
				birth_date,
				education_years
			)
			VALUES (
				:id,
				FALSE,
				:creator,
				:lastEditor,
				UTC_TIMESTAMP(),
				UTC_TIMESTAMP(),
				:firstName,
				:lastName,
				:gender,
				:birthDate,
				:educationYears
			)
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':creator' => $creator,
			':lastEditor' => $lastEditor,
			':firstName' => $firstName,
			':lastName' => $lastName,
			':gender' => $gender,
			':birthDate' => $birthDate,
			':educationYears' => $educationYears
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Creates a study.
	 * 
	 * It receives the study's data.
	 */
	public function createStudy($id, $consultation, $creator, $experiment, $lastEditor, $report, $observations) {
		// Defines the statement
		$statement = '
			INSERT INTO studies (
				id,
				is_erased,
				consultation,
				creator,
				experiment,
				last_editor,
				report,
				creation_datetime,
				last_edition_datetime,
				observations
			)
			VALUES (
				:id,
				FALSE,
				:consultation,
				:creator,
				:experiment,
				:lastEditor,
				:report,
				UTC_TIMESTAMP(),
				UTC_TIMESTAMP(),
				:observations
			)
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':consultation' => $consultation,
			':creator' => $creator,
			':experiment' => $experiment,
			':lastEditor' => $lastEditor,
			':report' => $report,
			':observations' => $observations
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Edits a background.
	 * 
	 * It receives the background's data.
	 */
	public function editBackground($id, $lastEditor, $name) {
		// Defines the statement
		$statement = '
			UPDATE backgrounds
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
	 * Edits a clinical impression.
	 * 
	 * It receives the clinical impression's data.
	 */
	public function editClinicalImpression($id, $lastEditor, $name) {
		// Defines the statement
		$statement = '
			UPDATE clinical_impressions
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
	 * Edits an image test.
	 * 
	 * It receives the image test's data.
	 */
	public function editImageTest($id, $lastEditor, $name, $dataTypeDefinition) {
		// Defines the statement
		$statement = '
			UPDATE image_tests
			SET
				last_editor = :lastEditor,
				last_edition_datetime = UTC_TIMESTAMP(),
				name = :name,
				data_type_definition = :dataTypeDefinition
			WHERE id = :id
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':lastEditor' => $lastEditor,
			':name' => $name,
			':dataTypeDefinition' => $dataTypeDefinition
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
	 * Edits a patient.
	 * 
	 * It receives the patient's data.
	 */
	public function editPatient($id, $lastEditor, $firstName, $lastName, $gender, $birthDate, $educationYears) {
		// Defines the statement
		$statement = '
			UPDATE patients
			SET
				last_editor = :lastEditor,
				last_edition_datetime = UTC_TIMESTAMP(),
				first_name = :firstName,
				last_name = :lastName,
				gender = :gender,
				birth_date = :birthDate,
				education_years = :educationYears
			WHERE id = :id
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':lastEditor' => $lastEditor,
			':firstName' => $firstName,
			':lastName' => $lastName,
			':gender' => $gender,
			':birthDate' => $birthDate,
			':educationYears' => $educationYears
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Edits a study.
	 * 
	 * It receives the study's data.
	 */
	public function editStudy($id, $consultation, $experiment, $lastEditor, $report, $observations) {
		// Defines the statement
		$statement = '
			UPDATE studies
			SET
				consultation = :consultation,
				experiment = :experiment,
				last_editor = :lastEditor,
				report = :report,
				last_edition_datetime = UTC_TIMESTAMP(),
				observations = :observations
			WHERE id = :id
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':consultation' => $consultation,
			':experiment' => $experiment,
			':lastEditor' => $lastEditor,
			':report' => $report,
			':observations' => $observations
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Erases a background.
	 * 
	 * It receives the background's ID.
	 */
	public function eraseBackground($id) {
		// Defines the statement
		$statement = '
			UPDATE backgrounds
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
	 * Erases a clinical impression.
	 * 
	 * It receives the clinical impression's ID.
	 */
	public function eraseClinicalImpression($id) {
		// Defines the statement
		$statement = '
			UPDATE clinical_impressions
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
	 * Erases a consultation.
	 * 
	 * It receives the consultation's ID.
	 */
	public function eraseConsultation($id) {
		// Defines the statement
		$statement = '
			UPDATE consultations
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
	public function eraseExperimentFiles($id) { // TODO: método dudoso (podría usarse getExperimentNonErasedFiles y eliminarlas manualmente)
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
	 * Erases an image test.
	 * 
	 * It receives the image test's ID.
	 */
	public function eraseImageTest($id) {
		// Defines the statement
		$statement = '
			UPDATE image_tests
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
	 * Erases a study.
	 * 
	 * It receives the study's ID.
	 */
	public function eraseStudy($id) {
		// Defines the statement
		$statement = '
			UPDATE studies
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
	 * Returns the non-erased files of an experiment.
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
	 * Returns a non-erased background. If it doesn't exist, null is returned.
	 * 
	 * It receives the background's ID.
	 */
	public function getNonErasedBackground($id) {
		// Defines the statement
		$statement = '
			SELECT
				id AS id,
				is_erased AS isErased,
				creator AS creator,
				last_editor AS lastEditor,
				creation_datetime AS creationDatetime,
				last_edition_datetime AS lastEditionDatetime,
				name AS name
			FROM non_erased_backgrounds
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
	 * Returns a non-erased clinical impression. If it doesn't exist, null is
	 * returned.
	 * 
	 * It receives the clinical impression's ID.
	 */
	public function getNonErasedClinicalImpression($id) {
		// Defines the statement
		$statement = '
			SELECT
				id AS id,
				is_erased AS isErased,
				creator AS creator,
				last_editor AS lastEditor,
				creation_datetime AS creationDatetime,
				last_edition_datetime AS lastEditionDatetime,
				name AS name
			FROM non_erased_clinical_impressions
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
	 * Returns a non-erased consultation. If it doesn't exist, null is returned.
	 * 
	 * It receives the consultation's ID.
	 */
	public function getNonErasedConsultation($id) {
		// Defines the statement
		$statement = '
			SELECT
				id AS id,
				is_erased AS isErased,
				clinical_impression AS clinicalImpression,
				creator AS creator,
				diagnosis AS diagnosis,
				last_editor AS lastEditor,
				patient AS patient,
				creation_datetime AS creationDatetime,
				last_edition_datetime AS lastEditionDatetime,
				date AS date,
				reasons AS reasons,
				observations AS observations,
				indications AS indications
			FROM non_erased_consultations
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
	 * Returns a non-erased experiment. If it doesn't exist, null is returned.
	 * 
	 * It receives the experiment's ID.
	 */
	public function getNonErasedExperiment($id) {
		// Defines the statement
		$statement = '
			SELECT
				id AS id,
				is_erased AS isErased,
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
	 * Returns a non-erased image test. If it doesn't exist, null is returned.
	 * 
	 * It receives the image test's ID.
	 */
	public function getNonErasedImageTest($id) {
		// Defines the statement
		$statement = '
			SELECT
				id AS id,
				is_erased AS isErased,
				creator AS creator,
				last_editor AS lastEditor,
				creation_datetime AS creationDatetime,
				last_edition_datetime AS lastEditionDatetime,
				name AS name,
				data_type_definition AS dataTypeDefinition
			FROM non_erased_image_tests
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
	 * Returns a non-erased medication. If it doesn't exist, null is returned.
	 * 
	 * It receives the medication's ID.
	 */
	public function getNonErasedMedication($id) {
		// Defines the statement
		$statement = '
			SELECT
				id AS id,
				is_erased AS isErased,
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
	 * Returns a non-erased patient. If it doesn't exist, null is returned.
	 * 
	 * It receives the patient's ID.
	 */
	public function getNonErasedPatient($id) {
		// Defines the statement
		$statement = '
			SELECT
				id AS id,
				is_erased AS isErased,
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
	 * Returns a non-erased study. If it doesn't exist, null is returned.
	 * 
	 * It receives the study's ID.
	 */
	public function getNonErasedStudy($id) {
		// Defines the statement
		$statement = '
			SELECT
				id AS id,
				is_erased AS isErased,
				consultation AS consultation,
				creator AS creator,
				experiment AS experiment,
				last_editor AS lastEditor,
				report AS report,
				creation_datetime AS creationDatetime,
				last_edition_datetime AS lastEditionDatetime,
				observations AS observations
			FROM non_erased_studies
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
	 * Returns the non-erased files of a study.
	 * 
	 * It receives the study's ID.
	 */
	public function getStudyNonErasedFiles($id) {
		// Defines the statement
		$statement = '
			SELECT file AS id
			FROM studies_non_erased_files
			WHERE study = :id
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
	 * Determines whether an image test exists.
	 * 
	 * It receives the image test's ID.
	 */
	public function imageTestExists($id) {
		// Defines the statement
		$statement = '
			SELECT 0
			FROM image_tests
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
	 * Determines whether a non-erased background exists.
	 * 
	 * It receives the background's ID.
	 */
	public function nonErasedBackgroundExists($id) {
		// Defines the statement
		$statement = '
			SELECT 0
			FROM non_erased_backgrounds
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
	 * Determines whether a non-erased clinical impression exists.
	 * 
	 * It receives the clinical impression's ID.
	 */
	public function nonErasedClinicalImpressionExists($id) {
		// Defines the statement
		$statement = '
			SELECT 0
			FROM non_erased_clinical_impressions
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
	 * Determines whether a non-erased consultation exists.
	 * 
	 * It receives the consultation's ID.
	 */
	public function nonErasedConsultationExists($id) {
		// Defines the statement
		$statement = '
			SELECT 0
			FROM non_erased_consultations
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
	 * Determines whether a non-erased file exists.
	 * 
	 * It receives the file's ID.
	 */
	public function nonErasedFileExists($id) {
		// Defines the statement
		$statement = '
			SELECT 0
			FROM non_erased_files
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
	 * Determines whether a non-erased image test exists.
	 * 
	 * It receives the image test's ID.
	 */
	public function nonErasedImageTestExists($id) {
		// Defines the statement
		$statement = '
			SELECT 0
			FROM non_erased_image_tests
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
	 * Determines whether a non-erased patient exists.
	 * 
	 * It receives the patient's ID.
	 */
	public function nonErasedPatientExists($id) {
		// Defines the statement
		$statement = '
			SELECT 0
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
		
		// Returns the result
		return count($results) === 1;
	}
	
	/*
	 * Determines whether a non-erased study exists.
	 * 
	 * It receives the study's ID.
	 */
	public function nonErasedStudyExists($id) {
		// Defines the statement
		$statement = '
			SELECT 0
			FROM non_erased_studies
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
	 * Determines whether a patient exists.
	 * 
	 * It receives the patient's ID.
	 */
	public function patientExists($id) {
		// Defines the statement
		$statement = '
			SELECT 0
			FROM patients
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
	 * Performs a search that includes all non-erased backgrounds and returns
	 * the results.
	 * 
	 * It receives an ORDER BY clause, the limit of rows to return and an
	 * offset.
	 */
	public function searchAllNonErasedBackgrounds($orderByClause, $limit, $offset) {
		// Defines the statement
		$statement = '
			SELECT SQL_CALC_FOUND_ROWS id AS id
			FROM non_erased_backgrounds
			ORDER BY ' . $orderByClause . '
			LIMIT :limit OFFSET :offset
		';
		
		// Sets the parameters
		$parameters = [
			':limit' => $limit,
			':offset' => $offset
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		return $results;
	}
	
	/*
	 * Performs a search that includes all non-erased clinical impressions and
	 * returns the results.
	 * 
	 * It receives an ORDER BY clause, the limit of rows to return and an
	 * offset.
	 */
	public function searchAllNonErasedClinicalImpressions($orderByClause, $limit, $offset) {
		// Defines the statement
		$statement = '
			SELECT SQL_CALC_FOUND_ROWS id AS id
			FROM non_erased_clinical_impressions
			ORDER BY ' . $orderByClause . '
			LIMIT :limit OFFSET :offset
		';
		
		// Sets the parameters
		$parameters = [
			':limit' => $limit,
			':offset' => $offset
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		return $results;
	}
	
	/*
	 * Performs a search that includes all non-erased experiments and returns
	 * the results.
	 * 
	 * It receives an ORDER BY clause, the limit of rows to return and an
	 * offset.
	 */
	public function searchAllNonErasedExperiments($orderByClause, $limit, $offset) {
		// Defines the statement
		$statement = '
			SELECT SQL_CALC_FOUND_ROWS id AS id
			FROM non_erased_experiments
			ORDER BY ' . $orderByClause . '
			LIMIT :limit OFFSET :offset
		';
		
		// Sets the parameters
		$parameters = [
			':limit' => $limit,
			':offset' => $offset
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		return $results;
	}
	
	/*
	 * Performs a search that includes all non-erased image tests and returns
	 * the results.
	 * 
	 * It receives an ORDER BY clause, the limit of rows to return and an
	 * offset.
	 */
	public function searchAllNonErasedImageTests($orderByClause, $limit, $offset) {
		// Defines the statement
		$statement = '
			SELECT SQL_CALC_FOUND_ROWS id AS id
			FROM non_erased_image_tests
			ORDER BY ' . $orderByClause . '
			LIMIT :limit OFFSET :offset
		';
		
		// Sets the parameters
		$parameters = [
			':limit' => $limit,
			':offset' => $offset
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		return $results;
	}
	
	/*
	 * Performs a search that includes all non-erased medications and returns
	 * the results.
	 * 
	 * It receives an ORDER BY clause, the limit of rows to return and an
	 * offset.
	 */
	public function searchAllNonErasedMedications($orderByClause, $limit, $offset) {
		// Defines the statement
		$statement = '
			SELECT SQL_CALC_FOUND_ROWS id AS id
			FROM non_erased_medications
			ORDER BY ' . $orderByClause . '
			LIMIT :limit OFFSET :offset
		';
		
		// Sets the parameters
		$parameters = [
			':limit' => $limit,
			':offset' => $offset
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		return $results;
	}
	
	/*
	 * Performs a search that includes all non-erased patients and returns the
	 * results.
	 * 
	 * It receives an ORDER BY clause, the limit of rows to return and an
	 * offset.
	 */
	public function searchAllNonErasedPatients($orderByClause, $limit, $offset) {
		// Defines the statement
		$statement = '
			SELECT SQL_CALC_FOUND_ROWS id AS id
			FROM non_erased_patients
			ORDER BY ' . $orderByClause . '
			LIMIT :limit OFFSET :offset
		';
		
		// Sets the parameters
		$parameters = [
			':limit' => $limit,
			':offset' => $offset
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		return $results;
	}
	
	/*
	 * Performs a search that includes specific non-erased backgrounds and
	 * returns the results.
	 * 
	 * It receives an expression, an ORDER BY clause, the limit of rows to
	 * return and an offset.
	 */
	public function searchSpecificNonErasedBackgrounds($expression, $orderByClause, $limit, $offset) {
		// Defines the statement
		$statement = '
			SELECT SQL_CALC_FOUND_ROWS id AS id
			FROM non_erased_backgrounds
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
	 * Performs a search that includes specific non-erased clinical impressions
	 * and returns the results.
	 * 
	 * It receives an expression, an ORDER BY clause, the limit of rows to
	 * return and an offset.
	 */
	public function searchSpecificNonErasedClinicalImpressions($expression, $orderByClause, $limit, $offset) {
		// Defines the statement
		$statement = '
			SELECT SQL_CALC_FOUND_ROWS id AS id
			FROM non_erased_clinical_impressions
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
	 * Performs a search that includes specific non-erased experiments and
	 * returns the results.
	 * 
	 * It receives an expression, an ORDER BY clause, the limit of rows to
	 * return and an offset.
	 */
	public function searchSpecificNonErasedExperiments($expression, $orderByClause, $limit, $offset) {
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
	 * Performs a search that includes specific non-erased image tests and
	 * returns the results.
	 * 
	 * It receives an expression, an ORDER BY clause, the limit of rows to
	 * return and an offset.
	 */
	public function searchSpecificNonErasedImageTests($expression, $orderByClause, $limit, $offset) {
		// Defines the statement
		$statement = '
			SELECT SQL_CALC_FOUND_ROWS id AS id
			FROM non_erased_image_tests
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
	 * Performs a search that includes specific non-erased medications and
	 * returns the results.
	 * 
	 * It receives an expression, an ORDER BY clause, the limit of rows to
	 * return and an offset.
	 */
	public function searchSpecificNonErasedMedications($expression, $orderByClause, $limit, $offset) {
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
	 * Performs a search that includes specific non-erased patients and returns
	 * the results.
	 * 
	 * It receives an expression, an ORDER BY clause, the limit of rows to
	 * return and an offset.
	 */
	public function searchSpecificNonErasedPatients($expression, $orderByClause, $limit, $offset) {
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
	 * Determines whether a study exists.
	 * 
	 * It receives the study's ID.
	 */
	public function studyExists($id) {
		// Defines the statement
		$statement = '
			SELECT 0
			FROM studies
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
		$businessLogicDatabase = $parameters['businessLogicDatabase'];
		$dsn = $businessLogicDatabase['dsn'];
		$username = $businessLogicDatabase['username'];
		$password = $businessLogicDatabase['password'];
		
		// Creates and returns the PDO instance
		return new \PDO($dsn, $username, $password);
	}
	
}
