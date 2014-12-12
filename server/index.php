<?php

/*
 * This script initializes the application.
 */

require 'private/scripts/constants.php';
require 'private/scripts/Slim/Slim.php';

// Initializes the framework
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim([
	'mode' => OPERATION_MODE_DEBUG
	//'mode' => OPERATION_MODE_RELEASE
]);

require 'private/scripts/classes.php';
require 'private/scripts/configurations.php';
require 'private/scripts/errors.php';
require 'private/scripts/modules.php';
require 'private/scripts/services.php';

// Serves the incoming request
$app->run();
