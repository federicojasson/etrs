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
 * Represents a password-reset permission from the database.
 * 
 * Annotations:
 * 
 * @Entity
 * @Table(name="password_reset_permissions")
 * @HasLifecycleCallbacks
 */
class PasswordResetPermission {
	
	/**
	 * The creation date-time.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name="creation_date_time",
	 *		type="datetime",
	 *		nullable=false
	 *	)
	 */
	private $creationDateTime;
	
	/**
	 * The ID.
	 * 
	 * Annotations:
	 * 
	 * @Id
	 * @GeneratedValue(strategy="CUSTOM")
	 * @CustomIdGenerator(class="App\Data\IdGenerator\Random")
	 * 
	 * @Column(
	 *		name="id",
	 *		type="binary_data",
	 *		length=16,
	 *		nullable=false,
	 *		
	 *		options={
	 *			"fixed": true
	 *		}
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
	 *		
	 *		options={
	 *			"unsigned": true
	 *		}
	 *	)
	 */
	private $keyStretchingIterations;
	
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
	 *		
	 *		options={
	 *			"fixed": true
	 *		}
	 *	)
	 */
	private $passwordHash;
	
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
	 *		
	 *		options={
	 *			"fixed": true
	 *		}
	 *	)
	 */
	private $salt;
	
	/**
	 * The user.
	 * 
	 * Annotations:
	 * 
	 * @OneToOne(targetEntity="User")
	 * 
	 * @JoinColumn(
	 *		name="user",
	 *		referencedColumnName="id",
	 *		nullable=false,
	 *		onDelete="RESTRICT"
	 *	)
	 */
	private $user;
	
	/**
	 * Sets the creation date-time.
	 * 
	 * Annotations:
	 * 
	 * @PrePersist
	 */
	public function setCreationDateTime() {
		$this->creationDateTime = getCurrentDateTime();
	}
	
}
