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

namespace App\Helper;

/**
 * Provides assertion methods.
 */
class Assertion {
	
	/**
	 * Asserts whether a directory has been created.
	 * 
	 * Receives an indicator of whether the directory has been created.
	 */
	public function directoryCreated($created) {
		if (! $created) {
			// The directory could not be created
			// Halts the application
			haltApp(HTTP_STATUS_INTERNAL_SERVER_ERROR, ERROR_CODE_FILE_SYSTEM_ERROR);
		}
	}
	
	/**
	 * Asserts whether an email has been delivered.
	 * 
	 * Receives an indicator of whether the email has been delivered.
	 */
	public function emailDelivered($delivered) {
		if (! $delivered) {
			// The email could not be delivered
			// Halts the application
			haltApp(HTTP_STATUS_INTERNAL_SERVER_ERROR, ERROR_CODE_UNDELIVERED_EMAIL);
		}
	}
	
	/**
	 * Asserts whether an entity exists.
	 * 
	 * Receives the entity.
	 */
	public function entityExists($entity) {
		if (is_null($entity)) {
			// The entity doesn't exist
			// Halts the application
			haltApp(HTTP_STATUS_NOT_FOUND, ERROR_CODE_NON_EXISTENT_ENTITY);
		}
	}
	
	/**
	 * Asserts whether an entity is updated.
	 * 
	 * Receives the entity and the alleged version.
	 */
	public function entityUpdated($entity, $version) {
		global $app;
		
		try {
			// Acquires a lock on the entity
			$app->data->lock($entity, \Doctrine\DBAL\LockMode::OPTIMISTIC, $version);
		} catch (\Doctrine\ORM\OptimisticLockException $exception) {
			// The entity is outdated
			// Halts the application
			haltApp(HTTP_STATUS_CONFLICT, ERROR_CODE_OUTDATED_ENTITY);
		}
	}
	
	/**
	 * Asserts whether a file's access permissions have been set.
	 * 
	 * Receives an indicator of whether the access permissions have been set.
	 */
	public function fileAccessPermissionsSet($set) {
		if (! $set) {
			// The access permissions could not be set
			// Halts the application
			haltApp(HTTP_STATUS_INTERNAL_SERVER_ERROR, ERROR_CODE_FILE_SYSTEM_ERROR);
		}
	}
	
	/**
	 * Asserts whether a file has been copied.
	 * 
	 * Receives an indicator of whether the file has been copied.
	 */
	public function fileCopied($copied) {
		if (! $copied) {
			// The file could not be copied
			// Halts the application
			haltApp(HTTP_STATUS_INTERNAL_SERVER_ERROR, ERROR_CODE_FILE_SYSTEM_ERROR);
		}
	}
	
	/**
	 * Asserts whether a file doesn't exist.
	 * 
	 * Receives an indicator of whether the file exists.
	 */
	public function fileDoesNotExist($exists) {
		if ($exists) {
			// The file exists
			// Halts the application
			haltApp(HTTP_STATUS_INTERNAL_SERVER_ERROR, ERROR_CODE_FILE_SYSTEM_ERROR);
		}
	}
	
	/**
	 * Asserts whether a file exists.
	 * 
	 * Receives an indicator of whether the file exists.
	 */
	public function fileExists($exists) {
		if (! $exists) {
			// The file doesn't exist
			// Halts the application
			haltApp(HTTP_STATUS_INTERNAL_SERVER_ERROR, ERROR_CODE_FILE_SYSTEM_ERROR);
		}
	}
	
	/**
	 * Asserts whether a file has been moved.
	 * 
	 * Receives an indicator of whether the file has been moved.
	 */
	public function fileMoved($moved) {
		if (! $moved) {
			// The file could not be moved
			// Halts the application
			haltApp(HTTP_STATUS_INTERNAL_SERVER_ERROR, ERROR_CODE_FILE_SYSTEM_ERROR);
		}
	}
	
	/**
	 * Asserts whether a file is not corrupted.
	 * 
	 * Receives an indicator of whether the file is corrupted.
	 */
	public function fileNotCorrupted($corrupted) {
		if ($corrupted) {
			// The file is corrupted
			// Halts the application
			haltApp(HTTP_STATUS_INTERNAL_SERVER_ERROR, ERROR_CODE_FILE_SYSTEM_ERROR);
		}
	}
	
	/**
	 * Asserts whether a file has been uploaded.
	 * 
	 * Receives an indicator of whether the file has been uploaded.
	 */
	public function fileUploaded($uploaded) {
		if (! $uploaded) {
			// The file has not been uploaded
			// Halts the application
			haltApp(HTTP_STATUS_INTERNAL_SERVER_ERROR, ERROR_CODE_FILE_SYSTEM_ERROR);
		}
	}
	
}
