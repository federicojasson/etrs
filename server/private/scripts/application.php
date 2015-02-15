<?php

/*
 * This script includes the application's scripts and defines bootstrapping
 * functions.
 */

// Defines a class autoloader
spl_autoload_register('onClassReference');

// Includes resources
require ROOT_DIRECTORY . '/private/scripts/resources/constants.php';
require ROOT_DIRECTORY . '/private/scripts/resources/functions.php';

// Includes vendors
require ROOT_DIRECTORY . '/private/scripts/vendors/PHPMailer/PHPMailerAutoload.php';
require ROOT_DIRECTORY . '/private/scripts/vendors/Slim/Slim.php'; \Slim\Slim::registerAutoloader();

/*
 * Invoked when a class is referenced and has not been defined yet.
 * 
 * It includes the class if the corresponding file exists.
 * 
 * It receives the class.
 */
function onClassReference($class) {
	// Initializes the application's namespace and its length
	$applicationNamespace = 'App\\';
	$length = strlen($applicationNamespace);

	// Gets the class' prefix and suffix
	$prefix = substr($class, 0, $length);
	$suffix = substr($class, $length);

	if ($prefix !== $applicationNamespace) {
		// The class don't belong to the application's namespace
		return;
	}

	// Builds the file's path
	$path = '';
	$path .= ROOT_DIRECTORY . '/private/scripts/classes/';
	$path .= str_replace('\\', '/', $suffix);
	$path .= '.php';

	if (file_exists($path)) {
		// The file exists: it includes it
		require $path;
	}
}

/*
 * Runs the application to serve a request.
 * 
 * It receives the operation mode and the middlewares to add before serving the
 * request.
 */
function runApplication($operationMode, $middlewares) {
	// Initializes the framework
	$app = new \Slim\Slim([
		'mode' => $operationMode
	]);

	// Adds the middlewares
	foreach ($middlewares as $middleware) {
		$app->add($middleware);
	}

	// Serves the request
	$app->run();
}

/*
 * Serves an external request.
 */
function serveExternalRequest() {
	// Defines the operation mode
	$operationMode = OPERATION_MODE_DEBUG;
	//$operationMode = OPERATION_MODE_RELEASE;

	// Runs the application
	runApplication($operationMode, [
		new \App\Middleware\Session(),
		new \App\Middleware\ExternalServices(),
		new \App\Middleware\Configurations(),
		new \App\Middleware\Helpers(),
		new \App\Middleware\ErrorHandlers(),
		new \App\Middleware\Extensions()
	]);
}

/*
 * Serves an internal request.
 * 
 * It receives the URI of the requested service.
 */
function serveInternalRequest($uri) {
	// Mocks the request
	\Slim\Environment::mock([
		'PATH_INFO' => $uri,
		'REQUEST_METHOD' => 'POST'
	]);
	
	// Defines the operation mode
	$operationMode = OPERATION_MODE_DEBUG;
	//$operationMode = OPERATION_MODE_RELEASE;

	// Runs the application
	runApplication($operationMode, [
		new \App\Middleware\InternalServices(),
		new \App\Middleware\Configurations(),
		new \App\Middleware\Helpers(),
		new \App\Middleware\ErrorHandlers(), // TODO: necessary?
		new \App\Middleware\Extensions() // TODO: necessary?
	]);
}
