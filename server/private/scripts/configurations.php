<?php

/*
 * This script applies application-wide configurations.
 */

$app = \Slim\Slim::getInstance();

// Debug-mode configurations
$app->configureMode(OPERATION_MODE_DEBUG, function() use ($app) {
	// Initializes a log writer to store logs in a file
	$fileHandle = fopen(FILE_PATH_LOGS_DEBUG, 'a');
	$logWriter = new \Slim\LogWriter($fileHandle);
	
	// Configures the framework
	$app->config([
		'debug' => true,
		'cookies.domain' => null,
		'cookies.lifetime' => 0,
		'cookies.path' => null,
		'http.version' => '1.1',
		'log.enabled' => true,
		'log.level' => \Slim\Log::DEBUG,
		'log.writer' => $logWriter,
		'routes.case_sensitive' => true
	]);
});

// Release-mode configurations
$app->configureMode(OPERATION_MODE_RELEASE, function() use ($app) {
	// Configures the framework
	$app->config([
		'debug' => false,
		'cookies.domain' => null,
		'cookies.lifetime' => 0,
		'cookies.path' => null,
		'http.version' => '1.1',
		'log.enabled' => true,
		'log.level' => \Slim\Log::DEBUG, // TODO: what level to use?
		'log.writer' => null, // TODO: use database for logs?
		'routes.case_sensitive' => true
	]);
});
