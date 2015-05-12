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
 * Represents an experiment from the database.
 * 
 * Annotations:
 * 
 * @Entity(repositoryClass="App\Data\EntityRepository\Custom")
 * @Table(name="experiments")
 * @HasLifecycleCallbacks
 */
class Experiment {

	/**
	 * The command line.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name="command_line",
	 *		type="string",
	 *		length=512,
	 *		nullable=false
	 *	)
	 */
	private $commandLine;
	
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
	 * Indicates whether the entity is deleted.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name="deleted",
	 *		type="boolean",
	 *		nullable=false
	 *	)
	 */
	private $deleted;
	
	/**
	 * The deleter.
	 * 
	 * Annotations:
	 * 
	 * @ManyToOne(targetEntity="User")
	 * @JoinColumn(
	 *		name="deleter",
	 *		referencedColumnName="id",
	 *		onDelete="SET NULL"
	 *	)
	 */
	private $deleter;
	
	/**
	 * The deletion date-time.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name="deletion_date_time",
	 *		type="datetime"
	 *	)
	 */
	private $deletionDateTime;
	
	/**
	 * The files.
	 * 
	 * Annotations:
	 * 
	 * @ManyToMany(
	 *		targetEntity="File",
	 *		inversedBy="experiments"
	 *	)
	 * @OrderBy({
	 *		"creationDateTime"="ASC"
	 *	})
	 * @JoinTable(
	 *		name="experiments_files",
	 *		joinColumns={
	 *			@JoinColumn(
	 *				name="experiment",
	 *				referencedColumnName="id",
	 *				nullable=false,
	 *				onDelete="RESTRICT"
	 *			)
	 *		},
	 *		inverseJoinColumns={
	 *			@JoinColumn(
	 *				name="file",
	 *				referencedColumnName="id",
	 *				nullable=false,
	 *				onDelete="RESTRICT"
	 *			)
	 *		}
	 *	)
	 */
	private $files;
	
	/**
	 * The ID.
	 * 
	 * Annotations:
	 * 
	 * @Id
	 * @GeneratedValue(strategy="CUSTOM")
	 * @CustomIdGenerator(class="App\Data\IdGenerator\Random")
	 * @Column(
	 *		name="id",
	 *		type="binary_data",
	 *		length=16,
	 *		nullable=false,
	 *		options={
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
	 *		name="last_edition_date_time",
	 *		type="datetime"
	 *	)
	 */
	private $lastEditionDateTime;
	
	/**
	 * The last editor.
	 * 
	 * Annotations:
	 * 
	 * @ManyToOne(targetEntity="User")
	 * @JoinColumn(
	 *		name="last_editor",
	 *		referencedColumnName="id",
	 *		onDelete="SET NULL"
	 *	)
	 */
	private $lastEditor;
	
	/**
	 * The name.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name="name",
	 *		type="string",
	 *		length=64,
	 *		nullable=false
	 *	)
	 */
	private $name;
	
	/**
	 * The output's name.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name="output_name",
	 *		type="string",
	 *		length=128,
	 *		nullable=false
	 *	)
	 */
	private $outputName;
	
	/**
	 * The studies.
	 * 
	 * Annotations:
	 * 
	 * @OneToMany(
	 *		targetEntity="Study",
	 *		mappedBy="experiment"
	 *	)
	 */
	private $studies;
	
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
	 * Initializes an instance of the class.
	 */
	public function __construct() {
		$this->deleted = false;
		$this->files = new \Doctrine\Common\Collections\ArrayCollection();
	}
	
	/**
	 * Returns a string representation of the entity.
	 */
	public function __toString() {
		return bin2hex($this->id);
	}
	
	/**
	 * Adds a file.
	 * 
	 * Receives the file to be added.
	 */
	public function addFile($file) {
		$this->files->add($file);
		$file->associate();
	}
	
	/**
	 * Deletes the entity.
	 * 
	 * Receives the user to be set as the deleter.
	 */
	public function delete($user) {
		$this->deletionDateTime = new \DateTime();
		$this->deleted = true;
		$this->deleter = $user;
		
		// Deletes the appropriate associated entities
		// The process only considers entities that have not been deleted yet
		
		foreach ($this->getFiles() as $file) {
			$file->delete($user);
		}
		
		foreach ($this->getStudies() as $study) {
			$study->delete($user);
		}
	}
	
	/**
	 * Returns the command line.
	 */
	public function getCommandLine() {
		return $this->commandLine;
	}
	
	/**
	 * Returns the creator.
	 */
	public function getCreator() {
		return $this->creator;
	}
	
	/**
	 * Returns the files.
	 */
	public function getFiles() {
		return $this->files->toArray();
	}
	
	/**
	 * Returns the ID.
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * Returns the last editor.
	 */
	public function getLastEditor() {
		return $this->lastEditor;
	}
	
	/**
	 * Returns the output's name.
	 */
	public function getOutputName() {
		return $this->outputName;
	}
	
	/**
	 * Returns the studies.
	 */
	public function getStudies() {
		$studies = [];
		
		foreach ($this->studies as $study) {
			if (! $study->isDeleted()) {
				$studies[] = $study;
			}
		}
		
		return $studies;
	}
	
	/**
	 * Determines whether the entity is deleted.
	 */
	public function isDeleted() {
		return $this->deleted;
	}
	
	/**
	 * Serializes the entity.
	 */
	public function serialize() {
		$serialized = [];
		
		// Adds the appropriate fields
		// The process only considers accessible fields and it filters them
		// according to their specific characteristics
		
		$serialized['id'] = bin2hex($this->id);
		$serialized['version'] = $this->version;
		$serialized['creationDateTime'] = $this->creationDateTime->format(\DateTime::ISO8601);
		
		$serialized['lastEditionDateTime'] = null;
		if (! is_null($this->lastEditionDateTime)) {
			$serialized['lastEditionDateTime'] = $this->lastEditionDateTime->format(\DateTime::ISO8601);
		}
		
		$serialized['commandLine'] = $this->commandLine;
		$serialized['outputName'] = $this->outputName;
		$serialized['name'] = $this->name;
		
		$serialized['creator'] = null;
		if (! is_null($this->getCreator())) {
			$serialized['creator'] = (string) $this->getCreator();
		}
		
		$serialized['lastEditor'] = null;
		if (! is_null($this->getLastEditor())) {
			$serialized['lastEditor'] = (string) $this->getLastEditor();
		}
		
		$serialized['files'] = filterArray($this->getFiles(), 'toString');
		
		return $serialized;
	}
	
	/**
	 * Sets the command line.
	 * 
	 * Receives the command line to be set.
	 */
	public function setCommandLine($commandLine) {
		$this->commandLine = $commandLine;
	}
	
	/**
	 * Sets the creation date-time.
	 * 
	 * Annotations:
	 * 
	 * @PrePersist
	 */
	public function setCreationDateTime() {
		$this->creationDateTime = new \DateTime();
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
	 */
	public function setLastEditionDateTime() {
		$this->lastEditionDateTime = new \DateTime();
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
	
	/**
	 * Sets the output's name.
	 * 
	 * Receives the name to be set.
	 */
	public function setOutputName($name) {
		$this->outputName = $name;
	}
	
}
