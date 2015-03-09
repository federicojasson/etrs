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
 * Represents a file from the database.
 * 
 * Annotations:
 * 
 * @Entity(repositoryClass = "App\Data\EntityRepository\CustomRepository")
 * @Table(name = "files")
 * @HasLifecycleCallbacks
 */
class File {
	
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
	private $creationDateTime;
	
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
	private $creator;
	
	/**
	 * Indicates whether the entity is deleted.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name = "deleted",
	 *		type = "boolean",
	 *		nullable = false
	 *	)
	 */
	private $deleted;
	
	/**
	 * The deletion date-time.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name = "deletion_date_time",
	 *		type = "datetime"
	 *	)
	 */
	private $deletionDateTime;
	
	/**
	 * The hash.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name = "hash",
	 *		type = "automatic_binary",
	 *		length = 16,
	 *		nullable = false,
	 *		options = {
	 *			"fixed": true
	 *		}
	 *	)
	 */
	private $hash;
	
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
	 *		type = "automatic_binary",
	 *		length = 16,
	 *		nullable = false,
	 *		options = {
	 *			"fixed": true
	 *		}
	 *	)
	 */
	private $id;
	
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
	private $lastEditionDateTime;
	
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
	private $lastEditor;
	
	/**
	 * The name.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name = "name",
	 *		type = "string",
	 *		length = 192,
	 *		nullable = false
	 *	)
	 */
	private $name;
	
	/**
	 * The version.
	 * 
	 * @Version
	 * 
	 * @Column(
	 *		name = "version",
	 *		type = "integer",
	 *		nullable = false,
	 *		options = {
	 *			"unsigned": true
	 *		}
	 * )
	 */
	private $version;
	
	/**
	 * Initializes an instance of the class.
	 */
	public function __construct() {
		// Sets default values
		$this->deleted = false;
	}
	
	/**
	 * Deletes the entity.
	 */
	public function delete() {
		global $app;
		
		// Sets the deletion date-time
		$this->deletionDateTime = $app->server->getCurrentDateTime();
		
		// Sets the deletion flag
		$this->deleted = true;
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
		
		// Sets the creation date-time
		$this->creationDateTime = $app->server->getCurrentDateTime();
	}
	
	/**
	 * Sets the signed-in user as the creator.
	 * 
	 * Annotations:
	 * 
	 * @PrePersist
	 */
	public function setCreator() {
		global $app;
		
		// Sets the creator
		$this->creator = $app->authentication->getSignedInUser();
	}
	
	/**
	 * Sets the hash.
	 * 
	 * Receives the hash to be set.
	 */
	public function setHash($hash) {
		$this->hash = $hash;
	}
	
	/**
	 * Sets the current date-time as the last-edition date-time.
	 */
	public function setLastEditionDateTime() {
		global $app;
		
		// Sets the last-edition date-time
		$this->lastEditionDateTime = $app->server->getCurrentDateTime();
	}
	
	/**
	 * Sets the signed-in user as the last editor.
	 */
	public function setLastEditor() {
		global $app;
		
		// Sets the last editor
		$this->lastEditor = $app->authentication->getSignedInUser();
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
