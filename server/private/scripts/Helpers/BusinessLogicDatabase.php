<?php

/*
 * This helper represents the business logic database.
 * 
 * TODO: deep code cleaning
 */
class BusinessLogicDatabase extends Database {
	
	/*
	 * TODO: comments
	 */
	public function consultationExists($consultationId) {
		// Defines the statement
		$statement = '
			SELECT EXISTS (
				SELECT *
				FROM consultations
				WHERE
					NOT erased
					AND
					id = :consultationId
			)
		';
		
		// Sets the parameters
		$parameters = [
			':consultationId' => $consultationId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the result
		return $results[0];
	}
	
	/*
	 * TODO: comments
	 */
	public function experimentExists($experimentId) {
		// Defines the statement
		$statement = '
			SELECT EXISTS (
				SELECT *
				FROM consultations
				WHERE
					NOT erased
					AND
					id = :experimentId
			)
		';
		
		// Sets the parameters
		$parameters = [
			':experimentId' => $experimentId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the result
		return $results[0];
	}
	
	/*
	 * TODO: comments
	 */
	public function fileExists($fileId) {
		// Defines the statement
		$statement = '
			SELECT EXISTS (
				SELECT *
				FROM consultations
				WHERE
					NOT erased
					AND
					id = :fileId
			)
		';
		
		// Sets the parameters
		$parameters = [
			':fileId' => $fileId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the result
		return $results[0];
	}
	
	/*
	 * TODO: comments
	 */
	public function patientExists($patientId) {
		// Defines the statement
		$statement = '
			SELECT EXISTS (
				SELECT *
				FROM consultations
				WHERE
					NOT erased
					AND
					id = :patientId
			)
		';
		
		// Sets the parameters
		$parameters = [
			':patientId' => $patientId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the result
		return $results[0];
	}
	
	/*
	 * TODO: comments
	 */
	public function selectConsultationImageAnalysis($consultationId) {
		// Defines the statement
		$statement = '
			SELECT
				doppler_normal_neck_vessels AS dopplerNormalNeckVessels,
				nmr_decreased_cerebral_cortex AS nmrDecreasedCerebralCortex,
				nmr_decreased_hippocampal_volume AS nmrDecreasedHippocampalVolume,
				nmr_frontotemporal_pattern AS nmrFrontotemporalPattern,
				nmr_vascular_pattern AS nmrVascularPattern
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
				apo_e4 AS apoE4,
				b_vitamin AS bVitamin,
				c_reactive_protein AS cReactiveProtein,
				calcium AS calcium,
				d_vitamin AS dVitamin,
				folic_acid AS folicAcid,
				homocysteine AS homocysteine,
				phosphorus AS phosphorus,
				thyroids AS thyroids,
				total_cholesterol AS totalCholesterol,
				triglycerides AS triglycerides,
				vdrl as vdrl
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
				date AS date,
				clinical_impression AS clinicalImpression,
				diagnosis AS diagnosis,
				indications AS indications,
				observations AS observations,
				reasons AS reasons
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
				creator AS creator,
				patient AS patient,
				creation_datetime AS creationDatetime
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
				addenbrooke_cognitive_examination AS addenbrookeCognitiveExamination,
				eye_tracking_pattern AS eyeTrackingPattern,
				ineco_frontal_screening AS inecoFrontalScreening,
				mini_mental_state_examination AS miniMentalStateExamination,
				working_memory_index AS workingMemoryIndex
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
				diabetes AS diabetes,
				dyslipidemia AS dyslipidemia,
				heart_disease AS heartDisease,
				hiv AS hiv,
				hypertension AS hypertension,
				psychiatric_disorder AS psychiatricDisorder,
				relative_with_alzheimer AS relativeWithAlzheimer,
				traumatic_brain_injury AS traumaticBrainInjury
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
				antidepressants AS antidepressants,
				antidiabetics AS antidiabetics,
				antihypertensives AS antihypertensives,
				antiplatelets_anticoagulants AS antiplateletsAnticoagulants,
				antipsychotics AS antipsychotics,
				benzodiazepines AS benzodiazepines,
				hypolipidemics AS hypolipidemics,
				levothyroxine AS levothyroxine,
				melatonin AS melatonin
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
				acetylcholinesterase_inhibitor AS acetylcholinesteraseInhibitor,
				acetylsalicylic_acid AS acetylsalicylicAcid,
				b_vitamin AS bVitamin,
				concomitant_disease_referral AS concomitantDiseaseReferral,
				folic_acid AS folicAcid,
				memantine AS memantine,
				neurocognitive_rehabilitation AS neurocognitiveRehabilitation,
				physical_exercise AS physicalExercise
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
	public function selectExperimentMainData($experimentId) {
		// Defines the statement
		$statement = '
			SELECT
				name AS name,
				command_line AS commandLine
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
				creator AS creator,
				creation_datetime AS creationDatetime
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
				hash AS hash,
				name AS name
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
				creator AS creator,
				creation_datetime AS creationDatetime
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
	public function selectNotErasedExperimentFiles($experimentId) {
		// Defines the statement
		$statement = '
			SELECT experiments_files.file AS file
			FROM experiments_files INNER JOIN files
			ON experiments_files.file = files.id
			WHERE
				NOT files.erased
				AND
				experiments_files.experiment = :experimentId
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
	public function selectNotErasedStudyFiles($studyId) {
		// Defines the statement
		$statement = '
			SELECT studies_files.file AS file
			FROM studies_files INNER JOIN files
			ON studies_files.file = files.id
			WHERE
				NOT files.erased
				AND
				studies_files.study = :studyId
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
	public function selectPatientMainData($patientId) {
		// Defines the statement
		$statement = '
			SELECT
				first_name AS firstName,
				last_name AS lastName,
				gender AS gender,
				birth_date AS birthDate,
				education_years AS educationYears
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
				creator AS creator,
				creation_datetime AS creationDatetime
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
	public function selectStudyMainData($studyId) {
		// Defines the statement
		$statement = '
			SELECT observations AS observations
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
				consultation AS consultation,
				creator AS creator,
				experiment AS experiment,
				report AS report,
				creation_datetime AS creationDatetime
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
				password_hash AS passwordHash,
				password_salt AS passwordSalt
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
				first_name AS firstName,
				last_name AS lastName,
				gender AS gender,
				email_address AS emailAddress,
				role AS role
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
			SELECT creation_datetime AS creationDatetime
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
	public function studyExists($studyId) {
		// Defines the statement
		$statement = '
			SELECT EXISTS (
				SELECT *
				FROM consultations
				WHERE
					NOT erased
					AND
					id = :studyId
			)
		';
		
		// Sets the parameters
		$parameters = [
			':studyId' => $studyId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the result
		return $results[0];
	}
	
	/*
	 * TODO: comments
	 */
	public function updateUserAuthenticationData($userId, $userPasswordHash, $userPasswordSalt) {
		// TODO: implement
	}
	
	/*
	 * TODO: comments
	 */
	public function userExists($userId) {
		// Defines the statement
		$statement = '
			SELECT EXISTS (
				SELECT *
				FROM consultations
				WHERE
					NOT erased
					AND
					id = :userId
			)
		';
		
		// Sets the parameters
		$parameters = [
			':userId' => $userId
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the result
		return $results[0];
	}
	
	/*
	 * Connects to the database.
	 * 
	 * It returns the PDO instance representing the connection.
	 */
	protected function connect() {
		$configuration = &$this->app->configurations->get('businessLogicDatabase');
		
		// Gets the configuration of the database
		$dsn = $configuration['dsn'];
		$username = $configuration['username'];
		$password = $configuration['password'];
		
		// Creates and returns a PDO instance
		return new PDO($dsn, $username, $password);
	}
	
}
