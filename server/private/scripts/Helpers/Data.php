<?php

/*
 * This helper facilitates the obtaining data of the business logic.
 * 
 * It offers a data cache to reduce the database queries.
 * 
 * TODO: deep code cleaning
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
			// The cache entry has not been initialized yet
			$this->initializeConsultationCacheEntry($consultationId);
		}
		
		// Gets the consultation from the cache
		$consultation = &$consultations[$consultationId];
		
		if (is_null($consultation)) {
			// The consultation doesn't exist
			return null;
		}
		
		// Defines the load functions for the different fields
		$fieldLoadFunctions = [
			'imageAnalysis' => [ $businessLogicDatabase, 'selectConsultationImageAnalysis' ],
			'laboratoryResults' => [ $businessLogicDatabase, 'selectConsultationLaboratoryResults' ],
			'mainData' => [ $businessLogicDatabase, 'selectConsultationMainData' ],
			'metadata' => [ $businessLogicDatabase, 'selectConsultationMetadata' ],
			'neurocognitiveAssessment' => [ $businessLogicDatabase, 'selectConsultationNeurocognitiveAssessment' ],
			'patientBackground' => [ $businessLogicDatabase, 'selectConsultationPatientBackground' ],
			'patientMedications' => [ $businessLogicDatabase, 'selectConsultationPatientMedications' ],
			'treatments' => [ $businessLogicDatabase, 'selectConsultationTreatments' ]
		];
		
		// Loads the requested fields that have not been loaded yet
		foreach ($fieldLoadFunctions as $field => $loadFunction) {
			if (in_array($field, $fields) && ! isset($consultation[$field])) {
				$consultation[$field] = call_user_func($loadFunction, $consultationId);
				
				if ($field === 'metadata') {
					// Checks the metadata of the consultation
					$this->checkConsultationMetadata($consultationId);
				}
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
			// The cache entry has not been initialized yet
			$this->initializeExperimentCacheEntry($experimentId);
		}
		
		// Gets the experiment from the cache
		$experiment = &$experiments[$experimentId];
		
		if (is_null($experiment)) {
			// The experiment doesn't exist
			return null;
		}
		
		// Defines the load functions for the different fields
		$fieldLoadFunctions = [
			'files' => [ $businessLogicDatabase, 'selectNonErasedExperimentFiles' ],
			'mainData' => [ $businessLogicDatabase, 'selectExperimentMainData' ],
			'metadata' => [ $businessLogicDatabase, 'selectExperimentMetadata' ]
		];
		
		// Loads the requested fields that have not been loaded yet
		foreach ($fieldLoadFunctions as $field => $loadFunction) {
			if (in_array($field, $fields) && ! isset($experiment[$field])) {
				$experiment[$field] = call_user_func($loadFunction, $experimentId);
				
				if ($field === 'metadata') {
					// Checks the metadata of the experiment
					$this->checkExperimentMetadata($experimentId);
				}
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
			// The cache entry has not been initialized yet
			$this->initializeFileCacheEntry($fileId);
		}
		
		// Gets the file from the cache
		$file = &$files[$fileId];
		
		if (is_null($file)) {
			// The file doesn't exist
			return null;
		}
		
		// Defines the load functions for the different fields
		$fieldLoadFunctions = [
			'mainData' => [ $businessLogicDatabase, 'selectFileMainData' ],
			'metadata' => [ $businessLogicDatabase, 'selectFileMetadata' ]
		];
		
		// Loads the requested fields that have not been loaded yet
		foreach ($fieldLoadFunctions as $field => $loadFunction) {
			if (in_array($field, $fields) && ! isset($file[$field])) {
				$file[$field] = call_user_func($loadFunction, $fileId);
				
				if ($field === 'metadata') {
					// Checks the metadata of the file
					$this->checkFileMetadata($fileId);
				}
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
			// The cache entry has not been initialized yet
			$this->initializePatientCacheEntry($patientId);
		}
		
		// Gets the patient from the cache
		$patient = &$patients[$patientId];
		
		if (is_null($patient)) {
			// The patient doesn't exist
			return null;
		}
		
		// Defines the load functions for the different fields
		$fieldLoadFunctions = [
			'mainData' => [ $businessLogicDatabase, 'selectPatientMainData' ],
			'metadata' => [ $businessLogicDatabase, 'selectPatientMetadata' ]
		];
		
		// Loads the requested fields that have not been loaded yet
		foreach ($fieldLoadFunctions as $field => $loadFunction) {
			if (in_array($field, $fields) && ! isset($patient[$field])) {
				$patient[$field] = call_user_func($loadFunction, $patientId);
				
				if ($field === 'metadata') {
					// Checks the metadata of the patient
					$this->checkPatientMetadata($patientId);
				}
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
			// The cache entry has not been initialized yet
			$this->initializeStudyCacheEntry($studyId);
		}
		
		// Gets the study from the cache
		$study = &$studies[$studyId];
		
		if (is_null($study)) {
			// The study doesn't exist
			return null;
		}
		
		// Defines the load functions for the different fields
		$fieldLoadFunctions = [
			'files' => [ $businessLogicDatabase, 'selectNonErasedStudyFiles' ],
			'mainData' => [ $businessLogicDatabase, 'selectStudyMainData' ],
			'metadata' => [ $businessLogicDatabase, 'selectStudyMetadata' ]
		];
		
		// Loads the requested fields that have not been loaded yet
		foreach ($fieldLoadFunctions as $field => $loadFunction) {
			if (in_array($field, $fields) && ! isset($study[$field])) {
				$study[$field] = call_user_func($loadFunction, $studyId);
				
				if ($field === 'metadata') {
					// Checks the metadata of the study
					$this->checkStudyMetadata($studyId);
				}
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
			// The cache entry has not been initialized yet
			$this->initializeUserCacheEntry($userId);
		}
		
		// Gets the user from the cache
		$user = &$users[$userId];
		
		if (is_null($user)) {
			// The user doesn't exist
			return null;
		}
		
		// Defines the load functions for the different fields
		$fieldLoadFunctions = [
			'authenticationData' => [ $businessLogicDatabase, 'selectUserAuthenticationData' ],
			'mainData' => [ $businessLogicDatabase, 'selectUserMainData' ],
			'metadata' => [ $businessLogicDatabase, 'selectUserMetadata' ]
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
	
	/*
	 * TODO: comments
	 */
	private function checkConsultationMetadata($consultationId) {
		$businessLogicDatabase = $this->app->businessLogicDatabase;
		$consultationMetadata = &$this->cache['consultations'][$consultationId]['metadata'];

		if (! $businessLogicDatabase->nonErasedUserExists($consultationMetadata['creator'])) {
			// The user doesn't exist or has been erased
			$consultationMetadata['creator'] = null;
		}

		if (! $businessLogicDatabase->nonErasedPatientExists($consultationMetadata['patient'])) {
			// The patient doesn't exist or has been erased
			$consultationMetadata['patient'] = null;
		}
	}
	
	/*
	 * TODO: comments
	 */
	private function checkExperimentMetadata($experimentId) {
		$businessLogicDatabase = $this->app->businessLogicDatabase;
		$experimentMetadata = &$this->cache['experiments'][$experimentId]['metadata'];

		if (! $businessLogicDatabase->nonErasedUserExists($experimentMetadata['creator'])) {
			// The user doesn't exist or has been erased
			$experimentMetadata['creator'] = null;
		}
	}
	
	/*
	 * TODO: comments
	 */
	private function checkFileMetadata($fileId) {
		$businessLogicDatabase = $this->app->businessLogicDatabase;
		$fileMetadata = &$this->cache['files'][$fileId]['metadata'];

		if (! $businessLogicDatabase->nonErasedUserExists($fileMetadata['creator'])) {
			// The user doesn't exist or has been erased
			$fileMetadata['creator'] = null;
		}
	}
	
	/*
	 * TODO: comments
	 */
	private function checkPatientMetadata($patientId) {
		$businessLogicDatabase = $this->app->businessLogicDatabase;
		$patientMetadata = &$this->cache['patients'][$patientId]['metadata'];

		if (! $businessLogicDatabase->nonErasedUserExists($patientMetadata['creator'])) {
			// The user doesn't exist or has been erased
			$patientMetadata['creator'] = null;
		}
	}
	
	/*
	 * TODO: comments
	 */
	private function checkStudyMetadata($studyId) {
		$businessLogicDatabase = $this->app->businessLogicDatabase;
		$studyMetadata = &$this->cache['studies'][$studyId]['metadata'];

		if (! $businessLogicDatabase->nonErasedConsultationExists($studyMetadata['consultation'])) {
			// The consultation doesn't exist or has been erased
			$studyMetadata['consultation'] = null;
		}

		if (! $businessLogicDatabase->nonErasedUserExists($studyMetadata['creator'])) {
			// The user doesn't exist or has been erased
			$studyMetadata['creator'] = null;
		}

		if (! $businessLogicDatabase->nonErasedExperimentExists($studyMetadata['experiment'])) {
			// The experiment doesn't exist or has been erased
			$studyMetadata['experiment'] = null;
		}

		$studyMetadataReport = $studyMetadata['report'];
		if (! is_null($studyMetadataReport)) {
			if (! $businessLogicDatabase->nonErasedFileExists($studyMetadataReport)) {
				// The file doesn't exist or has been erased
				$studyMetadata['report'] = null;
			}
		}
	}
	
	/*
	 * TODO: comments
	 */
	private function initializeConsultationCacheEntry($consultationId) {
		// Sets the cache entry's default value
		$cacheEntry = null;

		if ($this->app->businessLogicDatabase->nonErasedConsultationExists($consultationId)) {
			// The consultation exists and has not been erased
			$cacheEntry = [
				'id' => $consultationId
			];
		}
		
		// Initializes the cache entry
		$this->cache['consultations'][$consultationId] = $cacheEntry;
	}
	
	/*
	 * TODO: comments
	 */
	private function initializeExperimentCacheEntry($experimentId) {
		// Sets the cache entry's default value
		$cacheEntry = null;

		if ($this->app->businessLogicDatabase->nonErasedExperimentExists($experimentId)) {
			// The experiment exists and has not been erased
			$cacheEntry = [
				'id' => $experimentId
			];
		}
		
		// Initializes the cache entry
		$this->cache['experiments'][$experimentId] = $cacheEntry;
	}
	
	/*
	 * TODO: comments
	 */
	private function initializeFileCacheEntry($fileId) {
		// Sets the cache entry's default value
		$cacheEntry = null;

		if ($this->app->businessLogicDatabase->nonErasedFileExists($fileId)) {
			// The file exists and has not been erased
			$cacheEntry = [
				'id' => $fileId
			];
		}
		
		// Initializes the cache entry
		$this->cache['files'][$fileId] = $cacheEntry;
	}
	
	/*
	 * TODO: comments
	 */
	private function initializePatientCacheEntry($patientId) {
		// Sets the cache entry's default value
		$cacheEntry = null;

		if ($this->app->businessLogicDatabase->nonErasedPatientExists($patientId)) {
			// The patient exists and has not been erased
			$cacheEntry = [
				'id' => $patientId
			];
		}
		
		// Initializes the cache entry
		$this->cache['patients'][$patientId] = $cacheEntry;
	}
	
	/*
	 * TODO: comments
	 */
	private function initializeStudyCacheEntry($studyId) {
		// Sets the cache entry's default value
		$cacheEntry = null;

		if ($this->app->businessLogicDatabase->nonErasedStudyExists($studyId)) {
			// The study exists and has not been erased
			$cacheEntry = [
				'id' => $studyId
			];
		}
		
		// Initializes the cache entry
		$this->cache['studies'][$studyId] = $cacheEntry;
	}
	
	/*
	 * TODO: comments
	 */
	private function initializeUserCacheEntry($userId) {
		// Sets the cache entry's default value
		$cacheEntry = null;

		if ($this->app->businessLogicDatabase->nonErasedUserExists($userId)) {
			// The user exists and has not been erased
			$cacheEntry = [
				'id' => $userId
			];
		}
		
		// Initializes the cache entry
		$this->cache['users'][$userId] = $cacheEntry;
	}
	
}
