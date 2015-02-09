<?php

namespace App\Auxiliar\EntityModel;

/*
 * This class offers operations to manage studies.
 */
class StudyModel extends EntityModel {
	
	/*
	 * Creates a study.
	 * 
	 * It receives the study's data.
	 */
	public function create($id, $consultation, $creator, $experiment, $input, $report, $observations, $files) {
		$app = $this->app;
		
		// Starts a read-write transaction
		$app->businessLogicDatabase->startReadWriteTransaction();
		
		// Creates the study
		$app->businessLogicDatabase->createStudy($id, $consultation, $creator, $experiment, $input, $report, $observations);
		
		// Associates the data with the study
		$this->associateData($id, $files);
		
		// Commits the transaction
		$app->businessLogicDatabase->commitTransaction();
	}
	
	/*
	 * Deletes a study.
	 * 
	 * It receives the study's ID.
	 */
	public function delete($id) {
		$app = $this->app;
		
		// Starts a read-write transaction
		$app->businessLogicDatabase->startReadWriteTransaction();
		
		// Gets the study
		$study = $app->businessLogicDatabase->getNonDeletedStudy($id);
		
		// Deletes the study's input
		$app->data->file->delete($study['input']);
		
		if (! is_null($study['report'])) {
			// Deletes the study's report
			$app->data->file->delete($study['report']);
		}
		
		// Deletes the study's files
		$files = $app->businessLogicDatabase->getStudyNonDeletedFiles($id);
		foreach ($files as $file) {
			$app->data->file->delete($file['id']);
		}
		
		// Deletes the study
		$app->businessLogicDatabase->deleteStudy($id);
		
		// Commits the transaction
		$app->businessLogicDatabase->commitTransaction();
	}
	
	/*
	 * Edits a study.
	 * 
	 * It receives the study's data.
	 */
	public function edit($id, $lastEditor, $report, $observations, $files) {
		$app = $this->app;
		
		// Starts a read-write transaction
		$app->businessLogicDatabase->startReadWriteTransaction();
		
		// Edits the study
		$app->businessLogicDatabase->editStudy($id, $lastEditor, $report, $observations);
		
		// Disassociates all data from the study
		$this->disassociateData($id);
		
		// Associates the data with the study
		$this->associateData($id, $files);
		
		// Commits the transaction
		$app->businessLogicDatabase->commitTransaction();
	}
	
	/*
	 * Determines whether a study exists.
	 * 
	 * It receives the study's ID.
	 */
	public function exists($id) {
		$app = $this->app;
		
		// Determines whether the study exists
		return $app->businessLogicDatabase->nonDeletedStudyExists($id);
	}
	
	/*
	 * Filters a study for presentation and returns the result.
	 * 
	 * It receives the study.
	 */
	public function filter($study) {
		$app = $this->app;
		
		// Adds fields for the associated data
		$study['files'] = [];
		
		// Gets the accessible fields
		$accessibleFields = $app->accessValidator->getAccessibleFields(ENTITY_MODEL_STUDY);
		
		// Filters the study's fields
		$newStudy = filterArray($study, $accessibleFields);
		
		// Attaches associated data and applies conversions
		
		if (isset($newStudy['id'])) {
			$newStudy['id'] = bin2hex($study['id']);
		}
		
		if (isset($newStudy['consultation'])) {
			if ($app->businessLogicDatabase->nonDeletedConsultationExists($study['consultation'])) {
				$newStudy['consultation'] = bin2hex($study['consultation']);
			} else {
				$newStudy['consultation'] = null;
			}
		}
		
		if (isset($newStudy['experiment'])) {
			if ($app->businessLogicDatabase->nonDeletedExperimentExists($study['experiment'])) {
				$newStudy['experiment'] = bin2hex($study['experiment']);
			} else {
				$newStudy['experiment'] = null;
			}
		}
		
		if (isset($newStudy['input'])) {
			if ($app->businessLogicDatabase->nonDeletedFileExists($study['input'])) {
				$newStudy['input'] = bin2hex($study['input']);
			} else {
				$newStudy['input'] = null;
			}
		}
		
		if (isset($newStudy['report'])) {
			if ($app->businessLogicDatabase->nonDeletedFileExists($study['report'])) {
				$newStudy['report'] = bin2hex($study['report']);
			} else {
				$newStudy['report'] = null;
			}
		}
		
		if (isset($newStudy['files'])) {
			$files = $app->businessLogicDatabase->getStudyNonDeletedFiles($study['id']);
			
			foreach ($files as $file) {
				$newStudy['files'][] = bin2hex($file['id']);
			}
		}
		
		return $newStudy;
	}
	
	/*
	 * Returns a study. If it doesn't exist, null is returned.
	 * 
	 * It receives the study's ID.
	 */
	public function get($id) {
		$app = $this->app;
		
		// Gets the study
		return $app->businessLogicDatabase->getNonDeletedStudy($id);
	}
	
	/*
	 * Associates data with a study.
	 * 
	 * It receives the study's ID and the data to associate.
	 */
	private function associateData($id, $files) {
		$app = $this->app;
		
		// Associates the files
		foreach ($files as $file) {
			$app->businessLogicDatabase->createStudyFile($id, $file);
		}
	}
	
	/*
	 * Disassociates all data from a study.
	 * 
	 * It receives the study's ID.
	 */
	private function disassociateData($id) {
		$app = $this->app;
		
		// Disassociates the files
		$app->businessLogicDatabase->deleteStudyFiles($id);
	}
	
}
