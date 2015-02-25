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
 * TODO: comment
 */
class Assertor {
	
	/**
	 * TODO: comment
	 */
	public function entityFound($entity) {
		global $app;
		
		if (is_null($entity)) {
			// The entity has not been found
			// Halts the execution
			$app->server->haltExecution(HTTP_STATUS_NOT_FOUND, CODE_NON_EXISTENT_ENTITY);
		}
	}
	
	/**
	 * TODO: comment
	 */
	public function validEntityVersion($entity, $version) {
		global $app;
		
		try {
			// Acquires a lock on the entity
			$app->data->lock($entity, \Doctrine\DBAL\LockMode::OPTIMISTIC, $version);
		} catch (\Doctrine\ORM\OptimisticLockException $exception) {
			// The entity's version is invalid
			// Halts the execution
			$app->server->haltExecution(HTTP_STATUS_CONFLICT, CODE_INVALID_ENTITY_VERSION);
		}
	}
	
}
