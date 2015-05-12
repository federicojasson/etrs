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

namespace App\Data\EntityRepository;

/**
 * Represents a repository for entities with custom methods to retrieve data.
 */
class Custom extends \Doctrine\ORM\EntityRepository {
	
	/**
	 * Finds a non-deleted entity.
	 * 
	 * Receives the entity's ID.
	 */
	public function findNonDeleted($id) {
		// Finds the entity
		$entity = $this->find($id);
		
		if (is_null($entity)) {
			// The entity doesn't exist
			return null;
		}
		
		if ($entity->isDeleted()) {
			// The entity is deleted
			return null;
		}
		
		return $entity;
	}
	
	/**
	 * Finds non-deleted entities by a set of criteria.
	 * 
	 * Receives the criteria and, optionally, an order-by criteria, a limit and
	 * an offset.
	 */
	public function findNonDeletedBy($criteria, $orderBy = null, $limit = null, $offset = null) {
		// Adds a criterion
		$criteria['deleted'] = false;
		
		// Finds the entities
		return $this->findBy($criteria, $orderBy, $limit, $offset);
	}
	
	/**
	 * Finds a non-deleted-and-non-associated entity.
	 * 
	 * Receives the entity's ID.
	 */
	public function findNonDeletedNonAssociated($id) {
		// Finds the entity
		$entity = $this->findNonDeleted($id);
		
		if (is_null($entity)) {
			// The entity doesn't exist
			return null;
		}
		
		if ($entity->isAssociated()) {
			// The entity is associated
			return null;
		}
		
		return $entity;
	}
	
	/**
	 * Finds a non-deleted-and-non-deprecated entity.
	 * 
	 * Receives the entity's ID.
	 */
	public function findNonDeletedNonDeprecated($id) {
		// Finds the entity
		$entity = $this->findNonDeleted($id);
		
		if (is_null($entity)) {
			// The entity doesn't exist
			return null;
		}
		
		if ($entity->isDeprecated()) {
			// The entity is deprecated
			return null;
		}
		
		return $entity;
	}
	
}
