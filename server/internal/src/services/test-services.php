<?php

// TODO: remove this services

$app = \Slim\Slim::getInstance();

$app->group(ROUTE_GROUP_ANONYMOUS, function() use ($app) {
	
	$app->post('/log-in', function() use ($app) {
		// TODO: how to make this prettier?
		$app->environment()['output'] = [
			'loggedIn' => true,
			'user' => [
				'id' => 1251,
				'role' => 'DR'
			]
		];
	});
	
});
