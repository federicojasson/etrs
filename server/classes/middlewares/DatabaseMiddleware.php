<?php

/*
 * TODO
 */
class DatabaseMiddleware extends \Slim\Middleware {
	
	/*
	 * TODO
	 */
	public function call() {
		// Connects to the databases
		$this->connectBusinessDatabase();
		$this->connectServerDatabase();
		
		// Calls the next middleware
		$this->next->call();
	}
	
	/*
	 * TODO
	 */
	private function connectBusinessDatabase() {
		// Gets the app
		$app = $this->app;
		
		// Hooks some functionality before the dispatch
		$app->hook('slim.before.dispatch', function() use ($app) {
			// Gets the database
			$database = $app->businessDatabase;
			
			// Gets the route manager
			$routeManager = $app->routeManager;
			
			// Connects to the database with a different user according to the
			// route group
			
			$routeManager->addGroupAction(ROUTE_GROUP_ANONYMOUS, function() use ($database) {
				$database->connect(DSN_BUSINESS_DATABASE, DATABASE_USER_ANONYMOUS, DATABASE_USER_ANONYMOUS_PASSWORD);
			});
			
			$routeManager->addGroupAction(ROUTE_GROUP_DOCTOR, function() use ($database) {
				$database->connect(DSN_BUSINESS_DATABASE, DATABASE_USER_DOCTOR, DATABASE_USER_DOCTOR_PASSWORD);
			});
			
			$routeManager->addGroupAction(ROUTE_GROUP_OPERATOR, function() use ($database) {
				$database->connect(DSN_BUSINESS_DATABASE, DATABASE_USER_OPERATOR, DATABASE_USER_OPERATOR_PASSWORD);
			});
			
			$routeManager->addGroupAction(ROUTE_GROUP_RESEARCHER, function() use ($database) {
				$database->connect(DSN_BUSINESS_DATABASE, DATABASE_USER_RESEARCHER, DATABASE_USER_RESEARCHER_PASSWORD);
			});
		});
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
