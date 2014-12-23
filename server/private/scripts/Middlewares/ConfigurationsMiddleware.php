<?php

/*
 * This middleware applies application-wide configurations.
 */
class ConfigurationsMiddleware extends \Slim\Middleware {
	
	/*
	 * Applies debug configurations.
	 */
	public function applyDebugConfigurations() {
		// TODO: set debug config first?
		// TODO: use file to configure the application?
		
		// Initializes the log writer to use
		$fileHandle = fopen(FILE_PATH_LOGS_DEBUG, 'a');
		$logWriter = new \Slim\LogWriter($fileHandle);

		// Configures the framework
		$this->app->config([
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
	 * Executes the middleware.
	 */
	public function call() {
		$app = $this->app;
		
		// Applies configurations according to the operation mode
		$app->configureMode(OPERATION_MODE_DEBUG, [ $this, 'applyDebugConfigurations' ]);
		$app->configureMode(OPERATION_MODE_RELEASE, [ $this, 'applyReleaseConfigurations' ]);
		
		// Calls the next middleware
		$this->next->call();
	}
	
}
