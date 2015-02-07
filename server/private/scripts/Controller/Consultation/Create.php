<?php

namespace App\Controller\Consultation;

use App\Auxiliar\JsonStructureDescriptor\JsonArrayDescriptor;
use App\Auxiliar\JsonStructureDescriptor\JsonObjectDescriptor;
use App\Auxiliar\JsonStructureDescriptor\JsonValueDescriptor;

/*
 * This controller is responsible for the following service:
 * 
 * URL:		/server/consultation/create
 * Method:	POST
 */
class Create extends \App\Controller\SpecializedSecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Gets the input
		$clinicalImpression = $this->getInput('clinicalImpression', 'hex2bin');
		$diagnosis = $this->getInput('diagnosis', 'hex2bin');
		$patient = $this->getInput('patient', 'hex2bin');
		$date = $this->getInput('date');
		$reasons = $this->getInput('reasons', 'trimString');
		$indications = $this->getInput('indications', 'trimString');
		$observations = $this->getInput('observations', 'trimString');
		$backgrounds = $this->getinput('backgrounds', 'stringsToBinary');
		$imageTests = $this->getinput('imageTests', 'objectIdsToBinary');
		$laboratoryTests = $this->getinput('laboratoryTests', 'objectIdsToBinary');
		$medications = $this->getinput('medications', 'stringsToBinary');
		$neurocognitiveTests = $this->getinput('neurocognitiveTests', 'objectIdsToBinary');
		$treatments = $this->getinput('treatments', 'stringsToBinary');
		
		if (! is_null($clinicalImpression)) {
			// Checks the existence of the clinical impression
			$this->checkClinicalImpressionExistence($clinicalImpression);
		}
		
		if (! is_null($diagnosis)) {
			// Checks the existence of the diagnosis
			$this->checkDiagnosisExistence($diagnosis);
		}
		
		// Checks the existence of the patient
		$this->checkPatientExistence($patient);
		
		// Checks the existence of the backgrounds
		foreach ($backgrounds as $background) {
			$this->checkBackgroundExistence($background);
		}
		
		// Checks the existence of the medications
		foreach ($medications as $medication) {
			$this->checkMedicationExistence($medication);
		}
		
		// Checks the existence of the treatments
		foreach ($treatments as $treatment) {
			$this->checkTreatmentExistence($treatment);
		}
		
		// The image tests, laboratory tests and neurocognitive tests have
		// already been checked during the input validation
		
		// Generates a random ID
		$id = $app->cryptography->generateRandomId();
		
		// Gets the signed in user
		$signedInUser = $app->authentication->getSignedInUser();
		
		// Creates the consultation
		$app->data->consultation->create($id, $clinicalImpression, $signedInUser['id'], $diagnosis, $patient, $date, $reasons, $indications, $observations, $backgrounds, $imageTests, $laboratoryTests, $medications, $neurocognitiveTests, $treatments);
		
		// Sets an output
		$this->setOutput('id', $id, 'bin2hex');
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		$app = $this->app;
		
		// Defines the JSON structure descriptor
		$jsonStructureDescriptor = new JsonObjectDescriptor([
			'clinicalImpression' => new JsonValueDescriptor(function($input) use ($app) {
				if (is_null($input)) {
					return true;
				}
				
				return $app->inputValidator->isRandomId($input);
			}),
			
			'diagnosis' => new JsonValueDescriptor(function($input) use ($app) {
				if (is_null($input)) {
					return true;
				}
				
				return $app->inputValidator->isRandomId($input);
			}),
			
			'patient' => new JsonValueDescriptor(function($input) use ($app) {
				return $app->inputValidator->isRandomId($input);
			}),
			
			'date' => new JsonValueDescriptor(function($input) use ($app) {
				return $app->inputValidator->isDate($input);
			}),
			
			'reasons' => new JsonValueDescriptor(function($input) use ($app) {
				return $app->inputValidator->isValidText($input, 0, 1024);
			}),
			
			'indications' => new JsonValueDescriptor(function($input) use ($app) {
				return $app->inputValidator->isValidText($input, 0, 1024);
			}),
			
			'observations' => new JsonValueDescriptor(function($input) use ($app) {
				return $app->inputValidator->isValidText($input, 0, 1024);
			}),
			
			'backgrounds' => new JsonArrayDescriptor(
				new JsonValueDescriptor(function($input) use ($app) {
					return $app->inputValidator->isRandomId($input);
				})
			),
			
			'imageTests' => new JsonArrayDescriptor(
				new JsonObjectDescriptor([
					'id' => new JsonValueDescriptor(function($input) use ($app) {
						return $app->inputValidator->isRandomId($input);
					}),
					
					'value' => new JsonValueDescriptor(function() {
						// This input should be validated afterwards using the
						// data type descriptor
						return true;
					})
				])
			),
			
			'laboratoryTests' => new JsonArrayDescriptor(
				new JsonObjectDescriptor([
					'id' => new JsonValueDescriptor(function($input) use ($app) {
						return $app->inputValidator->isRandomId($input);
					}),
					
					'value' => new JsonValueDescriptor(function() {
						// This input should be validated afterwards using the
						// data type descriptor
						return true;
					})
				])
			),
			
			'medications' => new JsonArrayDescriptor(
				new JsonValueDescriptor(function($input) use ($app) {
					return $app->inputValidator->isRandomId($input);
				})
			),
			
			'neurocognitiveTests' => new JsonArrayDescriptor(
				new JsonObjectDescriptor([
					'id' => new JsonValueDescriptor(function($input) use ($app) {
						return $app->inputValidator->isRandomId($input);
					}),
					
					'value' => new JsonValueDescriptor(function() {
						// This input should be validated afterwards using the
						// data type descriptor
						return true;
					})
				])
			),
			
			'treatments' => new JsonArrayDescriptor(
				new JsonValueDescriptor(function($input) use ($app) {
					return $app->inputValidator->isRandomId($input);
				})
			)
		]);
		
		if (! $this->validateJsonRequest($jsonStructureDescriptor)) {
			// The JSON request is invalid
			return false;
		}
		
		// Gets the input
		$imageTests = $this->getInput('imageTests', 'objectIdsToBinary');
		$laboratoryTests = $this->getInput('laboratoryTests', 'objectIdsToBinary');
		$neurocognitiveTests = $this->getInput('neurocognitiveTests', 'objectIdsToBinary');
		
		// Validates the values of the image tests
		foreach ($imageTests as $imageTest) {
			if (! $this->validateImageTestValue($imageTest['id'], $imageTest['value'])) {
				// The value is invalid
				return false;
			}
		}
		
		// Validates the values of the laboratory tests
		foreach ($laboratoryTests as $laboratoryTest) {
			if (! $this->validateLaboratoryTestValue($laboratoryTest['id'], $laboratoryTest['value'])) {
				// The value is invalid
				return false;
			}
		}
		
		// Validates the values of the neurocognitive tests
		foreach ($neurocognitiveTests as $neurocognitiveTest) {
			if (! $this->validateNeurocognitiveTestValue($neurocognitiveTest['id'], $neurocognitiveTest['value'])) {
				// The value is invalid
				return false;
			}
		}
		
		return true;
	}
	
	/*
	 * Determines whether the user is authorized to use the service.
	 */
	protected function isUserAuthorized() {
		$app = $this->app;
		
		// Defines the authorized user roles
		$authorizedUserRoles = [
			USER_ROLE_ADMINISTRATOR,
			USER_ROLE_DOCTOR
		];
		
		// Validates the access and returns the result
		return $app->accessValidator->validateAccess($authorizedUserRoles);
	}
	
}
