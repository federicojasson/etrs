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
	public function selectExperimentFiles($consultationId) {
		// TODO: implement
	}
	
	/*
	 * TODO: comments
	 */
	public function selectExperimentMainData($consultationId) {
		// TODO: implement
	}
	
	/*
	 * TODO: comments
	 */
	public function selectExperimentMetadata($consultationId) {
		// TODO: implement
	}
	
	/*
	 * TODO: comments
	 */
	public function selectFileMainData($consultationId) {
		// TODO: implement
	}
	
	/*
	 * TODO: comments
	 */
	public function selectFileMetadata($consultationId) {
		// TODO: implement
	}
	
	/*
	 * TODO: comments
	 */
	public function selectPatientMainData($consultationId) {
		// TODO: implement
	}
	
	/*
	 * TODO: comments
	 */
	public function selectPatientMetadata($consultationId) {
		// TODO: implement
	}
	
	/*
	 * TODO: comments
	 */
	public function selectStudyFiles($consultationId) {
		// TODO: implement
	}
	
	/*
	 * TODO: comments
	 */
	public function selectStudyMainData($consultationId) {
		// TODO: implement
	}
	
	/*
	 * TODO: comments
	 */
	public function selectStudyMetadata($consultationId) {
		// TODO: implement
	}
	
	/*
	 * TODO: comments
	 */
	public function selectUserMainData($consultationId) {
		// TODO: implement
	}
	
	/*
	 * TODO: comments
	 */
	public function selectUserMetadata($consultationId) {
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
