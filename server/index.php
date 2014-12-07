<?php

/*
 * This script initializes the application.
 */

// Constants
require 'private/scripts/constants.php';

// Slim framework
require 'private/scripts/Slim/Slim.php';

// Initializes the framework
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim([
	'mode' => OPERATION_MODE_DEBUG
	//'mode' => OPERATION_MODE_RELEASE
]);

// Classes
require 'private/scripts/classes.php';

// Configurations
require 'private/scripts/configurations.php';

// Modules
require 'private/scripts/modules.php';

// Services
require 'private/scripts/services.php';

// Serves the incoming request
$app->run();
