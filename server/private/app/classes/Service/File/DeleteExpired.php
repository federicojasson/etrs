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

namespace App\Service\File;

/**
 * Represents the /file/delete-expired service.
 */
class DeleteExpired extends \App\Service\Internal {
	
	/**
	 * Executes the service.
	 */
	protected function execute() {
		global $app;
		
		// Acquires a lock
		$lockAcquired = $app->lock->acquire('file-delete-expired');
		
		if (! $lockAcquired) {
			// The lock could not be acquired
			return;
		}
		
		// Gets the current date-time
		$currentDateTime = new \DateTime();
		
		// Gets the expired files
		$queryBuilder = $app->data->createQueryBuilder();
		$files = $queryBuilder
			->select('f.id')
			->from('Entity:File', 'f')
			->where('f.associated = false')
			->andWhere($queryBuilder->expr()->orX(
				'f.deleted = true',
				'f.creationDateTime < DATEADD(:currentDateTime, (-:maximumAge), \'HOUR\')'
			))
			->setParameter('currentDateTime', $currentDateTime)
			->setParameter('maximumAge', FILE_MAXIMUM_AGE)
			->getQuery()
			->getResult();
		
		// Deletes the files
		foreach ($files as $file) {
			// Gets the file
			$file = $app->data->getReference('Entity:File', $file['id']);
			
			// Deletes the file
			$app->data->remove($file);
		}
		
		// Removes the files
		foreach ($files as $file) {
			$app->file->remove($file['id']);
		}
	}
	
	/**
	 * Determines whether the request is valid.
	 */
	protected function isRequestValid() {
		return true;
	}
	
}
