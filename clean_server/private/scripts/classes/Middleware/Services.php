<?php

/*
 * ETRS - Eye Tracking Record System
 * Copyright (C) 2015 Federico Jasson
 * 
 * This program is free software: you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation, either version 3 of the License, or (at your option) any later
 * version.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU General Public License along with
 * this program. If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Middleware;

/*
 * This middleware registers services.
 * 
 * Subclasses must implement the getServices method, which has to return the
 * services to be registered.
 */
abstract class Services extends \Slim\Middleware {
	
	/*
	 * Calls the middleware.
	 */
	public function call() {
		// Gets the services
		$services = $this->getServices();
		
		// Registers the services
		$this->registerServices($services);

		// Calls the next middleware
		$this->next->call();
	}
	
	/*
	 * Returns the services to be registered.
	 */
	protected abstract function getServices();
	
	/*
	 * Registers a service.
	 * 
	 * Receives the service.
	 */
	private function registerService($service) {
		$app = $this->app;
		
		// Gets the URL and the HTTP method of the service
		$url = $service->getUrl();
		$method = $service->getMethod();
		
		// Registers a routing rule for the service
		$app->map($url, function() use ($service) {
			// Executes the service
			$service->execute();
		})->via($method);
	}
	
	/*
	 * Registers the services.
	 * 
	 * Receives the services.
	 */
	private function registerServices($services) {
		// Registers the services
		foreach ($services as $service) {
			$this->registerService($service);
		}
	}
	
}