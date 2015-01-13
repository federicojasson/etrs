<?php

/*
 * This helper represents the business logic database.
 */
class BusinessLogicDatabase extends Database {
	
	/*
	 * Determines whether a background exists.
	 * 
	 * It receives the background's ID.
	 */
	public function backgroundExists($backgroundId) {
		// Defines the statement
		$statement = '
			SELECT 0
			FROM backgrounds
			WHERE id = :backgroundId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':backgroundId' => $backgroundId
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
	public function clinicalImpressionExists($clinicalImpressionId) {
		// Defines the statement
		$statement = '
			SELECT 0
			FROM clinical_impressions
			WHERE id = :clinicalImpressionId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':clinicalImpressionId' => $clinicalImpressionId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the result
		return count($results) === 1;
	}
	
	/*
	 * Determines whether a diagnosis exists.
	 * 
	 * It receives the diagnosis's ID.
	 */
	public function diagnosisExists($diagnosisId) {
		// Defines the statement
		$statement = '
			SELECT 0
			FROM diagnoses
			WHERE id = :diagnosisId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':diagnosisId' => $diagnosisId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the result
		return count($results) === 1;
	}
	
	/*
	 * Determines whether an experiment exists.
	 * 
	 * It receives the experiment's ID.
	 */
	public function experimentExists($experimentId) {
		// Defines the statement
		$statement = '
			SELECT 0
			FROM experiments
			WHERE id = :experimentId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':experimentId' => $experimentId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the result
		return count($results) === 1;
	}
	
	/*
	 * Determines whether an image test exists.
	 * 
	 * It receives the image test's ID.
	 */
	public function imageTestExists($imageTestId) {
		// Defines the statement
		$statement = '
			SELECT 0
			FROM image_tests
			WHERE id = :imageTestId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':imageTestId' => $imageTestId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the result
		return count($results) === 1;
	}
	
	/*
	 * Inserts a background.
	 * 
	 * It receives the values to insert.
	 */
	public function insertBackground($id, $creator, $name) {
		// Defines the statement
		$statement = '
			INSERT INTO backgrounds (
				id,
				is_erased,
				creator,
				creation_datetime,
				name
			)
			VALUES (
				:id,
				FALSE,
				:creator,
				UTC_TIMESTAMP(),
				:name
			)
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':creator' => $creator,
			':name' => $name
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Inserts a clinical impression.
	 * 
	 * It receives the values to insert.
	 */
	public function insertClinicalImpression($id, $creator, $name) {
		// Defines the statement
		$statement = '
			INSERT INTO clinical_impressions (
				id,
				is_erased,
				creator,
				creation_datetime,
				name
			)
			VALUES (
				:id,
				FALSE,
				:creator,
				UTC_TIMESTAMP(),
				:name
			)
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':creator' => $creator,
			':name' => $name
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Inserts a diagnosis.
	 * 
	 * It receives the values to insert.
	 */
	public function insertDiagnosis($id, $creator, $name) {
		// Defines the statement
		$statement = '
			INSERT INTO diagnoses (
				id,
				is_erased,
				creator,
				creation_datetime,
				name
			)
			VALUES (
				:id,
				FALSE,
				:creator,
				UTC_TIMESTAMP(),
				:name
			)
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':creator' => $creator,
			':name' => $name
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Inserts an experiment.
	 * 
	 * It receives the values to insert.
	 */
	public function insertExperiment($id, $creator, $name, $commandLine) {
		// Defines the statement
		$statement = '
			INSERT INTO experiments (
				id,
				is_erased,
				creator,
				creation_datetime,
				name,
				command_line
			)
			VALUES (
				:id,
				FALSE,
				:creator,
				UTC_TIMESTAMP(),
				:name,
				:commandLine
			)
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':creator' => $creator,
			':name' => $name,
			':commandLine' => $commandLine
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Inserts an image test.
	 * 
	 * It receives the values to insert.
	 */
	public function insertImageTest($id, $creator, $name, $dataTypeDefinition) {
		// Defines the statement
		$statement = '
			INSERT INTO image_tests (
				id,
				is_erased,
				creator,
				creation_datetime,
				name,
				data_type_definition
			)
			VALUES (
				:id,
				FALSE,
				:creator,
				UTC_TIMESTAMP(),
				:name,
				:dataTypeDefinition
			)
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':creator' => $creator,
			':name' => $name,
			':dataTypeDefinition' => $dataTypeDefinition
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Inserts a laboratory test.
	 * 
	 * It receives the values to insert.
	 */
	public function insertLaboratoryTest($id, $creator, $name, $dataTypeDefinition) {
		// Defines the statement
		$statement = '
			INSERT INTO laboratory_tests (
				id,
				is_erased,
				creator,
				creation_datetime,
				name,
				data_type_definition
			)
			VALUES (
				:id,
				FALSE,
				:creator,
				UTC_TIMESTAMP(),
				:name,
				:dataTypeDefinition
			)
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':creator' => $creator,
			':name' => $name,
			':dataTypeDefinition' => $dataTypeDefinition
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Inserts a medication.
	 * 
	 * It receives the values to insert.
	 */
	public function insertMedication($id, $creator, $name) {
		// Defines the statement
		$statement = '
			INSERT INTO medications (
				id,
				is_erased,
				creator,
				creation_datetime,
				name
			)
			VALUES (
				:id,
				FALSE,
				:creator,
				UTC_TIMESTAMP(),
				:name
			)
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':creator' => $creator,
			':name' => $name
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Inserts a neurocognitive test.
	 * 
	 * It receives the values to insert.
	 */
	public function insertNeurocognitiveTest($id, $creator, $name, $dataTypeDefinition) {
		// Defines the statement
		$statement = '
			INSERT INTO neurocognitive_tests (
				id,
				is_erased,
				creator,
				creation_datetime,
				name,
				data_type_definition
			)
			VALUES (
				:id,
				FALSE,
				:creator,
				UTC_TIMESTAMP(),
				:name,
				:dataTypeDefinition
			)
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':creator' => $creator,
			':name' => $name,
			':dataTypeDefinition' => $dataTypeDefinition
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Inserts a patient.
	 * 
	 * It receives the values to insert.
	 */
	public function insertPatient($id, $creator, $firstNames, $lastNames, $gender, $birthDate, $educationYears) {
		// Defines the statement
		$statement = '
			INSERT INTO patients (
				id,
				is_erased,
				creator,
				creation_datetime,
				first_names,
				last_names,
				gender,
				birth_date,
				education_years
			)
			VALUES (
				:id,
				FALSE,
				:creator,
				UTC_TIMESTAMP(),
				:firstNames,
				:lastNames,
				:gender,
				:birthDate,
				:educationYears
			)
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':creator' => $creator,
			':firstNames' => $firstNames,
			':lastNames' => $lastNames,
			':gender' => $gender,
			':birthDate' => $birthDate,
			':educationYears' => $educationYears
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Inserts a treatment.
	 * 
	 * It receives the values to insert.
	 */
	public function insertTreatment($id, $creator, $name) {
		// Defines the statement
		$statement = '
			INSERT INTO treatments (
				id,
				is_erased,
				creator,
				creation_datetime,
				name
			)
			VALUES (
				:id,
				FALSE,
				:creator,
				UTC_TIMESTAMP(),
				:name
			)
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':creator' => $creator,
			':name' => $name
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Determines whether a laboratory test exists.
	 * 
	 * It receives the laboratory test's ID.
	 */
	public function laboratoryTestExists($laboratoryTestId) {
		// Defines the statement
		$statement = '
			SELECT 0
			FROM laboratory_tests
			WHERE id = :laboratoryTestId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':laboratoryTestId' => $laboratoryTestId
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
	public function medicationExists($medicationId) {
		// Defines the statement
		$statement = '
			SELECT 0
			FROM medications
			WHERE id = :medicationId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':medicationId' => $medicationId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the result
		return count($results) === 1;
	}
	
	/*
	 * Determines whether a neurocognitive test exists.
	 * 
	 * It receives the neurocognitive test's ID.
	 */
	public function neurocognitiveTestExists($neurocognitiveTestId) {
		// Defines the statement
		$statement = '
			SELECT 0
			FROM neurocognitive_tests
			WHERE id = :neurocognitiveTestId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':neurocognitiveTestId' => $neurocognitiveTestId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the result
		return count($results) === 1;
	}
	
	/*
	 * Determines whether a clinical impression exists and has not been erased.
	 * 
	 * It receives the clinical impression's ID.
	 */
	public function nonErasedClinicalImpressionExists($clinicalImpressionId) {
		// Defines the statement
		$statement = '
			SELECT 0
			FROM non_erased_clinical_impressions
			WHERE id = :clinicalImpressionId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':clinicalImpressionId' => $clinicalImpressionId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the result
		return count($results) === 1;
	}
	
	/*
	 * Determines whether a consultation exists and has not been erased.
	 * 
	 * It receives the consultation's ID.
	 */
	public function nonErasedConsultationExists($consultationId) {
		// Defines the statement
		$statement = '
			SELECT 0
			FROM non_erased_consultations
			WHERE id = :consultationId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':consultationId' => $consultationId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the result
		return count($results) === 1;
	}
	
	/*
	 * Determines whether a diagnosis exists and has not been erased.
	 * 
	 * It receives the diagnosis's ID.
	 */
	public function nonErasedDiagnosisExists($diagnosisId) {
		// Defines the statement
		$statement = '
			SELECT 0
			FROM non_erased_diagnoses
			WHERE id = :diagnosisId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':diagnosisId' => $diagnosisId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the result
		return count($results) === 1;
	}
	
	/*
	 * Determines whether an experiment exists and has not been erased.
	 * 
	 * It receives the experiment's ID.
	 */
	public function nonErasedExperimentExists($experimentId) {
		// Defines the statement
		$statement = '
			SELECT 0
			FROM non_erased_experiments
			WHERE id = :experimentId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':experimentId' => $experimentId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the result
		return count($results) === 1;
	}
	
	/*
	 * Determines whether a file exists and has not been erased.
	 * 
	 * It receives the file's ID.
	 */
	public function nonErasedFileExists($fileId) {
		// Defines the statement
		$statement = '
			SELECT 0
			FROM non_erased_files
			WHERE id = :fileId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':fileId' => $fileId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the result
		return count($results) === 1;
	}
	
	/*
	 * Determines whether a patient exists and has not been erased.
	 * 
	 * It receives the patient's ID.
	 */
	public function nonErasedPatientExists($patientId) {
		// Defines the statement
		$statement = '
			SELECT 0
			FROM non_erased_patients
			WHERE id = :patientId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':patientId' => $patientId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the result
		return count($results) === 1;
	}
	
	/*
	 * Determines whether a user exists and has not been erased.
	 * 
	 * It receives the user's ID.
	 */
	public function nonErasedUserExists($userId) {
		// Defines the statement
		$statement = '
			SELECT 0
			FROM non_erased_users
			WHERE id = :userId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':userId' => $userId
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
	public function patientExists($patientId) {
		// Defines the statement
		$statement = '
			SELECT 0
			FROM patients
			WHERE id = :patientId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':patientId' => $patientId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the result
		return count($results) === 1;
	}
	
	/*
	 * Selects and returns a consultation's backgrounds that have not been
	 * erased.
	 * 
	 * It receives the consultation's ID.
	 */
	public function selectConsultationNonErasedBackgrounds($consultationId) {
		// Defines the statement
		$statement = '
			SELECT background AS background
			FROM consultations_non_erased_backgrounds
			WHERE consultation = :consultationId
		';
		
		// Sets the parameters
		$parameters = [
			':consultationId' => $consultationId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		return $results;
	}
	
	/*
	 * Selects and returns a consultation's image tests that have not been
	 * erased.
	 * 
	 * It receives the consultation's ID.
	 */
	public function selectConsultationNonErasedImageTests($consultationId) {
		// Defines the statement
		$statement = '
			SELECT
				image_test AS imageTest,
				value AS value
			FROM consultations_non_erased_image_tests
			WHERE consultation = :consultationId
		';
		
		// Sets the parameters
		$parameters = [
			':consultationId' => $consultationId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		return $results;
	}
	
	/*
	 * Selects and returns a consultation's laboratory tests that have not been
	 * erased.
	 * 
	 * It receives the consultation's ID.
	 */
	public function selectConsultationNonErasedLaboratoryTests($consultationId) {
		// Defines the statement
		$statement = '
			SELECT
				laboratory_test AS laboratoryTest,
				value AS value
			FROM consultations_non_erased_laboratory_tests
			WHERE consultation = :consultationId
		';
		
		// Sets the parameters
		$parameters = [
			':consultationId' => $consultationId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		return $results;
	}
	
	/*
	 * Selects and returns a consultation's medications that have not been
	 * erased.
	 * 
	 * It receives the consultation's ID.
	 */
	public function selectConsultationNonErasedMedications($consultationId) {
		// Defines the statement
		$statement = '
			SELECT medication AS medication
			FROM consultations_non_erased_medications
			WHERE consultation = :consultationId
		';
		
		// Sets the parameters
		$parameters = [
			':consultationId' => $consultationId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		return $results;
	}
	
	/*
	 * Selects and returns a consultation's neurocognitive tests that have not
	 * been erased.
	 * 
	 * It receives the consultation's ID.
	 */
	public function selectConsultationNonErasedNeurocognitiveTests($consultationId) {
		// Defines the statement
		$statement = '
			SELECT
				neurocognitive_test AS neurocognitiveTest,
				value AS value
			FROM consultations_non_erased_neurocognitive_tests
			WHERE consultation = :consultationId
		';
		
		// Sets the parameters
		$parameters = [
			':consultationId' => $consultationId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		return $results;
	}
	
	/*
	 * Selects and returns a consultation's treatments that have not been
	 * erased.
	 * 
	 * It receives the consultation's ID.
	 */
	public function selectConsultationNonErasedTreatments($consultationId) {
		// Defines the statement
		$statement = '
			SELECT treatment AS treatment
			FROM consultations_non_erased_treatments
			WHERE consultation = :consultationId
		';
		
		// Sets the parameters
		$parameters = [
			':consultationId' => $consultationId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		return $results;
	}
	
	/*
	 * Selects and returns an experiment's files that have not been erased.
	 * 
	 * It receives the experiment's ID.
	 */
	public function selectExperimentNonErasedFiles($experimentId) {
		// Defines the statement
		$statement = '
			SELECT file AS file
			FROM experiments_non_erased_files
			WHERE experiment = :experimentId
		';
		
		// Sets the parameters
		$parameters = [
			':experimentId' => $experimentId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		return $results;
	}
	
	/*
	 * Selects and returns a background. If it doesn't exist or has been erased,
	 * null is returned.
	 * 
	 * It receives the background's ID.
	 */
	public function selectNonErasedBackground($backgroundId) {
		// Defines the statement
		$statement = '
			SELECT
				id AS id,
				is_erased AS isErased,
				creator AS creator,
				creation_datetime AS creationDatetime,
				name AS name
			FROM non_erased_backgrounds
			WHERE id = :backgroundId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':backgroundId' => $backgroundId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the first result, or null if there is none
		return getFirstElementOrNull($results);
	}
	
	/*
	 * Selects and returns the backgrounds that have not been erased.
	 */
	public function selectNonErasedBackgrounds() {
		// Defines the statement
		$statement = '
			SELECT
				id AS id,
				is_erased AS isErased,
				creator AS creator,
				creation_datetime AS creationDatetime,
				name AS name
			FROM non_erased_backgrounds
		';
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement);
		
		return $results;
	}
	
	/*
	 * Selects and returns a clinical impression. If it doesn't exist or has
	 * been erased, null is returned.
	 * 
	 * It receives the clinical impression's ID.
	 */
	public function selectNonErasedClinicalImpression($clinicalImpressionId) {
		// Defines the statement
		$statement = '
			SELECT
				id AS id,
				is_erased AS isErased,
				creator AS creator,
				creation_datetime AS creationDatetime,
				name AS name
			FROM non_erased_clinical_impressions
			WHERE id = :clinicalImpressionId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':clinicalImpressionId' => $clinicalImpressionId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the first result, or null if there is none
		return getFirstElementOrNull($results);
	}
	
	/*
	 * Selects and returns the clinical impressions that have not been erased.
	 */
	public function selectNonErasedClinicalImpressions() {
		// Defines the statement
		$statement = '
			SELECT
				id AS id,
				is_erased AS isErased,
				creator AS creator,
				creation_datetime AS creationDatetime,
				name AS name
			FROM non_erased_clinical_impressions
		';
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement);
		
		return $results;
	}
	
	/*
	 * Selects and returns a consultation. If it doesn't exist or has been
	 * erased, null is returned.
	 * 
	 * It receives the consultation's ID.
	 */
	public function selectNonErasedConsultation($consultationId) {
		// Defines the statement
		$statement = '
			SELECT
				id AS id,
				is_erased AS isErased,
				clinical_impression AS clinicalImpression,
				creator AS creator,
				diagnosis AS diagnosis,
				patient AS patient,
				creation_datetime AS creationDatetime,
				date AS date,
				reasons AS reasons,
				observations AS observations,
				indications AS indications
			FROM non_erased_consultations
			WHERE id = :consultationId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':consultationId' => $consultationId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the first result, or null if there is none
		return getFirstElementOrNull($results);
	}
	
	/*
	 * Selects and returns the diagnoses that have not been erased.
	 */
	public function selectNonErasedDiagnoses() {
		// Defines the statement
		$statement = '
			SELECT
				id AS id,
				is_erased AS isErased,
				creator AS creator,
				creation_datetime AS creationDatetime,
				name AS name
			FROM non_erased_diagnoses
		';
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement);
		
		return $results;
	}
	
	/*
	 * Selects and returns a diagnosis. If it doesn't exist or has been erased,
	 * null is returned.
	 * 
	 * It receives the diagnosis's ID.
	 */
	public function selectNonErasedDiagnosis($diagnosisId) {
		// Defines the statement
		$statement = '
			SELECT
				id AS id,
				is_erased AS isErased,
				creator AS creator,
				creation_datetime AS creationDatetime,
				name AS name
			FROM non_erased_diagnoses
			WHERE id = :diagnosisId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':diagnosisId' => $diagnosisId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the first result, or null if there is none
		return getFirstElementOrNull($results);
	}
	
	/*
	 * Selects and returns an experiment. If it doesn't exist or has been
	 * erased, null is returned.
	 * 
	 * It receives the experiment's ID.
	 */
	public function selectNonErasedExperiment($experimentId) {
		// Defines the statement
		$statement = '
			SELECT
				id AS id,
				is_erased AS isErased,
				creator AS creator,
				creation_datetime AS creationDatetime,
				name AS name,
				command_line AS commandLine
			FROM non_erased_experiments
			WHERE id = :experimentId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':experimentId' => $experimentId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the first result, or null if there is none
		return getFirstElementOrNull($results);
	}
	
	/*
	 * Selects and returns the experiments that have not been erased.
	 */
	public function selectNonErasedExperiments() {
		// Defines the statement
		$statement = '
			SELECT
				id AS id,
				is_erased AS isErased,
				creator AS creator,
				creation_datetime AS creationDatetime,
				name AS name,
				command_line AS commandLine
			FROM non_erased_experiments
		';
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement);
		
		return $results;
	}
	
	/*
	 * Selects and returns a file. If it doesn't exist or has been erased, null
	 * is returned.
	 * 
	 * It receives the file's ID.
	 */
	public function selectNonErasedFile($fileId) {
		// Defines the statement
		$statement = '
			SELECT
				id AS id,
				is_erased AS isErased,
				creator AS creator,
				creation_datetime AS creationDatetime,
				name AS name,
				hash AS hash
			FROM non_erased_files
			WHERE id = :fileId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':fileId' => $fileId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the first result, or null if there is none
		return getFirstElementOrNull($results);
	}
	
	/*
	 * Selects and returns an image test. If it doesn't exist or has been
	 * erased, null is returned.
	 * 
	 * It receives the image test's ID.
	 */
	public function selectNonErasedImageTest($imageTestId) {
		// Defines the statement
		$statement = '
			SELECT
				id AS id,
				is_erased AS isErased,
				creator AS creator,
				creation_datetime AS creationDatetime,
				name AS name,
				data_type_definition AS dataTypeDefinition
			FROM non_erased_image_tests
			WHERE id = :imageTestId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':imageTestId' => $imageTestId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the first result, or null if there is none
		return getFirstElementOrNull($results);
	}
	
	/*
	 * Selects and returns the image tests that have not been erased.
	 */
	public function selectNonErasedImageTests() {
		// Defines the statement
		$statement = '
			SELECT
				id AS id,
				is_erased AS isErased,
				creator AS creator,
				creation_datetime AS creationDatetime,
				name AS name,
				data_type_definition AS dataTypeDefinition
			FROM non_erased_image_tests
		';
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement);
		
		return $results;
	}
	
	/*
	 * Selects and returns a laboratory test. If it doesn't exist or has been
	 * erased, null is returned.
	 * 
	 * It receives the laboratory test's ID.
	 */
	public function selectNonErasedLaboratoryTest($laboratoryTestId) {
		// Defines the statement
		$statement = '
			SELECT
				id AS id,
				is_erased AS isErased,
				creator AS creator,
				creation_datetime AS creationDatetime,
				name AS name,
				data_type_definition AS dataTypeDefinition
			FROM non_erased_laboratory_tests
			WHERE id = :laboratoryTestId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':laboratoryTestId' => $laboratoryTestId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the first result, or null if there is none
		return getFirstElementOrNull($results);
	}
	
	/*
	 * Selects and returns the laboratory tests that have not been erased.
	 */
	public function selectNonErasedLaboratoryTests() {
		// Defines the statement
		$statement = '
			SELECT
				id AS id,
				is_erased AS isErased,
				creator AS creator,
				creation_datetime AS creationDatetime,
				name AS name,
				data_type_definition AS dataTypeDefinition
			FROM non_erased_laboratory_tests
		';
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement);
		
		return $results;
	}
	
	/*
	 * Selects and returns a medication. If it doesn't exist or has been erased,
	 * null is returned.
	 * 
	 * It receives the medication's ID.
	 */
	public function selectNonErasedMedication($medicationId) {
		// Defines the statement
		$statement = '
			SELECT
				id AS id,
				is_erased AS isErased,
				creator AS creator,
				creation_datetime AS creationDatetime,
				name AS name
			FROM non_erased_medications
			WHERE id = :medicationId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':medicationId' => $medicationId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the first result, or null if there is none
		return getFirstElementOrNull($results);
	}
	
	/*
	 * Selects and returns the medications that have not been erased.
	 */
	public function selectNonErasedMedications() {
		// Defines the statement
		$statement = '
			SELECT
				id AS id,
				is_erased AS isErased,
				creator AS creator,
				creation_datetime AS creationDatetime,
				name AS name
			FROM non_erased_medications
		';
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement);
		
		return $results;
	}
	
	/*
	 * Selects and returns a neurocognitive test. If it doesn't exist or has
	 * been erased, null is returned.
	 * 
	 * It receives the neurocognitive test's ID.
	 */
	public function selectNonErasedNeurocognitiveTest($neurocognitiveTestId) {
		// Defines the statement
		$statement = '
			SELECT
				id AS id,
				is_erased AS isErased,
				creator AS creator,
				creation_datetime AS creationDatetime,
				name AS name,
				data_type_definition AS dataTypeDefinition
			FROM non_erased_neurocognitive_tests
			WHERE id = :neurocognitiveTestId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':neurocognitiveTestId' => $neurocognitiveTestId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the first result, or null if there is none
		return getFirstElementOrNull($results);
	}
	
	/*
	 * Selects and returns the neurocognitive tests that have not been erased.
	 */
	public function selectNonErasedNeurocognitiveTests() {
		// Defines the statement
		$statement = '
			SELECT
				id AS id,
				is_erased AS isErased,
				creator AS creator,
				creation_datetime AS creationDatetime,
				name AS name,
				data_type_definition AS dataTypeDefinition
			FROM non_erased_neurocognitive_tests
		';
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement);
		
		return $results;
	}
	
	/*
	 * Selects and returns a patient. If it doesn't exist or has been erased,
	 * null is returned.
	 * 
	 * It receives the patient's ID.
	 */
	public function selectNonErasedPatient($patientId) {
		// Defines the statement
		$statement = '
			SELECT
				id AS id,
				is_erased AS isErased,
				creator AS creator,
				creation_datetime AS creationDatetime,
				first_names AS firstNames,
				last_names AS lastNames,
				gender AS gender,
				birth_date AS birthDate,
				education_years AS educationYears
			FROM non_erased_patients
			WHERE id = :patientId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':patientId' => $patientId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the first result, or null if there is none
		return getFirstElementOrNull($results);
	}
	
	/*
	 * Selects and returns non-erased patients obtained by performing a
	 * full-text search.
	 * 
	 * It receives TODO: comments
	 */
	public function selectNonErasedPatientsByFullTextSearch($searchExpression, $limit, $offset) {
		// Defines the statement
		$statement = '
			SELECT SQL_CALC_FOUND_ROWS
				id AS id,
				is_erased AS isErased,
				creator AS creator,
				creation_datetime AS creationDatetime,
				first_names AS firstNames,
				last_names AS lastNames,
				gender AS gender,
				birth_date AS birthDate,
				education_years AS educationYears
			FROM non_erased_patients
			WHERE
				MATCH(first_names, last_names)
				AGAINST(:searchExpression IN BOOLEAN MODE)
			LIMIT :limit
			OFFSET :offset
		';
		
		// Sets the parameters
		$parameters = [
			':searchExpression' => $searchExpression,
			':limit' => $limit,
			':offset' => $offset
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		return $results;
	}
	
	/*
	 * Selects and returns a study. If it doesn't exist or has been erased, null
	 * is returned.
	 * 
	 * It receives the study's ID.
	 */
	public function selectNonErasedStudy($studyId) {
		// Defines the statement
		$statement = '
			SELECT
				id AS id,
				is_erased AS isErased,
				consultation AS consultation,
				creator AS creator,
				experiment AS experiment,
				report AS report,
				creation_datetime AS creationDatetime,
				observations AS observations
			FROM non_erased_studies
			WHERE id = :studyId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':studyId' => $studyId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the first result, or null if there is none
		return getFirstElementOrNull($results);
	}
	
	/*
	 * Selects and returns a treatment. If it doesn't exist or has been erased,
	 * null is returned.
	 * 
	 * It receives the treatment's ID.
	 */
	public function selectNonErasedTreatment($treatmentId) {
		// Defines the statement
		$statement = '
			SELECT
				id AS id,
				is_erased AS isErased,
				creator AS creator,
				creation_datetime AS creationDatetime,
				name AS name
			FROM non_erased_treatments
			WHERE id = :treatmentId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':treatmentId' => $treatmentId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the first result, or null if there is none
		return getFirstElementOrNull($results);
	}
	
	/*
	 * Selects and returns the treatments that have not been erased.
	 */
	public function selectNonErasedTreatments() {
		// Defines the statement
		$statement = '
			SELECT
				id AS id,
				is_erased AS isErased,
				creator AS creator,
				creation_datetime AS creationDatetime,
				name AS name
			FROM non_erased_treatments
		';
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement);
		
		return $results;
	}
	
	/*
	 * Selects and returns a user. If it doesn't exist or has been erased, null
	 * is returned.
	 * 
	 * It receives the user's ID.
	 */
	public function selectNonErasedUser($userId) {
		// Defines the statement
		$statement = '
			SELECT
				id AS id,
				is_erased AS isErased,
				creation_datetime AS creationDatetime,
				first_names AS firstNames,
				last_names AS lastNames,
				gender AS gender,
				email_address AS emailAddress,
				role AS role,
				password_hash AS passwordHash,
				password_salt AS passwordSalt,
				password_iterations AS passwordIterations
			FROM non_erased_users
			WHERE id = :userId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':userId' => $userId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the first result, or null if there is none
		return getFirstElementOrNull($results);
	}
	
	/*
	 * Selects and returns a study's files that have not been erased.
	 * 
	 * It receives the study's ID.
	 */
	public function selectStudyNonErasedFiles($studyId) {
		// Defines the statement
		$statement = '
			SELECT file AS file
			FROM studies_non_erased_files
			WHERE study = :studyId
		';
		
		// Sets the parameters
		$parameters = [
			':studyId' => $studyId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		return $results;
	}
	
	/*
	 * Determines whether a treatment exists.
	 * 
	 * It receives the treatment's ID.
	 */
	public function treatmentExists($treatmentId) {
		// Defines the statement
		$statement = '
			SELECT 0
			FROM treatments
			WHERE id = :treatmentId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':treatmentId' => $treatmentId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the result
		return count($results) === 1;
	}
	
	/*
	 * Connects to the database.
	 * 
	 * It returns the PDO instance representing the connection.
	 */
	protected function connect() {
		// Gets the database configuration
		$configuration = $this->app->configurations->get('businessLogicDatabase');
		$dsn = $configuration['dsn'];
		$username = $configuration['username'];
		$password = $configuration['password'];
		
		// Creates and returns a PDO instance
		return new PDO($dsn, $username, $password);
	}
	
}
