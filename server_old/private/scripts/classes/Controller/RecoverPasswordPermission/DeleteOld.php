<?php

namespace App\Controller\RecoverPasswordPermission;

/*
 * This controller is responsible for the following service:
 * 
 * URI:		/server/recover-password-permission/delete-old
 * Method:	POST
 */
class DeleteOld extends \App\Controller\SynchronizedInternalController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Deletes the old recover password permissions
		$app->data->recoverPasswordPermission->deleteOld(MAXIMUM_AGE_RECOVER_PASSWORD_PERMISSION);
	}

	/*
	 * Returns the path of the file used as lock.
	 */
	protected function getLockFilePath() {
		// The service corresponds to a short cron job
		return ROOT_DIRECTORY . '/private/locks/short-cron-job.lock';
	}

}
