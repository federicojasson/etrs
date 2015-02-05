<?php

namespace App\Auxiliar\EntityModel;

/*
 * This class offers an interface to perform operations on users.
 */
class UserModel extends EntityModel {
	
	/*
	 * Creates an entity of the type of this model.
	 * 
	 * It receives the entity's data.
	 */
	public function create() {
		$app = $this->app;
		
		// Creates the user
		$function = [ $app->webServerDatabase, 'createUser' ];
		call_user_func_array($function, func_get_args());
	}
	
	/*
	 * Deletes an entity of the type of this model.
	 * 
	 * It receives the entity's ID.
	 */
	public function delete($id) {
		// The operation is not defined
	}
	
	/*
	 * Edits an entity of the type of this model.
	 * 
	 * It receives the entity's data.
	 */
	public function edit() {
		// The operation is not defined
	}
	
	/*
	 * Determines whether an entity exists.
	 * 
	 * It receives the entity's ID.
	 */
	public function exists($id) {
		$app = $this->app;
		
		// Determines whether the user exists
		return $app->webServerDatabase->userExists($id);
	}
	
	/*
	 * Filters an entity for presentation and returns the result.
	 * 
	 * It receives the entity.
	 */
	public function filter($entity) {
		// The operation is not defined
		return null;
	}
	
	/*
	 * Returns an entity of the type of this model. If it doesn't exist, null is
	 * returned.
	 * 
	 * It receives the entity's ID.
	 */
	public function get($id) {
		$app = $this->app;
		
		// Gets the user
		return $app->webServerDatabase->getUser($id);
	}
	
	/*
	 * Searches entities of the type of this model. It returns an array
	 * containing, as the first element, the total number of results, and as the
	 * second, the results found in the page ready for presentation.
	 * 
	 * It receives an expression, the page and a sorting.
	 */
	public function search($expression, $page, $sorting) {
		// The operation is not defined
		return null;
	}
	
}
