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
		
		// TODO: implement
		$fileHandle = fopen('private/logs/debug.log', 'a');
		$logWriter = new \Slim\LogWriter($fileHandle);
		$app->config([
			'log.writer' => $logWriter
		]);
	}
	
	/*
	 * Applies release configurations.
	 */
	public function applyReleaseConfigurations() {
		$app = $this->app;
		
		// TODO: implement
		$app->config([
			'debug' => false
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
