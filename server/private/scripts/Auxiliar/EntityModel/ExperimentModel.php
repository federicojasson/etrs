<?php

namespace App\Auxiliar\EntityModel;

/*
 * This class offers operations to manage experiments.
 */
class ExperimentModel extends EntityModel {
	
	/*
	 * Deletes an experiment.
	 * 
	 * It receives the experiment's ID.
	 */
	public function delete($id) {
		// TODO: implement
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
		// TODO: implement
		return $experiment;
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
		$experiments = objectIdsToHexadecimal($experiments);
		
		// Gets the IDs
		$ids = array_column($experiments, 'id');
		
		return [ $foundRows, $ids ];
	}
	
}
