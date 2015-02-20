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
 * This class represents a log from the database.
 * 
 * Annotations:
 * 
 * @Entity
 * @Table(name = "logs")
 * @HasLifecycleCallbacks
 */
class Log {
	
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
	 * The ID.
	 * 
	 * Annotations:
	 * 
	 * @Id
	 * @GeneratedValue(strategy = "CUSTOM")
	 * @CustomIdGenerator(class = "App\Database\Utility\RandomIdGenerator")
	 * 
	 * @Column(
	 *		name = "id",
	 *		type = "binary",
	 *		length = 16,
	 *		nullable = false,
	 *		options = {
	 *			"fixed": true
	 *		}
	 *	)
	 */
	protected $id;
	
	/**
	 * The level.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name = "level",
	 *		type = "smallint",
	 *		nullable = false,
	 *		options = {
	 *			"unsigned": true
	 *		}
	 *	)
	 */
	protected $level;
	
	/**
	 * The message.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name = "message",
	 *		type = "string",
	 *		nullable = false
	 *	)
	 */
	protected $message;
	
	/**
	 * Returns the creation date-time.
	 */
	public function getCreationDateTime() {
		return $this->creationDateTime;
	}
	
	/**
	 * Returns the ID.
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * Returns the level.
	 */
	public function getLevel() {
		return $this->level;
	}
	
	/**
	 * Returns the message.
	 */
	public function getMessage() {
		return $this->message;
	}

	/**
	 * Sets the current date-time as the creation date-time.
	 * 
	 * Annotations:
	 * 
	 * @PrePersist
	 */
	public function setCreationDateTime() {
		global $app;
		
		// Gets the current date-time
		$currentDateTime = $app->server->getCurrentDateTime();
		
		// Sets the creation date-time
		$this->creationDateTime = $currentDateTime;
	}
	
	/**
	 * Sets the level.
	 * 
	 * Receives the level to be set.
	 */
	public function setLevel($level) {
		$this->level = $level;
	}
	
	/**
	 * Sets the message.
	 * 
	 * Receives the message to be set.
	 */
	public function setMessage($message) {
		$this->message = $message;
	}
	
}
