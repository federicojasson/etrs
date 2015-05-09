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
 * Represents a configuration.
 */
abstract class Configuration {
	
	/**
	 * Applies the configuration.
	 */
	public function __invoke() {
		global $app;
		
		// Applies common settings
		$this->applyCommonSettings();
		
		// Gets particular settings
		$loggingSettings = $this->getLoggingSettings();
		$miscellaneousSettings = $this->getMiscellaneousSettings();
		
		// Applies the particular settings
		$app->config($loggingSettings);
		$app->config($miscellaneousSettings);
	}
	
	/**
	 * Returns the logging settings.
	 */
	protected abstract function getLoggingSettings();
	
	/**
	 * Returns miscellaneous settings.
	 */
	protected abstract function getMiscellaneousSettings();
	
	/**
	 * Applies settings common to all configurations.
	 */
	private function applyCommonSettings() {
		// Sets the default time zone
		date_default_timezone_set('UTC');
	}
	
}
