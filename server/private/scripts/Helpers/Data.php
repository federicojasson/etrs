<?php

/*
 * This helper facilitates obtaining business logic data.
 * 
 * It offers a data cache to reduce the database queries.
 */
class Data extends Helper {
	
	/*
	 * The data cache.
	 */
	private $cache;
	
	/*
	 * Returns a background, or null if it doesn't exists or has been erased.
	 * 
	 * It receives the background's ID.
	 */
	public function getBackground($backgroundId) {
		return $this->getEntity($backgroundId, $this->cache['backgrounds'], [ $this, 'loadBackground' ]);
	}
	
	/*
	 * Returns a clinical impression, or null if it doesn't exists or has been
	 * erased.
	 * 
	 * It receives the clinical impression's ID.
	 */
	public function getClinicalImpression($clinicalImpressionId) {
		return $this->getEntity($clinicalImpressionId, $this->cache['clinicalImpressions'], [ $this, 'loadClinicalImpression' ]);
	}
	
	/*
	 * Returns a consultation, or null if it doesn't exists or has been erased.
	 * 
	 * It receives the consultation's ID.
	 */
	public function getConsultation($consultationId) {
		return $this->getEntity($consultationId, $this->cache['consultations'], [ $this, 'loadConsultation' ]);
	}
	
	/*
	 * Returns a diagnosis, or null if it doesn't exists or has been erased.
	 * 
	 * It receives the diagnosis's ID.
	 */
	public function getDiagnosis($diagnosisId) {
		return $this->getEntity($diagnosisId, $this->cache['diagnoses'], [ $this, 'loadDiagnosis' ]);
	}
	
	/*
	 * Returns an experiment, or null if it doesn't exists or has been erased.
	 * 
	 * It receives the experiment's ID.
	 */
	public function getExperiment($experimentId) {
		return $this->getEntity($experimentId, $this->cache['experiments'], [ $this, 'loadExperiment' ]);
	}
	
	/*
	 * Returns a file, or null if it doesn't exists or has been erased.
	 * 
	 * It receives the file's ID.
	 */
	public function getFile($fileId) {
		return $this->getEntity($fileId, $this->cache['files'], [ $this, 'loadFile' ]);
	}
	
	/*
	 * Returns an image test, or null if it doesn't exists or has been erased.
	 * 
	 * It receives the image test's ID.
	 */
	public function getImageTest($imageTestId) {
		return $this->getEntity($imageTestId, $this->cache['imageTests'], [ $this, 'loadImageTest' ]);
	}
	
	/*
	 * Returns a laboratory test, or null if it doesn't exists or has been
	 * erased.
	 * 
	 * It receives the laboratory test's ID.
	 */
	public function getLaboratoryTest($laboratoryTestId) {
		return $this->getEntity($laboratoryTestId, $this->cache['laboratoryTests'], [ $this, 'loadLaboratoryTest' ]);
	}
	
	/*
	 * Returns a medication, or null if it doesn't exists or has been erased.
	 * 
	 * It receives the medication's ID.
	 */
	public function getMedication($medicationId) {
		return $this->getEntity($medicationId, $this->cache['medications'], [ $this, 'loadMedication' ]);
	}
	
	/*
	 * Returns a neurocognitive evaluation, or null if it doesn't exists or has
	 * been erased.
	 * 
	 * It receives the neurocognitive evaluation's ID.
	 */
	public function getNeurocognitiveEvaluation($neurocognitiveEvaluationId) {
		return $this->getEntity($neurocognitiveEvaluationId, $this->cache['neurocognitiveEvaluations'], [ $this, 'loadNeurocognitiveEvaluation' ]);
	}
	
	/*
	 * Returns a patient, or null if it doesn't exists or has been erased.
	 * 
	 * It receives the patient's ID.
	 */
	public function getPatient($patientId) {
		return $this->getEntity($patientId, $this->cache['patients'], [ $this, 'loadPatient' ]);
	}
	
	/*
	 * Returns a study, or null if it doesn't exists or has been erased.
	 * 
	 * It receives the study's ID.
	 */
	public function getStudy($studyId) {
		return $this->getEntity($studyId, $this->cache['studies'], [ $this, 'loadStudy' ]);
	}
	
	/*
	 * Returns a treatment, or null if it doesn't exists or has been erased.
	 * 
	 * It receives the treatment's ID.
	 */
	public function getTreatment($treatmentId) {
		return $this->getEntity($treatmentId, $this->cache['treatments'], [ $this, 'loadTreatment' ]);
	}
	
	/*
	 * Returns a user, or null if it doesn't exists or has been erased.
	 * 
	 * It receives the user's ID.
	 */
	public function getUser($userId) {
		return $this->getEntity($userId, $this->cache['users'], [ $this, 'loadUser' ]);
	}
	
