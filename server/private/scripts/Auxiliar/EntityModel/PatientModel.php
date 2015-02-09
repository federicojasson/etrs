<?php

namespace App\Auxiliar\EntityModel;

/*
 * This class offers operations to manage patients.
 */
class PatientModel extends EntityModel {
	
	/*
	 * Creates a patient.
	 * 
	 * It receives the patient's data.
	 */
	public function create($id, $creator, $firstName, $lastName, $gender, $birthDate, $educationYears) {
		$app = $this->app;
		
		// Creates the patient
		$app->businessLogicDatabase->createPatient($id, $creator, $firstName, $lastName, $gender, $birthDate, $educationYears);
	}
	
	/*
	 * Deletes a patient.
	 * 
	 * It receives the patient's ID.
	 */
	public function delete($id) {
		$app = $this->app;
		
		// Starts a read-write transaction
		$app->businessLogicDatabase->startReadWriteTransaction();
		
		// Deletes the patient's consultations
		$consultations = $app->businessLogicDatabase->getPatientNonDeletedConsultations($id);
		foreach ($consultations as $consultation) {
			$app->data->consultation->delete($consultation['id']);
		}
		
		// Deletes the patient
		$app->businessLogicDatabase->deletePatient($id);
		
		// Commits the transaction
		$app->businessLogicDatabase->commitTransaction();
	}
	
	/*
	 * Edits a patient.
	 * 
	 * It receives the patient's data.
	 */
	public function edit($id, $lastEditor, $firstName, $lastName, $gender, $birthDate, $educationYears) {
		$app = $this->app;
		
		// Edits the patient
		$app->businessLogicDatabase->editPatient($id, $lastEditor, $firstName, $lastName, $gender, $birthDate, $educationYears);
	}
	
	/*
	 * Determines whether a patient exists.
	 * 
	 * It receives the patient's ID.
	 */
	public function exists($id) {
		$app = $this->app;
		
		// Determines whether the patient exists
		return $app->businessLogicDatabase->nonDeletedPatientExists($id);
	}
	
	/*
	 * Filters a patient for presentation and returns the result.
	 * 
	 * It receives the patient.
	 */
	public function filter($patient) {
		$app = $this->app;
		
		// Adds fields for the associated data
		$patient['consultations'] = [];
		
		// Gets the accessible fields
		$accessibleFields = $app->accessValidator->getAccessibleFields(ENTITY_MODEL_PATIENT);
		
		// Filters the patient's fields
		$newPatient = filterArray($patient, $accessibleFields);
		
		// Attaches associated data and applies conversions
		
		if (isset($newPatient['id'])) {
			$newPatient['id'] = bin2hex($patient['id']);
		}
		
		if (isset($newPatient['consultations'])) {
			$consultations = $app->businessLogicDatabase->getPatientNonDeletedConsultations($patient['id']);
			
			foreach ($consultations as $consultation) {
				$newPatient['consultations'][] = bin2hex($consultation['id']);
			}
		}
		
		return $newPatient;
	}
	
	/*
	 * Returns a patient. If it doesn't exist, null is returned.
	 * 
	 * It receives the patient's ID.
	 */
	public function get($id) {
		$app = $this->app;
		
		// Gets the patient
		return $app->businessLogicDatabase->getNonDeletedPatient($id);
	}
	
	/*
	 * Searches patients. It returns an array containing the total number of
	 * results and the results found in the page, ready for presentation.
	 * 
	 * It receives an expression, the page and a sorting.
	 */
	public function search($expression, $page, $sorting) {
		$app = $this->app;
		
		if (is_null($expression)) {
			// Searches all patients
			$patients = $app->businessLogicDatabase->searchAllNonDeletedPatients($page, $sorting);
		} else {
			// Searches specific patients
			$patients = $app->businessLogicDatabase->searchSpecificNonDeletedPatients($expression, $page, $sorting);
		}
		
		// Gets the number of rows found
		$foundRows = $app->businessLogicDatabase->getFoundRows();
		
		// Converts the IDs to hexadecimal
		$patients = arrayIdsToHexadecimal($patients);
		
		// Gets the IDs
		$ids = array_column($patients, 'id');
		
		return [ $foundRows, $ids ];
	}
	
}
