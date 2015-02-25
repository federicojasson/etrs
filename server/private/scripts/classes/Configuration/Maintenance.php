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

namespace App\Configuration;

/**
 * This class represents the maintenance-mode configuration.
 */
class Maintenance extends Configuration {
	
	/**
	 * TODO: comment
	 */
	protected function getCookieSettings() {
		// TODO: check and test cookies settings
		return [
			'cookies.cipher' => MCRYPT_RIJNDAEL_256,
			'cookies.cipher_mode' => MCRYPT_MODE_CBC,
			'cookies.domain' => null,
			'cookies.encrypt' => true,
			'cookies.httponly' => true,
			'cookies.lifetime' => '20 minutes',
			'cookies.path' => '/',
			'cookies.secret_key' => 'CHANGE_ME',
			'cookies.secure' => true
		];
	}
	
	/**
	 * TODO: comment
	 */
	protected function getLogSettings() {
		// Initializes the log writer
		$logWriter = new \App\Utility\LogWriter\DatabaseLogWriter();
		
		return [
			'log.enabled' => true,
			'log.level' => \Slim\Log::INFO,
			'log.writer' => $logWriter
		];
	}
	
	/**
	 * TODO: comment
	 */
	protected function getMiscellaneousSettings() {
		return [
			'debug' => false,
			'http.version' => '1.1',
			'routes.case_sensitive' => true
		];
	}
	
}
