<?php

namespace App\Auxiliar\EntityModel;

/*
 * This class offers operations to manage studies.
 */
class StudyModel extends EntityModel {
	
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
	
}
