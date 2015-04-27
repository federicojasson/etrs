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

namespace App\Service\Consultation;

/**
 * Provides functionalities shared by the /consultation/create and
 * /consultation/edit services.
 */
abstract class CreateEdit extends \App\Service\External {
	
	/**
	 * Applies a filter to a set of cognitive-test results.
	 * 
	 * Receives the cognitive-test results.
	 */
	protected function filterCognitiveTestResults($cognitiveTestResults) {
		$newCognitiveTestResults = [];
		
		// Adds the cognitive-test results
		foreach ($cognitiveTestResults as $cognitiveTestResult) {
			$cognitiveTest = hex2bin($cognitiveTestResult['cognitiveTest']);
			$value = $cognitiveTestResult['value'];
			$newCognitiveTestResults[$cognitiveTest] = $value;
		}
		
		return $newCognitiveTestResults;
	}
	
	/**
	 * Applies a filter to a set of imaging-test results.
	 * 
	 * Receives the imaging-test results.
	 */
	protected function filterImagingTestResults($imagingTestResults) {
		$newImagingTestResults = [];
		
		// Adds the imaging-test results
		foreach ($imagingTestResults as $imagingTestResult) {
			$imagingTest = hex2bin($imagingTestResult['imagingTest']);
			$value = $imagingTestResult['value'];
			$newImagingTestResults[$imagingTest] = $value;
		}
		
		return $newImagingTestResults;
	}
	
	/**
	 * Applies a filter to a set of laboratory-test results.
	 * 
	 * Receives the laboratory-test results.
	 */
	protected function filterLaboratoryTestResults($laboratoryTestResults) {
		$newLaboratoryTestResults = [];
		
		// Adds the laboratory-test results
		foreach ($laboratoryTestResults as $laboratoryTestResult) {
			$laboratoryTest = hex2bin($laboratoryTestResult['laboratoryTest']);
			$value = $laboratoryTestResult['value'];
			$newLaboratoryTestResults[$laboratoryTest] = $value;
		}
		
		return $newLaboratoryTestResults;
	}
	
	/**
	 * Sets a consultation's cognitive-test results.
	 * 
	 * Receives the consultation and the cognitive-test results.
	 */
	protected function setConsultationCognitiveTestResults($consultation, $cognitiveTestResults) {
		global $app;
		
		// Removes the cognitive-test results corresponding to cognitive tests
		// that have not been received
		foreach ($consultation->getCognitiveTestResults() as $cognitiveTestResult) {
			// Gets the cognitive test's ID
			$id = $cognitiveTestResult->getCognitiveTest()->getId();
			
			if (array_key_exists($id, $cognitiveTestResults)) {
				// The cognitive test has been received
				$cognitiveTestResult->setValue($cognitiveTestResults[$id]);
				unset($cognitiveTestResults[$id]);
			} else {
				// The cognitive test has not been received
				// Removes the cognitive test
				$consultation->removeCognitiveTestResult($cognitiveTestResult);
			}
		}
		
		// Adds the cognitive-test results
		foreach ($cognitiveTestResults as $cognitiveTest => $value) {
			// Gets the cognitive test
			$cognitiveTest = $app->data->getReference('Entity:CognitiveTest', $cognitiveTest);
			
			// Creates the cognitive-test result
			$cognitiveTestResult = new \App\Data\Entity\CognitiveTestResult();
			$cognitiveTestResult->setConsultation($consultation);
			$cognitiveTestResult->setCognitiveTest($cognitiveTest);
			$cognitiveTestResult->setValue($value);
			$app->data->persist($cognitiveTestResult);
			
			// Adds the cognitive-test result
			$consultation->addCognitiveTestResult($cognitiveTestResult);
		}
	}
	
	/**
	 * Sets a consultation's imaging-test results.
	 * 
	 * Receives the consultation and the imaging-test results.
	 */
	protected function setConsultationImagingTestResults($consultation, $imagingTestResults) {
		global $app;
		
		// Removes the imaging-test results corresponding to imaging tests that
		// have not been received
		foreach ($consultation->getImagingTestResults() as $imagingTestResult) {
			// Gets the imaging test's ID
			$id = $imagingTestResult->getImagingTest()->getId();
			
			if (array_key_exists($id, $imagingTestResults)) {
				// The imaging test has been received
				$imagingTestResult->setValue($imagingTestResults[$id]);
				unset($imagingTestResults[$id]);
			} else {
				// The imaging test has not been received
				// Removes the imaging test
				$consultation->removeImagingTestResult($imagingTestResult);
			}
		}
		
		// Adds the imaging-test results
		foreach ($imagingTestResults as $imagingTest => $value) {
			// Gets the imaging test
			$imagingTest = $app->data->getReference('Entity:ImagingTest', $imagingTest);
			
			// Creates the imaging-test result
			$imagingTestResult = new \App\Data\Entity\ImagingTestResult();
			$imagingTestResult->setConsultation($consultation);
			$imagingTestResult->setImagingTest($imagingTest);
			$imagingTestResult->setValue($value);
			$app->data->persist($imagingTestResult);
			
			// Adds the imaging-test result
			$consultation->addImagingTestResult($imagingTestResult);
		}
	}
	
