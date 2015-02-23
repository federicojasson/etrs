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
 * This class represents a user from the database.
 * 
 * Annotations:
 * 
 * @Entity(repositoryClass = "App\Data\EntityRepository\CustomRepository")
 * @Table(name = "users")
 * @HasLifecycleCallbacks
 */
class User {
	
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
	 * The email address.
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
	 * The first name.
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
	 * The gender.
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
	 * The ID.
	 * 
	 * Annotations:
	 * 
	 * @Id
	 * 
	 * @Column(
	 *		name = "id",
	 *		type = "binary",
	 *		length = 32,
	 *		nullable = false
	 *	)
	 */
	protected $id;
	
	/**
	 * The key-stretching iterations.
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
	 * The last name.
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
	 * The password hash.
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
	 * The role.
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
	 * The salt.
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
	 * Returns the email address.
	 */
	public function getEmailAddress() {
		return $this->emailAddress;
	}
	
	/**
	 * Returns the first name.
	 */
	public function getFirstName() {
		return $this->firstName;
	}
	
	/**
	 * Returns the gender.
	 */
	public function getGender() {
		return $this->gender;
	}
	
	/**
	 * Returns the ID.
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * Returns the key-stretching iterations.
	 */
	public function getKeyStretchingIterations() {
		return $this->keyStretchingIterations;
	}
	
	/**
	 * Returns the last-edition date-time.
	 */
	public function getLastEditionDateTime() {
		return $this->lastEditionDateTime;
	}
	
	/**
	 * Returns the last name.
	 */
	public function getLastName() {
		return $this->lastName;
	}
	
	/**
	 * Returns the password hash.
	 */
	public function getPasswordHash() {
		return $this->passwordHash;
	}
	
	/**
	 * Returns the role.
	 */
	public function getRole() {
		return $this->role;
	}
	
	/**
	 * Returns the salt.
	 */
	public function getSalt() {
		return $this->salt;
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
	 * Sets the email address.
	 * 
	 * Receives the email address to be set.
	 */
	public function setEmailAddress($emailAddress) {
		$this->emailAddress = $emailAddress;
	}
	
	/**
	 * Sets the first name.
	 * 
	 * Receives the first name to be set.
	 */
	public function setFirstName($firstName) {
		$this->firstName = $firstName;
	}
	
	/**
	 * Sets the gender.
	 * 
	 * Receives the gender to be set.
	 */
	public function setGender($gender) {
		$this->gender = $gender;
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
	 * Sets the key-stretching iterations.
	 * 
	 * Receives the key-stretching iterations to be set.
	 */
	public function setKeyStretchingIterations($keyStretchingIterations) {
		$this->keyStretchingIterations = $keyStretchingIterations;
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
	 * Sets the last name.
	 * 
	 * Receives the last name to be set.
	 */
	public function setLastName($lastName) {
		$this->lastName = $lastName;
	}
	
	/**
	 * Sets the password hash.
	 * 
	 * Receives the hash to be set.
	 */
	public function setPasswordHash($hash) {
		$this->passwordHash = $hash;
	}
	
	/**
	 * Sets the role.
	 * 
	 * Receives the role to be set.
	 */
	public function setRole($role) {
		$this->role = $role;
	}
	
	/**
	 * Sets the salt.
	 * 
	 * Receives the salt to be set.
	 */
	public function setSalt($salt) {
		$this->salt = $salt;
	}
	
}
