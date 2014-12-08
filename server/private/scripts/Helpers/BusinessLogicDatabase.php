<?php

/*
 * This helper represents the business logic database.
 */
class BusinessLogicDatabase extends Database {
	
	/*
	 * TODO: comments
	 */
	public function selectConsultationImageAnalysis($consultationId) {
		// TODO: implement
	}
	
	/*
	 * TODO: comments
	 */
	public function selectConsultationLaboratoryResults($consultationId) {
		// TODO: implement
	}
	
	/*
	 * TODO: comments
	 */
	public function selectConsultationMainData($consultationId) {
		// TODO: implement
	}
	
	/*
	 * TODO: comments
	 */
	public function selectConsultationMetadata($consultationId) {
		// TODO: implement
	}
	
	/*
	 * TODO: comments
	 */
	public function selectConsultationNeurocognitiveAssessment($consultationId) {
		// TODO: implement
	}
	
	/*
	 * TODO: comments
	 */
	public function selectConsultationPatientBackground($consultationId) {
		// TODO: implement
	}
	
	/*
	 * TODO: comments
	 */
	public function selectConsultationPatientMedications($consultationId) {
		// TODO: implement
	}
	
	/*
	 * TODO: comments
	 */
	public function selectConsultationTreatments($consultationId) {
		// TODO: implement
	}
	
	/*
	 * TODO: comments
	 */
	public function selectExperimentFiles($experimentId) {
		// TODO: implement
	}
	
	/*
	 * TODO: comments
	 */
	public function selectExperimentMainData($experimentId) {
		// TODO: implement
	}
	
	/*
	 * TODO: comments
	 */
	public function selectExperimentMetadata($experimentId) {
		// TODO: implement
	}
	
	/*
	 * TODO: comments
	 */
	public function selectFileMainData($fileId) {
		// TODO: implement
	}
	
	/*
	 * TODO: comments
	 */
	public function selectFileMetadata($fileId) {
		// TODO: implement
	}
	
	/*
	 * TODO: comments
	 */
	public function selectPatientMainData($patientId) {
		// TODO: implement
	}
	
	/*
	 * TODO: comments
	 */
	public function selectPatientMetadata($patientId) {
		// TODO: implement
	}
	
	/*
	 * TODO: comments
	 */
	public function selectStudyFiles($studyId) {
		// TODO: implement
	}
	
	/*
	 * TODO: comments
	 */
	public function selectStudyMainData($studyId) {
		// TODO: implement
	}
	
	/*
	 * TODO: comments
	 */
	public function selectStudyMetadata($studyId) {
		// TODO: implement
	}
	
	/*
	 * TODO: comments
	 */
	public function selectUserAuthenticationData($userId) {
		// TODO: implement
	}
	
	/*
	 * TODO: comments
	 */
	public function selectUserMainData($userId) {
		// TODO: implement
	}
	
	/*
	 * TODO: comments
	 */
	public function selectUserMetadata($userId) {
		// TODO: implement
	}
	
	/*
	 * Connects to the database.
	 * 
	 * It returns the PDO instance representing the connection.
	 */
	protected function connect() {
		// Gets the configuration of the database
		$configuration = $this->app->configurations->get(CONFIGURATION_ID_BUSINESS_LOGIC_DATABASE);
		$dsn = $configuration['dsn'];
		$password = $configuration['password'];
		$username = $configuration['username'];
		
		// Creates and returns a PDO instance
		return new PDO($dsn, $username, $password);
	}
	
}
