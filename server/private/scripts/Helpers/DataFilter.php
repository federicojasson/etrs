<?php

namespace App\Helpers;

/*
 * This helper is used to filter data before send it to the client.
 */
class DataFilter extends \App\Helpers\Helper {
	
	/*
	 * TODO: comments
	 */
	private $authorizedFields;
	
	/*
	 * TODO: comments
	 */
	public function filterExperiment($experiment) {
		// TODO: comments in method
		$app = $this->app;
		
		// Initializes the filtered experiment
		$filteredExperiment = $experiment;
		$filteredExperiment['files'] = [];
		
		// Filters the experiment's fields
		$filteredExperiment = $this->filterFields($filteredExperiment, $this->authorizedFields['experiments']);
		
		if (isset($filteredExperiment['id'])) {
			$filteredExperiment['id'] = bin2hex($experiment['id']);
		}
		
		if (isset($filteredExperiment['creator'])) {
			if (! $app->webServerDatabase->userExists($experiment['creator'])) {
				$filteredExperiment['creator'] = null;
			}
		}
		
		if (isset($filteredExperiment['lastEditor'])) {
			if (! $app->webServerDatabase->userExists($experiment['lastEditor'])) {
				$filteredExperiment['lastEditor'] = null;
			}
		}
		
		if (isset($filteredExperiment['files'])) {
			$files = $app->businessLogicDatabase->getExperimentNonErasedFiles($experiment['id']);
			
			$count = count($files);
			for ($i = 0; $i < $count; $i++) {
				$filteredExperiment['files'][$i] = bin2hex($files[$i]['id']);
			}
		}
		
		return $filteredExperiment;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterMedication($medication) {
		// TODO: implement filterMedication
		return $medication;
	}
	
	/*
	 * TODO: comments
	 */
	public function filterPatient($patient) {
		// TODO: implement filterPatient
		return $patient;
	}
	
	/*
	 * Performs initialization tasks.
	 */
	protected function initialize() {
		// TODO: user role
		
		// Initializes the authorized fields
		$this->authorizedFields = [
			'experiments' => [
				'id',
				'creator',
				'lastEditor',
				'creationDatetime',
				'lastEditionDatetime',
				'name',
				'commandLine',
				'files'
			]
			// TODO: authorized fields
		];
	}
	
	/*
	 * Filters the fields of an entity, leaving only a subset.
	 * 
	 * It receives the entity and the fields.
	 */
	private function filterFields($entity, $fields) {
		// Initializes the filtered entity
		$filteredEntity = [];
		
		// Filters the entity's fields
		$count = count($fields);
		for ($i = 0; $i < $count; $i++) {
			// TODO: comments
			$field = $fields[$i];
			$filteredEntity[$field] = $entity[$field];
		}
		
		return $filteredEntity;
	}
	
}
