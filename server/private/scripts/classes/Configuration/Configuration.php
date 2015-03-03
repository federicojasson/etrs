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
 * 
 * Subclasses must implement the getCookieSettings, getLogSettings and
 * getMiscellaneousSettings methods.
 */
abstract class Configuration {
	
	/**
	 * Invokes the configuration.
	 */
	public function __invoke() {
		global $app;
		
		// Gets the settings
		$cookieSettings = $this->getCookieSettings();
		$logSettings = $this->getLogSettings();
		$miscellaneousSettings = $this->getMiscellaneousSettings();
		
		// Applies the settings
		$app->config($cookieSettings);
		$app->config($logSettings);
		$app->config($miscellaneousSettings);
	}
	
	/**
	 * Returns the cookie settings.
	 */
	protected abstract function getCookieSettings();
	
	/**
	 * Returns the log settings.
	 */
	protected abstract function getLogSettings();
	
	/**
	 * Returns miscellaneous settings.
	 */
	protected abstract function getMiscellaneousSettings();
	
}
