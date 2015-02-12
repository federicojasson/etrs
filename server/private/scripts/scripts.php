<?php

/*
 * This script includes the application's scripts.
 */

// Classes
spl_autoload_register('onClassReference');

// Includes resources
require ROOT_PATH . 'private/scripts/resources/constants.php';
require ROOT_PATH . 'private/scripts/resources/utility-functions.php';

// Includes vendors
require ROOT_PATH . 'private/scripts/vendors/PHPMailer/PHPMailerAutoload.php';
require ROOT_PATH . 'private/scripts/vendors/Slim/Slim.php'; \Slim\Slim::registerAutoloader();

/*
 * Invoked when a class is referenced and has not been defined yet.
 * 
 * It includes the class if the proper file exists.
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
	$path = ROOT_PATH . 'private/scripts/classes/' . str_replace('\\', '/', $suffix) . '.php';

	if (file_exists($path)) {
		// The file exists: it includes it
		require $path;
	}
}
