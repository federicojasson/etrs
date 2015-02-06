<?php

namespace App\Auxiliar\EntityModel;

/*
 * This class offers an interface to perform operations on consultations.
 */
class ConsultationModel extends EntityModel {
	
	/*
	 * Creates an entity of the type of this model.
	 * 
	 * It receives the entity's data.
	 */
	public function create() {
		$app = $this->app;
		
		// Gets the function's arguments
		list($id, $clinicalImpression, $creator, $diagnosis, $patient, $date, $reasons, $indications, $observations, $backgrounds, $imageTests, $laboratoryTests, $medications, $neurocognitiveTests, $treatments) = func_get_args();
		
		// Starts a read-write transaction
		$app->businessLogicDatabase->startReadWriteTransaction();
		
		// Creates the consultation
		$app->businessLogicDatabase->createConsultation($id, $clinicalImpression, $creator, $diagnosis, $patient, $date, $reasons, $indications, $observations);
		
		// TODO: comment
		$this->associateData($id, $backgrounds, $imageTests, $laboratoryTests, $medications, $neurocognitiveTests, $treatments);
		
		// Commits the transaction
		$app->businessLogicDatabase->commitTransaction();
	}
	
	/*
	 * Deletes an entity of the type of this model.
	 * 
	 * It receives the entity's ID.
	 */
	public function delete($id) {
		$app = $this->app;
		
		// Starts a read-write transaction
		$app->businessLogicDatabase->startReadWriteTransaction();
		
		// Gets the consultation's studies
		$studies = $app->businessLogicDatabase->getConsultationNonDeletedStudies($id);
		
		// Deletes the studies
		foreach ($studies as $study) {
			$app->data->study->delete($study['id']);
		}
		
		// Deletes the consultation
		$app->businessLogicDatabase->deleteConsultation($id);
		
		// Commits the transaction
		$app->businessLogicDatabase->commitTransaction();
	}
	
	/*
	 * Edits an entity of the type of this model.
	 * 
	 * It receives the entity's data.
	 */
	public function edit() {
		$app = $this->app;
		
		// Gets the function's arguments
		list($id, $clinicalImpression, $diagnosis, $lastEditor, $date, $reasons, $indications, $observations, $backgrounds, $imageTests, $laboratoryTests, $medications, $neurocognitiveTests, $treatments) = func_get_args();
		
		// Starts a read-write transaction
		$app->businessLogicDatabase->startReadWriteTransaction();
		
		// Edits the consultation
		$app->businessLogicDatabase->editConsultation($id, $clinicalImpression, $diagnosis, $lastEditor, $date, $reasons, $indications, $observations);
		
		// TODO: delete info currently associated
		$this->deleteAssociatedData($id);
		
		// TODO: comment
		$this->associateData($id, $backgrounds, $imageTests, $laboratoryTests, $medications, $neurocognitiveTests, $treatments);
		
		// Commits the transaction
		$app->businessLogicDatabase->commitTransaction();
	}
	
	/*
	 * Determines whether an entity exists.
	 * 
	 * It receives the entity's ID.
	 */
	public function exists($id) {
		$app = $this->app;
		
		// Determines whether the consultation exists
		return $app->businessLogicDatabase->nonDeletedConsultationExists($id);
	}
	
	/*
	 * Filters an entity for presentation and returns the result.
	 * 
	 * It receives the entity.
	 */
	public function filter($entity) {
		// TODO: implement
		return $entity;
	}
	
	/*
	 * Returns an entity of the type of this model. If it doesn't exist, null is
	 * returned.
	 * 
	 * It receives the entity's ID.
	 */
	public function get($id) {
		$app = $this->app;
		
		// Gets the consultation
		return $app->businessLogicDatabase->getNonDeletedConsultation($id);
	}
	
	/*
	 * TODO: comments
	 */
	private function associateData($id, $backgrounds, $imageTests, $laboratoryTests, $medications, $neurocognitiveTests, $treatments) { // TODO: change name?
		$app = $this->app;
		
		// Associates the backgrounds with the consultation
		foreach ($backgrounds as $background) {
			$app->businessLogicDatabase->createConsultationBackground($id, $background);
		}
		
		// Associates the image tests with the consultation
		foreach ($imageTests as $imageTest) {
			$app->businessLogicDatabase->createConsultationImageTest($id, $imageTest['id'], $imageTest['value']);
		}
		
		// Associates the laboratory tests with the consultation
		foreach ($laboratoryTests as $laboratoryTest) {
			$app->businessLogicDatabase->createConsultationLaboratoryTest($id, $laboratoryTest['id'], $laboratoryTest['value']);
		}
		
		// Associates the medications with the consultation
		foreach ($medications as $medication) {
			$app->businessLogicDatabase->createConsultationMedication($id, $medication);
		}
		
		// Associates the neurocognitive tests with the consultation
		foreach ($neurocognitiveTests as $neurocognitiveTest) {
			$app->businessLogicDatabase->createConsultationNeurocognitiveTest($id, $neurocognitiveTest['id'], $neurocognitiveTest['value']);
		}
		
		// Associates the treatments with the consultation
		foreach ($treatments as $treatment) {
			$app->businessLogicDatabase->createConsultationTreatment($id, $treatment);
		}
	}
	
	/*
	 * TODO: comments
	 */
	private function deleteAssociatedData($id) { //TODO: rename?
		$app = $this->app;
		
		// Deletes the backgrounds associated with the consultation
		$app->businessLogicDatabase->deleteConsultationBackgrounds($id);
		
		// Deletes the image tests associated with the consultation
		$app->businessLogicDatabase->deleteConsultationImageTests($id);
		
		// Deletes the laboratory tests associated with the consultation
		$app->businessLogicDatabase->deleteConsultationLaboratoryTests($id);
		
		// Deletes the medications associated with the consultation
		$app->businessLogicDatabase->deleteConsultationMedications($id);
		
		// Deletes the neurocognitive tests associated with the consultation
		$app->businessLogicDatabase->deleteConsultationNeurocognitiveTests($id);
		
		// Deletes the treatments associated with the consultation
		$app->businessLogicDatabase->deleteConsultationTreatments($id);
	}
	
}
