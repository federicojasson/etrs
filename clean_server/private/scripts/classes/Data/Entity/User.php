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
 * @Entity
 * @Table(name="users", schema="etrs")
 */
class User extends Entity {
	
	/**
	 * @Id
	 * @Column(type="binary", length=32, nullable=false)
	 * @GeneratedValue(strategy="CUSTOM")
	 * @CustomIdGenerator(class="App\Data\Utility\RandomIdGenerator")
	 */
	protected $id;
	
	/**
	 * @ManyToOne(targetEntity="User")
	 * @JoinColumn(name="creator", referencedColumnName="id", nullable=true,
	 * onDelete="SET NULL")
	 */
	protected $creator;
	
	/**
	 * @Column(type="datetime", nullable=false)
	 */
	protected $creationDatetime;
	
	/**
	 * @Column(type="datetime", nullable=false)
	 */
	protected $lastEditionDatetime;
	
	/**
	 * @Column(type="binary", length=64, nullable=false, options={"fixed":true})
	 */
	protected $passwordHash;
	
	/**
	 * @Column(type="binary", length=64, nullable=false, options={"fixed":true})
	 */
	protected $salt;
	
	/**
	 * @Column(type="integer", nullable=false, options={"unsigned":true})
	 */
	protected $keyStretchingIterations;
	
	/**
	 * @Column(type="binary", length=2, nullable=false, options={"fixed":true})
	 */
	protected $role;
	
	/**
	 * @Column(type="string", length=48, nullable=false)
	 */
	protected $firstName;
	
	/**
	 * @Column(type="string", length=48, nullable=false)
	 */
	protected $lastName;
	
	/**
	 * @Column(type="binary", length=1, nullable=false, options={"fixed":true})
	 */
	protected $gender;
	
	/**
	 * @Column(type="string", length=254, nullable=false)
	 */
	protected $emailAddress;

	public function getId() {
		return $this->id;
	}

	public function getCreator() {
		return $this->creator;
	}

	public function getCreationDatetime() {
		return $this->creationDatetime;
	}

	public function getLastEditionDatetime() {
		return $this->lastEditionDatetime;
	}

	public function getPasswordHash() {
		return $this->passwordHash;
	}

	public function getSalt() {
		return $this->salt;
	}

	public function getKeyStretchingIterations() {
		return $this->keyStretchingIterations;
	}

	public function getRole() {
		return $this->role;
	}

	public function getFirstName() {
		return $this->firstName;
	}

	public function getLastName() {
		return $this->lastName;
	}

	public function getGender() {
		return $this->gender;
	}

	public function getEmailAddress() {
		return $this->emailAddress;
	}

	public function setId($id) {
		$this->id = $id;
		return $this;
	}

	public function setCreator($creator) {
		$this->creator = $creator;
		return $this;
	}

	public function setCreationDatetime($creationDatetime) {
		$this->creationDatetime = $creationDatetime;
		return $this;
	}

	public function setLastEditionDatetime($lastEditionDatetime) {
		$this->lastEditionDatetime = $lastEditionDatetime;
		return $this;
	}

	public function setPasswordHash($passwordHash) {
		$this->passwordHash = $passwordHash;
		return $this;
	}

	public function setSalt($salt) {
		$this->salt = $salt;
		return $this;
	}

	public function setKeyStretchingIterations($keyStretchingIterations) {
		$this->keyStretchingIterations = $keyStretchingIterations;
		return $this;
	}

	public function setRole($role) {
		$this->role = $role;
		return $this;
	}

	public function setFirstName($firstName) {
		$this->firstName = $firstName;
		return $this;
	}

	public function setLastName($lastName) {
		$this->lastName = $lastName;
		return $this;
	}

	public function setGender($gender) {
		$this->gender = $gender;
		return $this;
	}

	public function setEmailAddress($emailAddress) {
		$this->emailAddress = $emailAddress;
		return $this;
	}
	
}
