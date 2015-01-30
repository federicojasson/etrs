<?php

namespace App\Middlewares;

/*
 * This middleware applies general configurations.
 */
class Configurations extends \Slim\Middleware {
	
	/*
	 * Applies debug-mode configurations.
	 */
	public function applyDebugConfigurations() {
		$app = $this->app;
		
		// Enables the debug mode
		$app->config('debug', true);
		
		// Initializes the log writer
		$handle = fopen('private/logs/debug.log', FILE_ACCESS_MODE_APPEND);
		$logWriter = new \Slim\LogWriter($handle);
		
		// Configures the logs
		$app->config([
			'log.enabled' => true,
			'log.level' => \Slim\Log::DEBUG,
			'log.writer' => $logWriter
		]);
		
		// Configures the cookies
		$app->config([ // TODO
            'cookies.httponly' => true,
            'cookies.secure' => true,
            'cookies.encrypt' => true,
			
            'cookies.lifetime' => '20 minutes',
            'cookies.path' => '/',
            'cookies.domain' => null,
            'cookies.secret_key' => 'CHANGE_ME',
            'cookies.cipher' => MCRYPT_RIJNDAEL_256,
            'cookies.cipher_mode' => MCRYPT_MODE_CBC
		]);
		
		// Applies other configurations
		$app->config([
			'http.version' => '1.1',
			'routes.case_sensitive' => true
		]);
	}
	
	/*
	 * Applies release configurations.
	 */
	public function applyReleaseConfigurations() {
		$app = $this->app;
		
		// Disables the debug mode
		$app->config('debug', false);
		
		// Initializes the log writer
		$logWriter = new \App\Auxiliars\DatabaseLogWriter();
		
		// Configures the logs
		$app->config([
			'log.enabled' => true,
			'log.level' => \Slim\Log::INFO,
			'log.writer' => $logWriter
		]);
		
		// Configures the cookies
		$app->config([ // TODO
            'cookies.httponly' => true,
            'cookies.secure' => true,
            'cookies.encrypt' => true,
			
            'cookies.lifetime' => '20 minutes',
            'cookies.path' => '/',
            'cookies.domain' => null,
            'cookies.secret_key' => 'CHANGE_ME',
            'cookies.cipher' => MCRYPT_RIJNDAEL_256,
            'cookies.cipher_mode' => MCRYPT_MODE_CBC
		]);
		
		// Applies other configurations
		$app->config([
			'http.version' => '1.1',
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
