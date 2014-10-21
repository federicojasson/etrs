<?php

// TODO: comments

// Gets the app
$app = \Slim\Slim::getInstance();

// Applies the debug-mode configurations
$app->configureMode(OPERATION_MODE_DEBUG, function() use ($app) {
	$configuration = [
		// TODO: check configuration
		'cookies.lifetime' => '2 minutes',
		'debug' => true,
		'log.enabled' => true,
		'log.level' => \Slim\Log::DEBUG,
		'log.writer' => new \Slim\LogWriter(fopen(__DIR__ . '/logs/debug.log', 'a'))
	];
	
	$app->config($configuration);
	
	// Sets the session lifetime (in seconds)
	ini_set(PHP_DIRECTIVE_SESSION_LIFETIME, 60);
	
	// Deactivates the automatic session garbage collection
	ini_set(PHP_DIRECTIVE_GC_PROBABILITY, 0);
});


// Applies the release-mode configurations
$app->configureMode(OPERATION_MODE_RELEASE, function() use ($app) {
	$configuration = [
		// TODO: define configuration
	];
	
	$app->config($configuration);
});


// Defines the singleton resources

$app->container->singleton('authenticationManager', function() use ($app) {
    return new AuthenticationManager($app->businessDatabase, $app->session);
});

$app->container->singleton('businessDatabase', function() {
	return new BusinessDatabase();
});

$app->container->singleton('routeManager', function() {
	return new RouteManager();
});

$app->container->singleton('serverDatabase', function() {
	return new ServerDatabase();
});

$app->container->singleton('session', function() {
	return new Session();
});


// Registers the middlewares
$app->add(new Slim\Middleware\ContentTypes());
$app->add(new RouteMiddleware());
$app->add(new AuthorizationMiddleware());
$app->add(new SessionMiddleware(new DatabaseSessionStorageHandler($app->serverDatabase)));
$app->add(new DatabaseMiddleware());
