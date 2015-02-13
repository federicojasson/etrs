<?php

/*
 * This script defines cron job utilities.
 */

// Includes resources
require ROOT_PATH . 'private/scripts/resources/constants.php';
require ROOT_PATH . 'private/scripts/resources/utility-functions.php';

/*
 * Connects to a database and returns a PDO instance representing the
 * connection.
 * 
 * It receives the DSN, the username and the password.
 */
function connectToDatabase($dsn, $username, $password) {
	// Creates the PDO instance
	$pdo = new \PDO($dsn, $username, $password);

	// Configures the PDO
	$pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
	$pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
	$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

	// Sets the isolation level for the transactions
	$pdo->exec('SET SESSION TRANSACTION ISOLATION LEVEL SERIALIZABLE');
	
	return $pdo;
}

/*
 * Connects to the web server database and returns a PDO instance representing
 * the connection.
 */
function connectToWebServerDatabase() {
	// Gets the database's parameters
	$path = ROOT_PATH . 'private/parameters/databases.json';
	$parameters = readJsonFile($path)['webServerDatabase'];
	$dsn = $parameters['dsn'];
	$username = $parameters['username'];
	$password = $parameters['password'];
	
	// Connects to the database
	connectToDatabase($dsn, $username, $password);
}

/*
 * Executes a cron job, using a file as lock to avoid that multiple jobs get
 * executed at the same time.
 * 
 * It receives the file's path and an execution function to be invoked when the
 * cron job acquires the lock.
 */
function executeCronJob($path, $executionFunction) {
	// Opens the file
	$file = fopen($path, 'c');
	
	// Acquires the lock (or waits until it is released)
	flock($file, LOCK_EX);
	
	try {
		// Invokes the execution function
		call_user_func($executionFunction);
	} catch (\Exception $exception) {
		// The operation failed
		echo $exception->getMessage(); // TODO: remove this
	}
	
	// Releases the lock
	flock($file, LOCK_UN);
}

/*
 * Executes a long cron job.
 * 
 * It receives an execution function to be invoked when the cron job acquires
 * the lock.
 */
function executeLongCronJob($executionFunction) {
	// Executes the cron job
	$path = ROOT_PATH . 'private/locks/long-cron-job.lock';
	executeCronJob($path, $executionFunction);
}

/*
 * Executes a short cron job.
 * 
 * It receives an execution function to be invoked when the cron job acquires
 * the lock.
 */
function executeShortCronJob($executionFunction) {
	// Executes the cron job
	$path = ROOT_PATH . 'private/locks/short-cron-job.lock';
	executeCronJob($path, $executionFunction);
}
