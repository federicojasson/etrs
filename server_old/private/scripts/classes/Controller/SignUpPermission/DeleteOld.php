<?php

namespace App\Controller\SignUpPermission;

/*
 * This controller is responsible for the following service:
 * 
 * URI:		/server/sign-up-permission/delete-old
 * Method:	POST
 */
class DeleteOld extends \App\Controller\SynchronizedInternalController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Deletes the old sign up permissions
		$app->data->signUpPermission->deleteOld(MAXIMUM_AGE_SIGN_UP_PERMISSION);
	}

	/*
	 * Returns the path of the file used as lock.
	 */
	protected function getLockFilePath() {
		// The service corresponds to a short cron job
		return ROOT_DIRECTORY . '/private/locks/short-cron-job.lock';
	}

}
