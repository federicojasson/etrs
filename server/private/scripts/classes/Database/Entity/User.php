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
 * This class represents a user from the database.
 * 
 * Annotations:
 * 
 * @Entity
 * @Table(name = "users")
 * @HasLifecycleCallbacks
 */
class User {
	
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
	 *		name = "email_address",
	 *		type = "string",
	 *		length = 254,
	 *		nullable = false
	 *	)
	 */
	protected $emailAddress;
	
	/**
	 * TODO: comment
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name = "first_name",
	 *		type = "string",
	 *		length = 48,
	 *		nullable = false
	 *	)
	 */
	protected $firstName;
	
	/**
	 * TODO: comment
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name = "gender",
	 *		type = "binary",
	 *		length = 1,
	 *		nullable = false,
	 *		options = {
	 *			"fixed": true
	 *		}
	 *	)
	 */
	protected $gender;
	
	/**
	 * TODO: comment
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name = "id",
	 *		type = "binary",
	 *		length = 32,
	 *		nullable = false
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
	 *		name = "key_stretching_iterations",
	 *		type = "integer",
	 *		nullable = false,
	 *		options = {
	 *			"unsigned": true
	 *		}
	 *	)
	 */
	protected $keyStretchingIterations;
	
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
	 *		name = "last_name",
	 *		type = "string",
	 *		length = 48,
	 *		nullable = false
	 *	)
	 */
	protected $lastName;
	
	/**
	 * TODO: comment
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name = "password_hash",
	 *		type = "binary",
	 *		length = 64,
	 *		nullable = false,
	 *		options = {
	 *			"fixed": true
	 *		}
	 *	)
	 */
	protected $passwordHash;
	
	/**
	 * TODO: comment
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name = "role",
	 *		type = "binary",
	 *		length = 2,
	 *		nullable = false,
	 *		options = {
	 *			"fixed": true
	 *		}
	 *	)
	 */
	protected $role;
	
	/**
	 * TODO: comment
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name = "salt",
	 *		type = "binary",
	 *		length = 64,
	 *		nullable = false,
	 *		options = {
	 *			"fixed": true
	 *		}
	 *	)
	 */
	protected $salt;
	
	/**
	 * Creates an instance of the class.
	 */
	public function __construct() {
		// Sets default values
		$this->creator = null;
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
	public function getEmailAddress() {
		return $this->emailAddress;
	}
	
	/**
	 * TODO: comment
	 */
	public function getFirstName() {
		return $this->firstName;
	}
	
	/**
	 * TODO: comment
	 */
	public function getGender() {
		return $this->gender;
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
	public function getKeyStretchingIterations() {
		return $this->keyStretchingIterations;
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
	public function getLastName() {
		return $this->lastName;
	}
	
	/**
	 * TODO: comment
	 */
	public function getPasswordHash() {
		return $this->passwordHash;
	}
	
	/**
	 * TODO: comment
	 */
	public function getRole() {
		return $this->role;
	}
	
	/**
	 * TODO: comment
	 */
	public function getSalt() {
		return $this->salt;
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
	public function setEmailAddress($emailAddress) {
		$this->emailAddress = $emailAddress;
	}
	
	/**
	 * TODO: comment
	 */
	public function setFirstName($firstName) {
		$this->firstName = $firstName;
	}
	
	/**
	 * TODO: comment
	 */
	public function setGender($gender) {
		$this->gender = $gender;
	}
	
	/**
	 * TODO: comment
	 */
	public function setId($id) {
		$this->id = $id;
	}
	
	/**
	 * TODO: comment
	 */
	public function setKeyStretchingIterations($keyStretchingIterations) {
		$this->keyStretchingIterations = $keyStretchingIterations;
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
	public function setLastName($lastName) {
		$this->lastName = $lastName;
	}
	
	/**
	 * TODO: comment
	 */
	public function setPasswordHash($passwordHash) {
		$this->passwordHash = $passwordHash;
	}
	
	/**
	 * TODO: comment
	 */
	public function setRole($role) {
		$this->role = $role;
	}
	
	/**
	 * TODO: comment
	 */
	public function setSalt($salt) {
		$this->salt = $salt;
	}
	
}
