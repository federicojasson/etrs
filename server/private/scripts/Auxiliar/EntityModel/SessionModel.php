<?php

namespace App\Auxiliar\EntityModel;

/*
 * This class offers operations to manage sessions.
 */
class SessionModel extends EntityModel {
	
	/*
	 * Creates or edits a session.
	 * 
	 * It receives the session's data.
	 */
	public function createOrEdit($id, $data) {
		$app = $this->app;
		
		// Creates or edits the session
		$app->webServerDatabase->createOrEditSession($id, $data);
	}
	
	/*
	 * Deletes a session.
	 * 
	 * It receives the session's ID.
	 */
	public function delete($id) {
		$app = $this->app;
		
		// Deletes the session
		$app->webServerDatabase->deleteSession($id);
	}
	
	/*
	 * Deletes inactive sessions.
	 * 
	 * It receives the maximum time that a session can remain inactive (in
	 * seconds).
	 */
	public function deleteInactives($maximumInactiveTime) {
		$app = $this->app;
		
		// Deletes the inactive sessions
		$app->webServerDatabase->deleteInactiveSessions($maximumInactiveTime);
	}
	
	/*
	 * Returns a session. If it doesn't exist, null is returned.
	 * 
	 * It receives the session's ID.
	 */
	public function get($id) {
		$app = $this->app;
		
		// Gets the session
		return $app->webServerDatabase->getSession($id);
	}
	
}
