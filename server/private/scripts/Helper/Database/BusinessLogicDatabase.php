<?php

namespace App\Helper\Database;

/*
 * This helper represents the business logic database.
 */
class BusinessLogicDatabase extends SpecializedDatabase {
	
	/*
	 * Deletes a background.
	 * 
	 * It receives the background's ID.
	 */
	public function deleteBackground($id) {
		$this->deleteEntity('backgrounds', $id);
	}
	
	/*
	 * Deletes a clinical impression.
	 * 
	 * It receives the clinical impression's ID.
	 */
	public function deleteClinicalImpression($id) {
		$this->deleteEntity('clinical_impressions', $id);
	}
	
	/*
	 * Deletes a diagnosis.
	 * 
	 * It receives the diagnosis' ID.
	 */
	public function deleteDiagnosis($id) {
		$this->deleteEntity('diagnoses', $id);
	}
	
	/*
	 * Deletes an image test.
	 * 
	 * It receives the image test's ID.
	 */
	public function deleteImageTest($id) {
		$this->deleteEntity('image_tests', $id);
	}
	
	/*
	 * Deletes a laboratory test.
	 * 
	 * It receives the laboratory test's ID.
	 */
	public function deleteLaboratoryTest($id) {
		$this->deleteEntity('laboratory_tests', $id);
	}
	
	/*
	 * Deletes a medication.
	 * 
	 * It receives the medication's ID.
	 */
	public function deleteMedication($id) {
		$this->deleteEntity('medications', $id);
	}
	
	/*
	 * Deletes a neurocognitive test.
	 * 
	 * It receives the neurocognitive test's ID.
	 */
	public function deleteNeurocognitiveTest($id) {
		$this->deleteEntity('neurocognitive_tests', $id);
	}
	
	/*
	 * Deletes a treatment.
	 * 
	 * It receives the treatment's ID.
	 */
	public function deleteTreatment($id) {
		$this->deleteEntity('treatments', $id);
	}
	
	/*
	 * Returns a non-deleted background. If it doesn't exist, null is returned.
	 * 
	 * It receives the background's ID.
	 */
	public function getNonDeletedBackground($id) {
		// Defines the columns to select
		$columnsToSelect = [
			'id',
			'is_deleted',
			'creator',
			'last_editor',
			'creation_datetime',
			'last_edition_datetime',
			'name'
		];
		
		// Gets and returns the entity
		return $this->getEntity('non_deleted_backgrounds', $columnsToSelect, $id);
	}
	
	/*
	 * Returns a non-deleted clinical impression. If it doesn't exist, null is
	 * returned.
	 * 
	 * It receives the clinical impression's ID.
	 */
	public function getNonDeletedClinicalImpression($id) {
		// Defines the columns to select
		$columnsToSelect = [
			'id',
			'is_deleted',
			'creator',
			'last_editor',
			'creation_datetime',
			'last_edition_datetime',
			'name'
		];
		
		// Gets and returns the entity
		return $this->getEntity('non_deleted_clinical_impressions', $columnsToSelect, $id);
	}
	
	/*
	 * Returns a non-deleted consultation. If it doesn't exist, null is
	 * returned.
	 * 
	 * It receives the consultation's ID.
	 */
	public function getNonDeletedConsultation($id) {
		// Defines the columns to select
		$columnsToSelect = [
			'id',
			'is_deleted',
			'clinical_impression',
			'creator',
			'diagnosis',
			'last_editor',
			'patient',
			'creation_datetime',
			'last_edition_datetime',
			'date',
			'reasons',
			'indications',
			'observations'
		];
		
		// Gets and returns the entity
		return $this->getEntity('non_deleted_consultations', $columnsToSelect, $id);
	}
	
