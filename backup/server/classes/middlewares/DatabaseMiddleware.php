<?php

/*
 * TODO
 */
class DatabaseMiddleware extends \Slim\Middleware {
	
	/*
	 * TODO
	 */
	public function call() {
		// Gets the app
		$app = $this->app;
		
		// Hooks some functionality before the dispatch
		$app->hook('slim.before.dispatch', function() use ($app) {
			// Gets the route manager
			$routeManager = $app->routeManager;
			
			// Connects to the business database with a different user according
			// to the route group
			
			$routeManager->addGroupAction(ROUTE_GROUP_ANONYMOUS, function() {
				$this->connectBusinessDatabase(DATABASE_USER_ANONYMOUS, DATABASE_USER_ANONYMOUS_PASSWORD);
			});
			
			$routeManager->addGroupAction(ROUTE_GROUP_DOCTOR, function() {
				$this->connectBusinessDatabase(DATABASE_USER_DOCTOR, DATABASE_USER_DOCTOR_PASSWORD);
			});
			
			$routeManager->addGroupAction(ROUTE_GROUP_OPERATOR, function() {
				$this->connectBusinessDatabase(DATABASE_USER_OPERATOR, DATABASE_USER_OPERATOR_PASSWORD);
			});
			
			$routeManager->addGroupAction(ROUTE_GROUP_RESEARCHER, function() {
				$this->connectBusinessDatabase(DATABASE_USER_RESEARCHER, DATABASE_USER_RESEARCHER_PASSWORD);
			});
		});
		
		// Connects to the server database
		$this->connectServerDatabase();
		
		// Calls the next middleware
		$this->next->call();
	}
	
	/*
	 * TODO
	 */
	private function connectBusinessDatabase($user, $password) {
		// Gets the database
		$database = $this->app->businessDatabase;
		
		// Connects to the database
		$database->connect(DSN_BUSINESS_DATABASE, $user, $password);
	}
	
	/*
	 * TODO
	 */
	private function connectServerDatabase() {
		// Gets the database
		$database = $this->app->serverDatabase;
		
		// Connects to the database
		$database->connect(DSN_SERVER_DATABASE, DATABASE_USER_SYSTEM, DATABASE_USER_SYSTEM_PASSWORD);
	}
	
}
