<?php

/*
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

/*
 * This script includes the scripts of the application and defines bootstrapping
 * functions.
 */

// Defines useful directories
define('DIRECTORY_SCRIPTS', DIRECTORY_ROOT . '/private/scripts');

// Includes resources
require DIRECTORY_SCRIPTS . '/resources/constants.php';
require DIRECTORY_SCRIPTS . '/resources/functions.php';

// Includes vendors
require DIRECTORY_SCRIPTS . '/vendors/PHPMailer/PHPMailerAutoload.php';
require DIRECTORY_SCRIPTS . '/vendors/Slim/Slim.php'; \Slim\Slim::registerAutoloader();

// Defines a class autoloader
spl_autoload_register('loadClass');

// Defines the operation mode
define('OPERATION_MODE', OPERATION_MODE_DEBUG);
//define('OPERATION_MODE', OPERATION_MODE_MAINTENANCE);
//define('OPERATION_MODE', OPERATION_MODE_RELEASE);

/*
 * Executes a cron job.
 * 
 * Receives the URI and the HTTP method of the service to execute.
 */
function executeCronJob($uri, $method) {
	if (OPERATION_MODE === OPERATION_MODE_MAINTENANCE) {
		// The system is under maintenance
		// Prints an informative message
		echo 'The system is under maintenance.';
		return;
	}
	
	// Mocks the environment
	\Slim\Environment::mock([
		'PATH_INFO' => $uri,
		'REQUEST_METHOD' => $method
	]);
	
	// Defines the middlewares to use
	$middlewares = [
		new \App\Middleware\InternalServices()
	];
	
	// Runs the application
	runApplication($middlewares);
}

/*
 * Executes a maintenance job.
 * 
 * Receives the URI and the HTTP method of the service to execute.
 */
function executeMaintenanceJob($uri, $method) {
	if (OPERATION_MODE !== OPERATION_MODE_MAINTENANCE) {
		// The system is not under maintenance
		// Prints an informative message
		echo 'The system is not under maintenance.';
		return;
	}
	
	// Mocks the environment
	\Slim\Environment::mock([
		'PATH_INFO' => $uri,
		'REQUEST_METHOD' => $method
	]);
	
	// Defines the middlewares to use
	$middlewares = [
		new \App\Middleware\InternalServices()
	];
	
	// Runs the application
	runApplication($middlewares);
}

/*
 * Includes a class if the corresponding script exists.
 * 
 * Receives the fully qualified name of the class.
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

	// Builds the script's path
	$path = '';
	$path .= DIRECTORY_SCRIPTS . '/classes';
	$path .= '/' . str_replace('\\', '/', $suffix);
	$path .= '.php';

	if (file_exists($path)) {
		// The script exists
		// Includes the script
		require $path;
	}
}

/*
 * Registers a set of middlewares and runs the application.
 * 
 * Receives the middlewares.
 */
function runApplication($middlewares) {
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

/*
 * Serves an HTTP request.
 */
function serveHttpRequest() {
	// TODO: recheck middleware order
	
	// Defines the middlewares to use
	$middlewares = [
		new \App\Middleware\ExternalServices()
	];
	
	if (OPERATION_MODE === OPERATION_MODE_MAINTENANCE) {
		// The system is under maintenance
		// Defines an exceptional middleware
		$middlewares[] = new \App\Middleware\Maintenance();
	}
	
	// Runs the application
	runApplication($middlewares);
}
