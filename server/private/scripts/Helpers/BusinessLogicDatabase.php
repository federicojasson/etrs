<?php

/*
 * This helper represents the business logic database.
 */
class BusinessLogicDatabase extends Database {
	
	// TODO: change queries
	
	/*
	 * TODO: comments
	 */
	public function selectConsultationImageAnalysis($consultationId) {
		// Defines the statement
		$statement = '
			SELECT
				doppler_normal_neck_vessels,
				nmr_decreased_cerebral_cortex,
				nmr_decreased_hippocampal_volume,
				nmr_frontotemporal_pattern,
				nmr_vascular_pattern
			FROM consultations_image_analysis
			WHERE consultation = :consultationId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':consultationId' => $consultationId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the first result, or null if there is none
		return $this->getFirstResultOrNull($results);
	}
	
	/*
	 * TODO: comments
	 */
	public function selectConsultationLaboratoryResults($consultationId) {
		// Defines the statement
		$statement = '
			SELECT
				apo_e4,
				calcium,
				folic_acid,
				phosphorus,
				thyroids,
				total_cholesterol,
				triglycerides,
				vdrl,
				vitamin_b
			FROM consultations_laboratory_results
			WHERE consultation = :consultationId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':consultationId' => $consultationId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the first result, or null if there is none
		return $this->getFirstResultOrNull($results);
	}
	
	/*
	 * TODO: comments
	 */
	public function selectConsultationMainData($consultationId) {
		// Defines the statement
		$statement = '
			SELECT
				date,
				clinical_impression,
				diagnosis,
				indications,
				observations,
				reasons
			FROM consultations_main_data
			WHERE consultation = :consultationId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':consultationId' => $consultationId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the first result, or null if there is none
		return $this->getFirstResultOrNull($results);
	}
	
	/*
	 * TODO: comments
	 */
	public function selectConsultationMetadata($consultationId) {
		// Defines the statement
		$statement = '
			SELECT
				creator,
				patient,
				erased,
				creation_datetime
			FROM consultations_metadata
			WHERE consultation = :consultationId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':consultationId' => $consultationId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the first result, or null if there is none
		return $this->getFirstResultOrNull($results);
	}
	
	/*
	 * TODO: comments
	 */
	public function selectConsultationNeurocognitiveAssessment($consultationId) {
		// Defines the statement
		$statement = '
			SELECT
				TODO: define fields
			FROM consultations_neurocognitive_assessment
			WHERE consultation = :consultationId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':consultationId' => $consultationId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the first result, or null if there is none
		return $this->getFirstResultOrNull($results);
	}
	
	/*
	 * TODO: comments
	 */
	public function selectConsultationPatientBackground($consultationId) {
		// Defines the statement
		$statement = '
			SELECT
				TODO: check fields
			FROM consultations_patient_background
			WHERE consultation = :consultationId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':consultationId' => $consultationId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the first result, or null if there is none
		return $this->getFirstResultOrNull($results);
	}
	
	/*
	 * TODO: comments
	 */
	public function selectConsultationPatientMedications($consultationId) {
		// Defines the statement
		$statement = '
			SELECT
				antidepressants,
				antidiabetics,
				antihypertensives,
				antiplatelets_anticoagulants,
				antipsychotics,
				benzodiazepines,
				hypolipidemics,
				levothyroxine,
				melatonin
			FROM consultations_patient_medications
			WHERE consultation = :consultationId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':consultationId' => $consultationId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the first result, or null if there is none
		return $this->getFirstResultOrNull($results);
	}
	
	/*
	 * TODO: comments
	 */
	public function selectConsultationTreatments($consultationId) {
		// Defines the statement
		$statement = '
			SELECT
				TODO: check fields
			FROM consultations_treatments
			WHERE consultation = :consultationId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':consultationId' => $consultationId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the first result, or null if there is none
		return $this->getFirstResultOrNull($results);
	}
	
