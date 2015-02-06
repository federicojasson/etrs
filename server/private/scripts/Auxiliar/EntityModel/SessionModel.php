<?php

namespace App\Auxiliar\EntityModel;

/*
 * This class offers an interface to perform operations on sessions.
 */
class SessionModel extends EntityModel {
	
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
	
}
