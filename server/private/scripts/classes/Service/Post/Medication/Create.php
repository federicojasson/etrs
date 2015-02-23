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

namespace App\Service\Post\Medication;

/**
 * TODO: comment
 */
class Create extends \App\Service\ExternalService {
	
	/**
	 * Executes the service.
	 */
	protected function execute() {
		global $app;
		
		// TODO: get input somehow
		$name = 'NOMBRE';
		
		// Executes a transaction
		$id = $app->data->transactional(function($entityManager) use ($name) {
			global $app;
			
			// Gets the signed in user
			$signedInUser = $app->authentication->getSignedInUser();
			
			// Initializes the medication
			$medication = new \App\Data\Entity\Medication();
			
			// Creates the medication
			$medication->setName($name);
			$medication->setCreator($signedInUser);
			$entityManager->persist($medication);
			
			// Returns the medication's ID
			return $medication->getId();
		});
		
		// Sets an output
		$this->setOutput('id', $id, 'bin2hex');
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
