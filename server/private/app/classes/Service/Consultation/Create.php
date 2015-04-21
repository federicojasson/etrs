<?php

/**
 * ETRS - Eye Tracking Record System
 * Copyright (C) 2015 Federico Jasson
 * 
 * This program is free software: you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation, either version 3 of the License, or (at your option) any later
 * version.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU General Public License along with
 * this program. If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Service\Consultation;

/**
 * Represents the /consultation/create service.
 */
class Create extends \App\Service\External {
	
	/**
	 * Executes the service.
	 */
	protected function execute() {
		global $app;
		
		// Gets inputs
		$date = $this->getInputValue('date', 'stringToDate');
		$presentingProblem = $this->getInputValue('presentingProblem');
		$comments = $this->getInputValue('comments');
		$patient = $this->getInputValue('patient', 'hex2bin');
		$clinicalImpression = $this->getInputValue('clinicalImpression', 'hex2bin');
		$diagnosis = $this->getInputValue('diagnosis', 'hex2bin');
		$patientMedicalAntecedents = $this->getInputValue('patientMedicalAntecedents', createArrayFilter('hex2bin'));
		$concomitantMedicines = $this->getInputValue('concomitantMedicines', createArrayFilter('hex2bin'));
		$laboratoryTestResults = $this->getInputValue('laboratoryTestResults', [ $this, 'filterLaboratoryTestResults' ]);
		$imagingTestResults = $this->getInputValue('imagingTestResults', [ $this, 'filterImagingTestResults' ]);
		$cognitiveTestResults = $this->getInputValue('cognitiveTestResults', [ $this, 'filterCognitiveTestResults' ]);
		$prescribedTreatments = $this->getInputValue('prescribedTreatments', createArrayFilter('hex2bin'));
		
		// Gets the signed-in user
		$user = $app->account->getSignedInUser();
		
		// Gets the patient
		$patient = $app->data->getRepository('Entity:Patient')->findNonDeleted($patient);
		
		// Asserts conditions
		$app->assertion->entityExists($patient);
		
		if (! is_null($clinicalImpression)) {
			// Gets the clinical impression
			$clinicalImpression = $app->data->getRepository('Entity:ClinicalImpression')->findNonDeleted($clinicalImpression);
			
			// Asserts conditions
			$app->assertion->entityExists($clinicalImpression);
		}
		
		if (! is_null($diagnosis)) {
			// Gets the diagnosis
			$diagnosis = $app->data->getRepository('Entity:Diagnosis')->findNonDeleted($diagnosis);
			
			// Asserts conditions
			$app->assertion->entityExists($diagnosis);
		}
		
		// Creates the consultation
		$consultation = new \App\Data\Entity\Consultation();
		$consultation->setDate($date);
		$consultation->setPresentingProblem($presentingProblem);
		$consultation->setComments($comments);
		$consultation->setCreator($user);
		$consultation->setPatient($patient);
		$consultation->setClinicalImpression($clinicalImpression);
		$consultation->setDiagnosis($diagnosis);
		$app->data->persist($consultation);
		
		// Gets the consultation's ID
		$id = $consultation->getId();
		
		// Sets an output
		$this->setOutputValue('id', $id, 'bin2hex');
		
		// TODO: check existence and add associations
	}
	
	/**
	 * Applies a filter to a set of cognitive-test results.
	 * 
	 * Receives the cognitive-test results.
	 */
	protected function filterCognitiveTestResults($cognitiveTestResults) {
		return filterArray($cognitiveTestResults, function($cognitiveTestResult) {
			$cognitiveTestResult['cognitiveTest'] = hex2bin($cognitiveTestResult['cognitiveTest']);
			return $cognitiveTestResult;
		});
	}
	
	/**
	 * Applies a filter to a set of imaging-test results.
	 * 
	 * Receives the imaging-test results.
	 */
	protected function filterImagingTestResults($imagingTestResults) {
		return filterArray($imagingTestResults, function($imagingTestResult) {
			$imagingTestResult['imagingTest'] = hex2bin($imagingTestResult['imagingTest']);
			return $imagingTestResult;
		});
	}
	
