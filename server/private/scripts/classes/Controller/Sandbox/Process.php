<?php

namespace App\Controller\Sandbox;

/*
 * This controller is responsible for the following service:
 * 
 * URI:		/server/sandbox/process
 * Method:	POST
 */
class Process extends \App\Controller\SynchronizedInternalController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		// TODO: implement
	}

	/*
	 * Returns the path of the file used as lock.
	 */
	protected function getLockFilePath() {
		// The service corresponds to a long cron job
		return ROOT_DIRECTORY . '/private/locks/long-cron-job.lock';
	}

}
