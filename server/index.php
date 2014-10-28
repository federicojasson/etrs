<?php

/*
 * This script includes all the necessary scripts and initializes the
 * application.
 */

// Constants
require 'private/src/constants.php';

// Slim framework
require 'private/src/vendors/Slim/Slim.php';

// Initializes the framework
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim([
	'mode' => OPERATION_MODE_DEBUG
	//'mode' => OPERATION_MODE_RELEASE TODO: set before release
]);

// Classes
require 'private/src/classes.php';

// Configurations
require 'private/src/configurations.php';

// Services
require 'private/src/services.php';

// Serves the incoming request
$app->run();
