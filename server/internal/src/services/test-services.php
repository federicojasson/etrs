<?php

// TODO: remove this services

$app = \Slim\Slim::getInstance();

$app->group(ROUTE_GROUP_ANONYMOUS, function() use ($app) {
	
	$app->get('/test', function() use ($app) {
	});
	
});
