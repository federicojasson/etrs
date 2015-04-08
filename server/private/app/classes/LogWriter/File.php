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
 * TODO: comment
 */
class File extends \Slim\LogWriter {
	
	/**
	 * TODO
	 */
	private $TODO;
	
	/**
	 * Initializes an instance of the class.
	 * 
	 * TODO: comment
	 */
	public function __construct($path) {
		// Gets the TODO
		$this->TODO = $this->getTODO();
		
		// TODO
		$file = fopen($path, 'a');
		
		// Invokes the homonym method in the parent TODO: comment okay?
		parent::__construct($file);
	}
	
	/**
	 * Writes a log.
	 * 
	 * Receives the log's message and level.
	 */
	public function write($message, $level) {
		// Gets the current date-time
		$currentDateTime = getCurrentDateTime();
		
		// TODO: comment
		$TODO = $this->TODO[$level];
		
		// Builds the line
		$line = '';
		$line .= dateTimeToString($currentDateTime, 'Y-m-d H:i:s') . ' ';
		$line .= str_pad($TODO, 11) . ' - ';
		$line .= $message;
		
		// Invokes the homonym method in the parent
		parent::write($line, $level);
	}
	
	/**
	 * Returns TODO
	 */
	private function getTODO() { // TODO: rename
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
