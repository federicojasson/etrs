<?php

// TODO: remove this file before release

$app = \Slim\Slim::getInstance();


$app->get('/test/something', function() use ($app) {
	echo '/test/something';
	// TODO
	$app->log->debug('/test/something');
});