	/**
	 * Sets a consultation's laboratory-test results.
	 * 
	 * Receives the consultation and the laboratory-test results.
	 */
	protected function setConsultationLaboratoryTestResults($consultation, $laboratoryTestResults) {
		global $app;
		
		// Removes the laboratory-test results corresponding to laboratory tests
		// that have not been received
		foreach ($consultation->getLaboratoryTestResults() as $laboratoryTestResult) {
			// Gets the laboratory test's ID
			$id = $laboratoryTestResult->getLaboratoryTest()->getId();
			
			if (array_key_exists($id, $laboratoryTestResults)) {
				// The laboratory test has been received
				$laboratoryTestResult->setValue($laboratoryTestResults[$id]);
				unset($laboratoryTestResults[$id]);
			} else {
				// The laboratory test has not been received
				// Removes the laboratory test
				$consultation->removeLaboratoryTestResult($laboratoryTestResult);
			}
		}
		
		// Adds the laboratory-test results
		foreach ($laboratoryTestResults as $laboratoryTest => $value) {
			// Gets the laboratory test
			$laboratoryTest = $app->data->getReference('Entity:LaboratoryTest', $laboratoryTest);
			
			// Creates the laboratory-test result
			$laboratoryTestResult = new \App\Data\Entity\LaboratoryTestResult();
			$laboratoryTestResult->setConsultation($consultation);
			$laboratoryTestResult->setLaboratoryTest($laboratoryTest);
			$laboratoryTestResult->setValue($value);
			$app->data->persist($laboratoryTestResult);
			
			// Adds the laboratory-test result
			$consultation->addLaboratoryTestResult($laboratoryTestResult);
		}
	}
	
	/**
	 * Sets a consultation's medical antecedents.
	 * 
	 * Receives the consultation and the medical antecedents.
	 */
	protected function setConsultationMedicalAntecedents($consultation, $medicalAntecedents) {
		global $app;
		
		// Removes the medical antecedents that have not been received
		foreach ($consultation->getMedicalAntecedents() as $medicalAntecedent) {
			// Searches the medical antecedent
			$index = searchInArray($medicalAntecedent->getId(), $medicalAntecedents);
			
			if ($index === false) {
				// The medical antecedent has not been received
				// Removes the medical antecedent
				$consultation->removeMedicalAntecedent($medicalAntecedent);
			} else {
				// The medical antecedent has been received
				removeFromArrayByIndex($index, $medicalAntecedents);
			}
		}
		
		// Adds the medical antecedents
		foreach ($medicalAntecedents as $medicalAntecedent) {
			// Gets the medical antecedent
			$medicalAntecedent = $app->data->getRepository('Entity:MedicalAntecedent')->findNonDeleted($medicalAntecedent);
			
			// Asserts conditions
			$app->assertion->entityExists($medicalAntecedent);
			
			// Adds the medical antecedent
			$consultation->addMedicalAntecedent($medicalAntecedent);
		}
	}
	
	/**
	 * Sets a consultation's medicines.
	 * 
	 * Receives the consultation and the medicines.
	 */
	protected function setConsultationMedicines($consultation, $medicines) {
		global $app;
		
		// Removes the medicines that have not been received
		foreach ($consultation->getMedicines() as $medicine) {
			// Searches the medicine
			$index = searchInArray($medicine->getId(), $medicines);
			
			if ($index === false) {
				// The medicine has not been received
				// Removes the medicine
				$consultation->removeMedicine($medicine);
			} else {
				// The medicine has been received
				removeFromArrayByIndex($index, $medicines);
			}
		}
		
		// Adds the medicines
		foreach ($medicines as $medicine) {
			// Gets the medicine
			$medicine = $app->data->getRepository('Entity:Medicine')->findNonDeleted($medicine);
			
			// Asserts conditions
			$app->assertion->entityExists($medicine);
			
			// Adds the medicine
			$consultation->addMedicine($medicine);
		}
	}
	
	/**
	 * Sets a consultation's treatments.
	 * 
	 * Receives the consultation and the treatments.
	 */
	protected function setConsultationTreatments($consultation, $treatments) {
		global $app;
		
		// Removes the treatments that have not been received
		foreach ($consultation->getTreatments() as $treatment) {
			// Searches the treatment
			$index = searchInArray($treatment->getId(), $treatments);
			
			if ($index === false) {
				// The treatment has not been received
				// Removes the treatment
				$consultation->removeTreatment($treatment);
			} else {
				// The treatment has been received
				removeFromArrayByIndex($index, $treatments);
			}
		}
		
		// Adds the treatments
		foreach ($treatments as $treatment) {
			// Gets the treatment
			$treatment = $app->data->getRepository('Entity:Treatment')->findNonDeleted($treatment);
			
			// Asserts conditions
			$app->assertion->entityExists($treatment);
			
			// Adds the treatment
			$consultation->addTreatment($treatment);
		}
	}

}
