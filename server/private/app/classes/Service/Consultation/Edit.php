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
 * Represents the /consultation/edit service.
 */
class Edit extends CreateEdit {
	
	/**
	 * Executes the service.
	 */
	protected function execute() {
		global $app;
		
		// Gets inputs
		$id = $this->getInputValue('id', 'hex2bin');
		$version = $this->getInputValue('version');
		$date = $this->getInputValue('date', 'stringToDate');
		$presentingProblem = $this->getInputValue('presentingProblem');
		$comments = $this->getInputValue('comments');
		$clinicalImpression = $this->getInputValue('clinicalImpression', 'hex2bin');
		$diagnosis = $this->getInputValue('diagnosis', 'hex2bin');
		$medicalAntecedents = $this->getInputValue('medicalAntecedents', createArrayFilter('hex2bin'));
		$medicines = $this->getInputValue('medicines', createArrayFilter('hex2bin'));
		$laboratoryTestResults = $this->getInputValue('laboratoryTestResults', [ $this, 'filterLaboratoryTestResults' ]);
		$imagingTestResults = $this->getInputValue('imagingTestResults', [ $this, 'filterImagingTestResults' ]);
		$cognitiveTestResults = $this->getInputValue('cognitiveTestResults', [ $this, 'filterCognitiveTestResults' ]);
		$treatments = $this->getInputValue('treatments', createArrayFilter('hex2bin'));
		
		// Gets the signed-in user
		$user = $app->account->getSignedInUser();
		
		// Gets the consultation
		$consultation = $app->data->getRepository('Entity:Consultation')->findNonDeleted($id);
		
		// Asserts conditions
		$app->assertion->entityExists($consultation);
		$app->assertion->entityUpdated($consultation, $version);
		
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
		
		// Edits the consultation
		$consultation->setLastEditionDateTime();
		$consultation->setDate($date);
		$consultation->setPresentingProblem($presentingProblem);
		$consultation->setComments($comments);
		$consultation->setLastEditor($user);
		$consultation->setClinicalImpression($clinicalImpression);
		$consultation->setDiagnosis($diagnosis);
		$app->data->merge($consultation);
		
		// Sets the associated entities
		$this->setConsultationMedicalAntecedents($consultation, $medicalAntecedents);
		$this->setConsultationMedicines($consultation, $medicines);
		$this->setConsultationLaboratoryTestResults($consultation, $laboratoryTestResults);
		$this->setConsultationImagingTestResults($consultation, $imagingTestResults);
		$this->setConsultationCognitiveTestResults($consultation, $cognitiveTestResults);
		$this->setConsultationTreatments($consultation, $treatments);
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
			'id' => new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
				return $app->inputValidator->isRandomId($input);
			}),
			
			'version' => new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
				return $app->inputValidator->isValidInteger($input, 0);
			}),
			
			'date' => new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
				return $app->inputValidator->isDate($input);
			}),
			
			'presentingProblem' => new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
				return $app->inputValidator->isValidString($input, 0, 1024);
			}),
			
			'comments' => new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
				return $app->inputValidator->isValidString($input, 0, 1024);
			}),
			
			'clinicalImpression' => new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
				return is_null($input) || $app->inputValidator->isRandomId($input);
			}),
			
			'diagnosis' => new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
				return is_null($input) || $app->inputValidator->isRandomId($input);
			}),
			
			'medicalAntecedents' => new \App\InputValidator\Json\JsonArray(
				new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
					return $app->inputValidator->isRandomId($input);
				})
			),
			
			'medicines' => new \App\InputValidator\Json\JsonArray(
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
			
			'treatments' => new \App\InputValidator\Json\JsonArray(
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
		$medicalAntecedents = $this->getInputValue('medicalAntecedents', createArrayFilter('hex2bin'));
		$medicines = $this->getInputValue('medicines', createArrayFilter('hex2bin'));
		$laboratoryTestResults = $this->getInputValue('laboratoryTestResults', [ $this, 'filterLaboratoryTestResults' ]);
		$imagingTestResults = $this->getInputValue('imagingTestResults', [ $this, 'filterImagingTestResults' ]);
		$cognitiveTestResults = $this->getInputValue('cognitiveTestResults', [ $this, 'filterCognitiveTestResults' ]);
		$treatments = $this->getInputValue('treatments', createArrayFilter('hex2bin'));
		
		if (containsDuplicates($medicalAntecedents)) {
			// The medical antecedents are invalid
			return false;
		}
		
		if (containsDuplicates($medicines)) {
			// The medicines are invalid
			return false;
		}
		
		if (! $app->inputValidator->areTestResultsValid($laboratoryTestResults, 'LaboratoryTest')) {
			// The laboratory-test results are invalid
			return false;
		}
		
		if (! $app->inputValidator->areTestResultsValid($imagingTestResults, 'ImagingTest')) {
			// The imaging-test results are invalid
			return false;
		}
		
		if (! $app->inputValidator->areTestResultsValid($cognitiveTestResults, 'CognitiveTest')) {
			// The cognitive-test results are invalid
			return false;
		}
		
		if (containsDuplicates($treatments)) {
			// The treatments are invalid
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
