<?php

namespace App\Middleware;

/*
 * This middleware defines the helpers.
 */
class Helpers extends \Slim\Middleware {
	
	/*
	 * Calls the middleware.
	 */
	public function call() {
		// Defines the helpers
		$this->defineHelpers();
		
		// Calls the next middleware
		$this->next->call();
	}
	
	/*
	 * Creates the AccessValidator helper.
	 */
	public function createAccessValidatorHelper() {
		return new \App\Helper\AccessValidator();
	}
	
	/*
	 * Creates the Authentication helper.
	 */
	public function createAuthenticationHelper() {
		return new \App\Helper\Authentication();
	}
	
	/*
	 * Creates the BusinessLogicDatabase helper.
	 */
	public function createBusinessLogicDatabaseHelper() {
		return new \App\Helper\Database\BusinessLogicDatabase();
	}
	
	/*
	 * Creates the Cryptography helper.
	 */
	public function createCryptographyHelper() {
		return new \App\Helper\Cryptography();
	}
	
	/*
	 * Creates the Data helper.
	 */
	public function createDataHelper() {
		return new \App\Helper\Data();
	}
	
	/*
	 * Creates the DataTypeDescriptor helper.
	 */
	public function createDataTypeDescriptorHelper() {
		return new \App\Helper\DataTypeDescriptor();
	}
	
	/*
	 * Creates the InputValidator helper.
	 */
	public function createInputValidatorHelper() {
		return new \App\Helper\InputValidator();
	}
	
	/*
	 * Creates the Parameters helper.
	 */
	public function createParametersHelper() {
		return new \App\Helper\Parameters();
	}
	
	/*
	 * Creates the Services helper.
	 */
	public function createServicesHelper() {
		return new \App\Helper\Services();
	}
	
	/*
	 * Creates the Session helper.
	 */
	public function createSessionHelper() {
		return new \App\Helper\Session();
	}
	
	/*
	 * Creates the WebServerDatabase helper.
	 */
	public function createWebServerDatabaseHelper() {
		return new \App\Helper\Database\WebServerDatabase();
	}
	
	/*
	 * Defines the helpers.
	 */
	private function defineHelpers() {
		$app = $this->app;
		
		// Defines the helpers
		$app->container->singleton('accessValidator', [ $this, 'createAccessValidatorHelper' ]);
		$app->container->singleton('authentication', [ $this, 'createAuthenticationHelper' ]);
		$app->container->singleton('businessLogicDatabase', [ $this, 'createBusinessLogicDatabaseHelper' ]);
		$app->container->singleton('cryptography', [ $this, 'createCryptographyHelper' ]);
		$app->container->singleton('data', [ $this, 'createDataHelper' ]);
		$app->container->singleton('dataTypeDescriptor', [ $this, 'createDataTypeDescriptorHelper' ]);
		$app->container->singleton('inputValidator', [ $this, 'createInputValidatorHelper' ]);
		$app->container->singleton('parameters', [ $this, 'createParametersHelper' ]);
		$app->container->singleton('services', [ $this, 'createServicesHelper' ]);
		$app->container->singleton('session', [ $this, 'createSessionHelper' ]);
		$app->container->singleton('webServerDatabase', [ $this, 'createWebServerDatabaseHelper' ]);
	}
	
}
