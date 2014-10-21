<?php

// TODO: comments

require 'Slim/Slim.php';
require 'parameters.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim([
	//'mode' => OPERATION_MODE_RELEASE
	'mode' => OPERATION_MODE_DEBUG
]);

require 'classes/middlewares/AuthorizationMiddleware.php';
require 'classes/middlewares/DatabaseMiddleware.php';
require 'classes/middlewares/RouteMiddleware.php';
require 'classes/middlewares/SessionMiddleware.php';

require 'classes/data_objects/DataObject.php';
require 'classes/data_objects/SessionDataObject.php';
require 'classes/data_objects/UserDataObject.php';

require 'classes/Database.php';
require 'classes/BusinessDatabase.php';
require 'classes/ServerDatabase.php';

require 'classes/AuthenticationManager.php';
require 'classes/DatabaseConnection.php';
require 'classes/RouteManager.php';
require 'classes/Session.php';

require 'classes/SessionStorageHandler.php';
require 'classes/DatabaseSessionStorageHandler.php';

require 'configurations.php';

require 'services/anonymous_services.php';
require 'services/doctor_services.php';
require 'services/operator_services.php';
require 'services/researcher_services.php';

// Serves the incoming request
$app->run();