	/*
	 * TODO: comments
	 */
	public function selectExperimentFiles($experimentId) {
		// Defines the statement
		$statement = '
			SELECT file
			FROM experiments_files
			WHERE experiment = :experimentId
		';
		
		// Sets the parameters
		$parameters = [
			':experimentId' => $experimentId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the results
		return $results;
	}
	
	/*
	 * TODO: comments
	 */
	public function selectExperimentMainData($experimentId) {
		// Defines the statement
		$statement = '
			SELECT
				name,
				command_line
			FROM experiments_main_data
			WHERE experiment = :experimentId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':experimentId' => $experimentId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the first result, or null if there is none
		return $this->getFirstResultOrNull($results);
	}
	
	/*
	 * TODO: comments
	 */
	public function selectExperimentMetadata($experimentId) {
		// Defines the statement
		$statement = '
			SELECT
				creator,
				erased,
				creation_datetime
			FROM experiments_metadata
			WHERE experiment = :experimentId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':experimentId' => $experimentId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the first result, or null if there is none
		return $this->getFirstResultOrNull($results);
	}
	
	/*
	 * TODO: comments
	 */
	public function selectFileMainData($fileId) {
		// Defines the statement
		$statement = '
			SELECT
				hash,
				name
			FROM files_main_data
			WHERE file = :fileId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':fileId' => $fileId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the first result, or null if there is none
		return $this->getFirstResultOrNull($results);
	}
	
	/*
	 * TODO: comments
	 */
	public function selectFileMetadata($fileId) {
		// Defines the statement
		$statement = '
			SELECT
				creator,
				erased,
				creation_datetime
			FROM files_metadata
			WHERE file = :fileId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':fileId' => $fileId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the first result, or null if there is none
		return $this->getFirstResultOrNull($results);
	}
	
	/*
	 * TODO: comments
	 */
	public function selectPatientMainData($patientId) {
		// Defines the statement
		$statement = '
			SELECT
				first_name,
				last_name,
				gender,
				birth_date,
				education_years
			FROM patients_main_data
			WHERE patient = :patientId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':patientId' => $patientId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the first result, or null if there is none
		return $this->getFirstResultOrNull($results);
	}
	
	/*
	 * TODO: comments
	 */
	public function selectPatientMetadata($patientId) {
		// Defines the statement
		$statement = '
			SELECT
				creator,
				erased,
				creation_datetime
			FROM patients_metadata
			WHERE patient = :patientId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':patientId' => $patientId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the first result, or null if there is none
		return $this->getFirstResultOrNull($results);
	}
	
	/*
	 * TODO: comments
	 */
	public function selectStudyFiles($studyId) {
		// Defines the statement
		$statement = '
			SELECT file
			FROM studies_files
			WHERE study = :studyId
		';
		
		// Sets the parameters
		$parameters = [
			':studyId' => $studyId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the results
		return $results;
	}
	
	/*
	 * TODO: comments
	 */
	public function selectStudyMainData($studyId) {
		// Defines the statement
		$statement = '
			SELECT observations
			FROM studies_main_data
			WHERE study = :studyId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':studyId' => $studyId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the first result, or null if there is none
		return $this->getFirstResultOrNull($results);
	}
	
	/*
	 * TODO: comments
	 */
	public function selectStudyMetadata($studyId) {
		// Defines the statement
		$statement = '
			SELECT
				consultation,
				creator,
				experiment,
				report,
				erased,
				creation_datetime
			FROM studies_metadata
			WHERE study = :studyId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':studyId' => $studyId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the first result, or null if there is none
		return $this->getFirstResultOrNull($results);
	}
	
	/*
	 * TODO: comments
	 */
	public function selectUserAuthenticationData($userId) {
		// Defines the statement
		$statement = '
			SELECT
				password_hash,
				password_salt
			FROM users_authentication_data
			WHERE user = :userId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':userId' => $userId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the first result, or null if there is none
		return $this->getFirstResultOrNull($results);
	}
	
	/*
	 * TODO: comments
	 */
	public function selectUserMainData($userId) {
		// Defines the statement
		$statement = '
			SELECT
				first_name,
				last_name,
				gender,
				email_address,
				role
			FROM users_main_data
			WHERE user = :userId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':userId' => $userId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the first result, or null if there is none
		return $this->getFirstResultOrNull($results);
	}
	
	/*
	 * TODO: comments
	 */
	public function selectUserMetadata($userId) {
		// Defines the statement
		$statement = '
			SELECT
				erased,
				creation_datetime
			FROM users_metadata
			WHERE user = :userId
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':userId' => $userId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the first result, or null if there is none
		return $this->getFirstResultOrNull($results);
	}
	
	/*
	 * TODO: comments
	 */
	public function updateUserAuthenticationData($userId, $userPasswordHash, $userPasswordSalt) {
		// TODO: implement
	}
	
	/*
	 * Connects to the database.
	 * 
	 * It returns the PDO instance representing the connection.
	 */
	protected function connect() {
		// Gets the configuration of the database
		$configuration = &$this->app->configurations->get('businessLogicDatabase');
		$dsn = $configuration['dsn'];
		$username = $configuration['username'];
		$password = $configuration['password'];
		
		// Creates and returns a PDO instance
		return new PDO($dsn, $username, $password);
	}
	
}
