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
class Create extends CreateEdit {
	
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
		$medicalAntecedents = $this->getInputValue('medicalAntecedents', createArrayFilter('hex2bin'));
		$medicines = $this->getInputValue('medicines', createArrayFilter('hex2bin'));
		$laboratoryTestResults = $this->getInputValue('laboratoryTestResults', 'filterLaboratoryTestResults');
		$imagingTestResults = $this->getInputValue('imagingTestResults', 'filterImagingTestResults');
		$cognitiveTestResults = $this->getInputValue('cognitiveTestResults', 'filterCognitiveTestResults');
		$treatments = $this->getInputValue('treatments', createArrayFilter('hex2bin'));
		
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
		
		// Builds an input validator
		$inputValidator = new \App\InputValidator\Input\InputObject([
			'date' => new \App\InputValidator\Input\InputValue(function($input) use ($app) {
				return $app->inputValidator->isDate($input);
			}),
			
			'presentingProblem' => new \App\InputValidator\Input\InputValue(function($input) use ($app) {
				return $app->inputValidator->isValidString($input, 0, 1024);
			}),
			
			'comments' => new \App\InputValidator\Input\InputValue(function($input) use ($app) {
				return $app->inputValidator->isValidString($input, 0, 1024);
			}),
			
			'patient' => new \App\InputValidator\Input\InputValue(function($input) use ($app) {
				return $app->inputValidator->isRandomId($input);
			}),
			
			'clinicalImpression' => new \App\InputValidator\Input\InputValue(function($input) use ($app) {
				return is_null($input) || $app->inputValidator->isRandomId($input);
			}),
			
			'diagnosis' => new \App\InputValidator\Input\InputValue(function($input) use ($app) {
				return is_null($input) || $app->inputValidator->isRandomId($input);
			}),
			
			'medicalAntecedents' => new \App\InputValidator\Input\InputArray(
				new \App\InputValidator\Input\InputValue(function($input) use ($app) {
					return $app->inputValidator->isRandomId($input);
				})
			),
			
			'medicines' => new \App\InputValidator\Input\InputArray(
				new \App\InputValidator\Input\InputValue(function($input) use ($app) {
					return $app->inputValidator->isRandomId($input);
				})
			),
			
			'laboratoryTestResults' => new \App\InputValidator\Input\InputArray(
				new \App\InputValidator\Input\InputObject([
					'laboratoryTest' => new \App\InputValidator\Input\InputValue(function($input) use ($app) {
						return $app->inputValidator->isRandomId($input);
					}),
					
					'value' => new \App\InputValidator\Input\InputValue(function() {
						return true;
					})
				])
			),
			
			'imagingTestResults' => new \App\InputValidator\Input\InputArray(
				new \App\InputValidator\Input\InputObject([
					'imagingTest' => new \App\InputValidator\Input\InputValue(function($input) use ($app) {
						return $app->inputValidator->isRandomId($input);
					}),
					
					'value' => new \App\InputValidator\Input\InputValue(function() {
						return true;
					})
				])
			),
			
			'cognitiveTestResults' => new \App\InputValidator\Input\InputArray(
				new \App\InputValidator\Input\InputObject([
					'cognitiveTest' => new \App\InputValidator\Input\InputValue(function($input) use ($app) {
						return $app->inputValidator->isRandomId($input);
					}),
					
					'value' => new \App\InputValidator\Input\InputValue(function() {
						return true;
					})
				])
			),
			
			'treatments' => new \App\InputValidator\Input\InputArray(
				new \App\InputValidator\Input\InputValue(function($input) use ($app) {
					return $app->inputValidator->isRandomId($input);
				})
			)
		]);
		
		if (! $app->inputValidator->isInputValid($input, $inputValidator)) {
			// The input is invalid
			return false;
		}
		
		// Gets inputs
		$medicalAntecedents = $this->getInputValue('medicalAntecedents', createArrayFilter('hex2bin'));
		$medicines = $this->getInputValue('medicines', createArrayFilter('hex2bin'));
		$laboratoryTestResults = $this->getInputValue('laboratoryTestResults');
		$imagingTestResults = $this->getInputValue('imagingTestResults');
		$cognitiveTestResults = $this->getInputValue('cognitiveTestResults');
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
