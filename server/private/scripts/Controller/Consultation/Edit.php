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
		$backgrounds = $this->getinput('backgrounds', 'stringsToBinary');
		$imageTests = $this->getinput('imageTests', 'objectIdsToBinary');
		$laboratoryTests = $this->getinput('laboratoryTests', 'objectIdsToBinary');
		$medications = $this->getinput('medications', 'stringsToBinary');
		$neurocognitiveTests = $this->getinput('neurocognitiveTests', 'objectIdsToBinary');
		$treatments = $this->getinput('treatments', 'stringsToBinary');
		
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
		$this->checkBackgroundsExistence($backgrounds);
		
		// Checks the existence of the medications
		$this->checkMedicationsExistence($medications);
		
		// Checks the existence of the treatments
		$this->checkTreatmentsExistence($treatments);
		
		// The image tests, laboratory tests and neurocognitive tests existence
		// has already been checked during the input validation
		
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
		$backgrounds = $this->getinput('backgrounds', 'stringsToBinary');
		$imageTests = $this->getinput('imageTests', 'objectIdsToBinary');
		$laboratoryTests = $this->getinput('laboratoryTests', 'objectIdsToBinary');
		$medications = $this->getinput('medications', 'stringsToBinary');
		$neurocognitiveTests = $this->getinput('neurocognitiveTests', 'objectIdsToBinary');
		$treatments = $this->getinput('treatments', 'stringsToBinary');
		
		if (! $this->areValidBackgrounds($backgrounds)) {
			// The backgrounds are invalid
			return false;
		}
		
		if (! $this->areValidImageTests($imageTests)) {
			// The image tests are invalid
			return false;
		}
		
		if (! $this->areValidLaboratoryTests($laboratoryTests)) {
			// The laboratory tests are invalid
			return false;
		}
		
		if (! $this->areValidMedications($medications)) {
			// The medications are invalid
			return false;
		}
		
		if (! $this->areValidNeurocognitiveTests($neurocognitiveTests)) {
			// The neurocognitive tests are invalid
			return false;
		}
		
		if (! $this->areValidTreatments($treatments)) {
			// The treatments are invalid
			return false;
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
