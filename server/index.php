<?php

require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

// TODO: set
$app = new \Slim\Slim([
	'mode' => 'debug'
	//'mode' => 'release'
]);

require 'DatabaseManager.php';

require 'configurations.php';
require 'services.php';

$app->run();
