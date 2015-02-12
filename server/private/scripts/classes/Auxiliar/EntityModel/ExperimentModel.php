<?php

namespace App\Auxiliar\EntityModel;

/*
 * This class offers operations to manage experiments.
 */
class ExperimentModel extends EntityModel {
	
	/*
	 * Creates an experiment.
	 * 
	 * It receives the experiment's data.
	 */
	public function create($id, $creator, $name, $commandLine, $files) {
		$app = $this->app;
		
		// Starts a read-write transaction
		$app->businessLogicDatabase->startReadWriteTransaction();
		
		// Creates the experiment
		$app->businessLogicDatabase->createExperiment($id, $creator, $name, $commandLine);
		
		// Associates the data with the experiment
		$this->associateData($id, $files);
		
		// Commits the transaction
		$app->businessLogicDatabase->commitTransaction();
	}
	
	/*
	 * Deletes an experiment.
	 * 
	 * It receives the experiment's ID.
	 */
	public function delete($id) {
		$app = $this->app;
		
		// Starts a read-write transaction
		$app->businessLogicDatabase->startReadWriteTransaction();
		
		// Deletes the experiment's files
		$files = $app->businessLogicDatabase->getExperimentNonDeletedFiles($id);
		foreach ($files as $file) {
			$app->data->file->delete($file['id']);
		}
		
		// Deletes the experiment's studies
		$studies = $app->businessLogicDatabase->getExperimentNonDeletedStudies($id);
		foreach ($studies as $study) {
			$app->data->study->delete($study['id']);
		}
		
		// Deletes the experiment
		$app->businessLogicDatabase->deleteExperiment($id);
		
		// Commits the transaction
		$app->businessLogicDatabase->commitTransaction();
	}
	
	/*
	 * Edits an experiment.
	 * 
	 * It receives the experiment's data.
	 */
	public function edit($id, $lastEditor, $name, $commandLine, $files) {
		$app = $this->app;
		
		// Starts a read-write transaction
		$app->businessLogicDatabase->startReadWriteTransaction();
		
		// Edits the experiment
		$app->businessLogicDatabase->editExperiment($id, $lastEditor, $name, $commandLine);
		
		// Disassociates all data from the experiment
		$this->disassociateData($id);
		
		// Associates the data with the experiment
		$this->associateData($id, $files);
		
		// Commits the transaction
		$app->businessLogicDatabase->commitTransaction();
	}
	
	/*
	 * Determines whether an experiment exists.
	 * 
	 * It receives the experiment's ID.
	 */
	public function exists($id) {
		$app = $this->app;
		
		// Determines whether the experiment exists
		return $app->businessLogicDatabase->nonDeletedExperimentExists($id);
	}
	
	/*
	 * Filters an experiment for presentation and returns the result.
	 * 
	 * It receives the experiment.
	 */
	public function filter($experiment) {
		$app = $this->app;
		
		// Adds fields for the associated data
		$experiment['files'] = [];
		
		// Gets the accessible fields
		$accessibleFields = $app->accessValidator->getAccessibleFields(ENTITY_MODEL_EXPERIMENT);
		
		// Filters the experiment's fields
		$newExperiment = filterArray($experiment, $accessibleFields);
		
		// Starts a read-only transaction
		$app->businessLogicDatabase->startReadOnlyTransaction();
		
		// Attaches associated data and applies conversions
		
		if (isset($newExperiment['id'])) {
			$newExperiment['id'] = bin2hex($experiment['id']);
		}
		
		if (isset($newExperiment['files'])) {
			$files = $app->businessLogicDatabase->getExperimentNonDeletedFiles($experiment['id']);
			
			foreach ($files as $file) {
				$newExperiment['files'][] = bin2hex($file['id']);
			}
		}
		
		// Commits the transaction
		$app->businessLogicDatabase->commitTransaction();
		
		return $newExperiment;
	}
	
	/*
	 * Returns an experiment. If it doesn't exist, null is returned.
	 * 
	 * It receives the experiment's ID.
	 */
	public function get($id) {
		$app = $this->app;
		
		// Gets the experiment
		return $app->businessLogicDatabase->getNonDeletedExperiment($id);
	}
	
	/*
	 * Searches experiments. It returns an array containing the total number of
	 * results and the results found in the page, ready for presentation.
	 * 
	 * It receives an expression, the page and a sorting.
	 */
	public function search($expression, $page, $sorting) {
		$app = $this->app;
		
		if (is_null($expression)) {
			// Searches all experiments
			$experiments = $app->businessLogicDatabase->searchAllNonDeletedExperiments($page, $sorting);
		} else {
			// Searches specific experiments
			$experiments = $app->businessLogicDatabase->searchSpecificNonDeletedExperiments($expression, $page, $sorting);
		}
		
		// Gets the number of rows found
		$foundRows = $app->businessLogicDatabase->getFoundRows();
		
		// Converts the IDs to hexadecimal
		$experiments = arrayIdsToHexadecimal($experiments);
		
		// Gets the IDs
		$ids = array_column($experiments, 'id');
		
		return [ $foundRows, $ids ];
	}
	
	/*
	 * Associates data with an experiment.
	 * 
	 * It receives the experiment's ID and the data to associate.
	 */
	private function associateData($id, $files) {
		$app = $this->app;
		
		// Associates the files
		foreach ($files as $file) {
			$app->businessLogicDatabase->createExperimentFile($id, $file);
		}
	}
	
	/*
	 * Disassociates all data from an experiment.
	 * 
	 * It receives the experiment's ID.
	 */
	private function disassociateData($id) {
		$app = $this->app;
		
		// Disassociates the files
		$app->businessLogicDatabase->deleteExperimentFiles($id);
	}
	
}