	/*
	 * Performs initialization tasks.
	 */
	protected function initialize() {
		// Initializes the cache
		$this->cache = [
			'backgrounds' => [],
			'clinicalImpressions' => [],
			'consultations' => [],
			'diagnoses' => [],
			'experiments' => [],
			'files' => [],
			'imageTests' => [],
			'laboratoryTests' => [],
			'medications' => [],
			'neurocognitiveEvaluations' => [],
			'patients' => [],
			'studies' => [],
			'treatments' => [],
			'users' => []
		];
	}
	
	/*
	 * Returns an entity, or null if it doesn't exists or has been erased.
	 * 
	 * It receives the entity's ID, its corresponding cache and the load
	 * function, in case it hasn't been loaded yet.
	 */
	private function getEntity($entityId, &$entityCache, $loadFunction) {
		if (! isset($entityCache[$entityId])) {
			// The cache entry has not been initialized yet
			$entityCache[$entityId] = call_user_func($loadFunction, $entityId);
		}
		
		// Returns the entity from the cache
		return $entityCache[$entityId];
	}
	
	/*
	 * Loads a background and returns it. If it doesn't exist or has been
	 * erased, null is returned.
	 * 
	 * It receives the background's ID.
	 */
	private function loadBackground($backgroundId) {
		$businessLogicDatabase = $this->app->businessLogicDatabase;
		
		// Selects the background
		$background = $businessLogicDatabase->selectNonErasedBackground($backgroundId);
		
		if (is_null($background)) {
			// The background doesn't exist or has been erased
			return null;
		}
		
		if (! $businessLogicDatabase->nonErasedUserExists($background['creator'])) {
			// The creator doesn't exist or has been erased
			$background['creator'] = null;
		}
		
		return $background;
	}
	
	/*
	 * Loads a clinical impression and returns it. If it doesn't exist or has
	 * been erased, null is returned.
	 * 
	 * It receives the clinical impression's ID.
	 */
	private function loadClinicalImpression($clinicalImpressionId) {
		$businessLogicDatabase = $this->app->businessLogicDatabase;
		
		// Selects the clinical impression
		$clinicalImpression = $businessLogicDatabase->selectNonErasedClinicalImpression($clinicalImpressionId);
		
		if (is_null($clinicalImpression)) {
			// The clinical impression doesn't exist or has been erased
			return null;
		}
		
		if (! $businessLogicDatabase->nonErasedUserExists($clinicalImpression['creator'])) {
			// The creator doesn't exist or has been erased
			$clinicalImpression['creator'] = null;
		}
		
		return $clinicalImpression;
	}
	
	/*
	 * Loads a consultation and returns it. If it doesn't exist or has been
	 * erased, null is returned.
	 * 
	 * It receives the consultation's ID.
	 */
	private function loadConsultation($consultationId) {
		$businessLogicDatabase = $this->app->businessLogicDatabase;
		
		// Selects the consultation
		$consultation = $businessLogicDatabase->selectNonErasedConsultation($consultationId);
		
		if (is_null($consultation)) {
			// The consultation doesn't exist or has been erased
			return null;
		}
		
		$consultationClinicalImpression = $consultation['clinicalImpression'];
		if (! is_null($consultationClinicalImpression)) {
			if (! $businessLogicDatabase->nonErasedClinicalImpressionExists($consultationClinicalImpression)) {
				// The clinical impression doesn't exist or has been erased
				$consultation['clinicalImpression'] = null;
			}
		}
		
		if (! $businessLogicDatabase->nonErasedUserExists($consultation['creator'])) {
			// The creator doesn't exist or has been erased
			$consultation['creator'] = null;
		}
		
		$consultationDiagnosis = $consultation['diagnosis'];
		if (! is_null($consultationDiagnosis)) {
			if (! $businessLogicDatabase->nonErasedDiagnosisExists($consultationDiagnosis)) {
				// The diagnosis doesn't exist or has been erased
				$consultation['diagnosis'] = null;
			}
		}
		
		if (! $businessLogicDatabase->nonErasedPatientExists($consultation['patient'])) {
			// The patient doesn't exist or has been erased
			$consultation['patient'] = null;
		}
		
		// Loads the backgrounds
		$consultation['backgrounds'] = $businessLogicDatabase->selectConsultationNonErasedBackgrounds($consultationId);
		
		// Loads the image tests
		$consultation['imageTests'] = $businessLogicDatabase->selectConsultationNonErasedImageTests($consultationId);
		
		// Loads the laboratory tests
		$consultation['laboratoryTests'] = $businessLogicDatabase->selectConsultationNonErasedLaboratoryTests($consultationId);
		
		// Loads the medications
		$consultation['medications'] = $businessLogicDatabase->selectConsultationNonErasedMedications($consultationId);
		
		// Loads the neurocognitive evaluations
		$consultation['neurocognitiveEvaluations'] = $businessLogicDatabase->selectConsultationNonErasedNeurocognitiveEvaluations($consultationId);
		
		// Loads the treatments
		$consultation['treatments'] = $businessLogicDatabase->selectConsultationNonErasedTreatments($consultationId);
		
		return $consultation;
	}
	
