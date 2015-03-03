<?php

/**
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

/**
 * Initializes the session.
 */
class Session extends \Slim\Middleware {
	
	/**
	 * Calls the middleware.
	 */
	public function call() {
		// Initializes the session
		$this->initializeSession();

		// Calls the next middleware
		$this->next->call();
	}
	
	/**
	 * Initializes the session.
	 */
	private function initializeSession() {
		global $app;
		
		// Initializes the session implicitly
		$app->session;
		
		// Gets the IP address of the client
		$ipAddress = $app->server->getClientIpAddress();
		
		// Sets a data entry in the session for the IP address
		$app->session->setData(SESSION_DATA_IP_ADDRESS, $ipAddress);
	}
	
}
