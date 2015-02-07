<?php

namespace App\Auxiliar\EntityModel;

/*
 * This class offers operations to manage treatments.
 */
class TreatmentModel extends EntityModel {
	
	/*
	 * Creates a treatment.
	 * 
	 * It receives the treatment's data.
	 */
	public function create($id, $creator, $name) {
		$app = $this->app;
		
		// Creates the treatment
		$app->businessLogicDatabase->createTreatment($id, $creator, $name);
	}
	
	/*
	 * Deletes a treatment.
	 * 
	 * It receives the treatment's ID.
	 */
	public function delete($id) {
		$app = $this->app;
		
		// Deletes the treatment
		$app->businessLogicDatabase->deleteTreatment($id);
	}
	
	/*
	 * Edits a treatment.
	 * 
	 * It receives the treatment's data.
	 */
	public function edit($id, $lastEditor, $name) {
		$app = $this->app;
		
		// Edits the treatment
		$app->businessLogicDatabase->editTreatment($id, $lastEditor, $name);
	}
	
	/*
	 * Determines whether a treatment exists.
	 * 
	 * It receives the treatment's ID.
	 */
	public function exists($id) {
		$app = $this->app;
		
		// Determines whether the treatment exists
		return $app->businessLogicDatabase->nonDeletedTreatmentExists($id);
	}
	
	/*
	 * Filters a treatment for presentation and returns the result.
	 * 
	 * It receives the treatment.
	 */
	public function filter($treatment) {
		// TODO: implement
		return $treatment;
	}
	
	/*
	 * Returns a treatment. If it doesn't exist, null is returned.
	 * 
	 * It receives the treatment's ID.
	 */
	public function get($id) {
		$app = $this->app;
		
		// Gets the treatment
		return $app->businessLogicDatabase->getNonDeletedTreatment($id);
	}
	
	/*
	 * Searches treatments. It returns an array containing the total number of
	 * results and the results found in the page, ready for presentation.
	 * 
	 * It receives an expression, the page and a sorting.
	 */
	public function search($expression, $page, $sorting) {
		$app = $this->app;
		
		if (is_null($expression)) {
			// Searches all treatments
			$treatments = $app->businessLogicDatabase->searchAllNonDeletedTreatments($page, $sorting);
		} else {
			// Searches specific treatments
			$treatments = $app->businessLogicDatabase->searchSpecificNonDeletedTreatments($expression, $page, $sorting);
		}
		
		// Gets the number of rows found
		$foundRows = $app->businessLogicDatabase->getFoundRows();
		
		// Converts the IDs to hexadecimal
		$treatments = objectIdsToHexadecimal($treatments);
		
		// Gets the IDs
		$ids = array_column($treatments, 'id');
		
		return [ $foundRows, $ids ];
	}
	
}
