<?php

/**
 * ETRS - Eye Tracking Record System
 * Copyright (C) 2015 Federico Jasson
 * 
 * This program is free software: you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation, either version 3 of the License, or (at your option) any later
 * version.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU General Public License along with
 * this program. If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Service\Data;

/**
 * Represents the /data/reset-entities-versions service.
 */
class ResetEntitiesVersions extends \App\Service\Internal {
	
	/**
	 * Executes the service.
	 */
	protected function execute() {
		global $app;
		
		// Confirms the task
		confirmTask('You are about to reset the versions of all entities.');
		
		// Builds an array containing the versioned types
		$types = [
			'ClinicalImpression',
			'CognitiveTest',
			'Consultation',
			'Diagnosis',
			'Experiment',
			'File',
			'ImagingTest',
			'LaboratoryTest',
			'MedicalAntecedent',
			'Medicine',
			'Patient',
			'Study',
			'Treatment',
			'User'
			// DEFINEHERE: reset versions of all entities here
		];
		
		// Executes a transaction
		$app->data->transactional(function($entityManager) use ($types) {
			// Resets the entities' versions
			foreach ($types as $type) {
				$entityManager->createQueryBuilder()
					->update('Entity:' . $type, 'e')
					->set('e.version', 0)
					->getQuery()
					->execute();
			}
		});
	}
	
	/**
	 * Determines whether the request is valid.
	 */
	protected function isRequestValid() {
		return true;
	}
	
}
