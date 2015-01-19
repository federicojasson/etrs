<?php

/*
 * This script initializes the application.
 */

require 'private/vendors/Slim/Slim.php';
\Slim\Slim::registerAutoloader();

require 'private/scripts/classes.php';
require 'private/scripts/constants.php';
require 'private/scripts/functions.php';

// TODO: configure somewhere else
ini_set('session.hash_function', 'sha256');
ini_set('session.hash_bits_per_character', 4);

// Initializes the framework
$app = new \Slim\Slim([
	'mode' => OPERATION_MODE_DEBUG
	//'mode' => OPERATION_MODE_RELEASE
]);

// Adds the middlewares
$app->add(new \App\Middlewares\Session());
$app->add(new \App\Middlewares\Services());
$app->add(new \App\Middlewares\Configurations());
$app->add(new \App\Middlewares\Helpers());
$app->add(new \App\Middlewares\ErrorHandlers());
$app->add(new \App\Middlewares\Extensions());

// Serves the request
$app->run();
