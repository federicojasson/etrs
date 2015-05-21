<?php

/**
 * NEU-CO - Neuro-Cognitivo
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

namespace App\Service\MedicalAntecedent;

/**
 * Represents the /medical-antecedent/get-all service.
 */
class GetAll extends \App\Service\External {
	
	/**
	 * Executes the service.
	 */
	protected function execute() {
		global $app;
		
		// Gets all medical antecedents
		$medicalAntecedents = $app->data->createQueryBuilder()
			->select('ma.id')
			->from('Entity:MedicalAntecedent', 'ma')
			->where('ma.deleted = false')
			->addOrderBy('ma.name', 'ASC')
			->getQuery()
			->getResult();
		
		// Sets an output
		$this->setOutputValue('ids', $medicalAntecedents, createArrayFilter(function($medicalAntecedent) {
			return bin2hex($medicalAntecedent['id']);
		}));
	}
	
	/**
	 * Determines whether the request is valid.
	 */
	protected function isRequestValid() {
		return true;
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
