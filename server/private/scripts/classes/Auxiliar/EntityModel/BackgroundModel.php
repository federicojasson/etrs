<?php

namespace App\Auxiliar\EntityModel;

/*
 * This class offers operations to manage backgrounds.
 */
class BackgroundModel extends EntityModel {
	
	/*
	 * Creates a background.
	 * 
	 * It receives the background's data.
	 */
	public function create($id, $creator, $name) {
		$app = $this->app;
		
		// Creates the background
		$app->businessLogicDatabase->createBackground($id, $creator, $name);
	}
	
	/*
	 * Deletes a background.
	 * 
	 * It receives the background's ID.
	 */
	public function delete($id) {
		$app = $this->app;
		
		// Deletes the background
		$app->businessLogicDatabase->deleteBackground($id);
	}
	
	/*
	 * Edits a background.
	 * 
	 * It receives the background's data.
	 */
	public function edit($id, $lastEditor, $name) {
		$app = $this->app;
		
		// Edits the background
		$app->businessLogicDatabase->editBackground($id, $lastEditor, $name);
	}
	
	/*
	 * Determines whether a background exists.
	 * 
	 * It receives the background's ID.
	 */
	public function exists($id) {
		$app = $this->app;
		
		// Determines whether the background exists
		return $app->businessLogicDatabase->nonDeletedBackgroundExists($id);
	}
	
	/*
	 * Filters a background for presentation and returns the result.
	 * 
	 * It receives the background.
	 */
	public function filter($background) {
		$app = $this->app;
		
		// Gets the accessible fields
		$accessibleFields = $app->accessValidator->getAccessibleFields(ENTITY_MODEL_BACKGROUND);
		
		// Filters the background's fields
		$newBackground = filterArray($background, $accessibleFields);
		
		// Applies conversions
		
		if (isset($newBackground['id'])) {
			$newBackground['id'] = bin2hex($background['id']);
		}
		
		return $newBackground;
	}
	
	/*
	 * Returns a background. If it doesn't exist, null is returned.
	 * 
	 * It receives the background's ID.
	 */
	public function get($id) {
		$app = $this->app;
		
		// Gets the background
		return $app->businessLogicDatabase->getNonDeletedBackground($id);
	}
	
	/*
	 * Searches backgrounds. It returns an array containing the total number of
	 * results and the results found in the page, ready for presentation.
	 * 
	 * It receives an expression, the page and a sorting.
	 */
	public function search($expression, $page, $sorting) {
		$app = $this->app;
		
		if (is_null($expression)) {
			// Searches all backgrounds
			$backgrounds = $app->businessLogicDatabase->searchAllNonDeletedBackgrounds($page, $sorting);
		} else {
			// Searches specific backgrounds
			$backgrounds = $app->businessLogicDatabase->searchSpecificNonDeletedBackgrounds($expression, $page, $sorting);
		}
		
		// Gets the number of rows found
		$foundRows = $app->businessLogicDatabase->getFoundRows();
		
		// Converts the IDs to hexadecimal
		$backgrounds = arrayIdsToHexadecimal($backgrounds);
		
		// Gets the IDs
		$ids = array_column($backgrounds, 'id');
		
		return [ $foundRows, $ids ];
	}
	
}
