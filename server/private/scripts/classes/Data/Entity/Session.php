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

namespace App\Data\Entity;

/**
 * This class represents a session from the database.
 * 
 * Annotations:
 * 
 * @Entity(repositoryClass = "App\Data\EntityRepository\CustomRepository")
 * @Table(name = "sessions")
 * @HasLifecycleCallbacks
 */
class Session {
	
	/**
	 * The creation date-time.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name = "creation_date_time",
	 *		type = "datetime",
	 *		nullable = false
	 *	)
	 */
	protected $creationDateTime;
	
	/**
	 * The data.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name = "data",
	 *		type = "string",
	 *		nullable = false
	 *	)
	 */
	protected $data;
	
	/**
	 * The ID.
	 * 
	 * Annotations:
	 * 
	 * @Id
	 * 
	 * @Column(
	 *		name = "id",
	 *		type = "binary_string",
	 *		length = 32,
	 *		nullable = false,
	 *		options = {
	 *			"fixed": true
	 *		}
	 *	)
	 */
	protected $id;
	
	/**
	 * The last-access date-time.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name = "last_access_date_time",
	 *		type = "datetime",
	 *		nullable = false
	 *	)
	 */
	protected $lastAccessDateTime;
	
	/**
	 * Returns the creation date-time.
	 */
	public function getCreationDateTime() {
		return $this->creationDateTime;
	}
	
	/**
	 * Returns the data.
	 */
	public function getData() {
		return $this->data;
	}
	
	/**
	 * Returns the ID.
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * Returns the last-access date-time.
	 */
	public function getLastAccessDateTime() {
		return $this->lastAccessDateTime;
	}

	/**
	 * Sets the creation date-time.
	 * 
	 * Receives the date-time to be set.
	 */
	public function setCreationDateTime($dateTime) {
		$this->creationDateTime = $dateTime;
	}
	
	/**
	 * Sets the data.
	 * 
	 * Receives the data to be set.
	 */
	public function setData($data) {
		$this->data = $data;
	}
	
	/**
	 * Sets the ID.
	 * 
	 * Receives the ID to be set.
	 */
	public function setId($id) {
		$this->id = $id;
	}
	
	/**
	 * Sets the last-access date-time.
	 * 
	 * Receives the date-time to be set.
	 */
	public function setLastAccessDateTime($dateTime) {
		$this->lastAccessDateTime = $dateTime;
	}
	
}
