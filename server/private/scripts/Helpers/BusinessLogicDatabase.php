<?php

/*
 * This helper represents the business logic database.
 */
class BusinessLogicDatabase extends Database {
	
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
	 * Selects and returns a consultation's neurocognitive evaluations that have
	 * not been erased.
	 * 
	 * It receives the consultation's ID.
	 */
	public function selectConsultationNonErasedNeurocognitiveEvaluations($consultationId) {
		// Defines the statement
		$statement = '
			SELECT
				neurocognitive_evaluation AS neurocognitiveEvaluation,
				value AS value
			FROM consultations_non_erased_neurocognitive_evaluations
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
	 * Selects and returns a neurocognitive evaluation. If it doesn't exist or
	 * has been erased, null is returned.
	 * 
	 * It receives the neurocognitive evaluation's ID.
	 */
	public function selectNonErasedNeurocognitiveEvaluation($neurocognitiveEvaluationId) {
		// Defines the statement
		$statement = '
			SELECT
				id AS id,
				is_erased AS isErased,
				creator AS creator,
				creation_datetime AS creationDatetime,
				name AS name,
				data_type_definition AS dataTypeDefinition
			FROM non_erased_neurocognitive_evaluations
			WHERE id = :neurocognitiveEvaluationId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':neurocognitiveEvaluationId' => $neurocognitiveEvaluationId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the first result, or null if there is none
		return getFirstElementOrNull($results);
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
	 * TODO: comments
	 */
	public function selectNonErasedPatientIdsByQuery($query) {
		// Defines the statement
		$statement = '
			SELECT id AS id
			FROM non_erased_patients
			WHERE MATCH(first_names, last_names) AGAINST(:query IN NATURAL LANGUAGE MODE WITH QUERY EXPANSION)
		';
		
		// Sets the parameters
		$parameters = [
			':query' => $query
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
