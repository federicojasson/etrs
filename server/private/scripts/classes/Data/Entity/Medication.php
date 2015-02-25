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
 * This class represents a medication from the database.
 * 
 * Annotations:
 * 
 * @Entity(repositoryClass = "App\Data\EntityRepository\CustomRepository")
 * @Table(name = "medications")
 * @HasLifecycleCallbacks
 */
class Medication {
	
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
	 * The creator.
	 * 
	 * Annotations:
	 * 
	 * @ManyToOne(targetEntity = "User")
	 * 
	 * @JoinColumn(
	 *		name = "creator",
	 *		referencedColumnName = "id",
	 *		onDelete = "SET NULL"
	 *	)
	 */
	protected $creator;
	
	/**
	 * Indicates whether it is deleted.
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
	 * The ID.
	 * 
	 * Annotations:
	 * 
	 * @Id
	 * @GeneratedValue(strategy = "CUSTOM")
	 * @CustomIdGenerator(class = "App\Data\Utility\RandomIdGenerator")
	 * 
	 * @Column(
	 *		name = "id",
	 *		type = "binary_string",
	 *		length = 16,
	 *		nullable = false,
	 *		options = {
	 *			"fixed": true
	 *		}
	 *	)
	 */
	protected $id;
	
	/**
	 * The last-edition date-time.
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
	 * The last editor.
	 * 
	 * Annotations:
	 * 
	 * @ManyToOne(targetEntity = "User")
	 * 
	 * @JoinColumn(
	 *		name = "last_editor",
	 *		referencedColumnName = "id",
	 *		onDelete = "SET NULL"
	 *	)
	 */
	protected $lastEditor;
	
	/**
	 * The name.
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
	 * Initializes an instance of the class.
	 */
	public function __construct() {
		// Sets default values
		$this->creator = null;
		$this->deleted = false;
		$this->lastEditionDateTime = null;
		$this->lastEditor = null;
	}
	
	/**
	 * Deletes the medication.
	 */
	public function delete() {
		// TODO: implement well
		$this->deleted = $deleted;
	}
	
	/**
	 * Returns the creation date-time.
	 */
	public function getCreationDateTime() {
		return $this->creationDateTime;
	}
	
	/**
	 * Returns the creator.
	 */
	public function getCreator() {
		return $this->creator;
	}
	
	/**
	 * Returns the ID.
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * Returns the last-edition date-time.
	 */
	public function getLastEditionDateTime() {
		return $this->lastEditionDateTime;
	}
	
	/**
	 * Returns the last editor.
	 */
	public function getLastEditor() {
		return $this->lastEditor;
	}
	
	/**
	 * Returns the name.
	 */
	public function getName() {
		return $this->name;
	}
	
	/**
	 * Determines whether it is deleted.
	 */
	public function isDeleted() {
		return $this->deleted;
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
	 * Sets the creator.
	 * 
	 * Receives the user to be set.
	 */
	public function setCreator($user) {
		$this->creator = $user;
	}
	
	/**
	 * Sets the last-edition date-time.
	 * 
	 * Receives the date-time to be set.
	 */
	public function setLastEditionDateTime($dateTime) {
		$this->lastEditionDateTime = $dateTime;
	}
	
	/**
	 * Sets the last editor.
	 * 
	 * Receives the user to be set.
	 */
	public function setLastEditor($user) {
		$this->lastEditor = $user;
	}
	
	/**
	 * Sets the name.
	 * 
	 * Receives the name to be set.
	 */
	public function setName($name) {
		$this->name = $name;
	}
	
}
