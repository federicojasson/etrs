<?php

/*
 * This script initializes the application.
 */

use \App\Middleware as Middleware;

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
$app->add(new Middleware\Session());
$app->add(new Middleware\Services());
$app->add(new Middleware\Configurations());
$app->add(new Middleware\Helpers());
$app->add(new Middleware\ErrorHandlers());
$app->add(new Middleware\Extensions());

// Serves the request
$app->run();
