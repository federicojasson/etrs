<?php

/*
 * This script clears old logs.
 */

// Defines the root path
define('ROOT_PATH', __DIR__ . '/../../../');

// Includes resources
require ROOT_PATH . 'private/scripts/resources/cron-job-utilities.php';

// Executes the cron job
executeShortCronJob('execute');

/*
 * Executes the cron job.
 */
function execute() {
	// Gets the database's parameters
	/*$dsn = ;
	$username = ;
	$password = ;*/
	
	// Connects to the database
	//$pdo = connectToDatabase($dsn, $username, $password);
	
	// TODO: comments
	// TODO: try catch
	// TODO: implement
	
	// TODO: get dsn, username and password
	/*$databaseParameters = readJsonFile(__DIR__ . '/../../parameters/databases.json');
	$dsn = $databaseParameters['webServerDatabase']['dsn'];
	$username = $databaseParameters['webServerDatabase']['username'];
	$password = $databaseParameters['webServerDatabase']['password'];
	
	$pdo = connectToDatabase($dsn, $username, $password);

	$statement = '
		DELETE
		FROM logs
		WHERE creation_datetime < DATE_SUB(UTC_TIMESTAMP(), INTERVAL :maximumTime SECOND)
	';

	$maximumTime = 1; // TODO: set parameters
	$parameters = [
		':maximumTime' => $maximumTime // TODO: set maximum time variable and change name
	];

	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute($parameters);*/
}
