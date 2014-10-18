<?php

require 'Slim/Slim.php';
require 'parameters.php';


\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim([
	//'mode' => OPERATION_MODE_RELEASE
	'mode' => OPERATION_MODE_DEBUG
]);



require 'classes/AuthenticationManager.php';
require 'classes/AuthorizationMiddleware.php';
require 'classes/BusinessDatabase.php';
require 'classes/DbmsConnection.php';
require 'classes/ServerDatabase.php';
require 'classes/Session.php';
require 'classes/SessionMiddleware.php';
require 'classes/SessionStorageHandler.php';
require 'classes/DatabaseSessionStorageHandler.php';

require 'configurations.php';

require 'services/anonymous_services.php';
require 'services/doctor_services.php';
require 'services/operator_services.php';
require 'services/researcher_services.php';


// Serves the incoming request
$app->run();
