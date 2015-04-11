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
 * Represents a user from the database.
 * 
 * Annotations:
 * 
 * @Entity
 * @Table(name="users")
 * @HasLifecycleCallbacks
 */
class User {
	
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
	 * The creator.
	 * 
	 * Annotations:
	 * 
	 * @ManyToOne(targetEntity="User")
	 * @JoinColumn(
	 *		name="creator",
	 *		referencedColumnName="id",
	 *		onDelete="SET NULL"
	 *	)
	 */
	private $creator;
	
	/**
	 * The email address.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name="email_address",
	 *		type="string",
	 *		length=254,
	 *		nullable=false
	 *	)
	 */
	private $emailAddress;
	
	/**
	 * The first name.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name="first_name",
	 *		type="string",
	 *		length=48,
	 *		nullable=false
	 *	)
	 */
	private $firstName;
	
	/**
	 * The gender.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name="gender",
	 *		type="binary_data",
	 *		length=1,
	 *		nullable=false,
	 *		options={
	 *			"fixed": true
	 *		}
	 *	)
	 */
	private $gender;
	
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
	 *		nullable=false
	 *	)
	 */
	private $id;
	
	/**
	 * The key-stretching iterations.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name="key_stretching_iterations",
	 *		type="integer",
	 *		nullable=false,
	 *		options={
	 *			"unsigned": true
	 *		}
	 *	)
	 */
	private $keyStretchingIterations;
	
	/**
	 * The last-edition date-time.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name="last_edition_date_time",
	 *		type="utc_datetime"
	 *	)
	 */
	private $lastEditionDateTime;
	
	/**
	 * The last name.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name="last_name",
	 *		type="string",
	 *		length=48,
	 *		nullable=false
	 *	)
	 */
	private $lastName;
	
	/**
	 * The password's hash.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name="password_hash",
	 *		type="binary_data",
	 *		length=64,
	 *		nullable=false,
	 *		options={
	 *			"fixed": true
	 *		}
	 *	)
	 */
	private $passwordHash;
	
	/**
	 * The role.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name="role",
	 *		type="binary_data",
	 *		length=2,
	 *		nullable=false,
	 *		options={
	 *			"fixed": true
	 *		}
	 *	)
	 */
	private $role;
	
	/**
	 * The salt.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name="salt",
	 *		type="binary_data",
	 *		length=64,
	 *		nullable=false,
	 *		options={
	 *			"fixed": true
	 *		}
	 *	)
	 */
	private $salt;
	
	/**
	 * The version.
	 * 
	 * Annotations:
	 * 
	 * @Version
	 * @Column(
	 *		name="version",
	 *		type="integer",
	 *		nullable=false,
	 *		options={
	 *			"unsigned": true
	 *		}
	 *	)
	 */
	private $version;
	
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
	 * Returns the last name.
	 */
	public function getLastName() {
		return $this->lastName;
	}
	
	/**
	 * Returns the password's hash.
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
	 * Serializes the entity.
	 */
	public function serialize() {
		// Initializes the serialization
		$serialization = [];
		
		// Adds the appropriate fields
		// The process only considers accessible fields and it filters them
		// according to their specific characteristics
		
		$serialization['id'] = $this->id;
		$serialization['version'] = $this->version;
		$serialization['creationDateTime'] = $this->creationDateTime->format();
		
		$serialization['lastEditionDateTime'] = null;
		if (! is_null($this->lastEditionDateTime)) {
			$serialization['lastEditionDateTime'] = $this->lastEditionDateTime->format();
		}
		
		$serialization['role'] = $this->role;
		$serialization['emailAddress'] = $this->emailAddress;
		$serialization['firstName'] = $this->firstName;
		$serialization['lastName'] = $this->lastName;
		$serialization['gender'] = $this->gender;
		
		$serialization['creator'] = null;
		if (! is_null($this->creator)) {
			$serialization['creator'] = $this->creator->getId();
		}
		
		return $serialization;
	}
	
	/**
	 * Sets the creation date-time.
	 * 
	 * Annotations:
	 * 
	 * @PrePersist
	 */
	public function setCreationDateTime() {
		$this->creationDateTime = \App\DateTime\Custom::createCurrent();
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
	 */
	public function setLastEditionDateTime() {
		$this->lastEditionDateTime = \App\DateTime\Custom::createCurrent();
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
	 * Sets the password's hash.
	 * 
	 * Receives the hash to be set.
	 */
	public function setPasswordHash($hash) {
		$this->passwordHash = $hash;
	}
	
	/**
	 * Sets the role.
	 * 
	 * Receives the user role to be set.
	 */
	public function setRole($userRole) {
		$this->role = $userRole;
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
