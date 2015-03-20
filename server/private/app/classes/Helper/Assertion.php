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

namespace App\Helper;

/**
 * Provides assertion methods.
 */
class Assertion {
	
	/**
	 * Asserts whether an entity exists.
	 * 
	 * Receives the entity.
	 */
	public function entityExists($entity) {
		if (is_null($entity)) {
			// The entity doesn't exist
			// Halts the application
			haltApp(HTTP_STATUS_NOT_FOUND, ERROR_CODE_NON_EXISTENT_ENTITY);
		}
	}
	
	/**
	 * Asserts whether an entity is updated.
	 * 
	 * Receives the entity and the alleged version.
	 */
	public function entityUpdated($entity, $version) {
		global $app;
		
		try {
			// Acquires a lock on the entity
			$app->data->lock($entity, \Doctrine\DBAL\LockMode::OPTIMISTIC, $version);
		} catch (\Doctrine\ORM\OptimisticLockException $exception) {
			// The entity is outdated
			// Halts the application
			haltApp(HTTP_STATUS_CONFLICT, ERROR_CODE_OUTDATED_ENTITY);
		}
	}
	
}
