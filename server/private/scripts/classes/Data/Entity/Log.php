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
 * TODO: comment
 * 
 * Annotations:
 * 
 * @Entity
 * @Table(name = "logs")
 * @HasLifecycleCallbacks
 */
class Log {
	
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
	 *		name = "id",
	 *		type = "binary",
	 *		length = 16,
	 *		nullable = false,
	 *		options = {
	 *			"fixed": true
	 *		}
	 *	)
	 * @Id
	 * @GeneratedValue(strategy = "CUSTOM")
	 * @CustomIdGenerator(class = "App\Data\Utility\RandomIdGenerator")
	 */
	protected $id;
	
	/**
	 * TODO: comment
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
	 * TODO: comment
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
	 * TODO: comment
	 */
	public function getCreationDateTime() {
		return $this->creationDateTime;
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
	public function getLevel() {
		return $this->level;
	}
	
	/**
	 * TODO: comment
	 */
	public function getMessage() {
		return $this->message;
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
	 */
	public function setLevel($level) {
		$this->level = $level;
	}
	
	/**
	 * TODO: comment
	 */
	public function setMessage($message) {
		$this->message = $message;
	}
	
}
