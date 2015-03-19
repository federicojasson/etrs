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
	 * Returns a non-deleted entity.
	 * 
	 * Receives the entity's ID.
	 */
	public function findNonDeleted($id) {
		// Builds a set of criteria
		$criteria = [
			'id' => $id,
			'deleted' => false
		];
		
		// Gets the entity
		return $this->findOneBy($criteria);
	}
	
}
