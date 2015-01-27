<?php

namespace App\Helpers;

/*
 * This helper is used to filter data before send it to the client.
 */
class DataFilter extends \App\Helpers\Helper {
	
	/*
	 * The fields authorized to be retrieved for each data type.
	 */
	private $authorizedFields;
	
	/*
	 * Filters a consultation and returns the result.
	 * 
	 * It receives the consultation.
	 */
	public function filterConsultation($consultation) {
		$app = $this->app;
		
		// Initializes the filtered consultation
		$filteredConsultation = $consultation;
		$filteredConsultation['backgrounds'] = [];
		$filteredConsultation['imageTests'] = [];
		$filteredConsultation['laboratoryTests'] = [];
		$filteredConsultation['medications'] = [];
		$filteredConsultation['neurocognitiveTests'] = [];
		$filteredConsultation['treatments'] = [];
		
		// Removes the consultation's unauthorized fields
		$filteredConsultation = $this->removeUnauthorizedFields($filteredConsultation, $this->authorizedFields['consultations']);
		
		// TODO: filter fields
		
		return $filteredConsultation;
	}
	
	/*
	 * Filters an experiment and returns the result.
	 * 
	 * It receives the experiment.
	 */
	public function filterExperiment($experiment) {
		$app = $this->app;
		
		// Initializes the filtered experiment
		$filteredExperiment = $experiment;
		$filteredExperiment['files'] = [];
		
		// Removes the experiment's unauthorized fields
		$filteredExperiment = $this->removeUnauthorizedFields($filteredExperiment, $this->authorizedFields['experiments']);
		
		if (isset($filteredExperiment['id'])) {
			$filteredExperiment['id'] = bin2hex($experiment['id']);
		}
		
		if (isset($filteredExperiment['files'])) {
			$files = $app->businessLogicDatabase->getExperimentNonErasedFiles($experiment['id']);
			
			$count = count($files);
			for ($i = 0; $i < $count; $i++) {
				$filteredExperiment['files'][$i] = bin2hex($files[$i]['id']);
			}
		}
		
		return $filteredExperiment;
	}
	
	/*
	 * Filters an image test and returns the result.
	 * 
	 * It receives the image test.
	 */
	public function filterImageTest($imageTest) {
		$app = $this->app;
		
		// Initializes the filtered image test
		$filteredImageTest = $imageTest;
		
		// Removes the image test's unauthorized fields
		$filteredImageTest = $this->removeUnauthorizedFields($filteredImageTest, $this->authorizedFields['imageTests']);
		
		if (isset($filteredImageTest['id'])) {
			$filteredImageTest['id'] = bin2hex($imageTest['id']);
		}
		
		return $filteredImageTest;
	}
	
	/*
	 * Filters a medication and returns the result.
	 * 
	 * It receives the medication.
	 */
	public function filterMedication($medication) {
		$app = $this->app;
		
		// Initializes the filtered medication
		$filteredMedication = $medication;
		
		// Removes the medication's unauthorized fields
		$filteredMedication = $this->removeUnauthorizedFields($filteredMedication, $this->authorizedFields['medications']);
		
		if (isset($filteredMedication['id'])) {
			$filteredMedication['id'] = bin2hex($medication['id']);
		}
		
		return $filteredMedication;
	}
	
	/*
	 * Filters a patient and returns the result.
	 * 
	 * It receives the patient.
	 */
	public function filterPatient($patient) {
		$app = $this->app;
		
		// Initializes the filtered patient
		$filteredPatient = $patient;
		
		// Removes the patient's unauthorized fields
		$filteredPatient = $this->removeUnauthorizedFields($filteredPatient, $this->authorizedFields['patients']);
		
		if (isset($filteredPatient['id'])) {
			$filteredPatient['id'] = bin2hex($patient['id']);
		}
		
		return $filteredPatient;
	}
	
	/*
	 * Filters a study and returns the result.
	 * 
	 * It receives the study.
	 */
	public function filterStudy($study) {
		$app = $this->app;
		
		// Initializes the filtered study
		$filteredStudy = $study;
		
		// Removes the study's unauthorized fields
		$filteredStudy = $this->removeUnauthorizedFields($filteredStudy, $this->authorizedFields['studies']);
		
		if (isset($filteredStudy['id'])) {
			$filteredStudy['id'] = bin2hex($study['id']);
		}
		
		if (isset($filteredStudy['consultation'])) {
			$filteredStudy['consultation'] = bin2hex($study['consultation']);
		}
		
		if (isset($filteredStudy['experiment'])) {
			$filteredStudy['experiment'] = bin2hex($study['experiment']);
		}
		
		if (isset($filteredStudy['report'])) {
			if (! is_null($study['report'])) {
				if ($app->businessLogicDatabase->nonErasedFileExists($study['report'])) {
					$filteredStudy['report'] = bin2hex($study['report']);
				} else {
					$filteredStudy['report'] = null;
				}
			}
		}
		
		if (isset($filteredStudy['files'])) {
			$files = $app->businessLogicDatabase->getStudyNonErasedFiles($study['id']);
			
			$count = count($files);
			for ($i = 0; $i < $count; $i++) {
				$filteredStudy['files'][$i] = bin2hex($files[$i]['id']);
			}
		}
		
		return $filteredStudy;
	}
	
