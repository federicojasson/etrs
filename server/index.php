<?php

/*
 * This script includes all the necessary scripts and initializes the
 * application.
 */

// Constants
require 'internal/src/constants.php';

// Slim framework
require 'internal/src/Slim/Slim.php';

// Initializes the framework
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim([
	'mode' => OPERATION_MODE_DEBUG
	//'mode' => OPERATION_MODE_RELEASE TODO: set before release
]);

// Classes
require 'internal/src/classes.php';

// Configurations
require 'internal/src/configurations.php';

// Services
require 'internal/src/services.php';

// Serves the incoming request
$app->run();
