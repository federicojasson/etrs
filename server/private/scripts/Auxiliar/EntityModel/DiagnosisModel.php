<?php

namespace App\Auxiliar\EntityModel;

/*
 * This class offers operations to manage diagnoses.
 */
class DiagnosisModel extends EntityModel {
	
	/*
	 * Creates a diagnosis.
	 * 
	 * It receives the diagnosis' data.
	 */
	public function create($id, $creator, $name) {
		$app = $this->app;
		
		// Creates the diagnosis
		$app->businessLogicDatabase->createDiagnosis($id, $creator, $name);
	}
	
	/*
	 * Deletes a diagnosis.
	 * 
	 * It receives the diagnosis' ID.
	 */
	public function delete($id) {
		$app = $this->app;
		
		// Deletes the diagnosis
		$app->businessLogicDatabase->deleteDiagnosis($id);
	}
	
	/*
	 * Edits a diagnosis.
	 * 
	 * It receives the diagnosis' data.
	 */
	public function edit($id, $lastEditor, $name) {
		$app = $this->app;
		
		// Edits the diagnosis
		$app->businessLogicDatabase->editDiagnosis($id, $lastEditor, $name);
	}
	
	/*
	 * Determines whether a diagnosis exists.
	 * 
	 * It receives the diagnosis' ID.
	 */
	public function exists($id) {
		$app = $this->app;
		
		// Determines whether the diagnosis exists
		return $app->businessLogicDatabase->nonDeletedDiagnosisExists($id);
	}
	
	/*
	 * Filters a diagnosis for presentation and returns the result.
	 * 
	 * It receives the diagnosis.
	 */
	public function filter($diagnosis) {
		// TODO: implement
		return $diagnosis;
	}
	
	/*
	 * Returns a diagnosis. If it doesn't exist, null is returned.
	 * 
	 * It receives the diagnosis' ID.
	 */
	public function get($id) {
		$app = $this->app;
		
		// Gets the diagnosis
		return $app->businessLogicDatabase->getNonDeletedDiagnosis($id);
	}
	
	/*
	 * Searches diagnoses. It returns an array containing the total number of
	 * results and the results found in the page, ready for presentation.
	 * 
	 * It receives an expression, the page and a sorting.
	 */
	public function search($expression, $page, $sorting) {
		$app = $this->app;
		
		if (is_null($expression)) {
			// Searches all diagnoses
			$diagnoses = $app->businessLogicDatabase->searchAllNonDeletedDiagnoses($page, $sorting);
		} else {
			// Searches specific diagnoses
			$diagnoses = $app->businessLogicDatabase->searchSpecificNonDeletedDiagnoses($expression, $page, $sorting);
		}
		
		// Gets the number of rows found
		$foundRows = $app->businessLogicDatabase->getFoundRows();
		
		// Converts the IDs to hexadecimal
		$diagnoses = objectIdsToHexadecimal($diagnoses);
		
		// Gets the IDs
		$ids = array_column($diagnoses, 'id');
		
		return [ $foundRows, $ids ];
	}
	
}
