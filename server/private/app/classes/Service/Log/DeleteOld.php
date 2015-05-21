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

namespace App\Service\Log;

/**
 * Represents the /log/delete-old service.
 */
class DeleteOld extends \App\Service\Internal {
	
	/**
	 * Executes the service.
	 */
	protected function execute() {
		global $app;
		
		// Confirms the task
		$message = '';
		$message .= 'You are about to delete logs older than ' . LOG_MAXIMUM_AGE . ' ';
		$message .= (LOG_MAXIMUM_AGE === 1)? 'month' : 'months';
		$message .= '.';
		confirmTask($message);
		
		// Gets the current date-time
		$currentDateTime = new \DateTime();
		
		// Deletes old logs
		$app->data->createQueryBuilder()
			->delete('Entity:Log', 'l')
			->where('l.creationDateTime < DATEADD(:currentDateTime, (-:maximumAge), \'MONTH\')')
			->setParameter('currentDateTime', $currentDateTime)
			->setParameter('maximumAge', LOG_MAXIMUM_AGE)
			->getQuery()
			->execute();
	}
	
	/**
	 * Determines whether the request is valid.
	 */
	protected function isRequestValid() {
		return true;
	}
	
}
