<?php

/*
 * This helper facilitates the obtaining data of the business logic.
 * 
 * It offers a data cache to reduce the database queries.
 * 
 * TODO: add connection between data if necessary (probably not)
 * TODO: check if cache works OK with reference (test the database queries)
 */
class Data extends Helper {
	
	/*
	 * The data cache.
	 */
	private $cache;
	
	/*
	 * TODO: comments
	 */
	public function getConsultation($consultationId, $fields) {
		$businessLogicDatabase = $this->app->businessLogicDatabase;
		$consultations = &$this->cache['consultations'];
		
		if (! isset($consultations[$consultationId])) {
			// Initializes the consultation and stores it in cache
			$consultations[$consultationId] = [
				'id' => $consultationId
			];
		}
		
		// Gets the consultation from the cache
		$consultation = &$consultations[$consultationId];
		
		// Defines the load functions for the different fields
		$fieldLoadFunctions = [
			'imageAnalysis' => [ $businessLogicDatabase, 'selectNotErasedConsultationImageAnalysis' ],
			'laboratoryResults' => [ $businessLogicDatabase, 'selectNotErasedConsultationLaboratoryResults' ],
			'mainData' => [ $businessLogicDatabase, 'selectNotErasedConsultationMainData' ],
			'metadata' => [ $businessLogicDatabase, 'selectNotErasedConsultationMetadata' ],
			'neurocognitiveAssessment' => [ $businessLogicDatabase, 'selectNotErasedConsultationNeurocognitiveAssessment' ],
			'patientBackground' => [ $businessLogicDatabase, 'selectNotErasedConsultationPatientBackground' ],
			'patientMedications' => [ $businessLogicDatabase, 'selectNotErasedConsultationPatientMedications' ],
			'treatments' => [ $businessLogicDatabase, 'selectNotErasedConsultationTreatments' ]
		];
		
		// Loads the requested fields that have not been loaded yet
		foreach ($fieldLoadFunctions as $field => $loadFunction) {
			if (in_array($field, $fields) && ! isset($consultation[$field])) {
				$consultation[$field] = call_user_func($loadFunction, $consultationId);
			}
		}
		
		return $consultation;
	}
	
	/*
	 * TODO: comments
	 */
	public function getExperiment($experimentId, $fields) {
		$businessLogicDatabase = $this->app->businessLogicDatabase;
		$experiments = &$this->cache['experiments'];
		
		if (! isset($experiments[$experimentId])) {
			// Initializes the experiment and stores it in cache
			$experiments[$experimentId] = [
				'id' => $experimentId
			];
		}
		
		// Gets the experiment from the cache
		$experiment = &$experiments[$experimentId];
		
		// Defines the load functions for the different fields
		$fieldLoadFunctions = [
			'files' => [ $businessLogicDatabase, 'selectNotErasedExperimentFiles' ],
			'mainData' => [ $businessLogicDatabase, 'selectNotErasedExperimentMainData' ],
			'metadata' => [ $businessLogicDatabase, 'selectNotErasedExperimentMetadata' ]
		];
		
		// Loads the requested fields that have not been loaded yet
		foreach ($fieldLoadFunctions as $field => $loadFunction) {
			if (in_array($field, $fields) && ! isset($experiment[$field])) {
				$experiment[$field] = call_user_func($loadFunction, $experimentId);
			}
		}
		
		return $experiment;
	}
	
	/*
	 * TODO: comments
	 */
	public function getFile($fileId, $fields) {
		$businessLogicDatabase = $this->app->businessLogicDatabase;
		$files = &$this->cache['files'];
		
		if (! isset($files[$fileId])) {
			// Initializes the file and stores it in cache
			$files[$fileId] = [
				'id' => $fileId
			];
		}
		
		// Gets the file from the cache
		$file = &$files[$fileId];
		
		// Defines the load functions for the different fields
		$fieldLoadFunctions = [
			'mainData' => [ $businessLogicDatabase, 'selectNotErasedFileMainData' ],
			'metadata' => [ $businessLogicDatabase, 'selectNotErasedFileMetadata' ]
		];
		
		// Loads the requested fields that have not been loaded yet
		foreach ($fieldLoadFunctions as $field => $loadFunction) {
			if (in_array($field, $fields) && ! isset($file[$field])) {
				$file[$field] = call_user_func($loadFunction, $fileId);
			}
		}
		
		return $file;
	}
	
