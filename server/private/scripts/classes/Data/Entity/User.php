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
	private $emailAddress;
	
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
	private $firstName;
	
	/**
	 * The gender.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name = "gender",
	 *		type = "automatic_binary",
	 *		length = 1,
	 *		nullable = false,
	 *		options = {
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
	 * 
	 * @Column(
	 *		name = "id",
	 *		type = "automatic_binary",
	 *		length = 32,
	 *		nullable = false
	 *	)
	 */
	private $id;
	
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
	private $keyStretchingIterations;
	
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
	private $lastName;
	
	/**
	 * The password hash.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name = "password_hash",
	 *		type = "automatic_binary",
	 *		length = 64,
	 *		nullable = false,
	 *		options = {
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
	 *		name = "role",
	 *		type = "automatic_binary",
	 *		length = 2,
	 *		nullable = false,
	 *		options = {
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
	 *		name = "salt",
	 *		type = "automatic_binary",
	 *		length = 64,
	 *		nullable = false,
	 *		options = {
	 *			"fixed": true
	 *		}
	 *	)
	 */
	private $salt;
	
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
		
		// Sets the creation date-time
		$this->creationDateTime = $app->server->getCurrentDateTime();
	}
	
}
