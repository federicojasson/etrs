<?php

namespace App\Auxiliar\EntityModel;

/*
 * This class offers an interface to perform operations on backgrounds.
 */
class BackgroundModel extends EntityModel {
	
	/*
	 * Creates an entity of the type of this model.
	 * 
	 * It receives the entity's data.
	 */
	public function create() {
		$app = $this->app;
		
		// Creates the background
		$function = [ $app->businessLogicDatabase, 'createBackground' ];
		call_user_func_array($function, func_get_args());
	}
	
	/*
	 * Deletes an entity of the type of this model.
	 * 
	 * It receives the entity's ID.
	 */
	public function delete($id) {
		$app = $this->app;
		
		// Deletes the background
		$app->businessLogicDatabase->deleteBackground($id);
	}
	
	/*
	 * Edits an entity of the type of this model.
	 * 
	 * It receives the entity's data.
	 */
	public function edit() {
		$app = $this->app;
		
		// Edits the background
		$function = [ $app->businessLogicDatabase, 'editBackground' ];
		call_user_func_array($function, func_get_args());
	}
	
	/*
	 * Determines whether an entity exists.
	 * 
	 * It receives the entity's ID.
	 */
	public function exists($id) {
		$app = $this->app;
		
		// Determines whether the background exists
		return $app->businessLogicDatabase->nonDeletedBackgroundExists($id);
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
		
		// Gets the background
		return $app->businessLogicDatabase->getNonDeletedBackground($id);
	}
	
	/*
	 * Searches entities of the type of this model. It returns an array
	 * containing, as the first element, the total number of results, and as the
	 * second, the results found in the page ready for presentation.
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
		
		// Gets the found IDs
		$ids = array_column($backgrounds, 'id');
		
		// Converts the IDs to hexadecimal
		$ids = applyFunctionToArray($ids, 'bin2hex');
		
		return [
			$foundRows,
			$ids
		];
	}
	
}
