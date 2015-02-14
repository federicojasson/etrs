<?php

/*
 * This script deletes the old logs.
 */

// Defines the root path
define('ROOT_DIRECTORY', __DIR__ . '/../../..');

/*$_SERVER['REMOTE_ADDR'] = '::1';
$_SERVER['REQUEST_METHOD'] = 'POST';
$_SERVER['REQUEST_URI'] = '/server/authentication/get-state';
$_SERVER['SERVER_NAME'] = '';
$_SERVER['SERVER_PORT'] = '';*/

// Includes the application's scripts
require ROOT_DIRECTORY . '/private/scripts/scripts.php';

\Slim\Environment::mock([
	'PATH_INFO' => '/authentication/get-state',
	'REQUEST_METHOD' => 'POST'
	//'REQUEST_URI' => '/authentication/get-state'
]);

$_SERVER['REMOTE_ADDR'] = '::1';

//$_SERVER['REQUEST_METHOD'] = 'POST';
//$_SERVER['REQUEST_URI'] = '/authentication/get-state';

// Initializes the framework
$app = new \Slim\Slim([
	'mode' => OPERATION_MODE_DEBUG
	//'mode' => OPERATION_MODE_RELEASE
]);

// Adds the middlewares
$app->add(new \App\Middleware\Session());
//$app->add(new \App\Middleware\CronJobs());
$app->add(new \App\Middleware\Services());
$app->add(new \App\Middleware\Configurations());
$app->add(new \App\Middleware\Helpers());
$app->add(new \App\Middleware\ErrorHandlers());
$app->add(new \App\Middleware\Extensions());

// Serves the request
$app->run();

//// Includes resources
//require ROOT_DIRECTORY . '/private/scripts/resources/cron-job-utilities.php';
//
//// Executes the cron job
//executeShortCronJob('execute');
//
///*
// * Deletes the old logs.
// * 
// * It receives a PDO instance representing the connection with the database and
// * the maximum age of a log (in months).
// */
//function deleteOldLogs($pdo, $maximumAge) {
//	// Defines the statement
//	$statement = '
//		DELETE
//		FROM logs
//		WHERE creation_datetime < DATE_SUB(UTC_TIMESTAMP(), INTERVAL :maximumAge MONTH)
//	';
//	
//	// Defines the parameters
//	$parameters = [
//		':maximumAge' => $maximumAge
//	];
//	
//	// Executes the statement
//	$preparedStatement = $pdo->prepare($statement);
//	$preparedStatement->execute($parameters);
//}
//
///*
// * Executes the cron job.
// */
//function execute() {
//	// Connects to the web server database
//	$pdo = connectToWebServerDatabase();
//	
//	// Deletes the old logs
//	deleteOldLogs($pdo, MAXIMUM_AGE_LOG);
//}
