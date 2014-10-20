<?php

require 'Slim/Slim.php';
require 'parameters.php';


\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim([
	//'mode' => OPERATION_MODE_RELEASE
	'mode' => OPERATION_MODE_DEBUG
]);


require 'classes/middleware/DatabaseMiddleware.php';
require 'classes/middleware/SessionMiddleware.php';

require 'classes/Database.php';
require 'classes/DatabaseConnection.php';

require 'configurations.php';

require 'services/anonymous_services.php';
require 'services/doctor_services.php';
require 'services/operator_services.php';
require 'services/researcher_services.php';


// Serves the incoming request
$app->run();
