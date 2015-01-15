<?php

namespace App\Middlewares;

/*
 * This middleware applies general configurations.
 */
class Configurations extends \Slim\Middleware {
	
	/*
	 * Applies debug configurations.
	 */
	public function applyDebugConfigurations() {
		$app = $this->app;
		
		// TODO: check debug configurations and order of definition
		
		// TODO: set debug config first?
		// TODO: use file to configure the application?
		
		// Initializes the log writer to use
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
	}
	
	/*
	 * Applies release configurations.
	 */
	public function applyReleaseConfigurations() {
		$app = $this->app;
		
		// TODO: check release configurations and order of definition
		
		// TODO: set debug config first?
		// TODO: use file to configure the application?
		
		// Initializes the log writer use
		$logWriter = new DatabaseLogWriter($app->cryptography, $app->webServerDatabase);

		// Configures the framework
		$app->config([
			'debug' => false,
			'cookies.domain' => null,
			'cookies.lifetime' => 0,
			'cookies.path' => null,
			'http.version' => '1.1',
			'log.enabled' => true,
			'log.level' => \Slim\Log::INFO,
			'log.writer' => $logWriter,
			'routes.case_sensitive' => true
		]);
	}
	
	/*
	 * Calls the middleware.
	 */
	public function call() {
		// Defines the configurations
		$this->defineConfigurations();
		
		// Calls the next middleware
		$this->next->call();
	}
	
	/*
	 * Defines the configurations.
	 */
	private function defineConfigurations() {
		$app = $this->app;
		
		$app->configureMode(OPERATION_MODE_DEBUG, [ $this, 'applyDebugConfigurations' ]);
		$app->configureMode(OPERATION_MODE_RELEASE, [ $this, 'applyReleaseConfigurations' ]);
	}
	
}
