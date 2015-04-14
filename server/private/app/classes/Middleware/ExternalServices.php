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
 * Responsible for registering the external services.
 */
class ExternalServices extends Services {
	
	/**
	 * Returns the services.
	 */
	protected function getServices() {
		return [
			// DEFINEHERE: define external services here
			'/account/change-password',
			'/account/edit',
			'/account/reset-password',
			'/account/sign-in',
			'/account/sign-out',
			'/account/sign-up',
			'/account/signed-in',
			'/diagnosis/create',
			'/diagnosis/delete',
			'/diagnosis/edit',
			'/diagnosis/get',
			'/diagnosis/search',
			'/log/get',
			'/log/search',
			'/medicine/create',
			'/medicine/delete',
			'/medicine/edit',
			'/medicine/get',
			'/medicine/search',
			'/permission/password-reset/authenticate',
			'/permission/password-reset/request',
			'/permission/sign-up/authenticate',
			'/permission/sign-up/request',
			'/treatment/create',
			'/treatment/delete',
			'/treatment/edit',
			'/treatment/get',
			'/treatment/search',
			'/user/get'
		];
	}
	
}
