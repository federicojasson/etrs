<?php

/*
 * This script initializes the application.
 */

// Includes the application's scripts
require __DIR__ . '/private/scripts/scripts.php';

// Initializes the framework
$app = new \Slim\Slim([
	'mode' => OPERATION_MODE_DEBUG
	//'mode' => OPERATION_MODE_RELEASE
]);

// Adds the middlewares
$app->add(new \App\Middleware\Session());
$app->add(new \App\Middleware\Services());
$app->add(new \App\Middleware\Configurations());
$app->add(new \App\Middleware\Helpers());
$app->add(new \App\Middleware\ErrorHandlers());
$app->add(new \App\Middleware\Extensions());

// Serves the request
$app->run();