	/*
	 * Performs initialization tasks.
	 */
	protected function initialize() {
		$app = $this->app;
		
		// Gets the signed in user
		$signedInUser = $app->authentication->getSignedInUser();
		
		// Initializes the authorized fields according to the role of the user
		switch ($signedInUser['role']) {
			case USER_ROLE_ADMINISTRATOR: {
				$this->initializeAdministratorAuthorizedFields();
				break;
			}
			
			case USER_ROLE_DOCTOR: {
				$this->initializeDoctorAuthorizedFields();
				break;
			}
			
			case USER_ROLE_OPERATOR: {
				$this->initializeOperatorAuthorizedFields();
				break;
			}
		}
	}
	
	/*
	 * Initializes the fields authorized to be retrieved by administrators.
	 */
	private function initializeAdministratorAuthorizedFields() {
		// Initializes the authorized fields
		$this->authorizedFields = [
			'backgrounds' => [
				// TODO: define authorized fields
			],
			
			'clinicalImpressions' => [
				// TODO: define authorized fields
			],
			
			'consultations' => [
				// TODO: define authorized fields
			],
			
			'diagnoses' => [
				// TODO: define authorized fields
			],
			
			'experiments' => [
				// TODO: define authorized fields
			],
			
			'files' => [
				// TODO: define authorized fields
			],
			
			'imageTests' => [
				// TODO: define authorized fields
			],
			
			'laboratoryTests' => [
				// TODO: define authorized fields
			],
			
			'medications' => [
				// TODO: define authorized fields
			],
			
			'neurocognitiveTests' => [
				// TODO: define authorized fields
			],
			
			'patients' => [
				// TODO: define authorized fields
			],
			
			'studies' => [
				// TODO: define authorized fields
			],
			
			'treatments' => [
				// TODO: define authorized fields
			]
		];
	}
	
	/*
	 * Initializes the fields authorized to be retrieved by doctors.
	 */
	private function initializeDoctorAuthorizedFields() {
		// Initializes the authorized fields
		$this->authorizedFields = [
			'backgrounds' => [
				// TODO: define authorized fields
			],
			
			'clinicalImpressions' => [
				// TODO: define authorized fields
			],
			
			'consultations' => [
				// TODO: define authorized fields
			],
			
			'diagnoses' => [
				// TODO: define authorized fields
			],
			
			'experiments' => [
				// TODO: define authorized fields
			],
			
			'files' => [
				// TODO: define authorized fields
			],
			
			'imageTests' => [
				// TODO: define authorized fields
			],
			
			'laboratoryTests' => [
				// TODO: define authorized fields
			],
			
			'medications' => [
				// TODO: define authorized fields
			],
			
			'neurocognitiveTests' => [
				// TODO: define authorized fields
			],
			
			'patients' => [
				// TODO: define authorized fields
			],
			
			'studies' => [
				// TODO: define authorized fields
			],
			
			'treatments' => [
				// TODO: define authorized fields
			]
		];
	}
	
	/*
	 * Initializes the fields authorized to be retrieved by operators.
	 */
	private function initializeOperatorAuthorizedFields() {
		// Initializes the authorized fields
		$this->authorizedFields = [
			'backgrounds' => [
				// TODO: define authorized fields
			],
			
			'clinicalImpressions' => [
				// TODO: define authorized fields
			],
			
			'consultations' => [
				// TODO: define authorized fields
			],
			
			'diagnoses' => [
				// TODO: define authorized fields
			],
			
			'experiments' => [
				// TODO: define authorized fields
			],
			
			'files' => [
				// TODO: define authorized fields
			],
			
			'imageTests' => [
				// TODO: define authorized fields
			],
			
			'laboratoryTests' => [
				// TODO: define authorized fields
			],
			
			'medications' => [
				// TODO: define authorized fields
			],
			
			'neurocognitiveTests' => [
				// TODO: define authorized fields
			],
			
			'patients' => [
				// TODO: define authorized fields
			],
			
			'studies' => [
				// TODO: define authorized fields
			],
			
			'treatments' => [
				// TODO: define authorized fields
			]
		];
	}
	
	/*
	 * Removes the unauthorized fields of an entity.
	 * 
	 * It receives the entity and the authorized fields.
	 */
	private function removeUnauthorizedFields($entity, $authorizedFields) {
		// Initializes the filtered entity
		$filteredEntity = [];
		
		// Adds the authorized fields to the filtered entity
		$count = count($authorizedFields);
		for ($i = 0; $i < $count; $i++) {
			$authorizedField = $authorizedFields[$i];
			$filteredEntity[$authorizedField] = $entity[$authorizedField];
		}
		
		return $filteredEntity;
	}
	
}
