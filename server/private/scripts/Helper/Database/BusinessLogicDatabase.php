<?php

namespace App\Helper\Database;

/*
 * This helper represents the business logic database.
 */
class BusinessLogicDatabase extends SpecializedDatabase {
	
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
