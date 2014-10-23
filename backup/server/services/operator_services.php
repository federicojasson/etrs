<?php

// TODO: comments

// Gets the app
$app = \Slim\Slim::getInstance();

$app->group(ROUTE_GROUP_OPERATOR, function() use ($app) {
	
	// TODO: debug
	$app->get('/test', function() use ($app) {
		echo 'test<br>';
	});
	
});
