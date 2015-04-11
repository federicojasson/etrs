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

namespace App\LogWriter;

/**
 * Responsible for handling the persistence of the logs in a file.
 */
class File extends \Slim\LogWriter {
	
	/**
	 * The level names.
	 */
	private $levelNames;
	
	/**
	 * Initializes an instance of the class.
	 * 
	 * Receives the log file's path.
	 */
	public function __construct($path) {
		// Gets the level names
		$this->levelNames = $this->getLevelNames();
		
		// Opens the log file
		$file = fopen($path, 'a');
		
		// Invokes the homonym method in the parent
		parent::__construct($file);
	}
	
	/**
	 * Writes a log.
	 * 
	 * Receives the log's message and level.
	 */
	public function write($message, $level) {
		// Gets the current date-time
		$currentDateTime = new \DateTime();
		
		// Gets the level name
		$levelName = $this->levelNames[$level];
		
		// Builds the line
		$line = '';
		$line .= $currentDateTime->format('Y-m-d H:i:s') . ' ';
		$line .= str_pad($levelName, 11) . ' - ';
		$line .= $message;
		
		// Invokes the homonym method in the parent
		parent::write($line, $level);
	}
	
	/**
	 * Returns the level names.
	 */
	private function getLevelNames() {
		return [
			\Slim\Log::EMERGENCY => 'EMERGENCY',
			\Slim\Log::ALERT => 'ALERT',
			\Slim\Log::CRITICAL => 'CRITICAL',
			\Slim\Log::ERROR => 'ERROR',
			\Slim\Log::WARN => 'WARNING',
			\Slim\Log::NOTICE => 'NOTICE',
			\Slim\Log::INFO => 'INFORMATION',
			\Slim\Log::DEBUG => 'DEBUG'
		];
	}
	
}
