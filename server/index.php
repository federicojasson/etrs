<?php

// Initializes the framework

require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim([
	'mode' => 'debug'
	// 'mode' => 'release' TODO: set before release
]);


// Initializes the application
require 'AuthenticationManager.php';
require 'DbmsConnection.php';
require 'EtrsDatabase.php';
require 'EtrsServerDatabase.php';
require 'Session.php';
require 'SessionMiddleware.php';
require 'SessionStorageHandler.php';
require 'DatabaseSessionStorageHandler.php';

require 'test/TestSessionStorageHandler.php'; // TODO: remove before release

require 'configurations.php';
require 'doctor_services.php';

require 'test/test_services.php'; // TODO: remove before release


// Serves the incoming request
$app->run();
