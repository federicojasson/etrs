<?php

// TODO: remove this services

$app = \Slim\Slim::getInstance();

$app->group(ROUTE_GROUP_ANONYMOUS, function() use ($app) {
	
	$app->post('/get-authentication-state', function() use ($app) {
		sleep(3);
		
		$app->response->setBody([
			'loggedIn' => false,
			'user' => [
				'firstNames' => 'Federico',
				'id' => 1251,
				'lastNames' => 'Jasson',
				'role' => 'DR'
			]
		]);
	});
	
	$app->post('/log-in', function() use ($app) {
		sleep(3);
		
		$app->response->setBody([
			'loggedIn' => false
		]);
	});
	
	$app->post('/log-out', function() use ($app) {
		sleep(3);
	});
	
});
