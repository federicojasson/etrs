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
 * Represents the /session/delete-expired service.
 */
class DeleteExpired extends \App\Service\Internal {
	
	/**
	 * Executes the service.
	 */
	protected function execute() {
		global $app;
		
		// Calculates the age limit
		$ageLimit = getCurrentDateTime();
		$ageLimit->modify('-' . SESSION_MAXIMUM_AGE . ' day');
		
		// Calculates the inactivity limit
		$inactivityLimit = getCurrentDateTime();
		$inactivityLimit->modify('-' . SESSION_MAXIMUM_INACTIVITY_TIME . ' hour');
		
		// Executes a transaction
		$app->data->transactional(function($entityManager) use ($ageLimit, $inactivityLimit) {
			// Deletes the expired sessions
			$entityManager->createQueryBuilder()
				->delete('App\Data\Entity\Session', 's')
				->where('s.creationDateTime < :ageLimit')
				->orWhere('s.lastAccessDateTime < :inactivityLimit')
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
		return true;
	}
	
}