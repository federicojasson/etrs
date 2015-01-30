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
	
	// TODO: add methods
	
	/*
	 * Performs initialization tasks.
	 */
	protected function initialize() {
		$app = $this->app;
		
		// Gets the signed in user
		$signedInUser = $app->account->getSignedInUser();
		
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
		foreach ($authorizedFields as $authorizedField) {
			$filteredEntity[$authorizedField] = $entity[$authorizedField];
		}
		
		return $filteredEntity;
	}
	
}
