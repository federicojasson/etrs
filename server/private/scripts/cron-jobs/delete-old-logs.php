<?php

/*
 * This script deletes the old logs.
 */

// Defines the root path
define('ROOT_DIRECTORY', __DIR__ . '/../../..');

// Includes resources
require ROOT_DIRECTORY . '/private/scripts/resources/cron-job-utilities.php';

// Executes the cron job
executeShortCronJob('execute');

/*
 * Deletes the old logs.
 * 
 * It receives a PDO instance representing the connection with the database and
 * the maximum age of a log (in months).
 */
function deleteOldLogs($pdo, $maximumAge) {
	// Defines the statement
	$statement = '
		DELETE
		FROM logs
		WHERE creation_datetime < DATE_SUB(UTC_TIMESTAMP(), INTERVAL :maximumAge MONTH)
	';
	
	// Defines the parameters
	$parameters = [
		':maximumAge' => $maximumAge
	];
	
	// Executes the statement
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute($parameters);
}

/*
 * Executes the cron job.
 */
function execute() {
	// Connects to the web server database
	$pdo = connectToWebServerDatabase();
	
	// Deletes the old logs
	deleteOldLogs($pdo, MAXIMUM_AGE_LOG);
}
