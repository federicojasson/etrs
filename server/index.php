<?php

/*
 * This script initializes the application.
 */

require 'private/vendors/PHPMailer/PHPMailerAutoload.php';
require 'private/vendors/Slim/Slim.php'; \Slim\Slim::registerAutoloader();

require 'private/scripts/classes.php';
require 'private/scripts/constants.php';
require 'private/scripts/functions.php';

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