	/*
	 * Returns a non-deleted diagnosis. If it doesn't exist, null is returned.
	 * 
	 * It receives the diagnosis' ID.
	 */
	public function getNonDeletedDiagnosis($id) {
		// Defines the columns to select
		$columnsToSelect = [
			'id',
			'is_deleted',
			'creator',
			'last_editor',
			'creation_datetime',
			'last_edition_datetime',
			'name'
		];
		
		// Gets and returns the entity
		return $this->getEntity('non_deleted_diagnoses', $columnsToSelect, $id);
	}
	
	/*
	 * Returns a non-deleted experiment. If it doesn't exist, null is returned.
	 * 
	 * It receives the experiment's ID.
	 */
	public function getNonDeletedExperiment($id) {
		// Defines the columns to select
		$columnsToSelect = [
			'id',
			'is_deleted',
			'creator',
			'last_editor',
			'creation_datetime',
			'last_edition_datetime',
			'name',
			'command_line'
		];
		
		// Gets and returns the entity
		return $this->getEntity('non_deleted_experiments', $columnsToSelect, $id);
	}
	
	/*
	 * Returns a non-deleted image test. If it doesn't exist, null is returned.
	 * 
	 * It receives the image test's ID.
	 */
	public function getNonDeletedImageTest($id) {
		// Defines the columns to select
		$columnsToSelect = [
			'id',
			'is_deleted',
			'creator',
			'last_editor',
			'creation_datetime',
			'last_edition_datetime',
			'name',
			'data_type_descriptor'
		];
		
		// Gets and returns the entity
		return $this->getEntity('non_deleted_image_tests', $columnsToSelect, $id);
	}
	
	/*
	 * Returns a non-deleted laboratory test. If it doesn't exist, null is
	 * returned.
	 * 
	 * It receives the laboratory test's ID.
	 */
	public function getNonDeletedLaboratoryTest($id) {
		// Defines the columns to select
		$columnsToSelect = [
			'id',
			'is_deleted',
			'creator',
			'last_editor',
			'creation_datetime',
			'last_edition_datetime',
			'name',
			'data_type_descriptor'
		];
		
		// Gets and returns the entity
		return $this->getEntity('non_deleted_laboratory_tests', $columnsToSelect, $id);
	}
	
	/*
	 * Returns a non-deleted medication. If it doesn't exist, null is returned.
	 * 
	 * It receives the medication's ID.
	 */
	public function getNonDeletedMedication($id) {
		// Defines the columns to select
		$columnsToSelect = [
			'id',
			'is_deleted',
			'creator',
			'last_editor',
			'creation_datetime',
			'last_edition_datetime',
			'name'
		];
		
		// Gets and returns the entity
		return $this->getEntity('non_deleted_medications', $columnsToSelect, $id);
	}
	
	/*
	 * Returns a non-deleted neurocognitive test. If it doesn't exist, null is
	 * returned.
	 * 
	 * It receives the neurocognitive test's ID.
	 */
	public function getNonDeletedNeurocognitiveTest($id) {
		// Defines the columns to select
		$columnsToSelect = [
			'id',
			'is_deleted',
			'creator',
			'last_editor',
			'creation_datetime',
			'last_edition_datetime',
			'name',
			'data_type_descriptor'
		];
		
		// Gets and returns the entity
		return $this->getEntity('non_deleted_neurocognitive_tests', $columnsToSelect, $id);
	}
	
	/*
	 * Returns a non-deleted patient. If it doesn't exist, null is returned.
	 * 
	 * It receives the patient's ID.
	 */
	public function getNonDeletedPatient($id) {
		// Defines the columns to select
		$columnsToSelect = [
			'id',
			'is_deleted',
			'creator',
			'last_editor',
			'creation_datetime',
			'last_edition_datetime',
			'first_name',
			'last_name',
			'gender',
			'birth_date',
			'education_years'
		];
		
		// Gets and returns the entity
		return $this->getEntity('non_deleted_patients', $columnsToSelect, $id);
	}
	
