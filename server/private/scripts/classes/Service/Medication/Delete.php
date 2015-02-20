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

namespace App\Service\Medication;

/**
 * TODO: comment
 */
class Delete extends \App\Service\Service {
	
	/**
	 * Executes the service.
	 */
	protected function execute() {
		global $app;
		
		// TODO: get input somehow
		$id = '41421421';
		
		// Executes a transaction
		$app->database->transactional(function($entityManager) use ($id) {
			global $app;
			
			// Gets the medication
			$medication = $entityManager->getRepository('App\Database\Entity\Medication')->findNonDeleted($id);
			
			// Asserts conditions of the medication
			$app->assertor->medicationFound($medication);
			
			// Deletes the medication
			$medication->setDeleted(true); // TODO: should be done somewhere else? (what if another entity trigger something else)
			$entityManager->merge($medication);
		});
	}
	
	/**
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		// TODO: implement
		return true;
	}
	
	/**
	 * Determines whether the user is authorized to use the service.
	 */
	protected function isUserAuthorized() {
		// TODO: implement
		return true;
	}
	
}
