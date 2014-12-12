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
				consultations_image_analysis.doppler_normal_neck_vessels AS dopplerNormalNeckVessels,
				consultations_image_analysis.nmr_decreased_cerebral_cortex AS nmrDecreasedCerebralCortex,
				consultations_image_analysis.nmr_decreased_hippocampal_volume AS nmrDecreasedHippocampalVolume,
				consultations_image_analysis.nmr_frontotemporal_pattern AS nmrFrontotemporalPattern,
				consultations_image_analysis.nmr_vascular_pattern AS nmrVascularPattern
			FROM consultations_image_analysis INNER JOIN consultations_metadata
			ON consultations_image_analysis.consultation = consultations_metadata.consultation
			WHERE
				NOT consultations_metadata.erased
				AND
				consultations_image_analysis.consultation = :consultationId
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
				consultations_laboratory_results.apo_e4 AS apoE4,
				consultations_laboratory_results.b_vitamin AS bVitamin,
				consultations_laboratory_results.c_reactive_protein AS cReactiveProtein,
				consultations_laboratory_results.calcium AS calcium,
				consultations_laboratory_results.d_vitamin AS dVitamin,
				consultations_laboratory_results.folic_acid AS folicAcid,
				consultations_laboratory_results.homocysteine AS homocysteine,
				consultations_laboratory_results.phosphorus AS phosphorus,
				consultations_laboratory_results.thyroids AS thyroids,
				consultations_laboratory_results.total_cholesterol AS totalCholesterol,
				consultations_laboratory_results.triglycerides AS triglycerides,
				consultations_laboratory_results.vdrl as vdrl
			FROM consultations_laboratory_results INNER JOIN consultations_metadata
			ON consultations_laboratory_results.consultation = consultations_metadata.consultation
			WHERE
				NOT consultations_metadata.erased
				AND
				consultations_laboratory_results.consultation = :consultationId
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
				consultations_main_data.date AS date,
				consultations_main_data.clinical_impression AS clinicalImpression,
				consultations_main_data.diagnosis AS diagnosis,
				consultations_main_data.indications AS indications,
				consultations_main_data.observations AS observations,
				consultations_main_data.reasons AS reasons
			FROM consultations_main_data INNER JOIN consultations_metadata
			ON consultations_main_data.consultation = consultations_metadata.consultation
			WHERE
				NOT consultations_metadata.erased
				AND
				consultations_main_data.consultation = :consultationId
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
				erased AS erased,
				creation_datetime AS creationDatetime
			FROM consultations_metadata
			WHERE
				NOT erased
				AND
				consultation = :consultationId
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
				consultations_neurocognitive_assessment.addenbrooke_cognitive_examination AS addenbrookeCognitiveExamination,
				consultations_neurocognitive_assessment.eye_tracking_pattern AS eyeTrackingPattern,
				consultations_neurocognitive_assessment.ineco_frontal_screening AS inecoFrontalScreening,
				consultations_neurocognitive_assessment.mini_mental_state_examination AS miniMentalStateExamination,
				consultations_neurocognitive_assessment.working_memory_index AS workingMemoryIndex
			FROM consultations_neurocognitive_assessment INNER JOIN consultations_metadata
			ON consultations_neurocognitive_assessment.consultation = consultations_metadata.consultation
			WHERE
				NOT consultations_metadata.erased
				AND
				consultations_neurocognitive_assessment.consultation = :consultationId
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
				consultations_patient_background.diabetes AS diabetes,
				consultations_patient_background.dyslipidemia AS dyslipidemia,
				consultations_patient_background.heart_disease AS heartDisease,
				consultations_patient_background.hiv AS hiv,
				consultations_patient_background.hypertension AS hypertension,
				consultations_patient_background.psychiatric_disorder AS psychiatricDisorder,
				consultations_patient_background.relative_with_alzheimer AS relativeWithAlzheimer,
				consultations_patient_background.traumatic_brain_injury AS traumaticBrainInjury
			FROM consultations_patient_background INNER JOIN consultations_metadata
			ON consultations_patient_background.consultation = consultations_metadata.consultation
			WHERE
				NOT consultations_metadata.erased
				AND
				consultations_patient_background.consultation = :consultationId
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
				consultations_patient_medications.antidepressants AS antidepressants,
				consultations_patient_medications.antidiabetics AS antidiabetics,
				consultations_patient_medications.antihypertensives AS antihypertensives,
				consultations_patient_medications.antiplatelets_anticoagulants AS antiplateletsAnticoagulants,
				consultations_patient_medications.antipsychotics AS antipsychotics,
				consultations_patient_medications.benzodiazepines AS benzodiazepines,
				consultations_patient_medications.hypolipidemics AS hypolipidemics,
				consultations_patient_medications.levothyroxine AS levothyroxine,
				consultations_patient_medications.melatonin AS melatonin
			FROM consultations_patient_medications INNER JOIN consultations_metadata
			ON consultations_patient_medications.consultation = consultations_metadata.consultation
			WHERE
				NOT consultations_metadata.erased
				AND
				consultations_patient_medications.consultation = :consultationId
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
				consultations_treatments.acetylcholinesterase_inhibitor AS acetylcholinesteraseInhibitor,
				consultations_treatments.acetylsalicylic_acid AS acetylsalicylicAcid,
				consultations_treatments.b_vitamin AS bVitamin,
				consultations_treatments.concomitant_disease_referral AS concomitantDiseaseReferral,
				consultations_treatments.folic_acid AS folicAcid,
				consultations_treatments.memantine AS memantine,
				consultations_treatments.neurocognitive_rehabilitation AS neurocognitiveRehabilitation,
				consultations_treatments.physical_exercise AS physicalExercise
			FROM consultations_treatments INNER JOIN consultations_metadata
			ON consultations_treatments.consultation = consultations_metadata.consultation
			WHERE
				NOT consultations_metadata.erased
				AND
				consultations_treatments.consultation = :consultationId
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
			SELECT file AS file
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
				erased AS erased,
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
				erased AS erased,
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
				erased AS erased,
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
	public function selectStudyFiles($studyId) {
		// Defines the statement
		$statement = '
			SELECT file AS file
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
				erased AS erased,
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
			SELECT
				erased AS erased,
				creation_datetime AS creationDatetime
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
