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
	
	// TODO: use private function getEntity?
	
	/*
	 * Returns a background, or null if it doesn't exists or has been erased.
	 * 
	 * It receives the background's ID.
	 */
	public function getBackground($backgroundId) {
		$backgrounds = &$this->cache['backgrounds'];
		
		if (! isset($backgrounds[$backgroundId])) {
			// The cache entry has not been initialized yet
			$backgrounds[$backgroundId] = $this->loadBackground($backgroundId);
		}
		
		// Returns the background from the cache
		return $backgrounds[$backgroundId];
	}
	
	/*
	 * Returns a clinical impression, or null if it doesn't exists or has been
	 * erased.
	 * 
	 * It receives the clinical impression's ID.
	 */
	public function getClinicalImpression($clinicalImpressionId) {
		$clinicalImpressions = &$this->cache['clinicalImpressions'];
		
		if (! isset($clinicalImpressions[$clinicalImpressionId])) {
			// The cache entry has not been initialized yet
			$clinicalImpressions[$clinicalImpressionId] = $this->loadClinicalImpression($clinicalImpressionId);
		}
		
		// Returns the clinical impression from the cache
		return $clinicalImpressions[$clinicalImpressionId];
	}
	
	/*
	 * Returns a consultation, or null if it doesn't exists or has been erased.
	 * 
	 * It receives the consultation's ID.
	 */
	public function getConsultation($consultationId) {
		$consultations = &$this->cache['consultations'];
		
		if (! isset($consultations[$consultationId])) {
			// The cache entry has not been initialized yet
			$consultations[$consultationId] = $this->loadConsultation($consultationId);
		}
		
		// Returns the consultation from the cache
		return $consultations[$consultationId];
	}
	
	/*
	 * Returns a diagnosis, or null if it doesn't exists or has been erased.
	 * 
	 * It receives the diagnosis's ID.
	 */
	public function getDiagnosis($diagnosisId) {
		$diagnoses = &$this->cache['diagnoses'];
		
		if (! isset($diagnoses[$diagnosisId])) {
			// The cache entry has not been initialized yet
			$diagnoses[$diagnosisId] = $this->loadDiagnosis($diagnosisId);
		}
		
		// Returns the diagnosis from the cache
		return $diagnoses[$diagnosisId];
	}
	
	/*
	 * Returns an experiment, or null if it doesn't exists or has been erased.
	 * 
	 * It receives the experiment's ID.
	 */
	public function getExperiment($experimentId) {
		$experiments = &$this->cache['experiments'];
		
		if (! isset($experiments[$experimentId])) {
			// The cache entry has not been initialized yet
			$experiments[$experimentId] = $this->loadExperiment($experimentId);
		}
		
		// Returns the experiment from the cache
		return $experiments[$experimentId];
	}
	
	/*
	 * Returns a file, or null if it doesn't exists or has been erased.
	 * 
	 * It receives the file's ID.
	 */
	public function getFile($fileId) {
		$files = &$this->cache['files'];
		
		if (! isset($files[$fileId])) {
			// The cache entry has not been initialized yet
			$files[$fileId] = $this->loadFile($fileId);
		}
		
		// Returns the file from the cache
		return $files[$fileId];
	}
	
	/*
	 * Returns an image test, or null if it doesn't exists or has been erased.
	 * 
	 * It receives the image test's ID.
	 */
	public function getImageTest($imageTestId) {
		$imageTests = &$this->cache['imageTests'];
		
		if (! isset($imageTests[$imageTestId])) {
			// The cache entry has not been initialized yet
			$imageTests[$imageTestId] = $this->loadImageTest($imageTestId);
		}
		
		// Returns the image test from the cache
		return $imageTests[$imageTestId];
	}
	
	/*
	 * Returns a laboratory test, or null if it doesn't exists or has been
	 * erased.
	 * 
	 * It receives the laboratory test's ID.
	 */
	public function getLaboratoryTest($laboratoryTestId) {
		$laboratoryTests = &$this->cache['laboratoryTests'];
		
		if (! isset($laboratoryTests[$laboratoryTestId])) {
			// The cache entry has not been initialized yet
			$laboratoryTests[$laboratoryTestId] = $this->loadLaboratoryTest($laboratoryTestId);
		}
		
		// Returns the laboratory test from the cache
		return $laboratoryTests[$laboratoryTestId];
	}
	
	/*
	 * Returns a medication, or null if it doesn't exists or has been erased.
	 * 
	 * It receives the medication's ID.
	 */
	public function getMedication($medicationId) {
		$medications = &$this->cache['medications'];
		
		if (! isset($medications[$medicationId])) {
			// The cache entry has not been initialized yet
			$medications[$medicationId] = $this->loadMedication($medicationId);
		}
		
		// Returns the medication from the cache
		return $medications[$medicationId];
	}
	
	/*
	 * Returns a neurocognitive evaluation, or null if it doesn't exists or has
	 * been erased.
	 * 
	 * It receives the neurocognitive evaluation's ID.
	 */
	public function getNeurocognitiveEvaluation($neurocognitiveEvaluationId) {
		$neurocognitiveEvaluations = &$this->cache['neurocognitiveEvaluations'];
		
		if (! isset($neurocognitiveEvaluations[$neurocognitiveEvaluationId])) {
			// The cache entry has not been initialized yet
			$neurocognitiveEvaluations[$neurocognitiveEvaluationId] = $this->loadNeurocognitiveEvaluation($neurocognitiveEvaluationId);
		}
		
		// Returns the neurocognitive evaluation from the cache
		return $neurocognitiveEvaluations[$neurocognitiveEvaluationId];
	}
	
	/*
	 * Returns a patient, or null if it doesn't exists or has been erased.
	 * 
	 * It receives the patient's ID.
	 */
	public function getPatient($patientId) {
		$patients = &$this->cache['patients'];
		
		if (! isset($patients[$patientId])) {
			// The cache entry has not been initialized yet
			$patients[$patientId] = $this->loadPatient($patientId);
		}
		
		// Returns the patient from the cache
		return $patients[$patientId];
	}
	
	/*
	 * Returns a study, or null if it doesn't exists or has been erased.
	 * 
	 * It receives the study's ID.
	 */
	public function getStudy($studyId) {
		$studies = &$this->cache['studies'];
		
		if (! isset($studies[$studyId])) {
			// The cache entry has not been initialized yet
			$studies[$studyId] = $this->loadStudy($studyId);
		}
		
		// Returns the study from the cache
		return $studies[$studyId];
	}
	
	/*
	 * Returns a treatment, or null if it doesn't exists or has been erased.
	 * 
	 * It receives the treatment's ID.
	 */
	public function getTreatment($treatmentId) {
		$treatments = &$this->cache['treatments'];
		
		if (! isset($treatments[$treatmentId])) {
			// The cache entry has not been initialized yet
			$treatments[$treatmentId] = $this->loadTreatment($treatmentId);
		}
		
		// Returns the treatment from the cache
		return $treatments[$treatmentId];
	}
	
	/*
	 * Returns a user, or null if it doesn't exists or has been erased.
	 * 
	 * It receives the user's ID.
	 */
	public function getUser($userId) {
		$users = &$this->cache['users'];
		
		if (! isset($users[$userId])) {
			// The cache entry has not been initialized yet
			$users[$userId] = $this->loadUser($userId);
		}
		
		// Returns the user from the cache
		return $users[$userId];
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
