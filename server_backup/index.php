<?php

/*
 * This script includes all the necessary scripts and initializes the
 * application.
 */

// Constants
require 'private/scripts/constants.php';

// Slim framework
require 'private/scripts/Slim/Slim.php';

// Initializes the framework
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim([
	'mode' => OPERATION_MODE_DEBUG
	//'mode' => OPERATION_MODE_RELEASE TODO: set before release
]);

// Classes
require 'private/scripts/classes.php';

// Configurations
require 'private/scripts/configurations.php';

// Services
require 'private/scripts/services.php';

// Serves the incoming request
$app->run();
