<?php

/*
 * This middleware registers the helpers of the application.
 */
class HelpersMiddleware extends \Slim\Middleware {
	
	/*
	 * Executes the middleware.
	 */
	public function call() {
		// Registers the helpers
		$this->registerHelpers();
		
		// Calls the next middleware
		$this->next->call();
	}
	
	/*
	 * Registers the helpers.
	 */
	private function registerHelpers() {
		$container = $this->app->container;
		
		// Authentication helper
		$container->singleton('authentication', function() {
			return new Authentication();
		});

		// Authenticator helper
		$container->singleton('authenticator', function() {
			return new Authenticator();
		});

		// Authorization validator helper
		$container->singleton('authorizationValidator', function() {
			return new AuthorizationValidator();
		});

		// Business logic database helper
		$container->singleton('businessLogicDatabase', function() {
			return new BusinessLogicDatabase();
		});

		// Configurations helper
		$container->singleton('configurations', function() {
			return new Configurations();
		});

		// Cryptography helper
		$container->singleton('cryptography', function() {
			return new Cryptography();
		});

		// Data helper
		$container->singleton('data', function() {
			return new Data();
		});

		// Email builder helper
		$container->singleton('emailBuilder', function() {
			return new EmailBuilder();
		});

		// Input validator helper
		$container->singleton('inputValidator', function() {
			return new InputValidator();
		});

		// Services helper
		$container->singleton('services', function() {
			return new Services();
		});

		// Session helper
		$container->singleton('session', function() {
			return new Session();
		});

		// Utilities helper
		$container->singleton('utilities', function() {
			return new Utilities();
		});

		// Web server database helper
		$container->singleton('webServerDatabase', function() {
			return new WebServerDatabase();
		});
	}
	
}
