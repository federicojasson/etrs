<?php

namespace App\Controllers\Consultations;

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/consultations/create
 *	Method:	POST
 */
class Create extends \App\Controllers\SecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Gets the input
		$input = $app->request->getBody();
		$clinicalImpression = (is_null($input['clinicalImpression']))? null : hex2bin($input['clinicalImpression']);
		$diagnosis = (is_null($input['diagnosis']))? null : hex2bin($input['diagnosis']);
		$patient = hex2bin($input['patient']);
		$date = $input['date'];
		$reasons = $input['reasons']; // TODO: trim?
		$indications = $input['indications']; // TODO: trim?
		$observations = $input['observations']; // TODO: trim?
		$backgrounds = $input['backgrounds'];
		$imageTests = $input['imageTests'];
		$laboratoryTests = $input['laboratoryTests'];
		$medications = $input['medications'];
		$neurocognitiveTests = $input['neurocognitiveTests'];
		$treatments = $input['treatments'];
		
		// Starts a read-write transaction
		$app->businessLogicDatabase->startReadWriteTransaction();
		
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
		
		if (! $app->businessLogicDatabase->nonErasedPatientExists($patient)) {
			// The patient doesn't exist

			// Rolls back the transaction
			$app->businessLogicDatabase->rollBackTransaction();

			// Halts the execution
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'error' => ERROR_NON_EXISTENT_PATIENT
			]);
		}
		
		// TODO: check existence of other resources
		
		do {
			// Generates a random ID
			$id = $app->cryptography->generateRandomId();
		} while ($app->businessLogicDatabase->consultationExists($id));
		
		// Gets the signed in user
		$signedInUser = $app->authentication->getSignedInUser();
		
		// Creates the consultation
		$app->businessLogicDatabase->createConsultation($id, $clinicalImpression, $signedInUser['id'], $diagnosis, $signedInUser['id'], $patient, $date, $reasons, $indications, $observations);
		
		// Creates the consultation's backgrounds
		// TODO: implement
		
		// Creates the consultation's image tests
		// TODO: implement
		
		// Creates the consultation's laboratory tests
		// TODO: implement
		
		// Creates the consultation's medications
		// TODO: implement
		
		// Creates the consultation's neurocognitive tests
		// TODO: implement
		
		// Creates the consultation's treatments
		// TODO: implement
		
		// Commits the transaction
		$app->businessLogicDatabase->commitTransaction();
		
		// Sets the output
		$app->response->setBody([
			'id' => bin2hex($id)
		]);
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		$app = $this->app;
		
		// Defines the expected JSON structure
		$jsonStructureDescriptor = new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_OBJECT, [
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
			
			'patient' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
				return $app->inputValidator->isRandomId($input);
			}),
			
			'date' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
				return $app->inputValidator->isDate($input);
			}),
			
			'reasons' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
				// TODO: implement
				return true;
			}),
			
			'indications' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
				// TODO: implement
				return true;
			}),
			
			'observations' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
				// TODO: implement
				return true;
			}),
			
			'backgrounds' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_ARRAY,
				new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
					return $app->inputValidator->isRandomId($input);
				})
			),
			
			'imageTests' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_ARRAY,
				new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_OBJECT, [
					'id' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
						// TODO: implement
						return true;
					}),
					
					'value' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
						// TODO: implement
						return true;
					})
				])
			),
			
			'laboratoryTests' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_ARRAY,
				new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_OBJECT, [
					'id' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
						// TODO: implement
						return true;
					}),
					
					'value' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
						// TODO: implement
						return true;
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
						// TODO: implement
						return true;
					}),
					
					'value' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
						// TODO: implement
						return true;
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
			// TODO: define user roles
		];
		
		// Validates the authentication and returns the result
		return $app->authorizationValidator->validateAuthentication($authorizedUserRoles);
	}
	
}
