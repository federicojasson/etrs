<?php

/**
 * ETRS - Eye Tracking Record System
 * Copyright (C) 2015 Federico Jasson
 * 
 * This program is free software: you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation, either version 3 of the License, or (at your option) any later
 * version.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU General Public License along with
 * this program. If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * This script includes the application and defines utility functions.
 */

// Defines the directories
define('DIRECTORY_APP', DIRECTORY_ROOT . '/private/app');
define('DIRECTORY_EMAILS', DIRECTORY_ROOT . '/private/emails');
define('DIRECTORY_FILES', DIRECTORY_ROOT . '/private/files');
define('DIRECTORY_LOGS', DIRECTORY_ROOT . '/private/logs');
define('DIRECTORY_PARAMETERS', DIRECTORY_ROOT . '/private/parameters');
define('DIRECTORY_VENDORS', DIRECTORY_ROOT . '/private/vendors');

// Includes vendors
require_once DIRECTORY_VENDORS . '/autoload.php';

// Includes resources
require_once DIRECTORY_APP . '/resources/constants.php';
require_once DIRECTORY_APP . '/resources/functions.php';

// Defines the operation mode
define('OPERATION_MODE', OPERATION_MODE_DEVELOPMENT);
//define('OPERATION_MODE', OPERATION_MODE_MAINTENANCE);
//define('OPERATION_MODE', OPERATION_MODE_PRODUCTION);

// Registers a class autoloader
spl_autoload_register('loadClass');

/**
 * Confirms a task.
 * 
 * It should be used only for internal tasks, since it reads the stdin to
 * interact with the user.
 * 
 * Receives a message to show to the user.
 */
function confirmTask($message) {
	// Shows a message to the user
	echo $message . PHP_EOL;
	echo 'Continue? [y/N]' . PHP_EOL;
	ob_flush();
	
	// Opens the stdin
	$stdin = fopen('php://stdin', 'r');
	
	// Reads the user's response
	$response = strtolower(fgetc($stdin));
	
	if ($response !== 'y') {
		// The task has been canceled
		// Exits the application
		exit('The task has been canceled.');
	}
}

/**
 * Executes an external task.
 */
function executeExternalTask() {
	if (OPERATION_MODE === OPERATION_MODE_MAINTENANCE) {
		// The system is under maintenance
		// Halts the application
		haltApp(HTTP_STATUS_SERVICE_UNAVAILABLE, ERROR_CODE_SYSTEM_UNDER_MAINTENANCE);
	}
	
	// Serves the external request
	serveExternalRequest();
}

/**
 * Executes an internal task.
 * 
 * Receives the requested service's URL.
 */
function executeInternalTask($url) {
	if (OPERATION_MODE === OPERATION_MODE_MAINTENANCE) {
		// The system is under maintenance
		// Exits the application
		exit('The system is under maintenance.');
	}
	
	// Serves the internal request
	serveInternalRequest($url);
}

/**
 * Executes a maintenance task.
 * 
 * Receives the requested service's URL.
 */
function executeMaintenanceTask($url) {
	if (OPERATION_MODE !== OPERATION_MODE_MAINTENANCE) {
		// The system is not under maintenance
		// Exits the application
		exit('The system is not under maintenance.');
	}
	
	// Serves the internal request
	serveInternalRequest($url);
}

/**
 * Halts the application if is running and responds to the client with an error.
 * 
 * Receives the HTTP status to be set and a code that indicates what caused the
 * error.
 */
function haltApp($httpStatus, $errorCode) {
	global $app;
	
	// Builds the response
	$response = [
		'code' => $errorCode
	];
	
	if (isset($app)) {
		// The application is running
		// Halts the application
		$app->halt($httpStatus, $response);
	}
	
	// Encodes the response
	$response = json_encode($response);
	
	// Sets the appropriate headers
	http_response_code($httpStatus);
	header('Content-Type: application/json');

	// Sends the response
	echo $response;

	// Exits the application
	exit();
}

/**
 * Includes a class of the application if the corresponding script exists.
 * 
 * Receives the class.
 */
function loadClass($class) {
	// Defines the application's namespace and gets its length
	$namespace = 'App\\';
	$length = strlen($namespace);
	
	// Gets the prefix and the suffix of the class
	$prefix = substr($class, 0, $length);
	$suffix = substr($class, $length);
	
	if ($prefix !== $namespace) {
		// The class doesn't belong to the application
		return;
	}
	
	// Builds the script's path
	$path = '';
	$path .= DIRECTORY_APP . '/classes';
	$path .= '/' . str_replace('\\', '/', $suffix) . '.php';
	
	if (file_exists($path)) {
		// The script exists
		// Includes the script
		require_once $path;
	}
}

/**
 * Runs the application.
 * 
 * Receives a set of middlewares to be added.
 */
function runApp($middlewares) {
	global $app;
	
	// Initializes the application
	$app = new \Slim\Slim([
		'mode' => OPERATION_MODE
	]);
	
	// Reverses the order of the middlewares
	$middlewares = array_reverse($middlewares);
	
	// Adds the middlewares
	foreach ($middlewares as $middleware) {
		$app->add($middleware);
	}
	
	// Runs the application
	$app->run();
	
	// Exits the application
	exit();
}

/**
 * Serves an external request.
 */
function serveExternalRequest() {
	// Initializes the middlewares
	$middlewares = [
		new \App\Middleware\ErrorHandlers(),
		new \App\Middleware\Helpers(),
		new \App\Middleware\Configuration(),
		new \App\Middleware\ExternalServices(),
		new \App\Middleware\Session()
	];
	
	// Runs the application
	runApp($middlewares);
}

/**
 * Serves an internal request.
 * 
 * Receives the requested service's URL.
 */
function serveInternalRequest($url) {
	// Mocks the environment to simulate an HTTP request
	\Slim\Environment::mock([
		'PATH_INFO' => $url,
		'REQUEST_METHOD' => 'POST'
	]);
	
	// Initializes the middlewares
	$middlewares = [
		new \App\Middleware\ErrorHandlers(),
		new \App\Middleware\Helpers(),
		new \App\Middleware\Configuration(),
		new \App\Middleware\InternalServices()
	];
	
	// Runs the application
	runApp($middlewares);
}
