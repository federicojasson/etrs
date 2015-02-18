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
 * This middleware halts the execution for maintenance.
 */
class Maintenance extends \Slim\Middleware {
	
	/**
	 * Calls the middleware.
	 */
	public function call() {
		$app = $this->app;
		
		// Halts the execution
		$app->halt(HTTP_STATUS_SERVICE_UNAVAILABLE, [
			'code' => CODE_SYSTEM_UNDER_MAINTENANCE
		]);
	}
	
}
