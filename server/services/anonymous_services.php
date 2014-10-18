<?php

// Gets the app
$app = \Slim\Slim::getInstance();

$app->group(ROUTE_GROUP_ANONYMOUS, function() use ($app) {
	
	// TODO: debug
	$app->get('/test', function() use ($app) {
		echo 'test<br>';
	});
	
	$app->post('/log-in', function() use ($app) {
		// TODO
	});
	
	$app->post('/log-out', function() use ($app) {
		// TODO
	});
	
});
