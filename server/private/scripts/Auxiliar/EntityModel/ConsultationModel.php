<?php

namespace App\Auxiliar\EntityModel;

/*
 * This class offers operations to manage consultations.
 */
class ConsultationModel extends EntityModel {
	
	/*
	 * Creates a consultation.
	 * 
	 * It receives the consultation's data.
	 */
	public function create($id, $clinicalImpression, $creator, $diagnosis, $patient, $date, $reasons, $indications, $observations, $backgrounds, $imageTests, $laboratoryTests, $medications, $neurocognitiveTests, $treatments) {
		$app = $this->app;
		
		// Starts a read-write transaction
		$app->businessLogicDatabase->startReadWriteTransaction();
		
		// Creates the consultation
		$app->businessLogicDatabase->createConsultation($id, $clinicalImpression, $creator, $diagnosis, $patient, $date, $reasons, $indications, $observations);
		
		// Associates the data with the consultation
		$this->associateData($id, $backgrounds, $imageTests, $laboratoryTests, $medications, $neurocognitiveTests, $treatments);
		
		// Commits the transaction
		$app->businessLogicDatabase->commitTransaction();
	}
	
	/*
	 * Deletes a consultation.
	 * 
	 * It receives the consultation's ID.
	 */
	public function delete($id) {
		$app = $this->app;
		
		// Starts a read-write transaction
		$app->businessLogicDatabase->startReadWriteTransaction();
		
		// Deletes the consultation's studies
		$studies = $app->businessLogicDatabase->getConsultationNonDeletedStudies($id);
		foreach ($studies as $study) {
			$app->data->study->delete($study['id']);
		}
		
		// Deletes the consultation
		$app->businessLogicDatabase->deleteConsultation($id);
		
		// Commits the transaction
		$app->businessLogicDatabase->commitTransaction();
	}
	
	/*
	 * Edits a consultation.
	 * 
	 * It receives the consultation's data.
	 */
	public function edit($id, $clinicalImpression, $diagnosis, $lastEditor, $date, $reasons, $indications, $observations, $backgrounds, $imageTests, $laboratoryTests, $medications, $neurocognitiveTests, $treatments) {
		$app = $this->app;
		
		// Starts a read-write transaction
		$app->businessLogicDatabase->startReadWriteTransaction();
		
		// Edits the consultation
		$app->businessLogicDatabase->editConsultation($id, $clinicalImpression, $diagnosis, $lastEditor, $date, $reasons, $indications, $observations);
		
		// Disassociates all data from the consultation
		$this->disassociateData($id);
		
		// Associates the data with the consultation
		$this->associateData($id, $backgrounds, $imageTests, $laboratoryTests, $medications, $neurocognitiveTests, $treatments);
		
		// Commits the transaction
		$app->businessLogicDatabase->commitTransaction();
	}
	
	/*
	 * Determines whether a consultation exists.
	 * 
	 * It receives the consultation's ID.
	 */
	public function exists($id) {
		$app = $this->app;
		
		// Determines whether the consultation exists
		return $app->businessLogicDatabase->nonDeletedConsultationExists($id);
	}
	