	/**
	 * Applies a filter to a set of laboratory-test results.
	 * 
	 * Receives the laboratory-test results.
	 */
	protected function filterLaboratoryTestResults($laboratoryTestResults) {
		return filterArray($laboratoryTestResults, function($laboratoryTestResult) {
			$laboratoryTestResult['laboratoryTest'] = hex2bin($laboratoryTestResult['laboratoryTest']);
			return $laboratoryTestResult;
		});
	}
	
	/**
	 * Determines whether the request is valid.
	 */
	protected function isRequestValid() {
		global $app;
		
		if (! $this->isJsonRequest()) {
			// It is not a JSON request
			return false;
		}
		
		// Gets the input
		$input = $this->getInput();
		
		// Builds a JSON input validator
		$jsonInputValidator = new \App\InputValidator\Json\JsonObject([
			'date' => new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
				return $app->inputValidator->isDate($input);
			}),
			
			'presentingProblem' => new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
				return $app->inputValidator->isValidString($input, 0, 1024);
			}),
			
			'comments' => new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
				return $app->inputValidator->isValidString($input, 0, 1024);
			}),
			
			'patient' => new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
				return $app->inputValidator->isRandomId($input);
			}),
			
			'clinicalImpression' => new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
				return is_null($input) || $app->inputValidator->isRandomId($input);
			}),
			
			'diagnosis' => new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
				return is_null($input) || $app->inputValidator->isRandomId($input);
			}),
			
			'patientMedicalAntecedents' => new \App\InputValidator\Json\JsonArray(
				new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
					return $app->inputValidator->isRandomId($input);
				})
			),
			
			'concomitantMedicines' => new \App\InputValidator\Json\JsonArray(
				new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
					return $app->inputValidator->isRandomId($input);
				})
			),
			
			'laboratoryTestResults' => new \App\InputValidator\Json\JsonArray(
				new \App\InputValidator\Json\JsonObject([
					'laboratoryTest' => new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
						return $app->inputValidator->isRandomId($input);
					}),
					
					'value' => new \App\InputValidator\Json\JsonValue(function() {
						return true;
					})
				])
			),
			
			'imagingTestResults' => new \App\InputValidator\Json\JsonArray(
				new \App\InputValidator\Json\JsonObject([
					'imagingTest' => new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
						return $app->inputValidator->isRandomId($input);
					}),
					
					'value' => new \App\InputValidator\Json\JsonValue(function() {
						return true;
					})
				])
			),
			
			'cognitiveTestResults' => new \App\InputValidator\Json\JsonArray(
				new \App\InputValidator\Json\JsonObject([
					'cognitiveTest' => new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
						return $app->inputValidator->isRandomId($input);
					}),
					
					'value' => new \App\InputValidator\Json\JsonValue(function() {
						return true;
					})
				])
			),
			
			'prescribedTreatments' => new \App\InputValidator\Json\JsonArray(
				new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
					return $app->inputValidator->isRandomId($input);
				})
			)
		]);
		
		if (! $app->inputValidator->isJsonInputValid($input, $jsonInputValidator)) {
			// The input is invalid
			return false;
		}
		
		// Gets inputs
		$laboratoryTestResults = $this->getInputValue('laboratoryTestResults', [ $this, 'filterLaboratoryTestResults' ]);
		$imagingTestResults = $this->getInputValue('imagingTestResults', [ $this, 'filterImagingTestResults' ]);
		$cognitiveTestResults = $this->getInputValue('cognitiveTestResults', [ $this, 'filterCognitiveTestResults' ]);
		
		// TODO: check duplicates on others
		
		if (! $app->inputValidator->areLaboratoryTestResultsValid($laboratoryTestResults)) {
			// The laboratory-test results are invalid
			return false;
		}
		
		if (! $app->inputValidator->areImagingTestResultsValid($imagingTestResults)) {
			// The imaging-test results are invalid
			return false;
		}
		
		if (! $app->inputValidator->areCognitiveTestResultsValid($cognitiveTestResults)) {
			// The cognitive-test results are invalid
			return false;
		}
		
		return true;
	}
	
	/**
	 * Determines whether the user is authorized.
	 */
	protected function isUserAuthorized() {
		global $app;
		
		// Validates the access
		return $app->accessValidator->isUserAuthorized([
			USER_ROLE_ADMINISTRATOR,
			USER_ROLE_DOCTOR
		]);
	}

}
