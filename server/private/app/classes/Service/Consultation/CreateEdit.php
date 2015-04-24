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
	 * TODO: comment
	 */
	protected function setCognitiveTestResults($consultation, $cognitiveTestResults) {
		global $app;
		
		// TODO: comments
		
		foreach ($consultation->getCognitiveTestResults() as $cognitiveTestResult) {
			$id = $cognitiveTestResult->getCognitiveTest()->getId();
			
			if (array_key_exists($id, $cognitiveTestResults)) {
				$cognitiveTestResult->setValue($cognitiveTestResults[$id]);
				unset($cognitiveTestResults[$id]);
			} else {
				$consultation->removeCognitiveTestResult($cognitiveTestResult);
			}
		}
		
		foreach ($cognitiveTestResults as $cognitiveTest => $value) {
			$cognitiveTest = $app->data->getRepository('Entity:CognitiveTest')->findNonDeleted($cognitiveTest);
			
			$cognitiveTestResult = new \App\Data\Entity\CognitiveTestResult();
			$cognitiveTestResult->setConsultation($consultation);
			$cognitiveTestResult->setCognitiveTest($cognitiveTest);
			$cognitiveTestResult->setValue($value);
			$app->data->persist($cognitiveTestResult);
			
			$consultation->addCognitiveTestResult($cognitiveTestResult);
		}
	}
	
	/**
	 * TODO: comment
	 */
	protected function setImagingTestResults($consultation, $imagingTestResults) {
		global $app;
		
		// TODO: comments
		
		foreach ($consultation->getImagingTestResults() as $imagingTestResult) {
			$id = $imagingTestResult->getImagingTest()->getId();
			
			if (array_key_exists($id, $imagingTestResults)) {
				$imagingTestResult->setValue($imagingTestResults[$id]);
				unset($imagingTestResults[$id]);
			} else {
				$consultation->removeImagingTestResult($imagingTestResult);
			}
		}
		
		foreach ($imagingTestResults as $imagingTest => $value) {
			$imagingTest = $app->data->getRepository('Entity:ImagingTest')->findNonDeleted($imagingTest);
			
			$imagingTestResult = new \App\Data\Entity\ImagingTestResult();
			$imagingTestResult->setConsultation($consultation);
			$imagingTestResult->setImagingTest($imagingTest);
			$imagingTestResult->setValue($value);
			$app->data->persist($imagingTestResult);
			
			$consultation->addImagingTestResult($imagingTestResult);
		}
	}
	
	/**
	 * TODO: comment
	 */
	protected function setLaboratoryTestResults($consultation, $laboratoryTestResults) {
		global $app;
		
		// TODO: comments
		
		foreach ($consultation->getLaboratoryTestResults() as $laboratoryTestResult) {
			$id = $laboratoryTestResult->getLaboratoryTest()->getId();
			
			if (array_key_exists($id, $laboratoryTestResults)) {
				$laboratoryTestResult->setValue($laboratoryTestResults[$id]);
				unset($laboratoryTestResults[$id]);
			} else {
				$consultation->removeLaboratoryTestResult($laboratoryTestResult);
			}
		}
		
		foreach ($laboratoryTestResults as $laboratoryTest => $value) {
			$laboratoryTest = $app->data->getRepository('Entity:LaboratoryTest')->findNonDeleted($laboratoryTest);
			
			$laboratoryTestResult = new \App\Data\Entity\LaboratoryTestResult();
			$laboratoryTestResult->setConsultation($consultation);
			$laboratoryTestResult->setLaboratoryTest($laboratoryTest);
			$laboratoryTestResult->setValue($value);
			$app->data->persist($laboratoryTestResult);
			
			$consultation->addLaboratoryTestResult($laboratoryTestResult);
		}
	}
	
	/**
	 * TODO: comment
	 */
	protected function setMedicalAntecedents($consultation, $medicalAntecedents) {
		global $app;
		
		// TODO: comments
		
		foreach ($consultation->getMedicalAntecedents() as $medicalAntecedent) {
			$index = searchInArray($medicalAntecedent->getId(), $medicalAntecedents);
			
			if ($index === false) {
				$consultation->removeMedicalAntecedent($medicalAntecedent);
			} else {
				removeFromArray($medicalAntecedents, $index);
			}
		}
		
		foreach ($medicalAntecedents as $medicalAntecedent) {
			$medicalAntecedent = $app->data->getRepository('Entity:MedicalAntecedent')->findNonDeleted($medicalAntecedent);
			$app->assertion->entityExists($medicalAntecedent);
			$consultation->addMedicalAntecedent($medicalAntecedent);
		}
	}
	
	/**
	 * TODO: comment
	 */
	protected function setMedicines($consultation, $medicines) {
		global $app;
		
		// TODO: comments
		
		foreach ($consultation->getMedicines() as $medicine) {
			$index = searchInArray($medicine->getId(), $medicines);
			
			if ($index === false) {
				$consultation->removeMedicine($medicine);
			} else {
				removeFromArray($medicines, $index);
			}
		}
		
		foreach ($medicines as $medicine) {
			$medicine = $app->data->getRepository('Entity:Medicine')->findNonDeleted($medicine);
			$app->assertion->entityExists($medicine);
			$consultation->addMedicine($medicine);
		}
	}
	
	/**
	 * TODO: comment
	 */
	protected function setTreatments($consultation, $treatments) {
		global $app;
		
		// TODO: comments
		
		foreach ($consultation->getTreatments() as $treatment) {
			$index = searchInArray($treatment->getId(), $treatments);
			
			if ($index === false) {
				$consultation->removeTreatment($treatment);
			} else {
				removeFromArray($treatments, $index);
			}
		}
		
		foreach ($treatments as $treatment) {
			$treatment = $app->data->getRepository('Entity:Treatment')->findNonDeleted($treatment);
			$app->assertion->entityExists($treatment);
			$consultation->addTreatment($treatment);
		}
	}

}
