<?php

/*
 * This helper is used to filter data before send it to the client.
 */
class DataFilter extends Helper {
	
	/*
	 * TODO: comments
	 * TODO: initialize
	 */
	private $authorizedFields;
	
	/*
	 * TODO: comments
	 */
	public function filterBackground($background) {
		$filteredBackground = $background;
		
		// Filters the fields
		$filteredBackground = $this->filterFields($filteredBackground, $this->authorizedFields['backgrounds']);
		
		// Converts the binary fields to hexadecimal
		$filteredBackground = $this->applyFunction('bin2hex', $filteredBackground, [
			'id'
		]);
		
		return $filteredBackground;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterClinicalImpression($clinicalImpression) {
		$filteredClinicalImpression = $clinicalImpression;
		
		// Filters the fields
		$filteredClinicalImpression = $this->filterFields($filteredClinicalImpression, $this->authorizedFields['clinicalImpressions']);
		
		// Converts the binary fields to hexadecimal
		$filteredClinicalImpression = $this->applyFunction('bin2hex', $filteredClinicalImpression, [
			'id'
		]);
		
		return $filteredClinicalImpression;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterConsultation($consultation) {
		$filteredConsultation = $consultation;
		
		// Filters the fields
		$filteredConsultation = $this->filterFields($filteredConsultation, $this->authorizedFields['consultations']);
		
		// Converts the binary fields to hexadecimal
		$filteredConsultation = $this->applyFunction('bin2hex', $filteredConsultation, [
			'id',
			'clinicalImpression',
			'diagnosis',
			'patient'
		]);
		
		return $filteredConsultation;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterDiagnosis($diagnosis) {
		$filteredDiagnosis = $diagnosis;
		
		// Filters the fields
		$filteredDiagnosis = $this->filterFields($filteredDiagnosis, $this->authorizedFields['diagnoses']);
		
		// Converts the binary fields to hexadecimal
		$filteredDiagnosis = $this->applyFunction('bin2hex', $filteredDiagnosis, [
			'id'
		]);
		
		return $filteredDiagnosis;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterExperiment($experiment) {
		$filteredExperiment = $experiment;
		
		// Filters the fields
		$filteredExperiment = $this->filterFields($filteredExperiment, $this->authorizedFields['experiments']);
		
		// Converts the binary fields to hexadecimal
		$filteredExperiment = $this->applyFunction('bin2hex', $filteredExperiment, [
			'id'
		]);
		
		return $filteredExperiment;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterFile($file) {
		$filteredFile = $file;
		
		// Filters the fields
		$filteredFile = $this->filterFields($filteredFile, $this->authorizedFields['files']);
		
		// Converts the binary fields to hexadecimal
		$filteredFile = $this->applyFunction('bin2hex', $filteredFile, [
			'id',
			'hash'
		]);
		
		return $filteredFile;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterImageTest($imageTest) {
		$filteredImageTest = $imageTest;
		
		// Filters the fields
		$filteredImageTest = $this->filterFields($filteredImageTest, $this->authorizedFields['imageTests']);
		
		// Converts the binary fields to hexadecimal
		$filteredImageTest = $this->applyFunction('bin2hex', $filteredImageTest, [
			'id'
		]);
		
		return $filteredImageTest;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterLaboratoryTest($laboratoryTest) {
		$filteredLaboratoryTest = $laboratoryTest;
		
		// Filters the fields
		$filteredLaboratoryTest = $this->filterFields($filteredLaboratoryTest, $this->authorizedFields['laboratoryTests']);
		
		// Converts the binary fields to hexadecimal
		$filteredLaboratoryTest = $this->applyFunction('bin2hex', $filteredLaboratoryTest, [
			'id'
		]);
		
		return $filteredLaboratoryTest;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterMedication($medication) {
		$filteredMedication = $medication;
		
		// Filters the fields
		$filteredMedication = $this->filterFields($filteredMedication, $this->authorizedFields['medications']);
		
		// Converts the binary fields to hexadecimal
		$filteredMedication = $this->applyFunction('bin2hex', $filteredMedication, [
			'id'
		]);
		
		return $filteredMedication;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterNeurocognitiveEvaluation($neurocognitiveEvaluation) {
		$filteredNeurocognitiveEvaluation = $neurocognitiveEvaluation;
		
		// Filters the fields
		$filteredNeurocognitiveEvaluation = $this->filterFields($filteredNeurocognitiveEvaluation, $this->authorizedFields['neurocognitiveEvaluations']);
		
		// Converts the binary fields to hexadecimal
		$filteredNeurocognitiveEvaluation = $this->applyFunction('bin2hex', $filteredNeurocognitiveEvaluation, [
			'id'
		]);
		
		return $filteredNeurocognitiveEvaluation;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterPatient($patient) {
		$filteredPatient = $patient;
		
		// Filters the fields
		$filteredPatient = $this->filterFields($filteredPatient, $this->authorizedFields['patients']);
		
		// Converts the binary fields to hexadecimal
		$filteredPatient = $this->applyFunction('bin2hex', $filteredPatient, [
			'id'
		]);
		
		return $filteredPatient;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterStudy($study) {
		$filteredStudy = $study;
		
		// Filters the fields
		$filteredStudy = $this->filterFields($filteredStudy, $this->authorizedFields['studies']);
		
		// Converts the binary fields to hexadecimal
		$filteredStudy = $this->applyFunction('bin2hex', $filteredStudy, [
			'id',
			'consultation',
			'experiment',
			'report'
		]);
		
		return $filteredStudy;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterTreatment($treatment) {
		$filteredTreatment = $treatment;
		
		// Filters the fields
		$filteredTreatment = $this->filterFields($filteredTreatment, $this->authorizedFields['treatments']);
		
		// Converts the binary fields to hexadecimal
		$filteredTreatment = $this->applyFunction('bin2hex', $filteredTreatment, [
			'id'
		]);
		
		return $filteredTreatment;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterUser($user) {
		$filteredUser = $user;
		
		// Filters the fields
		$filteredUser = $this->filterFields($filteredUser, $this->authorizedFields['users']);
		
		// Converts the binary fields to hexadecimal
		$filteredUser = $this->applyFunction('bin2hex', $filteredUser, [
			'passwordHash',
			'passwordSalt'
		]);
		
		return $filteredUser;
	}
	
	/*
	 * Performs initialization tasks.
	 */
	protected function initialize() {
		// Initializes the authorized fields according to the role of the logged
		// in user
		switch ($this->app->authentication->getLoggedInUser()['role']) {
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
	 * TODO: comments
	 * 
	 * TODO: name
	 */
	private function applyFunction($function, $entity, $consideredFields) {
		// Applies the function to the considered fields of the entity
		$count = count($consideredFields);
		for ($i = 0; $i < $count; $i++) {
			$field = $consideredFields[$i];
			
			if (isset($entity[$field])) {
				// The entity contains the field
				
				// Applies the function
				$entity[$field] = call_user_func($function, $entity[$field]);
			}
		}
		
		return $entity;
	}
	
	/*
	 * TODO: comments
	 */
	private function filterFields($entity, $authorizedFields) {
		// Initializes the filtered entity
		$filteredEntity = [];
		
		// Filters the fields of the entity, leaving only the authorized ones
		$count = count($authorizedFields);
		for ($i = 0; $i < $count; $i++) {
			$field = $authorizedFields[$i];
			
			// Sets the field in the filtered entity
			$filteredEntity[$field] = $entity[$field];
		}
		
		return $filteredEntity;
	}
	
	/*
	 * TODO: comments
	 */
	private function initializeAdministratorAuthorizedFields() {
		$this->authorizedFields = [
			'backgrounds' => [
				// TODO: define fields
				'id',
				'isErased',
				'creator',
				'creationDatetime',
				'name'
			],
			
			'clinicalImpressions' => [
				// TODO: define fields
				'id',
				'isErased',
				'creator',
				'creationDatetime',
				'name'
			],
			
			'consultations' => [
				// TODO: define fields
				'id',
				'isErased',
				'clinicalImpression',
				'creator',
				'diagnosis',
				'patient',
				'creationDatetime',
				'date',
				'reasons',
				'observations',
				'indications'
			],
			
			'diagnoses' => [
				// TODO: define fields
				'id',
				'isErased',
				'creator',
				'creationDatetime',
				'name'
			],
			
			'experiments' => [
				// TODO: define fields
				'id',
				'isErased',
				'creator',
				'creationDatetime',
				'name',
				'commandLine'
			],
			
			'files' => [
				// TODO: define fields
				'id',
				'isErased',
				'creator',
				'creationDatetime',
				'name',
				'hash'
			],
			
			'imageTests' => [
				// TODO: define fields
				'id',
				'isErased',
				'creator',
				'creationDatetime',
				'name',
				'dataTypeDefinition'
			],
			
			'laboratoryTests' => [
				// TODO: define fields
				'id',
				'isErased',
				'creator',
				'creationDatetime',
				'name',
				'dataTypeDefinition'
			],
			
			'medications' => [
				// TODO: define fields
				'id',
				'isErased',
				'creator',
				'creationDatetime',
				'name'
			],
			
			'neurocognitiveEvaluations' => [
				// TODO: define fields
				'id',
				'isErased',
				'creator',
				'creationDatetime',
				'name',
				'dataTypeDefinition'
			],
			
			'patients' => [
				// TODO: define fields
				'id',
				'isErased',
				'creator',
				'creationDatetime',
				'firstNames',
				'lastNames',
				'gender',
				'birthDate',
				'educationYears'
			],
			
			'studies' => [
				// TODO: define fields
				'id',
				'isErased',
				'consultation',
				'creator',
				'experiment',
				'report',
				'creationDatetime',
				'observations'
			],
			
			'treatments' => [
				// TODO: define fields
				'id',
				'isErased',
				'creator',
				'creationDatetime',
				'name'
			],
			
			'users' => [
				// TODO: define fields
				'id', // TODO: send id?
				'lastNames',
				'gender',
				'role'
			]
		];
	}
	
	/*
	 * TODO: comments
	 */
	private function initializeDoctorAuthorizedFields() {
		$this->authorizedFields = [
			'backgrounds' => [
				// TODO: define fields
			],
			
			'clinicalImpressions' => [
				// TODO: define fields
			],
			
			'consultations' => [
				// TODO: define fields
			],
			
			'diagnoses' => [
				// TODO: define fields
			],
			
			'experiments' => [
				// TODO: define fields
			],
			
			'files' => [
				// TODO: define fields
			],
			
			'imageTests' => [
				// TODO: define fields
			],
			
			'laboratoryTests' => [
				// TODO: define fields
			],
			
			'medications' => [
				// TODO: define fields
			],
			
			'neurocognitiveEvaluations' => [
				// TODO: define fields
			],
			
			'patients' => [
				// TODO: define fields
			],
			
			'studies' => [
				// TODO: define fields
			],
			
			'treatments' => [
				// TODO: define fields
			],
			
			'users' => [
				// TODO: define fields
			]
		];
	}
	
	/*
	 * TODO: comments
	 */
	private function initializeOperatorAuthorizedFields() {
		$this->authorizedFields = [
			'backgrounds' => [
				// TODO: define fields
			],
			
			'clinicalImpressions' => [
				// TODO: define fields
			],
			
			'consultations' => [
				// TODO: define fields
			],
			
			'diagnoses' => [
				// TODO: define fields
			],
			
			'experiments' => [
				// TODO: define fields
			],
			
			'files' => [
				// TODO: define fields
			],
			
			'imageTests' => [
				// TODO: define fields
			],
			
			'laboratoryTests' => [
				// TODO: define fields
			],
			
			'medications' => [
				// TODO: define fields
			],
			
			'neurocognitiveEvaluations' => [
				// TODO: define fields
			],
			
			'patients' => [
				// TODO: define fields
			],
			
			'studies' => [
				// TODO: define fields
			],
			
			'treatments' => [
				// TODO: define fields
			],
			
			'users' => [
				// TODO: define fields
			]
		];
	}
	
}
