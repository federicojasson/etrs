<?php

namespace App\Helper\Database;

/*
 * This helper represents the business logic database.
 */
class BusinessLogicDatabase extends SpecializedDatabase {
	
	/*
	 * Creates a background.
	 * 
	 * It receives the background's data.
	 */
	public function createBackground($id, $creator, $name) {
		// Defines the statement
		$statement = '
			INSERT INTO backgrounds (
				id,
				deleted,
				creator,
				last_editor,
				creation_datetime,
				last_edition_datetime,
				name
			)
			VALUES (
				:id,
				FALSE,
				:creator,
				NULL,
				UTC_TIMESTAMP(),
				UTC_TIMESTAMP(),
				:name
			)
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':creator' => $creator,
			':name' => $name
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Creates a clinical impression.
	 * 
	 * It receives the clinical impression's data.
	 */
	public function createClinicalImpression($id, $creator, $name) {
		// Defines the statement
		$statement = '
			INSERT INTO clinical_impressions (
				id,
				deleted,
				creator,
				last_editor,
				creation_datetime,
				last_edition_datetime,
				name
			)
			VALUES (
				:id,
				FALSE,
				:creator,
				NULL,
				UTC_TIMESTAMP(),
				UTC_TIMESTAMP(),
				:name
			)
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':creator' => $creator,
			':name' => $name
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Creates a consultation.
	 * 
	 * It receives the consultation's data.
	 */
	public function createConsultation($id, $clinicalImpression, $creator, $diagnosis, $patient, $date, $reasons, $indications, $observations) {
		// Defines the statement
		$statement = '
			INSERT INTO consultations (
				id,
				deleted,
				clinical_impression,
				creator,
				diagnosis,
				last_editor,
				patient,
				creation_datetime,
				last_edition_datetime,
				date,
				reasons,
				indications,
				observations
			)
			VALUES (
				:id,
				FALSE,
				:clinicalImpression,
				:creator,
				:diagnosis,
				NULL,
				:patient,
				UTC_TIMESTAMP(),
				UTC_TIMESTAMP(),
				:date,
				:reasons,
				:indications,
				:observations
			)
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':clinicalImpression' => $clinicalImpression,
			':creator' => $creator,
			':diagnosis' => $diagnosis,
			':patient' => $patient,
			':date' => $date,
			':reasons' => $reasons,
			':indications' => $indications,
			':observations' => $observations
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Creates a background of a consultation.
	 * 
	 * It receives the consultation's ID and the background's ID.
	 */
	public function createConsultationBackground($consultation, $background) {
		// Defines the statement
		$statement = '
			INSERT INTO consultations_backgrounds (
				consultation,
				background
			)
			VALUES (
				:consultation,
				:background
			)
		';
		
		// Sets the parameters
		$parameters = [
			':consultation' => $consultation,
			':background' => $background
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Creates an image test of a consultation.
	 * 
	 * It receives the consultation's ID, the image test's ID and the value.
	 */
	public function createConsultationImageTest($consultation, $imageTest, $value) {
		// Defines the statement
		$statement = '
			INSERT INTO consultations_image_tests (
				consultation,
				image_test,
				value
			)
			VALUES (
				:consultation,
				:imageTest,
				:value
			)
		';
		
		// Sets the parameters
		$parameters = [
			':consultation' => $consultation,
			':imageTest' => $imageTest,
			':value' => $value
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Creates a laboratory test of a consultation.
	 * 
	 * It receives the consultation's ID, the laboratory test's ID and the
	 * value.
	 */
	public function createConsultationLaboratoryTest($consultation, $laboratoryTest, $value) {
		// Defines the statement
		$statement = '
			INSERT INTO consultations_laboratory_tests (
				consultation,
				laboratory_test,
				value
			)
			VALUES (
				:consultation,
				:laboratoryTest,
				:value
			)
		';
		
		// Sets the parameters
		$parameters = [
			':consultation' => $consultation,
			':laboratoryTest' => $laboratoryTest,
			':value' => $value
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Creates a medication of a consultation.
	 * 
	 * It receives the consultation's ID and the medication's ID.
	 */
	public function createConsultationMedication($consultation, $medication) {
		// Defines the statement
		$statement = '
			INSERT INTO consultations_medications (
				consultation,
				medication
			)
			VALUES (
				:consultation,
				:medication
			)
		';
		
		// Sets the parameters
		$parameters = [
			':consultation' => $consultation,
			':medication' => $medication
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Creates a neurocognitive test of a consultation.
	 * 
	 * It receives the consultation's ID, the neurocognitive test's ID and the
	 * value.
	 */
	public function createConsultationNeurocognitiveTest($consultation, $neurocognitiveTest, $value) {
		// Defines the statement
		$statement = '
			INSERT INTO consultations_neurocognitive_tests (
				consultation,
				neurocognitive_test,
				value
			)
			VALUES (
				:consultation,
				:neurocognitiveTest,
				:value
			)
		';
		
		// Sets the parameters
		$parameters = [
			':consultation' => $consultation,
			':neurocognitiveTest' => $neurocognitiveTest,
			':value' => $value
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Creates a treatment of a consultation.
	 * 
	 * It receives the consultation's ID and the treatment's ID.
	 */
	public function createConsultationTreatment($consultation, $treatment) {
		// Defines the statement
		$statement = '
			INSERT INTO consultations_treatments (
				consultation,
				treatment
			)
			VALUES (
				:consultation,
				:treatment
			)
		';
		
		// Sets the parameters
		$parameters = [
			':consultation' => $consultation,
			':treatment' => $treatment
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Creates a diagnosis.
	 * 
	 * It receives the diagnosis' data.
	 */
	public function createDiagnosis($id, $creator, $name) {
		// Defines the statement
		$statement = '
			INSERT INTO diagnoses (
				id,
				deleted,
				creator,
				last_editor,
				creation_datetime,
				last_edition_datetime,
				name
			)
			VALUES (
				:id,
				FALSE,
				:creator,
				NULL,
				UTC_TIMESTAMP(),
				UTC_TIMESTAMP(),
				:name
			)
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':creator' => $creator,
			':name' => $name
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Creates an image test.
	 * 
	 * It receives the image test's data.
	 */
	public function createImageTest($id, $creator, $name, $dataTypeDescriptor) {
		// Defines the statement
		$statement = '
			INSERT INTO image_tests (
				id,
				deleted,
				creator,
				last_editor,
				creation_datetime,
				last_edition_datetime,
				name,
				data_type_descriptor
			)
			VALUES (
				:id,
				FALSE,
				:creator,
				NULL,
				UTC_TIMESTAMP(),
				UTC_TIMESTAMP(),
				:name,
				:dataTypeDescriptor
			)
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':creator' => $creator,
			':name' => $name,
			':dataTypeDescriptor' => $dataTypeDescriptor
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Creates a laboratory test.
	 * 
	 * It receives the laboratory test's data.
	 */
	public function createLaboratoryTest($id, $creator, $name, $dataTypeDescriptor) {
		// Defines the statement
		$statement = '
			INSERT INTO laboratory_tests (
				id,
				deleted,
				creator,
				last_editor,
				creation_datetime,
				last_edition_datetime,
				name,
				data_type_descriptor
			)
			VALUES (
				:id,
				FALSE,
				:creator,
				NULL,
				UTC_TIMESTAMP(),
				UTC_TIMESTAMP(),
				:name,
				:dataTypeDescriptor
			)
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':creator' => $creator,
			':name' => $name,
			':dataTypeDescriptor' => $dataTypeDescriptor
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Creates a medication.
	 * 
	 * It receives the medication's data.
	 */
	public function createMedication($id, $creator, $name) {
		// Defines the statement
		$statement = '
			INSERT INTO medications (
				id,
				deleted,
				creator,
				last_editor,
				creation_datetime,
				last_edition_datetime,
				name
			)
			VALUES (
				:id,
				FALSE,
				:creator,
				NULL,
				UTC_TIMESTAMP(),
				UTC_TIMESTAMP(),
				:name
			)
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':creator' => $creator,
			':name' => $name
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Creates a neurocognitive test.
	 * 
	 * It receives the neurocognitive test's data.
	 */
	public function createNeurocognitiveTest($id, $creator, $name, $dataTypeDescriptor) {
		// Defines the statement
		$statement = '
			INSERT INTO neurocognitive_tests (
				id,
				deleted,
				creator,
				last_editor,
				creation_datetime,
				last_edition_datetime,
				name,
				data_type_descriptor
			)
			VALUES (
				:id,
				FALSE,
				:creator,
				NULL,
				UTC_TIMESTAMP(),
				UTC_TIMESTAMP(),
				:name,
				:dataTypeDescriptor
			)
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':creator' => $creator,
			':name' => $name,
			':dataTypeDescriptor' => $dataTypeDescriptor
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Creates a patient.
	 * 
	 * It receives the patient's data.
	 */
	public function createPatient($id, $creator, $firstName, $lastName, $gender, $birthDate, $educationYears) {
		// Defines the statement
		$statement = '
			INSERT INTO patients (
				id,
				deleted,
				creator,
				last_editor,
				creation_datetime,
				last_edition_datetime,
				first_name,
				last_name,
				gender,
				birth_date,
				education_years
			)
			VALUES (
				:id,
				FALSE,
				:creator,
				NULL,
				UTC_TIMESTAMP(),
				UTC_TIMESTAMP(),
				:firstName,
				:lastName,
				:gender,
				:birthDate,
				:educationYears
			)
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':creator' => $creator,
			':firstName' => $firstName,
			':lastName' => $lastName,
			':gender' => $gender,
			':birthDate' => $birthDate,
			':educationYears' => $educationYears
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Creates a treatment.
	 * 
	 * It receives the treatment's data.
	 */
	public function createTreatment($id, $creator, $name) {
		// Defines the statement
		$statement = '
			INSERT INTO treatments (
				id,
				deleted,
				creator,
				last_editor,
				creation_datetime,
				last_edition_datetime,
				name
			)
			VALUES (
				:id,
				FALSE,
				:creator,
				NULL,
				UTC_TIMESTAMP(),
				UTC_TIMESTAMP(),
				:name
			)
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':creator' => $creator,
			':name' => $name
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
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
	 * Deletes a consultation.
	 * 
	 * It receives the consultation's ID.
	 */
	public function deleteConsultation($id) {
		$this->deleteEntity('consultations', $id);
	}
	
	/*
	 * Deletes the backgrounds of a consultation.
	 * 
	 * It receives the consultation's ID.
	 */
	public function deleteConsultationBackgrounds($consultation) {
		// Defines the statement
		$statement = '
			DELETE
			FROM consultations_backgrounds
			WHERE consultation = :consultation
		';
		
		// Sets the parameters
		$parameters = [
			':consultation' => $consultation
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Deletes the image tests of a consultation.
	 * 
	 * It receives the consultation's ID.
	 */
	public function deleteConsultationImageTests($consultation) {
		// Defines the statement
		$statement = '
			DELETE
			FROM consultations_image_tests
			WHERE consultation = :consultation
		';
		
		// Sets the parameters
		$parameters = [
			':consultation' => $consultation
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Deletes the laboratory tests of a consultation.
	 * 
	 * It receives the consultation's ID.
	 */
	public function deleteConsultationLaboratoryTests($consultation) {
		// Defines the statement
		$statement = '
			DELETE
			FROM consultations_laboratory_tests
			WHERE consultation = :consultation
		';
		
		// Sets the parameters
		$parameters = [
			':consultation' => $consultation
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Deletes the medications of a consultation.
	 * 
	 * It receives the consultation's ID.
	 */
	public function deleteConsultationMedications($consultation) {
		// Defines the statement
		$statement = '
			DELETE
			FROM consultations_medications
			WHERE consultation = :consultation
		';
		
		// Sets the parameters
		$parameters = [
			':consultation' => $consultation
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Deletes the neurocognitive tests of a consultation.
	 * 
	 * It receives the consultation's ID.
	 */
	public function deleteConsultationNeurocognitiveTests($consultation) {
		// Defines the statement
		$statement = '
			DELETE
			FROM consultations_neurocognitive_tests
			WHERE consultation = :consultation
		';
		
		// Sets the parameters
		$parameters = [
			':consultation' => $consultation
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Deletes the treatments of a consultation.
	 * 
	 * It receives the consultation's ID.
	 */
	public function deleteConsultationTreatments($consultation) {
		// Defines the statement
		$statement = '
			DELETE
			FROM consultations_treatments
			WHERE consultation = :consultation
		';
		
		// Sets the parameters
		$parameters = [
			':consultation' => $consultation
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
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
	 * Deletes a file.
	 * 
	 * It receives the file's ID.
	 */
	public function deleteFile($id) {
		$this->deleteEntity('files', $id);
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
	 * Deletes a patient.
	 * 
	 * It receives the patient's ID.
	 */
	public function deletePatient($id) {
		$this->deleteEntity('patients', $id);
	}
	
	/*
	 * Deletes a study.
	 * 
	 * It receives the study's ID.
	 */
	public function deleteStudy($id) {
		$this->deleteEntity('studies', $id);
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
	 * Edits a background.
	 * 
	 * It receives the background's data.
	 */
	public function editBackground($id, $lastEditor, $name) {
		// Defines the statement
		$statement = '
			UPDATE backgrounds
			SET
				last_editor = :lastEditor,
				last_edition_datetime = UTC_TIMESTAMP(),
				name = :name
			WHERE id = :id
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':lastEditor' => $lastEditor,
			':name' => $name
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Edits a clinical impression.
	 * 
	 * It receives the clinical impression's data.
	 */
	public function editClinicalImpression($id, $lastEditor, $name) {
		// Defines the statement
		$statement = '
			UPDATE clinical_impressions
			SET
				last_editor = :lastEditor,
				last_edition_datetime = UTC_TIMESTAMP(),
				name = :name
			WHERE id = :id
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':lastEditor' => $lastEditor,
			':name' => $name
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Edits a consultation.
	 * 
	 * It receives the consultation's data.
	 */
	public function editConsultation($id, $clinicalImpression, $diagnosis, $lastEditor, $date, $reasons, $indications, $observations) {
		// Defines the statement
		$statement = '
			UPDATE consultations
			SET
				clinical_impression = :clinicalImpression,
				diagnosis = :diagnosis,
				last_editor = :lastEditor,
				last_edition_datetime = UTC_TIMESTAMP(),
				date = :date,
				reasons = :reasons,
				indications = :indications,
				observations = :observations
			WHERE id = :id
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':clinicalImpression' => $clinicalImpression,
			':diagnosis' => $diagnosis,
			':lastEditor' => $lastEditor,
			':date' => $date,
			':reasons' => $reasons,
			':indications' => $indications,
			':observations' => $observations
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Edits a diagnosis.
	 * 
	 * It receives the diagnosis' data.
	 */
	public function editDiagnosis($id, $lastEditor, $name) {
		// Defines the statement
		$statement = '
			UPDATE diagnoses
			SET
				last_editor = :lastEditor,
				last_edition_datetime = UTC_TIMESTAMP(),
				name = :name
			WHERE id = :id
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':lastEditor' => $lastEditor,
			':name' => $name
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Edits an image test.
	 * 
	 * It receives the image test's data.
	 */
	public function editImageTest($id, $lastEditor, $name, $dataTypeDescriptor) {
		// Defines the statement
		$statement = '
			UPDATE image_tests
			SET
				last_editor = :lastEditor,
				last_edition_datetime = UTC_TIMESTAMP(),
				name = :name,
				data_type_descriptor = :dataTypeDescriptor
			WHERE id = :id
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':lastEditor' => $lastEditor,
			':name' => $name,
			':dataTypeDescriptor' => $dataTypeDescriptor
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Edits a laboratory test.
	 * 
	 * It receives the laboratory test's data.
	 */
	public function editLaboratoryTest($id, $lastEditor, $name, $dataTypeDescriptor) {
		// Defines the statement
		$statement = '
			UPDATE laboratory_tests
			SET
				last_editor = :lastEditor,
				last_edition_datetime = UTC_TIMESTAMP(),
				name = :name,
				data_type_descriptor = :dataTypeDescriptor
			WHERE id = :id
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':lastEditor' => $lastEditor,
			':name' => $name,
			':dataTypeDescriptor' => $dataTypeDescriptor
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Edits a medication.
	 * 
	 * It receives the medication's data.
	 */
	public function editMedication($id, $lastEditor, $name) {
		// Defines the statement
		$statement = '
			UPDATE medications
			SET
				last_editor = :lastEditor,
				last_edition_datetime = UTC_TIMESTAMP(),
				name = :name
			WHERE id = :id
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':lastEditor' => $lastEditor,
			':name' => $name
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Edits a neurocognitive test.
	 * 
	 * It receives the neurocognitive test's data.
	 */
	public function editNeurocognitiveTest($id, $lastEditor, $name, $dataTypeDescriptor) {
		// Defines the statement
		$statement = '
			UPDATE neurocognitive_tests
			SET
				last_editor = :lastEditor,
				last_edition_datetime = UTC_TIMESTAMP(),
				name = :name,
				data_type_descriptor = :dataTypeDescriptor
			WHERE id = :id
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':lastEditor' => $lastEditor,
			':name' => $name,
			':dataTypeDescriptor' => $dataTypeDescriptor
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Edits a patient.
	 * 
	 * It receives the patient's data.
	 */
	public function editPatient($id, $lastEditor, $firstName, $lastName, $gender, $birthDate, $educationYears) {
		// Defines the statement
		$statement = '
			UPDATE patients
			SET
				last_editor = :lastEditor,
				last_edition_datetime = UTC_TIMESTAMP(),
				first_name = :firstName,
				last_name = :lastName,
				gender = :gender,
				birth_date = :birthDate,
				education_years = :educationYears
			WHERE id = :id
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':lastEditor' => $lastEditor,
			':firstName' => $firstName,
			':lastName' => $lastName,
			':gender' => $gender,
			':birthDate' => $birthDate,
			':educationYears' => $educationYears
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Edits a treatment.
	 * 
	 * It receives the treatment's data.
	 */
	public function editTreatment($id, $lastEditor, $name) {
		// Defines the statement
		$statement = '
			UPDATE treatments
			SET
				last_editor = :lastEditor,
				last_edition_datetime = UTC_TIMESTAMP(),
				name = :name
			WHERE id = :id
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':lastEditor' => $lastEditor,
			':name' => $name
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Returns the non-deleted studies of a consultation.
	 * 
	 * It receives the consultation's ID.
	 */
	public function getConsultationNonDeletedStudies($consultation) {
		// Defines the statement
		$statement = '
			SELECT id
			FROM non_deleted_studies
			WHERE consultation = :consultation
		';
		
		// Sets the parameters
		$parameters = [
			':consultation' => $consultation
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		return $results;
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
			'deleted',
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
			'deleted',
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
			'deleted',
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
			'deleted',
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
	 * Returns a non-deleted file. If it doesn't exist, null is returned.
	 * 
	 * It receives the file's ID.
	 */
	public function getNonDeletedFile($id) {
		// Defines the columns to select
		$columnsToSelect = [
			'id',
			'deleted',
			'creator',
			'last_editor',
			'creation_datetime',
			'last_edition_datetime',
			'name',
			'hash'
		];
		
		// Gets and returns the entity
		return $this->getEntity('non_deleted_files', $columnsToSelect, $id);
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
			'deleted',
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
			'deleted',
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
			'deleted',
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
			'deleted',
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
			'deleted',
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
			'deleted',
			'consultation',
			'creator',
			'experiment',
			'input',
			'last_editor',
			'report',
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
			'deleted',
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
	 * Returns the non-deleted consultations of a patient.
	 * 
	 * It receives the patient's ID.
	 */
	public function getPatientNonDeletedConsultations($patient) {
		// Defines the statement
		$statement = '
			SELECT id
			FROM non_deleted_consultations
			WHERE patient = :patient
		';
		
		// Sets the parameters
		$parameters = [
			':patient' => $patient
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		return $results;
	}
	
	/*
	 * Returns the non-deleted files of a study.
	 * 
	 * It receives the study's ID.
	 */
	public function getStudyNonDeletedFiles($study) {
		// Defines the statement
		$statement = '
			SELECT file AS id
			FROM studies_non_deleted_files
			WHERE study = :study
		';
		
		// Sets the parameters
		$parameters = [
			':study' => $study
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		return $results;
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
	 * Determines whether a non-deleted consultation exists.
	 * 
	 * It receives the consultation's ID.
	 */
	public function nonDeletedConsultationExists($id) {
		return $this->entityExists('non_deleted_consultations', $id);
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
	 * Determines whether a non-deleted patient exists.
	 * 
	 * It receives the patient's ID.
	 */
	public function nonDeletedPatientExists($id) {
		return $this->entityExists('non_deleted_patients', $id);
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
	 * Searches all non-deleted backgrounds and returns the results.
	 * 
	 * It receives the page and a sorting.
	 */
	public function searchAllNonDeletedBackgrounds($page, $sorting) {
		// Defines the columns to select
		$columnsToSelect = [
			'id'
		];
		
		// Searches all entities and returns the results
		return $this->searchAllEntities('non_deleted_backgrounds', $columnsToSelect, $page, $sorting);
	}
	
	/*
	 * Searches all non-deleted clinical impressions and returns the results.
	 * 
	 * It receives the page and a sorting.
	 */
	public function searchAllNonDeletedClinicalImpressions($page, $sorting) {
		// Defines the columns to select
		$columnsToSelect = [
			'id'
		];
		
		// Searches all entities and returns the results
		return $this->searchAllEntities('non_deleted_clinical_impressions', $columnsToSelect, $page, $sorting);
	}
	
	/*
	 * Searches all non-deleted diagnoses and returns the results.
	 * 
	 * It receives the page and a sorting.
	 */
	public function searchAllNonDeletedDiagnoses($page, $sorting) {
		// Defines the columns to select
		$columnsToSelect = [
			'id'
		];
		
		// Searches all entities and returns the results
		return $this->searchAllEntities('non_deleted_diagnoses', $columnsToSelect, $page, $sorting);
	}
	
	/*
	 * Searches all non-deleted image tests and returns the results.
	 * 
	 * It receives the page and a sorting.
	 */
	public function searchAllNonDeletedImageTests($page, $sorting) {
		// Defines the columns to select
		$columnsToSelect = [
			'id'
		];
		
		// Searches all entities and returns the results
		return $this->searchAllEntities('non_deleted_image_tests', $columnsToSelect, $page, $sorting);
	}
	
	/*
	 * Searches all non-deleted laboratory tests and returns the results.
	 * 
	 * It receives the page and a sorting.
	 */
	public function searchAllNonDeletedLaboratoryTests($page, $sorting) {
		// Defines the columns to select
		$columnsToSelect = [
			'id'
		];
		
		// Searches all entities and returns the results
		return $this->searchAllEntities('non_deleted_laboratory_tests', $columnsToSelect, $page, $sorting);
	}
	
	/*
	 * Searches all non-deleted medications and returns the results.
	 * 
	 * It receives the page and a sorting.
	 */
	public function searchAllNonDeletedMedications($page, $sorting) {
		// Defines the columns to select
		$columnsToSelect = [
			'id'
		];
		
		// Searches all entities and returns the results
		return $this->searchAllEntities('non_deleted_medications', $columnsToSelect, $page, $sorting);
	}
	
	/*
	 * Searches all non-deleted neurocognitive tests and returns the results.
	 * 
	 * It receives the page and a sorting.
	 */
	public function searchAllNonDeletedNeurocognitiveTests($page, $sorting) {
		// Defines the columns to select
		$columnsToSelect = [
			'id'
		];
		
		// Searches all entities and returns the results
		return $this->searchAllEntities('non_deleted_neurocognitive_tests', $columnsToSelect, $page, $sorting);
	}
	
	/*
	 * Searches all non-deleted patients and returns the results.
	 * 
	 * It receives the page and a sorting.
	 */
	public function searchAllNonDeletedPatients($page, $sorting) {
		// Defines the columns to select
		$columnsToSelect = [
			'id'
		];
		
		// Searches all entities and returns the results
		return $this->searchAllEntities('non_deleted_patients', $columnsToSelect, $page, $sorting);
	}
	
	/*
	 * Searches all non-deleted treatments and returns the results.
	 * 
	 * It receives the page and a sorting.
	 */
	public function searchAllNonDeletedTreatments($page, $sorting) {
		// Defines the columns to select
		$columnsToSelect = [
			'id'
		];
		
		// Searches all entities and returns the results
		return $this->searchAllEntities('non_deleted_treatments', $columnsToSelect, $page, $sorting);
	}
	
	/*
	 * Searches specific non-deleted backgrounds and returns the results.
	 * 
	 * It receives an expression, the page and a sorting.
	 */
	public function searchSpecificNonDeletedBackgrounds($expression, $page, $sorting) {
		// Defines the columns to select
		$columnsToSelect = [
			'id'
		];
		
		// Defines the columns to match
		$columnsToMatch = [
			'name'
		];
		
		// Searches specific entities and returns the results
		return $this->searchSpecificEntities('non_deleted_backgrounds', $columnsToSelect, $columnsToMatch, $expression, $page, $sorting);
	}
	
	/*
	 * Searches specific non-deleted clinical impressions and returns the
	 * results.
	 * 
	 * It receives an expression, the page and a sorting.
	 */
	public function searchSpecificNonDeletedClinicalImpressions($expression, $page, $sorting) {
		// Defines the columns to select
		$columnsToSelect = [
			'id'
		];
		
		// Defines the columns to match
		$columnsToMatch = [
			'name'
		];
		
		// Searches specific entities and returns the results
		return $this->searchSpecificEntities('non_deleted_clinical_impressions', $columnsToSelect, $columnsToMatch, $expression, $page, $sorting);
	}
	
	/*
	 * Searches specific non-deleted diagnoses and returns the results.
	 * 
	 * It receives an expression, the page and a sorting.
	 */
	public function searchSpecificNonDeletedDiagnoses($expression, $page, $sorting) {
		// Defines the columns to select
		$columnsToSelect = [
			'id'
		];
		
		// Defines the columns to match
		$columnsToMatch = [
			'name'
		];
		
		// Searches specific entities and returns the results
		return $this->searchSpecificEntities('non_deleted_diagnoses', $columnsToSelect, $columnsToMatch, $expression, $page, $sorting);
	}
	
	/*
	 * Searches specific non-deleted image tests and returns the results.
	 * 
	 * It receives an expression, the page and a sorting.
	 */
	public function searchSpecificNonDeletedImageTests($expression, $page, $sorting) {
		// Defines the columns to select
		$columnsToSelect = [
			'id'
		];
		
		// Defines the columns to match
		$columnsToMatch = [
			'name'
		];
		
		// Searches specific entities and returns the results
		return $this->searchSpecificEntities('non_deleted_image_tests', $columnsToSelect, $columnsToMatch, $expression, $page, $sorting);
	}
	
	/*
	 * Searches specific non-deleted laboratory tests and returns the results.
	 * 
	 * It receives an expression, the page and a sorting.
	 */
	public function searchSpecificNonDeletedLaboratoryTests($expression, $page, $sorting) {
		// Defines the columns to select
		$columnsToSelect = [
			'id'
		];
		
		// Defines the columns to match
		$columnsToMatch = [
			'name'
		];
		
		// Searches specific entities and returns the results
		return $this->searchSpecificEntities('non_deleted_laboratory_tests', $columnsToSelect, $columnsToMatch, $expression, $page, $sorting);
	}
	
	/*
	 * Searches specific non-deleted medications and returns the results.
	 * 
	 * It receives an expression, the page and a sorting.
	 */
	public function searchSpecificNonDeletedMedications($expression, $page, $sorting) {
		// Defines the columns to select
		$columnsToSelect = [
			'id'
		];
		
		// Defines the columns to match
		$columnsToMatch = [
			'name'
		];
		
		// Searches specific entities and returns the results
		return $this->searchSpecificEntities('non_deleted_medications', $columnsToSelect, $columnsToMatch, $expression, $page, $sorting);
	}
	
	/*
	 * Searches specific non-deleted neurocognitive tests and returns the
	 * results.
	 * 
	 * It receives an expression, the page and a sorting.
	 */
	public function searchSpecificNonDeletedNeurocognitiveTests($expression, $page, $sorting) {
		// Defines the columns to select
		$columnsToSelect = [
			'id'
		];
		
		// Defines the columns to match
		$columnsToMatch = [
			'name'
		];
		
		// Searches specific entities and returns the results
		return $this->searchSpecificEntities('non_deleted_neurocognitive_tests', $columnsToSelect, $columnsToMatch, $expression, $page, $sorting);
	}
	
	/*
	 * Searches specific non-deleted patients and returns the results.
	 * 
	 * It receives an expression, the page and a sorting.
	 */
	public function searchSpecificNonDeletedPatients($expression, $page, $sorting) {
		// Defines the columns to select
		$columnsToSelect = [
			'id'
		];
		
		// Defines the columns to match
		$columnsToMatch = [
			'name'
		];
		
		// Searches specific entities and returns the results
		return $this->searchSpecificEntities('non_deleted_patients', $columnsToSelect, $columnsToMatch, $expression, $page, $sorting);
	}
	
	/*
	 * Searches specific non-deleted treatments and returns the results.
	 * 
	 * It receives an expression, the page and a sorting.
	 */
	public function searchSpecificNonDeletedTreatments($expression, $page, $sorting) {
		// Defines the columns to select
		$columnsToSelect = [
			'id'
		];
		
		// Defines the columns to match
		$columnsToMatch = [
			'name'
		];
		
		// Searches specific entities and returns the results
		return $this->searchSpecificEntities('non_deleted_treatments', $columnsToSelect, $columnsToMatch, $expression, $page, $sorting);
	}
	
	/*
	 * Connects to the database and returns a PDO instance representing the
	 * connection.
	 */
	protected function connect() {
		$app = $this->app;
		
		// Gets the database's parameters
		$parameters = $app->parameters->databases['businessLogicDatabase'];
		$dsn = $parameters['dsn'];
		$username = $parameters['username'];
		$password = $parameters['password'];
		
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
			SET deleted = TRUE
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
