<?php

// TODO: comments

require 'Slim/Slim.php';
require 'parameters.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim([
	//'mode' => OPERATION_MODE_RELEASE
	'mode' => OPERATION_MODE_DEBUG
]);

require 'classes/middlewares/DatabaseMiddleware.php';
require 'classes/middlewares/RouteMiddleware.php';
require 'classes/middlewares/SessionMiddleware.php';

require 'classes/Database.php';
require 'classes/BusinessDatabase.php';
require 'classes/ServerDatabase.php';

require 'classes/DatabaseConnection.php';
require 'classes/RouteManager.php';

require 'configurations.php';

require 'services/anonymous_services.php';
require 'services/doctor_services.php';
require 'services/operator_services.php';
require 'services/researcher_services.php';

// Serves the incoming request
$app->run();