	/*
	 * Loads a diagnosis and returns it. If it doesn't exist or has been erased,
	 * null is returned.
	 * 
	 * It receives the diagnosis's ID.
	 */
	private function loadDiagnosis($diagnosisId) {
		$businessLogicDatabase = $this->app->businessLogicDatabase;
		
		// Selects the diagnosis
		$diagnosis = $businessLogicDatabase->selectNonErasedDiagnosis($diagnosisId);
		
		if (is_null($diagnosis)) {
			// The diagnosis doesn't exist or has been erased
			return null;
		}
		
		if (! $businessLogicDatabase->nonErasedUserExists($diagnosis['creator'])) {
			// The creator doesn't exist or has been erased
			$diagnosis['creator'] = null;
		}
		
		return $diagnosis;
	}
	
	/*
	 * Loads an experiment and returns it. If it doesn't exist or has been
	 * erased, null is returned.
	 * 
	 * It receives the experiment's ID.
	 */
	private function loadExperiment($experimentId) {
		$businessLogicDatabase = $this->app->businessLogicDatabase;
		
		// Selects the experiment
		$experiment = $businessLogicDatabase->selectNonErasedExperiment($experimentId);
		
		if (is_null($experiment)) {
			// The experiment doesn't exist or has been erased
			return null;
		}
		
		if (! $businessLogicDatabase->nonErasedUserExists($experiment['creator'])) {
			// The creator doesn't exist or has been erased
			$experiment['creator'] = null;
		}
		
		// Loads the files
		$experiment['files'] = $businessLogicDatabase->selectExperimentNonErasedFiles($experimentId);
		
		return $experiment;
	}
	
	/*
	 * Loads a file and returns it. If it doesn't exist or has been erased, null
	 * is returned.
	 * 
	 * It receives the file's ID.
	 */
	private function loadFile($fileId) {
		$businessLogicDatabase = $this->app->businessLogicDatabase;
		
		// Selects the file
		$file = $businessLogicDatabase->selectNonErasedFile($fileId);
		
		if (is_null($file)) {
			// The file doesn't exist or has been erased
			return null;
		}
		
		if (! $businessLogicDatabase->nonErasedUserExists($file['creator'])) {
			// The creator doesn't exist or has been erased
			$file['creator'] = null;
		}
		
		return $file;
	}
	
	/*
	 * Loads an image test and returns it. If it doesn't exist or has been
	 * erased, null is returned.
	 * 
	 * It receives the image test's ID.
	 */
	private function loadImageTest($imageTestId) {
		$businessLogicDatabase = $this->app->businessLogicDatabase;
		
		// Selects the image test
		$imageTest = $businessLogicDatabase->selectNonErasedImageTest($imageTestId);
		
		if (is_null($imageTest)) {
			// The image test doesn't exist or has been erased
			return null;
		}
		
		if (! $businessLogicDatabase->nonErasedUserExists($imageTest['creator'])) {
			// The creator doesn't exist or has been erased
			$imageTest['creator'] = null;
		}
		
		return $imageTest;
	}
	
	/*
	 * Loads a laboratory test and returns it. If it doesn't exist or has been
	 * erased, null is returned.
	 * 
	 * It receives the laboratory test's ID.
	 */
	private function loadLaboratoryTest($laboratoryTestId) {
		$businessLogicDatabase = $this->app->businessLogicDatabase;
		
		// Selects the laboratory test
		$laboratoryTest = $businessLogicDatabase->selectNonErasedLaboratoryTest($laboratoryTestId);
		
		if (is_null($laboratoryTest)) {
			// The laboratory test doesn't exist or has been erased
			return null;
		}
		
		if (! $businessLogicDatabase->nonErasedUserExists($laboratoryTest['creator'])) {
			// The creator doesn't exist or has been erased
			$laboratoryTest['creator'] = null;
		}
		
		return $laboratoryTest;
	}
	
