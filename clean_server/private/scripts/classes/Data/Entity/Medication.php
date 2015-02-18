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
 * @Table(name="medications", schema="etrs")
 * @HasLifecycleCallbacks
 */
class Medication {
	
	/**
	 * @Id
	 * @Column(type="binary", length=16, nullable=false, options={"fixed":true})
	 * @GeneratedValue(strategy="CUSTOM")
	 * @CustomIdGenerator(class="App\Data\Utility\RandomIdGenerator")
	 */
	protected $id;
	
	/**
	 * @Column(type="boolean", nullable=false)
	 */
	protected $deleted;
	
	/**
	 * @ManyToOne(targetEntity="User")
	 * @JoinColumn(name="creator", referencedColumnName="id", nullable=true,
	 * onDelete="SET NULL")
	 */
	protected $creator;
	
	/**
	 * @ManyToOne(targetEntity="User")
	 * @JoinColumn(name="last_editor", referencedColumnName="id", nullable=true,
	 * onDelete="SET NULL")
	 */
	protected $lastEditor;
	
	/**
	 * @Column(type="datetime", nullable=false)
	 */
	protected $creationDatetime;
	
	/**
	 * @Column(type="datetime", nullable=false)
	 */
	protected $lastEditionDatetime;
	
	/**
	 * @Column(type="string", length=128, nullable=false)
	 */
	protected $name;
	
	/**
	 * TODO: comment
	 */
	public function __construct() {
		$this->deleted = false;
	}
	
	/**
	 * @PrePersist
	 */
	public function onPrePersist() {
		// TODO: obtain current timezone and restaure it after
		// TODO: use server helper to obtain UTC datetime
		$this->creationDatetime = new \DateTime(null, new \DateTimeZone('UTC'));
		$this->lastEditionDatetime = $this->creationDatetime;
	}
	
	public function getId() {
		return $this->id;
	}

	public function getDeleted() {
		return $this->deleted;
	}

	public function getCreator() {
		return $this->creator;
	}

	public function getLastEditor() {
		return $this->lastEditor;
	}

	public function getCreationDatetime() {
		return $this->creationDatetime;
	}

	public function getLastEditionDatetime() {
		return $this->lastEditionDatetime;
	}

	public function getName() {
		return $this->name;
	}

	public function setDeleted($deleted) {
		$this->deleted = $deleted;
		return $this;
	}

	public function setCreator($creator) {
		$this->creator = $creator;
		return $this;
	}

	public function setLastEditor($lastEditor) {
		$this->lastEditor = $lastEditor;
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

	public function setName($name) {
		$this->name = $name;
		return $this;
	}

}
