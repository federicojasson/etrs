<?php

namespace App\Auxiliar\EntityModel;

/*
 * This class offers an interface to perform operations on sessions.
 */
class SessionModel extends EntityModel {
	
	/*
	 * Creates an entity of the type of this model.
	 * 
	 * It receives the entity's data.
	 */
	public function create() {
		// The operation is not defined
	}
	
	/*
	 * TODO: comments
	 */
	public function createOrEdit() { // TODO: put in in parent class also?
		$app = $this->app;
		
		// Creates or edits the session
		$function = [ $app->webServerDatabase, 'createOrEditSession' ];
		call_user_func_array($function, func_get_args());
	}
	
	/*
	 * Deletes an entity of the type of this model.
	 * 
	 * It receives the entity's ID.
	 */
	public function delete($id) {
		$app = $this->app;
		
		// Deletes the session
		$app->webServerDatabase->deleteSession($id);
	}
	
	/*
	 * TODO: comments
	 */
	public function deleteInactives($maximumInactiveTime) { // TODO: put in in parent class also?
		$app = $this->app;
		
		// Deletes the inactive sessions
		$app->webServerDatabase->deleteInactiveSessions($maximumInactiveTime);
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
		// The operation is not defined
		return false;
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
		
		// Gets the session
		return $app->webServerDatabase->getSession($id);
	}
	
	/*
	 * Searches entities of the type of this model. It returns an array
	 * containing, as the first element, the total number of results, and as the
	 * second, the results ready for presentation found in the page.
	 * 
	 * It receives an expression, the page and a sorting.
	 */
	public function search($expression, $page, $sorting) {
		// The operation is not defined
		return null;
	}
	
}
