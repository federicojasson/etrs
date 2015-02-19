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
 * This class represents a medication from the database.
 * 
 * Annotations:
 * 
 * @Entity
 * @Table(name = "medications")
 * @HasLifecycleCallbacks
 */
class Medication {
	
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
	 * @ManyToOne(targetEntity = "User")
	 * @JoinColumn(
	 *		name = "creator",
	 *		referencedColumnName = "id",
	 *		onDelete = "SET NULL"
	 *	)
	 */
	protected $creator;
	
	/**
	 * TODO: comment
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name = "deleted",
	 *		type = "boolean",
	 *		nullable = false
	 *	)
	 */
	protected $deleted;
	
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
	 * @CustomIdGenerator(class = "App\Database\Utility\RandomIdGenerator")
	 */
	protected $id;
	
	/**
	 * TODO: comment
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name = "last_edition_date_time",
	 *		type = "datetime",
	 *		nullable = false
	 *	)
	 */
	protected $lastEditionDateTime;
	
	/**
	 * TODO: comment
	 * 
	 * Annotations:
	 * 
	 * @ManyToOne(targetEntity = "User")
	 * @JoinColumn(
	 *		name = "last_editor",
	 *		referencedColumnName = "id",
	 *		onDelete = "SET NULL"
	 *	)
	 */
	protected $lastEditor;
	
	/**
	 * TODO: comment
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name = "name",
	 *		type = "string",
	 *		length = 128,
	 *		nullable = false
	 *	)
	 */
	protected $name;
	
	/**
	 * Creates an instance of the class.
	 */
	public function __construct() {
		// Sets default values
		$this->creator = null;
		$this->deleted = false;
		$this->lastEditionDateTime = null;
		$this->lastEditor = null;
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
	public function getCreator() {
		return $this->creator;
	}
	
	/**
	 * TODO: comment
	 */
	public function getDeleted() {
		return $this->deleted;
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
	 */
	public function getLastEditor() {
		return $this->lastEditor;
	}
	
	/**
	 * TODO: comment
	 */
	public function getName() {
		return $this->name;
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
	public function setCreator($creator) {
		$this->creator = $creator;
	}
	
	/**
	 * TODO: comment
	 */
	public function setDeleted($deleted) {
		$this->deleted = $deleted;
	}
	
	/**
	 * TODO: comment
	 */
	public function setLastEditor($lastEditor) {
		$this->lastEditor = $lastEditor;
	}
	
	/**
	 * TODO: comment
	 */
	public function setName($name) {
		$this->name = $name;
	}
	
}
