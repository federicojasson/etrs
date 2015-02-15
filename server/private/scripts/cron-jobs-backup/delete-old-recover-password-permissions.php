<?php

/*
 * This script deletes the old recover password permissions.
 */

// Defines the root path
define('ROOT_DIRECTORY', __DIR__ . '/../../..');

// Includes resources
require ROOT_DIRECTORY . '/private/scripts/resources/cron-job-utilities.php';

// Executes the cron job
executeShortCronJob('execute');

/*
 * Deletes the old recover password permissions.
 * 
 * It receives a PDO instance representing the connection with the database and
 * the maximum age of a recover password permission (in hours).
 */
function deleteOldRecoverPasswordPermissions($pdo, $maximumAge) {
	// Defines the statement
	$statement = '
		DELETE
		FROM recover_password_permissions
		WHERE creation_datetime < DATE_SUB(UTC_TIMESTAMP(), INTERVAL :maximumAge HOUR)
	';
	
	// Defines the parameters
	$parameters = [
		':maximumAge' => $maximumAge
	];
	
	// Prepares and executes the statement
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute($parameters);
}

/*
 * Executes the cron job.
 */
function execute() {
	// Connects to the web server database
	$pdo = connectToWebServerDatabase();
	
	// Deletes the old recover password permissions
	deleteOldRecoverPasswordPermissions($pdo, MAXIMUM_AGE_RECOVER_PASSWORD_PERMISSION);
}
