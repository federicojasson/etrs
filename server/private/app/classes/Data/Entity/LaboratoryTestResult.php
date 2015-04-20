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
 * Represents a laboratory-test result from the database.
 * 
 * Annotations:
 * 
 * @Entity
 * @Table(name="laboratory_test_results")
 */
class LaboratoryTestResult {
	
	/**
	 * The consultation.
	 * 
	 * Annotations:
	 * 
	 * @Id
	 * @ManyToOne(
	 *		targetEntity="Consultation",
	 *		inversedBy="laboratoryTestResults"
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
	 * The laboratory test.
	 * 
	 * Annotations:
	 * 
	 * @Id
	 * @ManyToOne(targetEntity="LaboratoryTest")
	 * @JoinColumn(
	 *		name="laboratory_test",
	 *		referencedColumnName="id",
	 *		nullable=false,
	 *		onDelete="RESTRICT"
	 *	)
	 */
	private $laboratoryTest;
	
	/**
	 * The value.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name="value",
	 *		type="binary_data",
	 *		length=64,
	 *		nullable=false
	 *	)
	 */
	private $value;
	
	/**
	 * Returns the laboratory test.
	 */
	public function getLaboratoryTest() {
		return $this->laboratoryTest;
	}
	
	/**
	 * Returns the value.
	 */
	public function getValue() {
		return $this->value;
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
	 * Sets the laboratory test.
	 * 
	 * Receives the laboratory test to be set.
	 */
	public function setLaboratoryTest($laboratoryTest) {
		$this->laboratoryTest = $laboratoryTest;
	}
	
	/**
	 * Sets the value.
	 * 
	 * Receives the value to be set.
	 */
	public function setValue($value) {
		$this->value = $value;
	}
	
}
