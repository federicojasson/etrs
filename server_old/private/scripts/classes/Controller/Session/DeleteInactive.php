<?php

namespace App\Controller\Session;

/*
 * This controller is responsible for the following service:
 * 
 * URI:		/server/session/delete-inactive
 * Method:	POST
 */
class DeleteInactive extends \App\Controller\SynchronizedInternalController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Deletes the inactive sessions
		$app->data->session->deleteInactive(MAXIMUM_INACTIVITY_TIME_SESSION);
	}

	/*
	 * Returns the path of the file used as lock.
	 */
	protected function getLockFilePath() {
		// The service corresponds to a short cron job
		return ROOT_DIRECTORY . '/private/locks/short-cron-job.lock';
	}

}
