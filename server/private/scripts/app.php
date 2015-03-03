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
 * This script includes the application and defines bootstrapping functions.
 */

// Defines the directories
define('DIRECTORY_EMAILS', DIRECTORY_ROOT . '/private/emails');
define('DIRECTORY_FILES', DIRECTORY_ROOT . '/private/files');
define('DIRECTORY_LOGS', DIRECTORY_ROOT . '/private/logs');
define('DIRECTORY_PARAMETERS', DIRECTORY_ROOT . '/private/parameters');
define('DIRECTORY_SCRIPTS', DIRECTORY_ROOT . '/private/scripts');
define('DIRECTORY_VENDORS', DIRECTORY_ROOT . '/private/vendors');

// Includes the vendors
require_once DIRECTORY_VENDORS . '/Doctrine2/autoload.php';
require_once DIRECTORY_VENDORS . '/PHPMailer/PHPMailerAutoload.php';
require_once DIRECTORY_VENDORS . '/Slim/Slim.php'; \Slim\Slim::registerAutoloader();

// Includes the resources
require_once DIRECTORY_SCRIPTS . '/resources/constants.php';
require_once DIRECTORY_SCRIPTS . '/resources/functions.php';

// Registers a class autoloader
spl_autoload_register('loadClass');

// Defines the operation mode
define('OPERATION_MODE', OPERATION_MODE_DEVELOPMENT);
//define('OPERATION_MODE', OPERATION_MODE_MAINTENANCE);
//define('OPERATION_MODE', OPERATION_MODE_PRODUCTION);

/**
 * Executes a maintenance task.
 * 
 * Receives the URL of the requested service.
 */
function executeMaintenanceTask($url) {
	if (OPERATION_MODE !== OPERATION_MODE_MAINTENANCE) {
		// The system is not under maintenance
		
		// Shows an informative message
		echo 'The system is not under maintenance';
		
		// Exits the application
		exit();
	}
	
	// Serves the internal request
	serveInternalRequest($url);
}

/**
 * Executes a scheduled task.
 * 
 * Receives the URL of the requested service.
 */
function executeScheduledTask($url) {
	if (OPERATION_MODE === OPERATION_MODE_MAINTENANCE) {
		// The system is under maintenance
		
		// Shows an informative message
		echo 'The system is under maintenance';
		
		// Exits the application
		exit();
	}
	
	// Serves the internal request
	serveInternalRequest($url);
}

/**
 * Executes a server task.
 */
function executeServerTask() {
	if (OPERATION_MODE === OPERATION_MODE_MAINTENANCE) {
		// The system is under maintenance
		
		// Defines the response
		$response = [
			'code' => CODE_SYSTEM_UNDER_MAINTENANCE
		];
		
		// Sets the appropriate headers
		http_response_code(HTTP_STATUS_SERVICE_UNAVAILABLE);
		header('Content-Type: application/json');
		
		// Sends the response
		echo json_encode($response);
		
		// Exits the application
		exit();
	}
	
	// Serves the external request
	serveExternalRequest();
}

/**
 * Returns the external services.
 */
function getExternalServices() {
	return [
		'/account/sign-in',
		'/account/sign-out',
		'/authentication/get-state',
		'/file/download',
		'/file/upload',
		'/medication/create',
		'/medication/delete',
		'/medication/edit',
		'/medication/get',
		'/medication/search',
		'/permission/reset-password/authenticate',
		'/permission/reset-password/request',
		'/permission/sign-up/authenticate',
		'/permission/sign-up/request'
	];
}

/**
 * Returns the internal services.
 */
function getInternalServices() {
	return [
		'/data/check-settings',
		'/data/generate-proxies',
		'/session/delete-expired',
		'/user/delete'
	];
}

/**
 * Includes a class if the corresponding script exists.
 * 
 * Receives the fully-qualified class name.
 */
function loadClass($class) {
	// Defines the namespace of the application and gets its length
	$namespace = 'App\\';
	$length = strlen($namespace);

	// Gets the prefix and the suffix of the class
	$prefix = substr($class, 0, $length);
	$suffix = substr($class, $length);

	if ($prefix !== $namespace) {
		// The class doesn't belong to the application
		return;
	}

	// Builds the path of the script
	$path = '';
	$path .= DIRECTORY_SCRIPTS . '/classes';
	$path .= '/' . str_replace('\\', '/', $suffix) . '.php';

	if (file_exists($path)) {
		// The script exists
		// Includes the script
		require_once $path;
	}
}

/**
 * Registers a set of middlewares and runs the application.
 * 
 * Receives the middlewares.
 */
function runApp($middlewares) {
	global $app;
	
	// Initializes the application
	$app = new \Slim\Slim([
		'mode' => OPERATION_MODE
	]);

	// Registers the middlewares
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
	// Gets the external services
	$externalServices = getExternalServices();
	
	// Initializes the middlewares
	$middlewares = [
		new \App\Middleware\Session(),
		new \App\Middleware\Services($externalServices),
		new \App\Middleware\Configurations(),
		new \App\Middleware\Helpers(),
		new \App\Middleware\ErrorHandlers()
	];
	
	// Runs the application
	runApp($middlewares);
}

/**
 * Serves an internal request.
 * 
 * Receives the URL of the requested service.
 */
function serveInternalRequest($url) {
	// Mocks the environment to simulate an HTTP request
	\Slim\Environment::mock([
		'PATH_INFO' => $url,
		'REQUEST_METHOD' => 'POST'
	]);
	
	// Gets the internal services
	$internalServices = getInternalServices();
	
	// Initializes the middlewares
	$middlewares = [
		new \App\Middleware\Services($internalServices),
		new \App\Middleware\Configurations(),
		new \App\Middleware\Helpers(),
		new \App\Middleware\ErrorHandlers()
	];
	
	// Runs the application
	runApp($middlewares);
}
