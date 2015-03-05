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
 * Allows to write logs in the database.
 */
class DatabaseLogWriter {
	
	/**
	 * The level mapping.
	 * 
	 * Maps the log levels used in the application to those used in the
	 * database.
	 */
	private $levelMapping;
	
	/**
	 * Initializes an instance of the class.
	 */
	public function __construct() {
		// Defines the level mapping
		$this->levelMapping = [
			\Slim\Log::DEBUG => LOG_LEVEL_5,
			\Slim\Log::INFO => LOG_LEVEL_4,
			\Slim\Log::NOTICE => LOG_LEVEL_4,
			\Slim\Log::WARN => LOG_LEVEL_3,
			\Slim\Log::ERROR => LOG_LEVEL_2,
			\Slim\Log::CRITICAL => LOG_LEVEL_2,
			\Slim\Log::ALERT => LOG_LEVEL_1,
			\Slim\Log::EMERGENCY => LOG_LEVEL_1
		];
	}
	
	/**
	 * Writes a log.
	 * 
	 * Receives the log's message and level.
	 */
	public function write($message, $level) {
		global $app;
		
		// Maps the level to the corresponding value used in the database
		$level = $this->levelMapping[$level];
		
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
