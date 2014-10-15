<?php

$app = \Slim\Slim::getInstance();

$app->configureMode('debug', function() use ($app) {
	$logPath = __DIR__ . '/logs/debug.log';
	$logWriter = new \Slim\LogWriter(fopen($logPath, 'a'));
	
	$configuration = [
		// TODO: check configuration
		'cookies.lifetime' => '2 minutes',
		'debug' => true,
		'log.enabled' => true,
		'log.level' => \Slim\Log::DEBUG,
		'log.writer' => $logWriter
	];
	
	$app->config($configuration);
});

$app->configureMode('release', function() use ($app) {
	$configuration = [
		// TODO: define configuration
	];
	
	$app->config($configuration);
});

$app->container->singleton('database', function() {
    return new DatabaseManager();
});

$app->container->singleton('user', function() {
    return new UserManager();
});

$app->add(new Slim\Middleware\ContentTypes());
