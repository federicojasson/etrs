<?php

/*
 * This script deletes the orphan files.
 * 
 * A file is orphan when is not associated with any entity of the system.
 */

// Defines the root path
define('ROOT_DIRECTORY', __DIR__ . '/../../..');

// Includes resources
require ROOT_DIRECTORY . '/private/scripts/resources/cron-job-utilities.php';

// Executes the cron job
executeLongCronJob('execute');

/*
 * Executes the cron job.
 */
function execute() {
	// Connects to the business logic database
	//$pdo = connectToBusinessLogicDatabase();
	
	// Starts a read-write transaction
	//startReadWriteTransaction($pdo); // TODO: implement
	
	// TODO: delete non-associated files
	
	// TODO: delete files physically
	
	// Commits the transaction
	//commitTransaction($pdo); // TODO: implement
}
