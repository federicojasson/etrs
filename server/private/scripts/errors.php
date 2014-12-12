<?php

/*
 * This script defines the actions to take when errors occur.
 */

$app = \Slim\Slim::getInstance();

// Defines the action to take when the requested service is not defined
$app->notFound(function() use ($app) {
	$app->halt(HTTP_STATUS_NOT_FOUND, [
		'id' => ERROR_ID_UNDEFINED_SERVICE
	]);
});

// Defines the action to take when an error occurs
$app->error(function() use ($app) {
	$app->halt(HTTP_STATUS_INTERNAL_SERVER_ERROR, [
		'id' => ERROR_ID_UNEXPECTED_ERROR
	]);
});