	/*
	 * TODO: comments
	 */
	public function getPatient($patientId, $fields) {
		$businessLogicDatabase = $this->app->businessLogicDatabase;
		$patients = &$this->cache['patients'];
		
		if (! isset($patients[$patientId])) {
			// Initializes the patient and stores it in cache
			$patients[$patientId] = [
				'id' => $patientId
			];
		}
		
		// Gets the patient from the cache
		$patient = &$patients[$patientId];
		
		// Defines the load functions for the different fields
		$fieldLoadFunctions = [
			'mainData' => [ $businessLogicDatabase, 'selectNotErasedPatientMainData' ],
			'metadata' => [ $businessLogicDatabase, 'selectNotErasedPatientMetadata' ]
		];
		
		// Loads the requested fields that have not been loaded yet
		foreach ($fieldLoadFunctions as $field => $loadFunction) {
			if (in_array($field, $fields) && ! isset($patient[$field])) {
				$patient[$field] = call_user_func($loadFunction, $patientId);
			}
		}
		
		return $patient;
	}
	
	/*
	 * TODO: comments
	 */
	public function getStudy($studyId, $fields) {
		$businessLogicDatabase = $this->app->businessLogicDatabase;
		$studies = &$this->cache['studies'];
		
		if (! isset($studies[$studyId])) {
			// Initializes the study and stores it in cache
			$studies[$studyId] = [
				'id' => $studyId
			];
		}
		
		// Gets the study from the cache
		$study = &$studies[$studyId];
		
		// Defines the load functions for the different fields
		$fieldLoadFunctions = [
			'files' => [ $businessLogicDatabase, 'selectNotErasedStudyFiles' ],
			'mainData' => [ $businessLogicDatabase, 'selectNotErasedStudyMainData' ],
			'metadata' => [ $businessLogicDatabase, 'selectNotErasedStudyMetadata' ]
		];
		
		// Loads the requested fields that have not been loaded yet
		foreach ($fieldLoadFunctions as $field => $loadFunction) {
			if (in_array($field, $fields) && ! isset($study[$field])) {
				$study[$field] = call_user_func($loadFunction, $studyId);
			}
		}
		
		return $study;
	}
	
	/*
	 * TODO: comments
	 */
	public function getUser($userId, $fields) {
		$businessLogicDatabase = $this->app->businessLogicDatabase;
		$users = &$this->cache['users'];
		
		if (! isset($users[$userId])) {
			// Initializes the user and stores it in cache
			$users[$userId] = [
				'id' => $userId
			];
		}
		
		// Gets the user from the cache
		$user = &$users[$userId];
		
		// Defines the load functions for the different fields
		$fieldLoadFunctions = [
			'authenticationData' => [ $businessLogicDatabase, 'selectNotErasedUserAuthenticationData' ],
			'mainData' => [ $businessLogicDatabase, 'selectNotErasedUserMainData' ],
			'metadata' => [ $businessLogicDatabase, 'selectNotErasedUserMetadata' ]
		];
		
		// Loads the requested fields that have not been loaded yet
		foreach ($fieldLoadFunctions as $field => $loadFunction) {
			if (in_array($field, $fields) && ! isset($user[$field])) {
				$user[$field] = call_user_func($loadFunction, $userId);
			}
		}
		
		return $user;
	}
	
	/*
	 * Performs initialization tasks.
	 */
	protected function initialize() {
		// Initializes the cache
		$this->cache = [
			'consultations' => [],
			'experiments' => [],
			'files' => [],
			'patients' => [],
			'studies' => [],
			'users' => []
		];
	}
	
}
