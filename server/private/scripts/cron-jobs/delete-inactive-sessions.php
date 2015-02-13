<?php

/*
 * This script deletes the inactive sessions.
 */

// Defines the root path
define('ROOT_DIRECTORY', __DIR__ . '/../../..');

// Includes resources
require ROOT_DIRECTORY . '/private/scripts/resources/cron-job-utilities.php';

// Executes the cron job
executeShortCronJob('execute');

/*
 * Deletes the inactive sessions.
 * 
 * It receives a PDO instance representing the connection with the database and
 * the maximum inactivity time of a session (in minutes).
 */
function deleteInactiveSessions($pdo, $maximumInactivityTime) {
	// Defines the statement
	$statement = '
		DELETE
		FROM sessions
		WHERE last_edition_datetime < DATE_SUB(UTC_TIMESTAMP(), INTERVAL :maximumInactivityTime MINUTE)
	';
	
	// Defines the parameters
	$parameters = [
		':maximumInactivityTime' => $maximumInactivityTime
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
	
	// Deletes the inactive sessions
	deleteInactiveSessions($pdo, MAXIMUM_INACTIVITY_TIME_SESSION);
}
