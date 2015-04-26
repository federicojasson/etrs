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
 * Represents a study from the database.
 * 
 * Annotations:
 * 
 * @Entity(repositoryClass="App\Data\EntityRepository\Custom")
 * @Table(name="studies")
 * @HasLifecycleCallbacks
 */
class Study {
	
	/**
	 * The comments.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name="comments",
	 *		type="text",
	 *		nullable=false
	 *	)
	 */
	private $comments;
	
	/**
	 * The consultation.
	 * 
	 * Annotations:
	 * 
	 * @ManyToOne(
	 *		targetEntity="Consultation",
	 *		inversedBy="studies"
	 *	)
	 * @JoinColumn(
	 *		name="consultation",
	 *		referencedColumnName="id",
	 *		nullable=false,
	 *		onDelete="RESTRICT"
	 *	)
	 */
	private $consultation;
	
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
	 * The experiment.
	 * 
	 * Annotations:
	 * 
	 * @ManyToOne(
	 *		targetEntity="Experiment",
	 *		inversedBy="studies"
	 *	)
	 * @JoinColumn(
	 *		name="experiment",
	 *		referencedColumnName="id",
	 *		nullable=false,
	 *		onDelete="RESTRICT"
	 *	)
	 */
	private $experiment;
	
	/**
	 * The files.
	 * 
	 * Annotations:
	 * 
	 * @ManyToMany(targetEntity="File")
	 * @JoinTable(
	 *		name="studies_files",
	 *		joinColumns={
	 *			@JoinColumn(
	 *				name="study",
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
	 * The input.
	 * 
	 * Annotations:
	 * 
	 * @OneToOne(targetEntity="File")
	 * @JoinColumn(
	 *		name="input",
	 *		referencedColumnName="id",
	 *		nullable=false,
	 *		onDelete="RESTRICT"
	 *	)
	 */
	private $input;
	
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
	 * The output.
	 * 
	 * Annotations:
	 * 
	 * @OneToOne(targetEntity="File")
	 * @JoinColumn(
	 *		name="output",
	 *		referencedColumnName="id",
	 *		onDelete="SET NULL"
	 *	)
	 */
	private $output;
	
	/**
	 * The state.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name="state",
	 *		type="smallint",
	 *		nullable=false,
	 *		options={
	 *			"unsigned": true
	 *		}
	 *	)
	 */
	private $state;
	
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
		$this->state = STUDY_STATE_PENDING;
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
		
		$this->getInput()->delete($user);
		
		if (! is_null($this->getOutput())) {
			$this->getOutput()->delete($user);
		}
		
		foreach ($this->getFiles() as $file) {
			$file->delete($user);
		}
	}
	
	/**
	 * Returns the consultation.
	 */
	public function getConsultation() {
		return $this->consultation;
	}
	
	/**
	 * Returns the creator.
	 */
	public function getCreator() {
		return $this->creator;
	}
	
	/**
	 * Returns the experiment.
	 */
	public function getExperiment() {
		return $this->experiment;
	}
	
	/**
	 * Returns the files.
	 */
	public function getFiles() {
		$files = [];
		
		foreach ($this->files as $file) {
			if (! $file->isDeleted()) {
				$files[] = $file;
			}
		}
		
		return $files;
	}
	
	/**
	 * Returns the ID.
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * Returns the input.
	 */
	public function getInput() {
		return $this->input;
	}
	
	/**
	 * Returns the last editor.
	 */
	public function getLastEditor() {
		return $this->lastEditor;
	}
	
	/**
	 * Returns the output.
	 */
	public function getOutput() {
		return $this->output;
	}
	
	/**
	 * Determines whether the entity is deleted.
	 */
	public function isDeleted() {
		return $this->deleted;
	}
	
	/**
	 * Removes a file.
	 * 
	 * Receives the file to be removed.
	 */
	public function removeFile($file) {
		$this->files->removeElement($file);
		$file->delete($this->getLastEditor());
		$file->disassociate();
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
		
		$serialized['state'] = $this->state;
		$serialized['comments'] = $this->comments;
		
		$serialized['creator'] = null;
		if (! is_null($this->getCreator())) {
			$serialized['creator'] = (string) $this->getCreator();
		}
		
		$serialized['lastEditor'] = null;
		if (! is_null($this->getLastEditor())) {
			$serialized['lastEditor'] = (string) $this->getLastEditor();
		}
		
		$serialized['consultation'] = (string) $this->getConsultation();
		$serialized['experiment'] = (string) $this->getExperiment();
		$serialized['input'] = (string) $this->getInput();
		
		$serialized['output'] = null;
		if (! is_null($this->getOutput())) {
			$serialized['output'] = (string) $this->getOutput();
		}
		
		$serialized['files'] = filterArray($this->getFiles(), 'toString');
		
		return $serialized;
	}
	
	/**
	 * Sets the comments.
	 * 
	 * Receives the comments to be set.
	 */
	public function setComments($comments) {
		$this->comments = $comments;
	}
	
	/**
	 * Sets the consultation.
	 * 
	 * Receives the consultation to be set.
	 */
	public function setConsultation($consultation) {
		$this->consultation = $consultation;
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
	 * Sets the experiment.
	 * 
	 * Receives the experiment to be set.
	 */
	public function setExperiment($experiment) {
		$this->experiment = $experiment;
	}
	
	/**
	 * Sets the input.
	 * 
	 * Receives the file to be set.
	 */
	public function setInput($file) {
		$this->input = $file;
		$file->associate();
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
	 * Sets the output.
	 * 
	 * Receives the file to be set.
	 */
	public function setOutput($file) {
		$this->output = $file;
		$file->associate();
	}
	
	/**
	 * Sets the state.
	 * 
	 * Receives the state to be set.
	 */
	public function setState($state) {
		$this->state = $state;
	}
	
}
