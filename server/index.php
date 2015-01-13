<?php

/*
 * This script initializes the application.
 */

require 'private/vendors/Slim/Slim.php';
\Slim\Slim::registerAutoloader();

require 'private/scripts/classes.php';
require 'private/scripts/constants.php';
require 'private/scripts/functions.php';

// Initializes Slim
$app = new \Slim\Slim([
	'mode' => OPERATION_MODE_DEBUG
	//'mode' => OPERATION_MODE_RELEASE
]);

// Adds the middlewares
// TODO: add middlewares

// Serves the request
$app->run();
