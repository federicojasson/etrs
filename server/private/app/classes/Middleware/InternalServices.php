<?php

/**
 * NEU-CO - Neuro-Cognitivo
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
 * Responsible for registering the internal services.
 */
class InternalServices extends Services {
	
	/**
	 * Returns the services.
	 */
	protected function getServices() {
		return [
			'/data/check-configuration',
			'/data/generate-proxies',
			'/data/reset-entities-versions',
			'/file/delete-expired',
			'/log/delete-old',
			'/permission/password-reset/delete-expired',
			'/permission/sign-up/delete-expired',
			'/session/delete-all',
			'/session/delete-expired',
			'/study/conduct',
			'/user/delete'
		];
	}
	
}
