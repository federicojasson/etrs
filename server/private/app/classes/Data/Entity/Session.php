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
 * Represents a session from the database.
 * 
 * Annotations:
 * 
 * @Entity
 * @Table(name="sessions")
 * @HasLifecycleCallbacks
 */
class Session {
	
	/**
	 * The creation date-time.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name="creation_date_time",
	 *		type="utc_datetime",
	 *		nullable=false
	 *	)
	 */
	private $creationDateTime;
	
	/**
	 * The data.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name="data",
	 *		type="text",
	 *		nullable=false
	 *	)
	 */
	private $data;
	
	/**
	 * The ID.
	 * 
	 * Annotations:
	 * 
	 * @Id
	 * @Column(
	 *		name="id",
	 *		type="binary_data",
	 *		length=32,
	 *		nullable=false,
	 *		options={
	 *			"fixed": true
	 *		}
	 *	)
	 */
	private $id;
	
	/**
	 * The last-access date-time.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name="last_access_date_time",
	 *		type="utc_datetime",
	 *		nullable=false
	 *	)
	 */
	private $lastAccessDateTime;
	
	/**
	 * Returns the data.
	 */
	public function getData() {
		return $this->data;
	}
	
	/**
	 * Sets the creation date-time.
	 * 
	 * Annotations:
	 * 
	 * @PrePersist
	 */
	public function setCreationDateTime() {
		$this->creationDateTime = new \App\DateTime\Custom();
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
	 * Annotations:
	 * 
	 * @PrePersist
	 */
	public function setLastAccessDateTime() {
		$this->lastAccessDateTime = new \App\DateTime\Custom();
	}
	
}
