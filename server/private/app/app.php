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
require_once DIRECTORY_VENDORS . '/Doctrine2/autoload.php';
require_once DIRECTORY_VENDORS . '/PHPMailer/PHPMailerAutoload.php';
require_once DIRECTORY_VENDORS . '/Slim/Slim.php';

// Includes resources
require_once DIRECTORY_APP . '/resources/constants.php';
require_once DIRECTORY_APP . '/resources/functions.php';

// Defines the operation mode
define('OPERATION_MODE', OPERATION_MODE_DEVELOPMENT);
//define('OPERATION_MODE', OPERATION_MODE_MAINTENANCE);
//define('OPERATION_MODE', OPERATION_MODE_PRODUCTION);

// Registers class autoloaders
\Slim\Slim::registerAutoloader();
spl_autoload_register('loadClass');

/**
 * Executes a server task.
 */
function executeServerTask() {
	if (OPERATION_MODE === OPERATION_MODE_MAINTENANCE) {
		// The system is under maintenance
		// Halts the application
		haltApp(HTTP_STATUS_SERVICE_UNAVAILABLE, ERROR_CODE_SYSTEM_UNDER_MAINTENANCE);
	}
	
	// Serves the external request
	serveExternalRequest();
}

/**
 * Halts the application if is running and responds to the client with an error.
 * 
 * Receives the HTTP status to set and a code that indicates what caused the
 * error.
 */
function haltApp($httpStatus, $errorCode) {
	global $app;
	
	// Defines the response
	$response = [
		'code' => $errorCode
	];
	
	if (isset($app)) {
		// The application is running
		// Halts the application
		$app->halt($httpStatus, $response);
	}
	
	// Sets the appropriate headers
	http_response_code($httpStatus);
	header('Content-Type: application/json');

	// Sends the response
	echo json_encode($response);

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
 * Receives a set of middlewares to add for the execution.
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
}

/**
 * Serves an external request.
 */
function serveExternalRequest() {
	// Initializes the necessary middlewares
	$middlewares = [
		// TODO: define middlewares here
		new \App\Middleware\ErrorHandlers(),
		new \App\Middleware\Helpers(),
		new \App\Middleware\Configuration(),
		new \App\Middleware\ExternalServices(),
		new \App\Middleware\Session()
	];
	
	// Runs the application
	runApp($middlewares);
}
