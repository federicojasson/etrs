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

namespace App\Service\Session;

/**
 * TODO: comment
 */
class DeleteExpired extends \App\Service\InternalService {
	
	/**
	 * Executes the service.
	 */
	protected function execute() {
		global $app;
		
		// Calculates the age limit
		$ageLimit = $app->server->getCurrentDateTime();
		$ageLimit->modify('-' . SESSION_MAXIMUM_AGE . ' day');
		
		// Calculates the inactivity limit
		$inactivityLimit = $app->server->getCurrentDateTime();
		$inactivityLimit->modify('-' . SESSION_MAXIMUM_INACTIVITY_TIME . ' hour');
		
		// Executes a transaction
		$app->data->transactional(function($entityManager) use ($ageLimit, $inactivityLimit) {
			// Deletes the expired sessions
			$entityManager->createQueryBuilder()
				->delete('App\Data\Entity\Session', 'e')
				->where('e.creationDateTime < :ageLimit')
				->orWhere('e.lastAccessDateTime < :inactivityLimit')
				->setParameter('ageLimit', $ageLimit)
				->setParameter('inactivityLimit', $inactivityLimit)
				->getQuery()
				->getResult();
		});
	}
	
	/**
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		// The service has no input
		return true;
	}
	
}