	/*
	 * Returns a non-deleted study. If it doesn't exist, null is returned.
	 * 
	 * It receives the study's ID.
	 */
	public function getNonDeletedStudy($id) {
		// Defines the columns to select
		$columnsToSelect = [
			'id',
			'is_deleted',
			'consultation',
			'creator',
			'experiment',
			'last_editor',
			'report',
			'subject',
			'creation_datetime',
			'last_edition_datetime',
			'observations'
		];
		
		// Gets and returns the entity
		return $this->getEntity('non_deleted_studies', $columnsToSelect, $id);
	}
	
	/*
	 * Returns a non-deleted treatment. If it doesn't exist, null is returned.
	 * 
	 * It receives the treatment's ID.
	 */
	public function getNonDeletedTreatment($id) {
		// Defines the columns to select
		$columnsToSelect = [
			'id',
			'is_deleted',
			'creator',
			'last_editor',
			'creation_datetime',
			'last_edition_datetime',
			'name'
		];
		
		// Gets and returns the entity
		return $this->getEntity('non_deleted_treatments', $columnsToSelect, $id);
	}
	
	/*
	 * Determines whether a non-deleted background exists.
	 * 
	 * It receives the background's ID.
	 */
	public function nonDeletedBackgroundExists($id) {
		return $this->entityExists('non_deleted_backgrounds', $id);
	}
	
	/*
	 * Determines whether a non-deleted clinical impression exists.
	 * 
	 * It receives the clinical impression's ID.
	 */
	public function nonDeletedClinicalImpressionExists($id) {
		return $this->entityExists('non_deleted_clinical_impressions', $id);
	}
	
	/*
	 * Determines whether a non-deleted diagnosis exists.
	 * 
	 * It receives the diagnosis' ID.
	 */
	public function nonDeletedDiagnosisExists($id) {
		return $this->entityExists('non_deleted_diagnoses', $id);
	}
	
	/*
	 * Determines whether a non-deleted image test exists.
	 * 
	 * It receives the image test's ID.
	 */
	public function nonDeletedImageTestExists($id) {
		return $this->entityExists('non_deleted_image_tests', $id);
	}
	
	/*
	 * Determines whether a non-deleted laboratory test exists.
	 * 
	 * It receives the laboratory test's ID.
	 */
	public function nonDeletedLaboratoryTestExists($id) {
		return $this->entityExists('non_deleted_laboratory_tests', $id);
	}
	
	/*
	 * Determines whether a non-deleted medication exists.
	 * 
	 * It receives the medication's ID.
	 */
	public function nonDeletedMedicationExists($id) {
		return $this->entityExists('non_deleted_medications', $id);
	}
	
	/*
	 * Determines whether a non-deleted neurocognitive test exists.
	 * 
	 * It receives the neurocognitive test's ID.
	 */
	public function nonDeletedNeurocognitiveTestExists($id) {
		return $this->entityExists('non_deleted_neurocognitive_tests', $id);
	}
	
	/*
	 * Determines whether a non-deleted treatment exists.
	 * 
	 * It receives the treatment's ID.
	 */
	public function nonDeletedTreatmentExists($id) {
		return $this->entityExists('non_deleted_treatments', $id);
	}
	
	/*
	 * Connects to the database.
	 * 
	 * It returns a PDO instance representing the connection.
	 */
	protected function connect() {
		$app = $this->app;
		
		// Gets the database's parameters
		$parameters = $app->parameters->get(PARAMETERS_DATABASES);
		$dsn = $parameters['businessLogicDatabase']['dsn'];
		$username = $parameters['businessLogicDatabase']['username'];
		$password = $parameters['businessLogicDatabase']['password'];
		
		// Creates and returns the PDO instance
		return new \PDO($dsn, $username, $password);
	}
	
	/*
	 * Deletes an entity.
	 * 
	 * It receives the entity's table and ID.
	 */
	protected function deleteEntity($table, $id) {
		// Defines the statement
		$statement = '
			UPDATE ' . $table . '
			SET is_deleted = TRUE
			WHERE id = :id
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
}
