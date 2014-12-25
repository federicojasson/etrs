<?php

/*
 * This middleware defines the helpers of the application.
 */
class HelpersMiddleware extends \Slim\Middleware {
	
	/*
	 * Executes the middleware.
	 */
	public function call() {
		$container = $this->app->container;
		
		// Defines the helpers
		$container->singleton('authentication', [ $this, 'initializeAuthenticationHelper' ]);
		$container->singleton('authenticator', [ $this, 'initializeAuthenticatorHelper' ]);
		$container->singleton('authorizationValidator', [ $this, 'initializeAuthorizationValidatorHelper' ]);
		$container->singleton('businessLogicDatabase', [ $this, 'initializeBusinessLogicDatabaseHelper' ]);
		$container->singleton('configurations', [ $this, 'initializeConfigurationsHelper' ]);
		$container->singleton('cryptography', [ $this, 'initializeCryptographyHelper' ]);
		$container->singleton('data', [ $this, 'initializeDataHelper' ]);
		$container->singleton('dataFilter', [ $this, 'initializeDataFilterHelper' ]);
		$container->singleton('emailBuilder', [ $this, 'initializeEmailBuilderHelper' ]);
		$container->singleton('inputValidator', [ $this, 'initializeInputValidatorHelper' ]);
		$container->singleton('services', [ $this, 'initializeServicesHelper' ]);
		$container->singleton('session', [ $this, 'initializeSessionHelper' ]);
		$container->singleton('webServerDatabase', [ $this, 'initializeWebServerDatabaseHelper' ]);
		
		// Calls the next middleware
		$this->next->call();
	}
	
	/*
	 * Initializes the authentication helper.
	 */
	public function initializeAuthenticationHelper() {
		return new Authentication();
	}
	
	/*
	 * Initializes the authenticator helper.
	 */
	public function initializeAuthenticatorHelper() {
		return new Authenticator();
	}
	
	/*
	 * Initializes the authorization validator helper.
	 */
	public function initializeAuthorizationValidatorHelper() {
		return new AuthorizationValidator();
	}
	
	/*
	 * Initializes the business logic database helper.
	 */
	public function initializeBusinessLogicDatabaseHelper() {
		return new BusinessLogicDatabase();
	}
	
	/*
	 * Initializes the configurations helper.
	 */
	public function initializeConfigurationsHelper() {
		return new Configurations();
	}
	
	/*
	 * Initializes the cryptography helper.
	 */
	public function initializeCryptographyHelper() {
		return new Cryptography();
	}
	
	/*
	 * Initializes the data helper.
	 */
	public function initializeDataHelper() {
		return new Data();
	}
	
	/*
	 * Initializes the data filter helper.
	 */
	public function initializeDataFilterHelper() {
		return new DataFilter();
	}
	
	/*
	 * Initializes the email builder helper.
	 */
	public function initializeEmailBuilderHelper() {
		return new EmailBuilder();
	}
	
	/*
	 * Initializes the input validator helper.
	 */
	public function initializeInputValidatorHelper() {
		return new InputValidator();
	}
	
	/*
	 * Initializes the services helper.
	 */
	public function initializeServicesHelper() {
		return new Services();
	}
	
	/*
	 * Initializes the session helper.
	 */
	public function initializeSessionHelper() {
		return new Session();
	}
	
	/*
	 * Initializes the web server database helper.
	 */
	public function initializeWebServerDatabaseHelper() {
		return new WebServerDatabase();
	}
	
}
