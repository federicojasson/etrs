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
 * This class offers assertion methods to check different conditions.
 */
class Assertor {
	
	/**
	 * Checks if an entity exists.
	 * 
	 * Receives the entity.
	 */
	public function entityExists($entity) {
		global $app;
		
		// TODO: perform search here somehow?
		
		if (is_null($entity)) {
			// The entity doesn't exist
			// Halts the execution
			$app->server->haltExecution(HTTP_STATUS_NOT_FOUND, CODE_NON_EXISTENT_ENTITY);
		}
	}
	
	/**
	 * Checks if the version of an entity is updated.
	 * 
	 * Receives the entity and the version to check.
	 */
	public function entityVersionUpdated($entity, $version) {
		global $app;
		
		try {
			// Acquires a lock on the entity
			$app->data->lock($entity, \Doctrine\DBAL\LockMode::OPTIMISTIC, $version);
		} catch (\Doctrine\ORM\OptimisticLockException $exception) {
			// The entity's version is outdated
			// Halts the execution
			$app->server->haltExecution(HTTP_STATUS_CONFLICT, CODE_OUTDATED_ENTITY_VERSION);
		}
	}
	
}
