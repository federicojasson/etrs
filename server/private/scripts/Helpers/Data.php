<?php

namespace App\Helpers;

/*
 * This helper offers data-related functionalities.
 */
class Data extends \App\Helpers\Helper {
	
	/*
	 * The fields authorized to be retrieved for each data type.
	 */
	private $authorizedFields;
	
	/*
	 * Filters a background and returns the result.
	 * 
	 * It receives the background.
	 */
	public function filterBackground($background) {
		$app = $this->app;
		
		// Initializes the filtered background
		$filteredBackground = $background;
		
		// Removes the background's unauthorized fields
		$filteredBackground = $this->removeUnauthorizedFields($filteredBackground, $this->authorizedFields['backgrounds']);
		
		if (array_key_exists('id', $filteredBackground)) {
			$filteredBackground['id'] = bin2hex($background['id']);
		}
		
		return $filteredBackground;
	}
	
	/*
	 * Filters a clinical impression and returns the result.
	 * 
	 * It receives the clinical impression.
	 */
	public function filterClinicalImpression($clinicalImpression) {
		$app = $this->app;
		
		// Initializes the filtered clinical impression
		$filteredClinicalImpression = $clinicalImpression;
		
		// Removes the clinical impression's unauthorized fields
		$filteredClinicalImpression = $this->removeUnauthorizedFields($filteredClinicalImpression, $this->authorizedFields['clinicalImpressions']);
		
		if (array_key_exists('id', $filteredClinicalImpression)) {
			$filteredClinicalImpression['id'] = bin2hex($clinicalImpression['id']);
		}
		
		return $filteredClinicalImpression;
	}
	
	/*
	 * Filters a diagnosis and returns the result.
	 * 
	 * It receives the diagnosis.
	 */
	public function filterDiagnosis($diagnosis) {
		$app = $this->app;
		
		// Initializes the filtered diagnosis
		$filteredDiagnosis = $diagnosis;
		
		// Removes the diagnosis' unauthorized fields
		$filteredDiagnosis = $this->removeUnauthorizedFields($filteredDiagnosis, $this->authorizedFields['diagnoses']);
		
		if (array_key_exists('id', $filteredDiagnosis)) {
			$filteredDiagnosis['id'] = bin2hex($diagnosis['id']);
		}
		
		return $filteredDiagnosis;
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
		
		if (array_key_exists('id', $filteredImageTest)) {
			$filteredImageTest['id'] = bin2hex($imageTest['id']);
		}
		
		return $filteredImageTest;
	}
	
	/*
	 * Filters a laboratory test and returns the result.
	 * 
	 * It receives the laboratory test.
	 */
	public function filterLaboratoryTest($laboratoryTest) {
		$app = $this->app;
		
		// Initializes the filtered laboratory test
		$filteredLaboratoryTest = $laboratoryTest;
		
		// Removes the laboratory test's unauthorized fields
		$filteredLaboratoryTest = $this->removeUnauthorizedFields($filteredLaboratoryTest, $this->authorizedFields['laboratoryTests']);
		
		if (array_key_exists('id', $filteredLaboratoryTest)) {
			$filteredLaboratoryTest['id'] = bin2hex($laboratoryTest['id']);
		}
		
		return $filteredLaboratoryTest;
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
		
		if (array_key_exists('id', $filteredMedication)) {
			$filteredMedication['id'] = bin2hex($medication['id']);
		}
		
		return $filteredMedication;
	}
	
	/*
	 * Filters a neurocognitive test and returns the result.
	 * 
	 * It receives the neurocognitive test.
	 */
	public function filterNeurocognitiveTest($neurocognitiveTest) {
		$app = $this->app;
		
		// Initializes the filtered neurocognitive test
		$filteredNeurocognitiveTest = $neurocognitiveTest;
		
		// Removes the neurocognitive test's unauthorized fields
		$filteredNeurocognitiveTest = $this->removeUnauthorizedFields($filteredNeurocognitiveTest, $this->authorizedFields['neurocognitiveTests']);
		
		if (array_key_exists('id', $filteredNeurocognitiveTest)) {
			$filteredNeurocognitiveTest['id'] = bin2hex($neurocognitiveTest['id']);
		}
		
		return $filteredNeurocognitiveTest;
	}
	
	/*
	 * Filters a treatment and returns the result.
	 * 
	 * It receives the treatment.
	 */
	public function filterTreatment($treatment) {
		$app = $this->app;
		
		// Initializes the filtered treatment
		$filteredTreatment = $treatment;
		
		// Removes the treatment's unauthorized fields
		$filteredTreatment = $this->removeUnauthorizedFields($filteredTreatment, $this->authorizedFields['treatments']);
		
		if (array_key_exists('id', $filteredTreatment)) {
			$filteredTreatment['id'] = bin2hex($treatment['id']);
		}
		
		return $filteredTreatment;
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
				'id',
				'isErased',
				'name',
				'creator',
				'creationDatetime',
				'dataTypeDefinition'
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
		foreach ($authorizedFields as $authorizedField) {
			$filteredEntity[$authorizedField] = $entity[$authorizedField];
		}
		
		return $filteredEntity;
	}
	
}
