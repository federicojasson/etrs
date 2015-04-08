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

namespace App\Service\User;

/**
 * Represents the /user/delete service.
 */
class Delete extends \App\Service\Internal {
	
	/**
	 * Executes the service.
	 */
	protected function execute() {
		global $app;
		
		// Gets the inputs
		$id = $this->getInputValue(0);
		
		// Gets the user
		$user = $app->data->getRepository('Entity:User')->find($id);

		// Asserts conditions
		$app->assertion->entityExists($user);
		
		// TODO: check if there is at least one administrator after the operation?
		
		// Confirms the action
		confirmAction('You are about to delete the user "' . $id . '".');
		
		// Deletes any password-reset permission associated with the user
		$app->data->createQueryBuilder()
			->delete('Entity:PasswordResetPermission', 'prp')
			->where('prp.user = :user')
			->setParameter('user', $user)
			->getQuery()
			->setMaxResults(1)
			->setHint(\Doctrine\ORM\Query::HINT_CUSTOM_OUTPUT_WALKER, 'App\Data\OutputWalker\Custom')
			->execute();
		
		// Deletes the user
		$app->data->remove($user);
	}
	
	/**
	 * Determines whether the request is valid.
	 */
	protected function isRequestValid() {
		global $app;
		
		// Gets the input
		$input = $this->getInput();
		
		// Builds a command-line input validator
		$commandLineInputValidator = new \App\InputValidator\CommandLine([
			function($input) use ($app) {
				return $app->inputValidator->isUserId($input);
			}
		]);
		
		// Validates the input
		return $app->inputValidator->isCommandLineInputValid($input, $commandLineInputValidator);
	}
	
}
