<?php

namespace App\Controller;

use App\Auxiliar\JsonStructureDescriptor\JsonObjectDescriptor;
use App\Auxiliar\JsonStructureDescriptor\JsonValueDescriptor;

/*
 * This class encapsulates the logic of a secure service and offers specialized
 * methods.
 */
abstract class SpecializedSecureController extends SecureController {
	
	/*
	 * The output.
	 */
	private $output;
	
	/*
	 * Serves the request.
	 */
	public function serveRequest() {
		$app = $this->app;
		
		// Initializes the output
		$this->output = [];
		
		// Invokes the parent's function
		parent::serveRequest();
		
		if (isArrayEmpty($this->output)) {
			// There is no output
			return;
		}
		
		// Sets the output
		$app->response->setBody($this->output);
	}
	
	/*
	 * Checks the existence of a background. If it doesn't exist, the execution
	 * is halted.
	 * 
	 * It receives the background's ID.
	 */
	protected function checkBackgroundExistence($id) {
		$app = $this->app;
		
		if (! $app->data->background->exists($id)) {
			// The background doesn't exist
			
			// Halts the execution
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'error' => ERROR_NON_EXISTENT_BACKGROUND
			]);
		}
	}
	
	/*
	 * Checks the existence of a clinical impression. If it doesn't exist, the
	 * execution is halted.
	 * 
	 * It receives the clinical impression's ID.
	 */
	protected function checkClinicalImpressionExistence($id) {
		$app = $this->app;
		
		if (! $app->data->clinicalImpression->exists($id)) {
			// The clinical impression doesn't exist
			
			// Halts the execution
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'error' => ERROR_NON_EXISTENT_CLINICAL_IMPRESSION
			]);
		}
	}
	
	/*
	 * Checks the existence of a consultation. If it doesn't exist, the
	 * execution is halted.
	 * 
	 * It receives the consultation's ID.
	 */
	protected function checkConsultationExistence($id) {
		$app = $this->app;
		
		if (! $app->data->consultation->exists($id)) {
			// The consultation doesn't exist
			
			// Halts the execution
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'error' => ERROR_NON_EXISTENT_CONSULTATION
			]);
		}
	}
	
	/*
	 * Checks the existence of a diagnosis. If it doesn't exist, the execution
	 * is halted.
	 * 
	 * It receives the diagnosis' ID.
	 */
	protected function checkDiagnosisExistence($id) {
		$app = $this->app;
		
		if (! $app->data->diagnosis->exists($id)) {
			// The diagnosis doesn't exist
			
			// Halts the execution
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'error' => ERROR_NON_EXISTENT_DIAGNOSIS
			]);
		}
	}
	
	/*
	 * Checks the existence of an image test. If it doesn't exist, the execution
	 * is halted.
	 * 
	 * It receives the image test's ID.
	 */
	protected function checkImageTestExistence($id) {
		$app = $this->app;
		
		if (! $app->data->imageTest->exists($id)) {
			// The image test doesn't exist
			
			// Halts the execution
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'error' => ERROR_NON_EXISTENT_IMAGE_TEST
			]);
		}
	}
	
	/*
	 * Checks the existence of a laboratory test. If it doesn't exist, the
	 * execution is halted.
	 * 
	 * It receives the laboratory test's ID.
	 */
	protected function checkLaboratoryTestExistence($id) {
		$app = $this->app;
		
		if (! $app->data->laboratoryTest->exists($id)) {
			// The laboratory test doesn't exist
			
			// Halts the execution
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'error' => ERROR_NON_EXISTENT_LABORATORY_TEST
			]);
		}
	}
	
	/*
	 * Checks the existence of a medication. If it doesn't exist, the execution
	 * is halted.
	 * 
	 * It receives the medication's ID.
	 */
	protected function checkMedicationExistence($id) {
		$app = $this->app;
		
		if (! $app->data->medication->exists($id)) {
			// The medication doesn't exist
			
			// Halts the execution
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'error' => ERROR_NON_EXISTENT_MEDICATION
			]);
		}
	}
	
	/*
	 * Checks the existence of a neurocognitive test. If it doesn't exist, the
	 * execution is halted.
	 * 
	 * It receives the neurocognitive test's ID.
	 */
	protected function checkNeurocognitiveTestExistence($id) {
		$app = $this->app;
		
		if (! $app->data->neurocognitiveTest->exists($id)) {
			// The neurocognitive test doesn't exist
			
			// Halts the execution
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'error' => ERROR_NON_EXISTENT_NEUROCOGNITIVE_TEST
			]);
		}
	}
	
	/*
	 * Checks the existence of a patient. If it doesn't exist, the execution is
	 * halted.
	 * 
	 * It receives the patient's ID.
	 */
	protected function checkPatientExistence($id) {
		$app = $this->app;
		
		if (! $app->data->patient->exists($id)) {
			// The patient doesn't exist
			
			// Halts the execution
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'error' => ERROR_NON_EXISTENT_PATIENT
			]);
		}
	}
	
	/*
	 * Checks the existence of a treatment. If it doesn't exist, the execution
	 * is halted.
	 * 
	 * It receives the treatment's ID.
	 */
	protected function checkTreatmentExistence($id) {
		$app = $this->app;
		
		if (! $app->data->treatment->exists($id)) {
			// The treatment doesn't exist
			
			// Halts the execution
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'error' => ERROR_NON_EXISTENT_TREATMENT
			]);
		}
	}
	
	/*
	 * Checks the non-existence of a user. If it exists, the execution is
	 * halted.
	 * 
	 * It receives the user's ID.
	 */
	protected function checkUserNonExistence($id) {
		$app = $this->app;
		
		if ($app->data->user->exists($id)) {
			// The user exists
			
			// Halts the execution
			$app->halt(HTTP_STATUS_CONFLICT, [
				'error' => ERROR_ALREADY_EXISTING_USER
			]);
		}
	}
	
	/*
	 * Returns a background. If it doesn't exist, the execution is halted.
	 * 
	 * It receives the background's ID.
	 */
	protected function getBackground($id) {
		$app = $this->app;
		
		// Gets the background
		$background = $app->data->background->get($id);
		
		if (is_null($background)) {
			// The background doesn't exist
			
			// Halts the execution
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'error' => ERROR_NON_EXISTENT_BACKGROUND
			]);
		}
		
		return $background;
	}
	
	/*
	 * Returns a clinical impression. If it doesn't exist, the execution is
	 * halted.
	 * 
	 * It receives the clinical impression's ID.
	 */
	protected function getClinicalImpression($id) {
		$app = $this->app;
		
		// Gets the clinical impression
		$clinicalImpression = $app->data->clinicalImpression->get($id);
		
		if (is_null($clinicalImpression)) {
			// The clinical impression doesn't exist
			
			// Halts the execution
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'error' => ERROR_NON_EXISTENT_CLINICAL_IMPRESSION
			]);
		}
		
		return $clinicalImpression;
	}
	
	/*
	 * Returns a consultation. If it doesn't exist, the execution is halted.
	 * 
	 * It receives the consultation's ID.
	 */
	protected function getConsultation($id) {
		$app = $this->app;
		
		// Gets the consultation
		$consultation = $app->data->consultation->get($id);
		
		if (is_null($consultation)) {
			// The consultation doesn't exist
			
			// Halts the execution
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'error' => ERROR_NON_EXISTENT_CONSULTATION
			]);
		}
		
		return $consultation;
	}
	
	/*
	 * Returns a diagnosis. If it doesn't exist, the execution is halted.
	 * 
	 * It receives the diagnosis' ID.
	 */
	protected function getDiagnosis($id) {
		$app = $this->app;
		
		// Gets the diagnosis
		$diagnosis = $app->data->diagnosis->get($id);
		
		if (is_null($diagnosis)) {
			// The diagnosis doesn't exist
			
			// Halts the execution
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'error' => ERROR_NON_EXISTENT_DIAGNOSIS
			]);
		}
		
		return $diagnosis;
	}
	
	/*
	 * Returns a file. If it doesn't exist, the execution is halted.
	 * 
	 * It receives the file's ID.
	 */
	protected function getFile($id) {
		$app = $this->app;
		
		// Gets the file
		$file = $app->data->file->get($id);
		
		if (is_null($file)) {
			// The file doesn't exist
			
			// Halts the execution
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'error' => ERROR_NON_EXISTENT_FILE
			]);
		}
		
		return $file;
	}
	
	/*
	 * Returns an image test. If it doesn't exist, the execution is halted.
	 * 
	 * It receives the image test's ID.
	 */
	protected function getImageTest($id) {
		$app = $this->app;
		
		// Gets the image test
		$imageTest = $app->data->imageTest->get($id);
		
		if (is_null($imageTest)) {
			// The image test doesn't exist
			
			// Halts the execution
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'error' => ERROR_NON_EXISTENT_IMAGE_TEST
			]);
		}
		
		return $imageTest;
	}
	
	/*
	 * Returns an input.
	 * 
	 * It receives the input's key and, optionally, a filtering function to be
	 * invoked on the input before it is returned.
	 */
	protected function getInput($key, $filteringFunction = null) {
		$app = $this->app;
		
		// Gets the input
		$inputs = $app->request->getBody();
		$input = $inputs[$key];
		
		if (is_null($input)) {
			// The input is null
			return null;
		}
		
		if (! is_null($filteringFunction)) {
			// Invokes the filtering function
			$input = call_user_func($filteringFunction, $input);
		}
		
		return $input;
	}
	
	/*
	 * Returns a laboratory test. If it doesn't exist, the execution is halted.
	 * 
	 * It receives the laboratory test's ID.
	 */
	protected function getLaboratoryTest($id) {
		$app = $this->app;
		
		// Gets the laboratory test
		$laboratoryTest = $app->data->laboratoryTest->get($id);
		
		if (is_null($laboratoryTest)) {
			// The laboratory test doesn't exist
			
			// Halts the execution
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'error' => ERROR_NON_EXISTENT_LABORATORY_TEST
			]);
		}
		
		return $laboratoryTest;
	}
	
	/*
	 * Returns a medication. If it doesn't exist, the execution is halted.
	 * 
	 * It receives the medication's ID.
	 */
	protected function getMedication($id) {
		$app = $this->app;
		
		// Gets the medication
		$medication = $app->data->medication->get($id);
		
		if (is_null($medication)) {
			// The medication doesn't exist
			
			// Halts the execution
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'error' => ERROR_NON_EXISTENT_MEDICATION
			]);
		}
		
		return $medication;
	}
	
	/*
	 * Returns a neurocognitive test. If it doesn't exist, the execution is
	 * halted.
	 * 
	 * It receives the neurocognitive test's ID.
	 */
	protected function getNeurocognitiveTest($id) {
		$app = $this->app;
		
		// Gets the neurocognitive test
		$neurocognitiveTest = $app->data->neurocognitiveTest->get($id);
		
		if (is_null($neurocognitiveTest)) {
			// The neurocognitive test doesn't exist
			
			// Halts the execution
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'error' => ERROR_NON_EXISTENT_NEUROCOGNITIVE_TEST
			]);
		}
		
		return $neurocognitiveTest;
	}
	
	/*
	 * Returns a patient. If it doesn't exist, the execution is halted.
	 * 
	 * It receives the patient's ID.
	 */
	protected function getPatient($id) {
		$app = $this->app;
		
		// Gets the patient
		$patient = $app->data->patient->get($id);
		
		if (is_null($patient)) {
			// The patient doesn't exist
			
			// Halts the execution
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'error' => ERROR_NON_EXISTENT_PATIENT
			]);
		}
		
		return $patient;
	}
	
	/*
	 * Returns the JSON structure descriptor used in the search controllers.
	 * 
	 * It receives the sorting's fields.
	 */
	protected function getSearchJsonStructureDescriptor($sortingFields) {
		$app = $this->app;
		
		// Defines and returns the JSON structure descriptor
		return new JsonObjectDescriptor([
			'expression' => new JsonValueDescriptor(function($input) use ($app) {
				if (is_null($input)) {
					return true;
				}
				
				return $app->inputValidator->isValidText($input, 1, 128);
			}),
			
			'page' => new JsonValueDescriptor(function($input) use ($app) {
				return $app->inputValidator->isValidInteger($input, 1);
			}),
			
			'sorting' => new JsonObjectDescriptor([
				'field' => new JsonValueDescriptor(function($input) use ($sortingFields) {
					return isElementInArray($input, $sortingFields);
				}),
				
				'order' => new JsonValueDescriptor(function($input) use ($app) {
					return $app->inputValidator->isSortingOrder($input);
				})
			])
		]);
	}
	
	/*
	 * Returns a treatment. If it doesn't exist, the execution is halted.
	 * 
	 * It receives the treatment's ID.
	 */
	protected function getTreatment($id) {
		$app = $this->app;
		
		// Gets the treatment
		$treatment = $app->data->treatment->get($id);
		
		if (is_null($treatment)) {
			// The treatment doesn't exist
			
			// Halts the execution
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'error' => ERROR_NON_EXISTENT_TREATMENT
			]);
		}
		
		return $treatment;
	}
	
	/*
	 * Sets the value of an output entry.
	 * 
	 * It receives the entry's key, the value to be set and, optionally, a
	 * filtering function to be invoked on the value before it is set.
	 */
	protected function setOutput($key, $value, $filteringFunction = null) {
		if (! is_null($filteringFunction)) {
			// Invokes the filtering function
			$value = call_user_func($filteringFunction, $value);
		}
		
		$this->output[$key] = $value;
	}
	
	/*
	 * Sets the output.
	 * 
	 * It receives the output.
	 */
	protected function setOutputCompletely($output) {
		$this->output = $output;
	}
	
	/*
	 * Validates a JSON request and returns the result.
	 * 
	 * If the request is valid, the input is replaced by a decoded version.
	 * 
	 * It receives the descriptor of the expected JSON structure.
	 */
	protected function validateJsonRequest($jsonStructureDescriptor) {
		$app = $this->app;
		
		// Gets the media type
		$mediaType = $app->request->getMediaType();
		
		if ($mediaType !== 'application/json') {
			// The media type is not JSON
			return false;
		}
		
		// Gets the input
		$input = $app->request->getBody();
		
		// Decodes the input
		$input = json_decode($input, true);
		
		if (is_null($input)) {
			// The input could not be decoded
			return false;
		}
		
		if (! $jsonStructureDescriptor->isValidInput($input)) {
			// The input is invalid
			return false;
		}
		
		// Replaces the request's body with the decoded input
		$app->request->setBody($input);
		
		return true;
	}
	
}
