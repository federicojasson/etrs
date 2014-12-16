<?php

/*
 * This script initializes the application.
 */

require 'private/scripts/Slim/Slim.php';
\Slim\Slim::registerAutoloader();

require 'private/scripts/classes.php';
require 'private/scripts/constants.php';

// Initializes the framework
$app = new \Slim\Slim([
	//'mode' => OPERATION_MODE_DEBUG
	'mode' => OPERATION_MODE_RELEASE
]);

// Adds the middlewares
$app->add(new SessionMiddleware());
$app->add(new ServicesMiddleware());
$app->add(new ConfigurationsMiddleware());
$app->add(new HelpersMiddleware());
$app->add(new ErrorsMiddleware());
$app->add(new ExtensionsMiddleware());

// Serves the incoming request
$app->run();
