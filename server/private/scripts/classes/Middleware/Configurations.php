<?php

namespace App\Middleware;

/*
 * This middleware applies general configurations.
 */
class Configurations extends \Slim\Middleware {
	
	/*
	 * Applies debug configurations.
	 */
	public function applyDebugConfigurations() {
		$app = $this->app;
		
		// Enables the debug mode
		$app->config('debug', true);
		
		// Creates the log writer
		$path = ROOT_PATH . 'private/logs/debug.log';
		$file = fopen($path, 'a');
		$logWriter = new \Slim\LogWriter($file);
		
		// Applies logs configurations
		$app->config([
			'log.enabled' => true,
			'log.level' => \Slim\Log::DEBUG,
			'log.writer' => $logWriter
		]);
		
		// Applies cookies configurations
		$app->config([ // TODO: check and test cookies configurations
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
		
		// Creates the log writer
		$logWriter = new \App\Auxiliar\LogWriter\DatabaseLogWriter();
		
		// Applies logs configurations
		$app->config([
			'log.enabled' => true,
			'log.level' => \Slim\Log::INFO,
			'log.writer' => $logWriter
		]);
		
		// Applies cookies configurations
		$app->config([ // TODO: check and test cookies configurations
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
		// Applies the configurations
		$this->applyConfigurations();
		
		// Calls the next middleware
		$this->next->call();
	}
	
	/*
	 * Applies the configurations.
	 */
	private function applyConfigurations() {
		$app = $this->app;
		
		// Applies the configurations
		$app->configureMode(OPERATION_MODE_DEBUG, [ $this, 'applyDebugConfigurations' ]);
		$app->configureMode(OPERATION_MODE_RELEASE, [ $this, 'applyReleaseConfigurations' ]);
	}
	
}