	/*
	 * Filters a consultation for presentation and returns the result.
	 * 
	 * It receives the consultation.
	 */
	public function filter($consultation) {
		$app = $this->app;
		
		// Adds fields for the associated data
		$consultation['backgrounds'] = [];
		$consultation['imageTests'] = [];
		$consultation['laboratoryTests'] = [];
		$consultation['medications'] = [];
		$consultation['neurocognitiveTests'] = [];
		$consultation['studies'] = [];
		$consultation['treatments'] = [];
		
		// Gets the accessible fields
		$accessibleFields = $app->accessValidator->getAccessibleFields('consultation');
		
		// Filters the consultation's fields
		$newConsultation = filterArray($consultation, $accessibleFields);
		
		// Attaches associated data and applies conversions
		
		if (isset($newConsultation['id'])) {
			$newConsultation['id'] = bin2hex($consultation['id']);
		}
		
		if (isset($newConsultation['clinicalImpression'])) {
			if ($app->businessLogicDatabase->nonDeletedClinicalImpressionExists($consultation['clinicalImpression'])) {
				$newConsultation['clinicalImpression'] = bin2hex($consultation['clinicalImpression']);
			} else {
				$newConsultation['clinicalImpression'] = null;
			}
		}
		
		if (isset($newConsultation['diagnosis'])) {
			if ($app->businessLogicDatabase->nonDeletedDiagnosisExists($consultation['diagnosis'])) {
				$newConsultation['diagnosis'] = bin2hex($consultation['diagnosis']);
			} else {
				$newConsultation['diagnosis'] = null;
			}
		}
		
		if (isset($newConsultation['patient'])) {
			if ($app->businessLogicDatabase->nonDeletedPatientExists($consultation['patient'])) {
				$newConsultation['patient'] = bin2hex($consultation['patient']);
			} else {
				$newConsultation['patient'] = null;
			}
		}
		
		if (isset($newConsultation['backgrounds'])) {
			$backgrounds = $app->businessLogicDatabase->getConsultationNonDeletedBackgrounds($consultation['id']);
			
			foreach ($backgrounds as $background) {
				$newConsultation['backgrounds'][] = bin2hex($background['id']);
			}
		}
		
		if (isset($newConsultation['imageTests'])) {
			$imageTests = $app->businessLogicDatabase->getConsultationNonDeletedImageTests($consultation['id']);
			
			foreach ($imageTests as $imageTest) {
				$newConsultation['imageTests'][] = [
					'id' => bin2hex($imageTest['id']),
					'value' => $imageTest['value']
				];
			}
		}
		
		if (isset($newConsultation['laboratoryTests'])) {
			$laboratoryTests = $app->businessLogicDatabase->getConsultationNonDeletedLaboratoryTests($consultation['id']);
			
			foreach ($laboratoryTests as $laboratoryTest) {
				$newConsultation['laboratoryTests'][] = [
					'id' => bin2hex($laboratoryTest['id']),
					'value' => $laboratoryTest['value']
				];
			}
		}
		
		if (isset($newConsultation['medications'])) {
			$medications = $app->businessLogicDatabase->getConsultationNonDeletedMedications($consultation['id']);
			
			foreach ($medications as $medication) {
				$newConsultation['medications'][] = bin2hex($medication['id']);
			}
		}
		
		if (isset($newConsultation['neurocognitiveTests'])) {
			$neurocognitiveTests = $app->businessLogicDatabase->getConsultationNonDeletedNeurocognitiveTests($consultation['id']);
			
			foreach ($neurocognitiveTests as $neurocognitiveTest) {
				$newConsultation['neurocognitiveTests'][] = [
					'id' => bin2hex($neurocognitiveTest['id']),
					'value' => $neurocognitiveTest['value']
				];
			}
		}
		
		if (isset($newConsultation['treatments'])) {
			$treatments = $app->businessLogicDatabase->getConsultationNonDeletedTreatments($consultation['id']);
			
			foreach ($treatments as $treatment) {
				$newConsultation['treatments'][] = bin2hex($treatment['id']);
			}
		}
		
		return $newConsultation;
	}
	
	/*
	 * Returns a consultation. If it doesn't exist, null is returned.
	 * 
	 * It receives the consultation's ID.
	 */
	public function get($id) {
		$app = $this->app;
		
		// Gets the consultation
		return $app->businessLogicDatabase->getNonDeletedConsultation($id);
	}
	
	/*
	 * Associates data with a consultation.
	 * 
	 * It receives the consultation's ID and the data to associate.
	 */
	private function associateData($id, $backgrounds, $imageTests, $laboratoryTests, $medications, $neurocognitiveTests, $treatments) {
		$app = $this->app;
		
		// Associates the backgrounds
		foreach ($backgrounds as $background) {
			$app->businessLogicDatabase->createConsultationBackground($id, $background);
		}
		
		// Associates the image tests
		foreach ($imageTests as $imageTest) {
			$app->businessLogicDatabase->createConsultationImageTest($id, $imageTest['id'], $imageTest['value']);
		}
		
		// Associates the laboratory tests
		foreach ($laboratoryTests as $laboratoryTest) {
			$app->businessLogicDatabase->createConsultationLaboratoryTest($id, $laboratoryTest['id'], $laboratoryTest['value']);
		}
		
		// Associates the medications
		foreach ($medications as $medication) {
			$app->businessLogicDatabase->createConsultationMedication($id, $medication);
		}
		
		// Associates the neurocognitive tests
		foreach ($neurocognitiveTests as $neurocognitiveTest) {
			$app->businessLogicDatabase->createConsultationNeurocognitiveTest($id, $neurocognitiveTest['id'], $neurocognitiveTest['value']);
		}
		
		// Associates the treatments
		foreach ($treatments as $treatment) {
			$app->businessLogicDatabase->createConsultationTreatment($id, $treatment);
		}
	}
	
	/*
	 * Disassociates all data from a consultation.
	 * 
	 * It receives the consultation's ID.
	 */
	private function disassociateData($id) {
		$app = $this->app;
		
		// Disassociates the backgrounds
		$app->businessLogicDatabase->deleteConsultationBackgrounds($id);
		
		// Disassociates the image tests
		$app->businessLogicDatabase->deleteConsultationImageTests($id);
		
		// Disassociates the laboratory tests
		$app->businessLogicDatabase->deleteConsultationLaboratoryTests($id);
		
		// Disassociates the medications
		$app->businessLogicDatabase->deleteConsultationMedications($id);
		
		// Disassociates the neurocognitive tests
		$app->businessLogicDatabase->deleteConsultationNeurocognitiveTests($id);
		
		// Disassociates the treatments
		$app->businessLogicDatabase->deleteConsultationTreatments($id);
	}
	
}
