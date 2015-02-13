<?php

/*
 * This script deletes the old sign up permissions.
 */

// Defines the root path
define('ROOT_DIRECTORY', __DIR__ . '/../../..');

// Includes resources
require ROOT_DIRECTORY . '/private/scripts/resources/cron-job-utilities.php';

// Executes the cron job
executeShortCronJob('execute');

/*
 * Deletes the old sign up permissions.
 * 
 * It receives a PDO instance representing the connection with the database and
 * the maximum age of a sign up permission (in hours).
 */
function deleteOldSignUpPermissions($pdo, $maximumAge) {
	// Defines the statement
	$statement = '
		DELETE
		FROM sign_up_permissions
		WHERE creation_datetime < DATE_SUB(UTC_TIMESTAMP(), INTERVAL :maximumAge HOUR)
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
	
	// Deletes the old sign up permissions
	deleteOldSignUpPermissions($pdo, MAXIMUM_AGE_SIGN_UP_PERMISSION);
}
