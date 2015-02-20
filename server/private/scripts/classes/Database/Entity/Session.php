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

namespace App\Database\Entity;

/**
 * This class represents a session from the database.
 * 
 * Annotations:
 * 
 * @Entity
 * @Table(name = "sessions")
 * @HasLifecycleCallbacks
 */
class Session {
	
	/**
	 * TODO: comment
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
	 * TODO: comment
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
	 * TODO: comment
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name = "id",
	 *		type = "binary",
	 *		length = 32,
	 *		nullable = false,
	 *		options = {
	 *			"fixed": true
	 *		}
	 *	)
	 * @Id
	 */
	protected $id;
	
	/**
	 * TODO: comment
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name = "last_edition_date_time",
	 *		type = "datetime"
	 *	)
	 */
	protected $lastEditionDateTime;
	
	/**
	 * Creates an instance of the class.
	 */
	public function __construct() {
		// Sets default values
		$this->lastEditionDateTime = null;
	}
	
	/**
	 * TODO: comment
	 */
	public function getCreationDateTime() {
		return $this->creationDateTime;
	}
	
	/**
	 * TODO: comment
	 */
	public function getData() {
		return $this->data;
	}
	
	/**
	 * TODO: comment
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * TODO: comment
	 */
	public function getLastEditionDateTime() {
		return $this->lastEditionDateTime;
	}

	/**
	 * TODO: comment
	 * 
	 * Annotations:
	 * 
	 * @PrePersist
	 */
	public function onPrePersist() {
		global $app;
		
		// Gets the current UTC date-time
		$currentDateTime = $app->server->getCurrentUtcDateTime();
		
		// Sets the creation date-time
		$this->creationDateTime = $currentDateTime;
	}
	
	/**
	 * TODO: comment
	 * 
	 * Annotations:
	 * 
	 * @PreUpdate
	 */
	public function onPreUpdate() {
		global $app;
		
		// Gets the current UTC date-time
		$currentDateTime = $app->server->getCurrentUtcDateTime();
		
		// Sets the last-edition date-time
		$this->lastEditionDateTime = $currentDateTime;
	}
	
	/**
	 * TODO: comment
	 */
	public function setData($data) {
		$this->data = $data;
	}
	
	/**
	 * TODO: comment
	 */
	public function setId($id) {
		$this->id = $id;
	}
	
}
