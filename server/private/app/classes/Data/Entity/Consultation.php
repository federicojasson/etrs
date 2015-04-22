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
 * Represents a consultation from the database.
 * 
 * Annotations:
 * 
 * @Entity(repositoryClass="App\Data\EntityRepository\Custom")
 * @Table(name="consultations")
 * @HasLifecycleCallbacks
 */
class Consultation {
	
	/**
	 * The clinical impression.
	 * 
	 * Annotations:
	 * 
	 * @ManyToOne(targetEntity="ClinicalImpression")
	 * @JoinColumn(
	 *		name="clinical_impression",
	 *		referencedColumnName="id",
	 *		onDelete="SET NULL"
	 *	)
	 */
	private $clinicalImpression;
	
	/**
	 * The cognitive-test results.
	 * 
	 * Annotations:
	 * 
	 * @OneToMany(
	 *		targetEntity="CognitiveTestResult",
	 *		mappedBy="consultation"
	 *	)
	 */
	private $cognitiveTestResults;
	
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
	 * The date.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name="date",
	 *		type="date",
	 *		nullable=false
	 *	)
	 */
	private $date;
	
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
	 * The diagnosis.
	 * 
	 * Annotations:
	 * 
	 * @ManyToOne(targetEntity="Diagnosis")
	 * @JoinColumn(
	 *		name="diagnosis",
	 *		referencedColumnName="id",
	 *		onDelete="SET NULL"
	 *	)
	 */
	private $diagnosis;
	
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
	 * The imaging-test results.
	 * 
	 * Annotations:
	 * 
	 * @OneToMany(
	 *		targetEntity="ImagingTestResult",
	 *		mappedBy="consultation"
	 *	)
	 */
	private $imagingTestResults;
	
	/**
	 * The laboratory-test results.
	 * 
	 * Annotations:
	 * 
	 * @OneToMany(
	 *		targetEntity="LaboratoryTestResult",
	 *		mappedBy="consultation"
	 *	)
	 */
	private $laboratoryTestResults;
	
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
	 * The medical antecedents.
	 * 
	 * Annotations:
	 * 
	 * @ManyToMany(targetEntity="MedicalAntecedent")
	 * @JoinTable(
	 *		name="consultations_medical_antecedents",
	 *		joinColumns={
	 *			@JoinColumn(
	 *				name="consultation",
	 *				referencedColumnName="id",
	 *				nullable=false,
	 *				onDelete="RESTRICT"
	 *			)
	 *		},
	 *		inverseJoinColumns={
	 *			@JoinColumn(
	 *				name="medical_antecedent",
	 *				referencedColumnName="id",
	 *				nullable=false,
	 *				onDelete="RESTRICT"
	 *			)
	 *		}
	 *	)
	 */
	private $medicalAntecedents;
	
	/**
	 * The medicines.
	 * 
	 * Annotations:
	 * 
	 * @ManyToMany(targetEntity="Medicine")
	 * @JoinTable(
	 *		name="consultations_medicines",
	 *		joinColumns={
	 *			@JoinColumn(
	 *				name="consultation",
	 *				referencedColumnName="id",
	 *				nullable=false,
	 *				onDelete="RESTRICT"
	 *			)
	 *		},
	 *		inverseJoinColumns={
	 *			@JoinColumn(
	 *				name="medicine",
	 *				referencedColumnName="id",
	 *				nullable=false,
	 *				onDelete="RESTRICT"
	 *			)
	 *		}
	 *	)
	 */
	private $medicines;
	
	/**
	 * The patient.
	 * 
	 * Annotations:
	 * 
	 * @ManyToOne(
	 *		targetEntity="Patient",
	 *		inversedBy="consultations"
	 *	)
	 * @JoinColumn(
	 *		name="patient",
	 *		referencedColumnName="id",
	 *		nullable=false,
	 *		onDelete="RESTRICT"
	 *	)
	 */
	private $patient;
	
	/**
	 * The presenting problem.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name="presenting_problem",
	 *		type="text",
	 *		nullable=false
	 *	)
	 */
	private $presentingProblem;
	
	/**
	 * The studies.
	 * 
	 * Annotations:
	 * 
	 * @OneToMany(
	 *		targetEntity="Study",
	 *		mappedBy="consultation"
	 *	)
	 */
	private $studies;
	
	/**
	 * The treatments.
	 * 
	 * Annotations:
	 * 
	 * @ManyToMany(targetEntity="Treatment")
	 * @JoinTable(
	 *		name="consultations_treatments",
	 *		joinColumns={
	 *			@JoinColumn(
	 *				name="consultation",
	 *				referencedColumnName="id",
	 *				nullable=false,
	 *				onDelete="RESTRICT"
	 *			)
	 *		},
	 *		inverseJoinColumns={
	 *			@JoinColumn(
	 *				name="treatment",
	 *				referencedColumnName="id",
	 *				nullable=false,
	 *				onDelete="RESTRICT"
	 *			)
	 *		}
	 *	)
	 */
	private $treatments;
	
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
		
		// Deletes the non-deleted studies
		foreach ($this->studies as $study) {
			if (! $study->isDeleted()) {
				// The study is not deleted
				$study->delete($user);
			}
		}
	}
	
	/**
	 * Returns the ID.
	 */
	public function getId() {
		return $this->id;
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
		
		$serialized['date'] = $this->date->format('Y-m-d');
		$serialized['presentingProblem'] = $this->presentingProblem;
		$serialized['comments'] = $this->comments;
		
		$serialized['creator'] = null;
		if (! is_null($this->creator)) {
			$serialized['creator'] = $this->creator->getId();
		}
		
		$serialized['lastEditor'] = null;
		if (! is_null($this->lastEditor)) {
			$serialized['lastEditor'] = $this->lastEditor->getId();
		}
		
		$serialized['patient'] = bin2hex($this->patient->getId());
		
		$serialized['clinicalImpression'] = null;
		if (! is_null($this->clinicalImpression)) {
			if (! $this->clinicalImpression->isDeleted()) {
				$serialized['clinicalImpression'] = bin2hex($this->clinicalImpression->getId());
			}
		}
		
		$serialized['diagnosis'] = null;
		if (! is_null($this->diagnosis)) {
			if (! $this->diagnosis->isDeleted()) {
				$serialized['diagnosis'] = bin2hex($this->diagnosis->getId());
			}
		}
		
		$serialized['medicalAntecedents'] = [];
		foreach ($this->medicalAntecedents as $medicalAntecedent) {
			if (! $medicalAntecedent->isDeleted()) {
				$serialized['medicalAntecedents'][] = bin2hex($medicalAntecedent->getId());
			}
		}
		
		$serialized['medicines'] = [];
		foreach ($this->medicines as $medicine) {
			if (! $medicine->isDeleted()) {
				$serialized['medicines'][] = bin2hex($medicine->getId());
			}
		}
		
		$serialized['laboratoryTestResults'] = [];
		foreach ($this->laboratoryTestResults as $laboratoryTestResult) {
			$laboratoryTest = $laboratoryTestResult->getLaboratoryTest();
			
			if (! $laboratoryTest->isDeleted()) {
				$serialized['laboratoryTestResults'][bin2hex($laboratoryTest->getId())] = $laboratoryTestResult->getValue();
			}
		}
		
		$serialized['imagingTestResults'] = [];
		foreach ($this->imagingTestResults as $imagingTestResult) {
			$imagingTest = $imagingTestResult->getImagingTest();
			
			if (! $imagingTest->isDeleted()) {
				$serialized['imagingTestResults'][bin2hex($imagingTest->getId())] = $imagingTestResult->getValue();
			}
		}
		
		$serialized['cognitiveTestResults'] = [];
		foreach ($this->cognitiveTestResults as $cognitiveTestResult) {
			$cognitiveTest = $cognitiveTestResult->getCognitiveTest();
			
			if (! $cognitiveTest->isDeleted()) {
				$serialized['cognitiveTestResults'][bin2hex($cognitiveTest->getId())] = $cognitiveTestResult->getValue();
			}
		}
		
		$serialized['treatments'] = [];
		foreach ($this->treatments as $treatment) {
			if (! $treatment->isDeleted()) {
				$serialized['treatments'][] = bin2hex($treatment->getId());
			}
		}
		
		$serialized['studies'] = [];
		foreach ($this->studies as $study) {
			if (! $study->isDeleted()) {
				$serialized['studies'][] = bin2hex($study->getId());
			}
		}
		
		return $serialized;
	}
	
	/**
	 * Sets the clinical impression.
	 * 
	 * Receives the clinical impression to be set.
	 */
	public function setClinicalImpression($clinicalImpression) {
		$this->clinicalImpression = $clinicalImpression;
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
	 * Sets the date.
	 * 
	 * Receives the date to be set.
	 */
	public function setDate($date) {
		$this->date = $date;
	}
	
	/**
	 * Sets the diagnosis.
	 * 
	 * Receives the diagnosis to be set.
	 */
	public function setDiagnosis($diagnosis) {
		$this->diagnosis = $diagnosis;
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
	 * Sets the patient.
	 * 
	 * Receives the patient to be set.
	 */
	public function setPatient($patient) {
		$this->patient = $patient;
	}
	
	/**
	 * Sets the presenting problem.
	 * 
	 * Receives the presenting problem to be set.
	 */
	public function setPresentingProblem($presentingProblem) {
		$this->presentingProblem = $presentingProblem;
	}
	
}
