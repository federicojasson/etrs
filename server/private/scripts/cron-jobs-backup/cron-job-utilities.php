<?php

/*
 * This script defines cron job utilities.
 */

// Includes resources
require ROOT_DIRECTORY . '/private/scripts/resources/constants.php';
require ROOT_DIRECTORY . '/private/scripts/resources/utility-functions.php';

/*
 * Connects to the business logic database and returns a PDO instance
 * representing the connection.
 */
function connectToBusinessLogicDatabase() {
	// Gets the database's parameters
	$parameters = getDatabaseParameters('businessLogicDatabase');
	$dsn = $parameters['dsn'];
	$username = $parameters['username'];
	$password = $parameters['password'];
	
	// Connects to the database and returns the PDO instance
	return connectToDatabase($dsn, $username, $password);
}

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
	$parameters = getDatabaseParameters('webServerDatabase');
	$dsn = $parameters['dsn'];
	$username = $parameters['username'];
	$password = $parameters['password'];
	
	// Connects to the database and returns the PDO instance
	return connectToDatabase($dsn, $username, $password);
}

/*
 * Executes a cron job, using a file as lock to avoid that multiple jobs of the
 * same type get executed at the same time.
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
 * It receives an execution function to be invoked when the cron job gains
 * access.
 */
function executeLongCronJob($executionFunction) {
	// Executes the cron job
	$path = ROOT_DIRECTORY . '/private/locks/long-cron-job.lock';
	executeCronJob($path, $executionFunction);
}

/*
 * Executes a short cron job.
 * 
 * It receives an execution function to be invoked when the cron job gains
 * access.
 */
function executeShortCronJob($executionFunction) {
	// Executes the cron job
	$path = ROOT_DIRECTORY . '/private/locks/short-cron-job.lock';
	executeCronJob($path, $executionFunction);
}

/*
 * Returns the parameters of a database.
 * 
 * It receives the database's name.
 */
function getDatabaseParameters($name) {
	// Reads the databases parameters file and stores the result
	$path = ROOT_DIRECTORY . '/private/parameters/databases.json';
	$parameters = readJsonFile($path);
	
	// Returns the database's parameters
	return $parameters[$name];
}
