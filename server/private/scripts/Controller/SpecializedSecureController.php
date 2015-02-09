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
	 * Determines whether a set of backgrounds is valid.
	 * 
	 * It receives the backgrounds.
	 */
	protected function areBackgroundsValid($backgrounds) {
		return ! arrayContainsDuplicateElements($backgrounds);
	}
	
	/*
	 * Determines whether a set of files is valid.
	 * 
	 * It receives the files.
	 */
	protected function areFilesValid($files) {
		return ! arrayContainsDuplicateElements($files);
	}
	
	/*
	 * Determines whether a set of image tests is valid.
	 * 
	 * It receives the image tests.
	 */
	protected function areImageTestsValid($imageTests) {
		// Gets the IDs
		$ids = array_column($imageTests, 'id');
		
		if (arrayContainsDuplicateElements($ids)) {
			// There are duplicate IDs
			return false;
		}
		
		// Validates the values
		foreach ($imageTests as $imageTest) {
			if (! $this->isValidImageTestValue($imageTest['id'], $imageTest['value'])) {
				// The value is invalid
				return false;
			}
		}
		
		return true;
	}
	
	/*
	 * Determines whether a set of laboratory tests is valid.
	 * 
	 * It receives the laboratory tests.
	 */
	protected function areLaboratoryTestsValid($laboratoryTests) {
		// Gets the IDs
		$ids = array_column($laboratoryTests, 'id');
		
		if (arrayContainsDuplicateElements($ids)) {
			// There are duplicate IDs
			return false;
		}
		
		// Validates the values
		foreach ($laboratoryTests as $laboratoryTest) {
			if (! $this->isValidLaboratoryTestValue($laboratoryTest['id'], $laboratoryTest['value'])) {
				// The value is invalid
				return false;
			}
		}
		
		return true;
	}
	
	/*
	 * Determines whether a set of medications is valid.
	 * 
	 * It receives the medications.
	 */
	protected function areMedicationsValid($medications) {
		return ! arrayContainsDuplicateElements($medications);
	}
	
	/*
	 * Determines whether a set of neurocognitive tests is valid.
	 * 
	 * It receives the neurocognitive tests.
	 */
	protected function areNeurocognitiveTestsValid($neurocognitiveTests) {
		// Gets the IDs
		$ids = array_column($neurocognitiveTests, 'id');
		
		if (arrayContainsDuplicateElements($ids)) {
			// There are duplicate IDs
			return false;
		}
		
		// Validates the values
		foreach ($neurocognitiveTests as $neurocognitiveTest) {
			if (! $this->isValidNeurocognitiveTestValue($neurocognitiveTest['id'], $neurocognitiveTest['value'])) {
				// The value is invalid
				return false;
			}
		}
		
		return true;
	}
	
	/*
	 * Determines whether a set of treatments is valid.
	 * 
	 * It receives the treatments.
	 */
	protected function areTreatmentsValid($treatments) {
		return ! arrayContainsDuplicateElements($treatments);
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
	 * Checks the existence of a set of backgrounds.
	 * 
	 * It receives the backgrounds' IDs.
	 */
	protected function checkBackgroundsExistence($ids) {
		// Checks the existence of the backgrounds
		foreach ($ids as $id) {
			$this->checkBackgroundExistence($id);
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
	 * Checks the existence of an experiment. If it doesn't exist, the execution
	 * is halted.
	 * 
	 * It receives the experiment's ID.
	 */
	protected function checkExperimentExistence($id) {
		$app = $this->app;
		
		if (! $app->data->experiment->exists($id)) {
			// The experiment doesn't exist
			
			// Halts the execution
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'error' => ERROR_NON_EXISTENT_EXPERIMENT
			]);
		}
	}
	
	/*
	 * Checks the existence of a file. If it doesn't exist, the execution is
	 * halted.
	 * 
	 * It receives the file's ID.
	 */
	protected function checkFileExistence($id) {
		$app = $this->app;
		
		if (! $app->data->file->exists($id)) {
			// The file doesn't exist
			
			// Halts the execution
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'error' => ERROR_NON_EXISTENT_FILE
			]);
		}
	}
	
	/*
	 * Checks the existence of a set of files.
	 * 
	 * It receives the files' IDs.
	 */
	protected function checkFilesExistence($ids) {
		// Checks the existence of the files
		foreach ($ids as $id) {
			$this->checkFileExistence($id);
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
	 * Checks the existence of a set of medications.
	 * 
	 * It receives the medications' IDs.
	 */
	protected function checkMedicationsExistence($ids) {
		// Checks the existence of the medications
		foreach ($ids as $id) {
			$this->checkMedicationExistence($id);
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
	 * Checks the existence of a study. If it doesn't exist, the execution is
	 * halted.
	 * 
	 * It receives the study's ID.
	 */
	protected function checkStudyExistence($id) {
		$app = $this->app;
		
		if (! $app->data->study->exists($id)) {
			// The study doesn't exist
			
			// Halts the execution
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'error' => ERROR_NON_EXISTENT_STUDY
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
	 * Checks the existence of a set of treatments.
	 * 
	 * It receives the treatments' IDs.
	 */
	protected function checkTreatmentsExistence($ids) {
		// Checks the existence of the treatments
		foreach ($ids as $id) {
			$this->checkTreatmentExistence($id);
		}
	}
	
	/*
	 * Checks the existence of a user. If it doesn't exist, the execution is
	 * halted.
	 * 
	 * It receives the user's ID.
	 */
	protected function checkUserExistence($id) {
		$app = $this->app;
		
		if (! $app->data->user->exists($id)) {
			// The user doesn't exist
			
			// Halts the execution
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'error' => ERROR_NON_EXISTENT_USER
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
	 * Returns an experiment. If it doesn't exist, the execution is halted.
	 * 
	 * It receives the experiment's ID.
	 */
	protected function getExperiment($id) {
		$app = $this->app;
		
		// Gets the experiment
		$experiment = $app->data->experiment->get($id);
		
		if (is_null($experiment)) {
			// The experiment doesn't exist
			
			// Halts the execution
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'error' => ERROR_NON_EXISTENT_EXPERIMENT
			]);
		}
		
		return $experiment;
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
	 * Returns the value of an input entry.
	 * 
	 * It receives the entry's key and, optionally, a filtering function to be
	 * invoked on the value before it is returned.
	 */
	protected function getInput($key, $filteringFunction = null) {
		$app = $this->app;
		
		// Gets the value
		$inputs = $app->request->getBody();
		$value = $inputs[$key];
		
		if (is_null($value)) {
			// The value is null
			return null;
		}
		
		if (! is_null($filteringFunction)) {
			// Invokes the filtering function
			$value = call_user_func($filteringFunction, $value);
		}
		
		return $value;
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
	 * Returns a log. If it doesn't exist, the execution is halted.
	 * 
	 * It receives the log's ID.
	 */
	protected function getLog($id) {
		$app = $this->app;
		
		// Gets the log
		$log = $app->data->log->get($id);
		
		if (is_null($log)) {
			// The log doesn't exist
			
			// Halts the execution
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'error' => ERROR_NON_EXISTENT_LOG
			]);
		}
		
		return $log;
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
	 * Returns a study. If it doesn't exist, the execution is halted.
	 * 
	 * It receives the study's ID.
	 */
	protected function getStudy($id) {
		$app = $this->app;
		
		// Gets the study
		$study = $app->data->study->get($id);
		
		if (is_null($study)) {
			// The study doesn't exist
			
			// Halts the execution
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'error' => ERROR_NON_EXISTENT_STUDY
			]);
		}
		
		return $study;
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
	 * Returns a user. If it doesn't exist, the execution is halted.
	 * 
	 * It receives the user's ID.
	 */
	protected function getUser($id) {
		$app = $this->app;
		
		// Gets the user
		$user = $app->data->user->get($id);
		
		if (is_null($user)) {
			// The user doesn't exist
			
			// Halts the execution
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'error' => ERROR_NON_EXISTENT_USER
			]);
		}
		
		return $user;
	}
	
	/*
	 * Sets the entire output, replacing any current entry.
	 * 
	 * It receives the output.
	 */
	protected function setEntireOutput($output) {
		$this->output = $output;
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
	
	/*
	 * Determines whether the value of a data type is valid.
	 * 
	 * It receives a formatted descriptor and the value to validate.
	 */
	private function isValidDataTypeValue($formattedDescriptor, $value) {
		// Creates the data type descriptor
		$dataTypeDescriptor = \App\Auxiliar\DataTypeDescriptor\Factory::create($formattedDescriptor);
		
		// Determines whether the value is valid
		return $dataTypeDescriptor->isValidInput($value);
	}
	
	/*
	 * Determines whether the value of an image test is valid. If the image test
	 * doesn't exist, the execution is halted.
	 * 
	 * It receives the image test's ID and the value to validate.
	 */
	private function isValidImageTestValue($id, $value) {
		// Gets the image test
		$imageTest = $this->getImageTest($id);
		
		// Determines whether the value is valid
		return $this->isValidDataTypeValue($imageTest['dataTypeDescriptor'], $value);
	}
	
	/*
	 * Determines whether the value of a laboratory test is valid. If the
	 * laboratory test doesn't exist, the execution is halted.
	 * 
	 * It receives the laboratory test's ID and the value to validate.
	 */
	private function isValidLaboratoryTestValue($id, $value) {
		// Gets the laboratory test
		$laboratoryTest = $this->getLaboratoryTest($id);
		
		// Determines whether the value is valid
		return $this->isValidDataTypeValue($laboratoryTest['dataTypeDescriptor'], $value);
	}
	
	/*
	 * Determines whether the value of a neurocognitive test is valid. If the
	 * neurocognitive test doesn't exist, the execution is halted.
	 * 
	 * It receives the neurocognitive test's ID and the value to validate.
	 */
	private function isValidNeurocognitiveTestValue($id, $value) {
		// Gets the neurocognitive test
		$neurocognitiveTest = $this->getNeurocognitiveTest($id);
		
		// Determines whether the value is valid
		return $this->isValidDataTypeValue($neurocognitiveTest['dataTypeDescriptor'], $value);
	}
	
}
