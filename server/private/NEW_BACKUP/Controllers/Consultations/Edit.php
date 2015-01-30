<?php

namespace App\Controllers\Consultations;

/*
 * This controller is responsible for the following service:
 * 
 * URL:		/server/consultations/edit
 * Method:	POST
 */
class Edit extends \App\Controllers\SecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Gets the input
		$input = $app->request->getBody();
		$id = hex2bin($input['id']);
		$clinicalImpression = (is_null($input['clinicalImpression']))? null : hex2bin($input['clinicalImpression']);
		$diagnosis = (is_null($input['diagnosis']))? null : hex2bin($input['diagnosis']);
		$date = $input['date'];
		$reasons = trimString($input['reasons']);
		$indications = trimString($input['indications']);
		$observations = trimString($input['observations']);
		$backgrounds = $input['backgrounds'];
		$imageTests = $input['imageTests'];
		$laboratoryTests = $input['laboratoryTests'];
		$medications = $input['medications'];
		$neurocognitiveTests = $input['neurocognitiveTests'];
		$treatments = $input['treatments'];
		
		// Starts a read-write transaction
		$app->businessLogicDatabase->startReadWriteTransaction();
		
		if (! $app->businessLogicDatabase->nonErasedConsultationExists($id)) {
			// The consultation doesn't exist
			
			// Rolls back the transaction
			$app->businessLogicDatabase->rollBackTransaction();
			
			// Halts the execution
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'error' => ERROR_NON_EXISTENT_CONSULTATION
			]);
		}
		
		if (! is_null($clinicalImpression)) {
			if (! $app->businessLogicDatabase->nonErasedClinicalImpressionExists($clinicalImpression)) {
				// The clinical impression doesn't exist

				// Rolls back the transaction
				$app->businessLogicDatabase->rollBackTransaction();

				// Halts the execution
				$app->halt(HTTP_STATUS_NOT_FOUND, [
					'error' => ERROR_NON_EXISTENT_CLINICAL_IMPRESSION
				]);
			}
		}
		
		if (! is_null($diagnosis)) {
			if (! $app->businessLogicDatabase->nonErasedDiagnosisExists($diagnosis)) {
				// The diagnosis doesn't exist

				// Rolls back the transaction
				$app->businessLogicDatabase->rollBackTransaction();

				// Halts the execution
				$app->halt(HTTP_STATUS_NOT_FOUND, [
					'error' => ERROR_NON_EXISTENT_DIAGNOSIS
				]);
			}
		}
		
		foreach ($backgrounds as $background) {
			if (! $app->businessLogicDatabase->nonErasedBackgroundExists($background)) {
				// The background doesn't exist

				// Rolls back the transaction
				$app->businessLogicDatabase->rollBackTransaction();

				// Halts the execution
				$app->halt(HTTP_STATUS_NOT_FOUND, [
					'error' => ERROR_NON_EXISTENT_BACKGROUND
				]);
			}
		}
		
		foreach ($imageTests as $imageTest) {
			if (! $app->businessLogicDatabase->nonErasedImageTestExists($imageTest)) {
				// The image test doesn't exist

				// Rolls back the transaction
				$app->businessLogicDatabase->rollBackTransaction();

				// Halts the execution
				$app->halt(HTTP_STATUS_NOT_FOUND, [
					'error' => ERROR_NON_EXISTENT_IMAGE_TEST
				]);
			}
		}
		
		foreach ($laboratoryTests as $laboratoryTest) {
			if (! $app->businessLogicDatabase->nonErasedLaboratoryTestExists($laboratoryTest)) {
				// The laboratory test doesn't exist

				// Rolls back the transaction
				$app->businessLogicDatabase->rollBackTransaction();

				// Halts the execution
				$app->halt(HTTP_STATUS_NOT_FOUND, [
					'error' => ERROR_NON_EXISTENT_LABORATORY_TEST
				]);
			}
		}
		
		foreach ($medications as $medication) {
			if (! $app->businessLogicDatabase->nonErasedMedicationExists($medication)) {
				// The medication doesn't exist

				// Rolls back the transaction
				$app->businessLogicDatabase->rollBackTransaction();

				// Halts the execution
				$app->halt(HTTP_STATUS_NOT_FOUND, [
					'error' => ERROR_NON_EXISTENT_MEDICATION
				]);
			}
		}
		
		foreach ($neurocognitiveTests as $neurocognitiveTest) {
			if (! $app->businessLogicDatabase->nonErasedNeurocognitiveTestExists($neurocognitiveTest)) {
				// The neurocognitive test doesn't exist

				// Rolls back the transaction
				$app->businessLogicDatabase->rollBackTransaction();

				// Halts the execution
				$app->halt(HTTP_STATUS_NOT_FOUND, [
					'error' => ERROR_NON_EXISTENT_NEUROCOGNITIVE_TEST
				]);
			}
		}
		
		foreach ($treatments as $treatment) {
			if (! $app->businessLogicDatabase->nonErasedTreatmentExists($treatment)) {
				// The treatment doesn't exist

				// Rolls back the transaction
				$app->businessLogicDatabase->rollBackTransaction();

				// Halts the execution
				$app->halt(HTTP_STATUS_NOT_FOUND, [
					'error' => ERROR_NON_EXISTENT_TREATMENT
				]);
			}
		}
		
		// Gets the signed in user
		$signedInUser = $app->authentication->getSignedInUser();
		
		// Edits the consultation
		$app->data->editConsultation($id, $clinicalImpression, $diagnosis, $signedInUser['id'], $date, $reasons, $indications, $observations, $backgrounds, $imageTests, $laboratoryTests, $medications, $neurocognitiveTests, $treatments);
		
		// Commits the transaction
		$app->businessLogicDatabase->commitTransaction();
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		$app = $this->app;
		
		// Defines the expected JSON structure
		$jsonStructureDescriptor = new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_OBJECT, [
			'id' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
				return $app->inputValidator->isRandomId($input);
			}),
			
			'clinicalImpression' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
				if (is_null($input)) {
					return true;
				}
				
				return $app->inputValidator->isRandomId($input);
			}),
			
			'diagnosis' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
				if (is_null($input)) {
					return true;
				}
				
				return $app->inputValidator->isRandomId($input);
			}),
			
			'date' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
				return $app->inputValidator->isDate($input); // TODO: should be bounded?
			}),
			
			'reasons' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
				if (! is_string($input)) {
					return false;
				}
				
				$input = trimString($input);
				
				return	$app->inputValidator->isBoundedString($input, 1024) &&
						$app->inputValidator->isPrintableString($input);
			}),
			
			'indications' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
				if (! is_string($input)) {
					return false;
				}
				
				$input = trimString($input);
				
				return	$app->inputValidator->isBoundedString($input, 1024) &&
						$app->inputValidator->isPrintableString($input);
			}),
			
			'observations' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
				if (! is_string($input)) {
					return false;
				}
				
				$input = trimString($input);
				
				return	$app->inputValidator->isBoundedString($input, 1024) &&
						$app->inputValidator->isPrintableString($input);
			}),
			
			'backgrounds' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_ARRAY,
				new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
					return $app->inputValidator->isRandomId($input);
				})
			),
			
			'imageTests' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_ARRAY,
				new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_OBJECT, [
					'id' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
						return $app->inputValidator->isRandomId($input);
					}),
					
					'value' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
						// TODO: implement
					})
				])
			),
			
			'laboratoryTests' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_ARRAY,
				new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_OBJECT, [
					'id' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
						return $app->inputValidator->isRandomId($input);
					}),
					
					'value' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
						// TODO: implement
					})
				])
			),
			
			'medications' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_ARRAY,
				new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
					return $app->inputValidator->isRandomId($input);
				})
			),
			
			'neurocognitiveTests' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_ARRAY,
				new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_OBJECT, [
					'id' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
						return $app->inputValidator->isRandomId($input);
					}),
					
					'value' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
						// TODO: implement
					})
				])
			),
			
			'treatments' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_ARRAY,
				new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
					return $app->inputValidator->isRandomId($input);
				})
			)
		]);
		
		// Validates the request and returns the result
		return $app->inputValidator->validateJsonRequest($jsonStructureDescriptor);
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
		
		// Validates the authentication and returns the result
		return $app->authorizationValidator->validateAuthentication($authorizedUserRoles);
	}
	
}
