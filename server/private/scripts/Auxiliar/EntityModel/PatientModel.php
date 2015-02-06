<?php

namespace App\Auxiliar\EntityModel;

/*
 * This class offers an interface to perform operations on patients.
 */
class PatientModel extends EntityModel {
	
	/*
	 * Creates an entity of the type of this model.
	 * 
	 * It receives the entity's data.
	 */
	public function create() {
		$app = $this->app;
		
		// Creates the patient
		$function = [ $app->businessLogicDatabase, 'createPatient' ];
		call_user_func_array($function, func_get_args());
	}
	
	/*
	 * Deletes an entity of the type of this model.
	 * 
	 * It receives the entity's ID.
	 */
	public function delete($id) {
		$app = $this->app;
		
		// Starts a read-write transaction
		$app->businessLogicDatabase->startReadWriteTransaction();
		
		// Gets the patient's consultations
		$consultations = $app->businessLogicDatabase->getPatientNonDeletedConsultations($id);
		
		// Deletes the consultations
		foreach ($consultations as $consultation) {
			$app->data->consultation->delete($consultation['id']);
		}
		
		// Deletes the patient
		$app->businessLogicDatabase->deletePatient($id);
		
		// Commits the transaction
		$app->businessLogicDatabase->commitTransaction();
	}
	
	/*
	 * Edits an entity of the type of this model.
	 * 
	 * It receives the entity's data.
	 */
	public function edit() {
		$app = $this->app;
		
		// Edits the patient
		$function = [ $app->businessLogicDatabase, 'editPatient' ];
		call_user_func_array($function, func_get_args());
	}
	
	/*
	 * Determines whether an entity exists.
	 * 
	 * It receives the entity's ID.
	 */
	public function exists($id) {
		$app = $this->app;
		
		// Determines whether the patient exists
		return $app->businessLogicDatabase->nonDeletedPatientExists($id);
	}
	
	/*
	 * Filters an entity for presentation and returns the result.
	 * 
	 * It receives the entity.
	 */
	public function filter($entity) {
		// TODO: implement
		return $entity;
	}
	
	/*
	 * Returns an entity of the type of this model. If it doesn't exist, null is
	 * returned.
	 * 
	 * It receives the entity's ID.
	 */
	public function get($id) {
		$app = $this->app;
		
		// Gets the patient
		return $app->businessLogicDatabase->getNonDeletedPatient($id);
	}
	
	/*
	 * Searches entities of the type of this model. It returns an array
	 * containing, as the first element, the total number of results, and as the
	 * second, the results ready for presentation that were found in the page.
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
		
		// Gets the IDs
		$ids = array_column($patients, 'id');
		
		// Converts the IDs to hexadecimal
		$ids = applyFunctionToArray($ids, 'bin2hex');
		
		return [ $foundRows, $ids ];
	}
	
}
