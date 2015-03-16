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

namespace App\Utility\LogWriter;

/**
 * Manages the persistence of the logs in the database.
 */
class Database {
	
	/**
	 * Writes a log.
	 * 
	 * Receives the log's message and level.
	 */
	public function write($message, $level) {
		global $app;
		
		// Executes a transaction
		$app->data->transactional(function($entityManager) use ($level, $message) {
			// Initializes the log
			$log = new \App\Data\Entity\Log();
			
			// Creates the log
			$log->setLevel($level);
			$log->setMessage($message);
			$entityManager->persist($log);
		});
	}
	
}
