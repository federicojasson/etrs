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

namespace App\Service\Medicine;

/**
 * Represents the /medicine/search service.
 */
class Search extends \App\Service\External {
	
	/**
	 * Executes the service.
	 */
	protected function execute() {
		global $app;
		
		// Gets the inputs
		//TODO
		
		// TODO: comment
		$results = $app->data->createQueryBuilder()
			->select('m.id')
			->from('Entity:Medicine', 'm')
			->getQuery()
			->setFirstResult(1) // TODO
			->setMaxResults(1) // TODO
			->setHint(\Doctrine\ORM\Query::HINT_CUSTOM_OUTPUT_WALKER, 'App\Data\OutputWalker\Custom')
			->setHint('SQL_CALC_FOUND_ROWS', true) // TODO: hint name
			->getResult();
		
		// Sets an output
		$this->setOutputValue('results', $results, createArrayFilter(function($result) {
			return bin2hex($result['id']);
		}));
		
		// TODO: comment
		$statement = $app->data->getConnection()->prepare('SELECT FOUND_ROWS() AS foundRows');
		$statement->execute();
		$total = $statement->fetch()['foundRows'];
		
		// Sets an output
		$this->setOutputValue('total', $total);
	}
	
	/**
	 * Determines whether the request is valid.
	 */
	protected function isRequestValid() {
		global $app;
		
		if (! $this->isJsonRequest()) {
			// It is not a JSON request
			return false;
		}
		
		// Builds a JSON input validator
		$jsonInputValidator = new \App\InputValidator\Json\JsonObject([
			// TODO
		]);
		
		// Gets the input
		$input = $this->getInput();
		
		// Validates the input
		return $app->inputValidator->isJsonInputValid($input, $jsonInputValidator);
	}
	
	/**
	 * Determines whether the user is authorized.
	 */
	protected function isUserAuthorized() {
		global $app;
		
		// Validates the access
		return $app->accessValidator->isUserAuthorized([
			USER_ROLE_ADMINISTRATOR,
			USER_ROLE_DOCTOR
		]);
	}

}