	/*
	 * Loads a medication and returns it. If it doesn't exist or has been
	 * erased, null is returned.
	 * 
	 * It receives the medication's ID.
	 */
	private function loadMedication($medicationId) {
		$businessLogicDatabase = $this->app->businessLogicDatabase;
		
		// Selects the medication
		$medication = $businessLogicDatabase->selectNonErasedMedication($medicationId);
		
		if (is_null($medication)) {
			// The medication doesn't exist or has been erased
			return null;
		}
		
		if (! $businessLogicDatabase->nonErasedUserExists($medication['creator'])) {
			// The creator doesn't exist or has been erased
			$medication['creator'] = null;
		}
		
		return $medication;
	}
	
	/*
	 * Loads a neurocognitive evaluation and returns it. If it doesn't exist or
	 * has been erased, null is returned.
	 * 
	 * It receives the neurocognitive evaluation's ID.
	 */
	private function loadNeurocognitiveEvaluation($neurocognitiveEvaluationId) {
		$businessLogicDatabase = $this->app->businessLogicDatabase;
		
		// Selects the neurocognitive evaluation
		$neurocognitiveEvaluation = $businessLogicDatabase->selectNonErasedNeurocognitiveEvaluation($neurocognitiveEvaluationId);
		
		if (is_null($neurocognitiveEvaluation)) {
			// The neurocognitive evaluation doesn't exist or has been erased
			return null;
		}
		
		if (! $businessLogicDatabase->nonErasedUserExists($neurocognitiveEvaluation['creator'])) {
			// The creator doesn't exist or has been erased
			$neurocognitiveEvaluation['creator'] = null;
		}
		
		return $neurocognitiveEvaluation;
	}
	
	/*
	 * Loads a patient and returns it. If it doesn't exist or has been erased,
	 * null is returned.
	 * 
	 * It receives the patient's ID.
	 */
	private function loadPatient($patientId) {
		$businessLogicDatabase = $this->app->businessLogicDatabase;
		
		// Selects the patient
		$patient = $businessLogicDatabase->selectNonErasedPatient($patientId);
		
		if (is_null($patient)) {
			// The patient doesn't exist or has been erased
			return null;
		}
		
		if (! $businessLogicDatabase->nonErasedUserExists($patient['creator'])) {
			// The creator doesn't exist or has been erased
			$patient['creator'] = null;
		}
		
		return $patient;
	}
	
	/*
	 * Loads a study and returns it. If it doesn't exist or has been erased,
	 * null is returned.
	 * 
	 * It receives the study's ID.
	 */
	private function loadStudy($studyId) {
		$businessLogicDatabase = $this->app->businessLogicDatabase;
		
		// Selects the study
		$study = $businessLogicDatabase->selectNonErasedStudy($studyId);
		
		if (is_null($study)) {
			// The study doesn't exist or has been erased
			return null;
		}
		
		if (! $businessLogicDatabase->nonErasedConsultationExists($study['consultation'])) {
			// The consultation doesn't exist or has been erased
			$study['consultation'] = null;
		}
		
		if (! $businessLogicDatabase->nonErasedUserExists($study['creator'])) {
			// The creator doesn't exist or has been erased
			$study['creator'] = null;
		}
		
		if (! $businessLogicDatabase->nonErasedExperimentExists($study['experiment'])) {
			// The experiment doesn't exist or has been erased
			$study['experiment'] = null;
		}
		
		$studyReport = $study['report'];
		if (! is_null($studyReport)) {
			if (! $businessLogicDatabase->nonErasedFileExists($studyReport)) {
				// The report doesn't exist or has been erased
				$study['report'] = null;
			}
		}
		
		// Loads the files
		$study['files'] = $businessLogicDatabase->selectStudyNonErasedFiles($studyId);
		
		return $study;
	}
	
	/*
	 * Loads a treatment and returns it. If it doesn't exist or has been erased,
	 * null is returned.
	 * 
	 * It receives the treatment's ID.
	 */
	private function loadTreatment($treatmentId) {
		$businessLogicDatabase = $this->app->businessLogicDatabase;
		
		// Selects the treatment
		$treatment = $businessLogicDatabase->selectNonErasedTreatment($treatmentId);
		
		if (is_null($treatment)) {
			// The treatment doesn't exist or has been erased
			return null;
		}
		
		if (! $businessLogicDatabase->nonErasedUserExists($treatment['creator'])) {
			// The creator doesn't exist or has been erased
			$treatment['creator'] = null;
		}
		
		return $treatment;
	}
	
	/*
	 * Loads a user and returns it. If it doesn't exist or has been erased, null
	 * is returned.
	 * 
	 * It receives the user's ID.
	 */
	private function loadUser($userId) {
		// Selects the user and returns it
		return $this->app->businessLogicDatabase->selectNonErasedUser($userId);
	}
	
}
