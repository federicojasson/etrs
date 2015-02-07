<?php

namespace App\Controller\Consultation;

use App\Auxiliar\JsonStructureDescriptor\JsonArrayDescriptor;
use App\Auxiliar\JsonStructureDescriptor\JsonObjectDescriptor;
use App\Auxiliar\JsonStructureDescriptor\JsonValueDescriptor;

/*
 * This controller is responsible for the following service:
 * 
 * URL:		/server/consultation/edit
 * Method:	POST
 */
class Edit extends \App\Controller\SpecializedSecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Gets the input
		$id = $this->getInput('id', 'hex2bin');
		$clinicalImpression = $this->getInput('clinicalImpression', 'hex2bin');
		$diagnosis = $this->getInput('diagnosis', 'hex2bin');
		$date = $this->getInput('date');
		$reasons = $this->getInput('reasons', 'trimString');
		$indications = $this->getInput('indications', 'trimString');
		$observations = $this->getInput('observations', 'trimString');
		$backgrounds = $this->getinput('backgrounds', 'hexadecimalsToBinaries');
		$imageTests = $this->getinput('imageTests', 'idsToBinary'); // TODO: idsToBinary?
		$laboratoryTests = $this->getinput('laboratoryTests', 'idsToBinary'); // TODO: idsToBinary?
		$medications = $this->getinput('medications', 'hexadecimalsToBinaries');
		$neurocognitiveTests = $this->getinput('neurocognitiveTests', 'idsToBinary'); // TODO: idsToBinary?
		$treatments = $this->getinput('treatments', 'hexadecimalsToBinaries');
		
		// Checks the existence of the consultation
		$this->checkConsultationExistence($id);
		
		if (! is_null($clinicalImpression)) {
			// Checks the existence of the clinical impression
			$this->checkClinicalImpressionExistence($clinicalImpression);
		}
		
		if (! is_null($diagnosis)) {
			// Checks the existence of the diagnosis
			$this->checkDiagnosisExistence($diagnosis);
		}
		
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
		
		// Gets the signed in user
		$signedInUser = $app->authentication->getSignedInUser();
		
		// Edits the consultation
		$app->data->consultation->edit($id, $clinicalImpression, $diagnosis, $signedInUser['id'], $date, $reasons, $indications, $observations, $backgrounds, $imageTests, $laboratoryTests, $medications, $neurocognitiveTests, $treatments);
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		$app = $this->app;
		
		// Defines the JSON structure descriptor
		$jsonStructureDescriptor = new JsonObjectDescriptor([
			'id' => new JsonValueDescriptor(function($input) use ($app) {
				return $app->inputValidator->isRandomId($input);
			}),
			
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
		$imageTests = $this->getInput('imageTests', 'idsToBinary'); // TODO: idsToBinary?
		$laboratoryTests = $this->getInput('laboratoryTests', 'idsToBinary'); // TODO: idsToBinary?
		$neurocognitiveTests = $this->getInput('neurocognitiveTests', 'idsToBinary'); // TODO: idsToBinary?
		
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
