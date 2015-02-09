<?php

namespace App\Auxiliar\EntityModel;

/*
 * This class offers operations to manage clinical impressions.
 */
class ClinicalImpressionModel extends EntityModel {
	
	/*
	 * Creates a clinical impression.
	 * 
	 * It receives the clinical impression's data.
	 */
	public function create($id, $creator, $name) {
		$app = $this->app;
		
		// Creates the clinical impression
		$app->businessLogicDatabase->createClinicalImpression($id, $creator, $name);
	}
	
	/*
	 * Deletes a clinical impression.
	 * 
	 * It receives the clinical impression's ID.
	 */
	public function delete($id) {
		$app = $this->app;
		
		// Deletes the clinical impression
		$app->businessLogicDatabase->deleteClinicalImpression($id);
	}
	
	/*
	 * Edits a clinical impression.
	 * 
	 * It receives the clinical impression's data.
	 */
	public function edit($id, $lastEditor, $name) {
		$app = $this->app;
		
		// Edits the clinical impression
		$app->businessLogicDatabase->editClinicalImpression($id, $lastEditor, $name);
	}
	
	/*
	 * Determines whether a clinical impression exists.
	 * 
	 * It receives the clinical impression's ID.
	 */
	public function exists($id) {
		$app = $this->app;
		
		// Determines whether the clinical impression exists
		return $app->businessLogicDatabase->nonDeletedClinicalImpressionExists($id);
	}
	
	/*
	 * Filters a clinical impression for presentation and returns the result.
	 * 
	 * It receives the clinical impression.
	 */
	public function filter($clinicalImpression) {
		$app = $this->app;
		
		// Gets the accessible fields
		$accessibleFields = $app->accessValidator->getAccessibleFields(ENTITY_MODEL_CLINICAL_IMPRESSION);
		
		// Filters the clinical impression's fields
		$newClinicalImpression = filterArray($clinicalImpression, $accessibleFields);
		
		// Applies conversions
		
		if (isset($newClinicalImpression['id'])) {
			$newClinicalImpression['id'] = bin2hex($clinicalImpression['id']);
		}
		
		return $newClinicalImpression;
	}
	
	/*
	 * Returns a clinical impression. If it doesn't exist, null is returned.
	 * 
	 * It receives the clinical impression's ID.
	 */
	public function get($id) {
		$app = $this->app;
		
		// Gets the clinical impression
		return $app->businessLogicDatabase->getNonDeletedClinicalImpression($id);
	}
	
	/*
	 * Searches clinical impressions. It returns an array containing the total
	 * number of results and the results found in the page, ready for
	 * presentation.
	 * 
	 * It receives an expression, the page and a sorting.
	 */
	public function search($expression, $page, $sorting) {
		$app = $this->app;
		
		if (is_null($expression)) {
			// Searches all clinical impressions
			$clinicalImpressions = $app->businessLogicDatabase->searchAllNonDeletedClinicalImpressions($page, $sorting);
		} else {
			// Searches specific clinical impressions
			$clinicalImpressions = $app->businessLogicDatabase->searchSpecificNonDeletedClinicalImpressions($expression, $page, $sorting);
		}
		
		// Gets the number of rows found
		$foundRows = $app->businessLogicDatabase->getFoundRows();
		
		// Converts the IDs to hexadecimal
		$clinicalImpressions = arrayIdsToHexadecimal($clinicalImpressions);
		
		// Gets the IDs
		$ids = array_column($clinicalImpressions, 'id');
		
		return [ $foundRows, $ids ];
	}
	
}
