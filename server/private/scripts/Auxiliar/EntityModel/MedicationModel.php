<?php

namespace App\Auxiliar\EntityModel;

/*
 * This class offers operations to manage medications.
 */
class MedicationModel extends EntityModel {
	
	/*
	 * Creates a medication.
	 * 
	 * It receives the medication's data.
	 */
	public function create($id, $creator, $name) {
		$app = $this->app;
		
		// Creates the medication
		$app->businessLogicDatabase->createMedication($id, $creator, $name);
	}
	
	/*
	 * Deletes a medication.
	 * 
	 * It receives the medication's ID.
	 */
	public function delete($id) {
		$app = $this->app;
		
		// Deletes the medication
		$app->businessLogicDatabase->deleteMedication($id);
	}
	
	/*
	 * Edits a medication.
	 * 
	 * It receives the medication's data.
	 */
	public function edit($id, $lastEditor, $name) {
		$app = $this->app;
		
		// Edits the medication
		$app->businessLogicDatabase->editMedication($id, $lastEditor, $name);
	}
	
	/*
	 * Determines whether a medication exists.
	 * 
	 * It receives the medication's ID.
	 */
	public function exists($id) {
		$app = $this->app;
		
		// Determines whether the medication exists
		return $app->businessLogicDatabase->nonDeletedMedicationExists($id);
	}
	
	/*
	 * Filters a medication for presentation and returns the result.
	 * 
	 * It receives the medication.
	 */
	public function filter($medication) {
		$app = $this->app;
		
		// Gets the accessible fields
		$accessibleFields = $app->accessValidator->getAccessibleFields('medication');
		
		// Filters the medication's fields
		$newMedication = filterArray($medication, $accessibleFields);
		
		// Applies conversions
		
		if (isset($newMedication['id'])) {
			$newMedication['id'] = bin2hex($medication['id']);
		}
		
		return $newMedication;
	}
	
	/*
	 * Returns a medication. If it doesn't exist, null is returned.
	 * 
	 * It receives the medication's ID.
	 */
	public function get($id) {
		$app = $this->app;
		
		// Gets the medication
		return $app->businessLogicDatabase->getNonDeletedMedication($id);
	}
	
	/*
	 * Searches medications. It returns an array containing the total number of
	 * results and the results found in the page, ready for presentation.
	 * 
	 * It receives an expression, the page and a sorting.
	 */
	public function search($expression, $page, $sorting) {
		$app = $this->app;
		
		if (is_null($expression)) {
			// Searches all medications
			$medications = $app->businessLogicDatabase->searchAllNonDeletedMedications($page, $sorting);
		} else {
			// Searches specific medications
			$medications = $app->businessLogicDatabase->searchSpecificNonDeletedMedications($expression, $page, $sorting);
		}
		
		// Gets the number of rows found
		$foundRows = $app->businessLogicDatabase->getFoundRows();
		
		// Converts the IDs to hexadecimal
		$medications = arrayIdsToHexadecimal($medications);
		
		// Gets the IDs
		$ids = array_column($medications, 'id');
		
		return [ $foundRows, $ids ];
	}
	
}
