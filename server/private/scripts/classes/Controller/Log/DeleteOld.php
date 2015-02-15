<?php

namespace App\Controller\Log;

/*
 * This controller is responsible for the following service:
 * 
 * URI:		/server/log/delete-old
 * Method:	POST
 */
class DeleteOld extends \App\Controller\SynchronizedInternalController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Deletes the old logs
		$app->data->log->deleteOld(MAXIMUM_AGE_LOG);
	}

	/*
	 * Returns the path of the file used as lock.
	 */
	protected function getLockFilePath() {
		// The service corresponds to a short cron job
		return ROOT_DIRECTORY . '/private/locks/short-cron-job.lock';
	}

}
