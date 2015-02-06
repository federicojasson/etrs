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
		$backgrounds = $this->getinput('backgrounds');
		$imageTests = $this->getinput('imageTests');
		$laboratoryTests = $this->getinput('laboratoryTests');
		$medications = $this->getinput('medications');
		$neurocognitiveTests = $this->getinput('neurocognitiveTests');
		$treatments = $this->getinput('treatments');
		
		// Checks the existence of the consultation
		$this->checkConsultationExistence($id);
		
		// TODO: checks
		
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
					'id' => new JsonValue(function($input) use ($app) {
						return $app->inputValidator->isRandomId($input);
					}),
					
					'value' => new JsonValue(function() {
						// This input should be validated afterwards using the
						// data type descriptor
						return true;
					})
				])
			),
			
			'laboratoryTests' => new JsonArrayDescriptor(
				new JsonObjectDescriptor([
					'id' => new JsonValue(function($input) use ($app) {
						return $app->inputValidator->isRandomId($input);
					}),
					
					'value' => new JsonValue(function() {
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
					'id' => new JsonValue(function($input) use ($app) {
						return $app->inputValidator->isRandomId($input);
					}),
					
					'value' => new JsonValue(function() {
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
		
		// Validates the JSON request and returns the result
		return $this->validateJsonRequest($jsonStructureDescriptor);
		
		// TODO
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
	
	/*
	 * Checks the existence of a consultation. If it doesn't exist, the
	 * execution is halted.
	 * 
	 * It receives the consultation's ID.
	 */
	private function checkConsultationExistence($id) {
		$app = $this->app;
		
		if (! $app->data->consultation->exists($id)) {
			// The consultation doesn't exist
			
			// Halts the execution
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'error' => ERROR_NON_EXISTENT_CONSULTATION
			]);
		}
	}
	
}
