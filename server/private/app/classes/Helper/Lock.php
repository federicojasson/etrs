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

namespace App\Helper;

/**
 * Provides lock-related functionalities.
 */
class Lock {
	
	/**
	 * Acquires a lock.
	 * 
	 * Receives the lock's name.
	 */
	public function acquire($name) {
		global $app;
		
		// Opens the lock file
		$path = buildPath(DIRECTORY_LOCKS, $name . '.lock');
		$file = fopen($path, 'c');
		
		// Acquires the lock
		$lockAcquired = flock($file, LOCK_EX | LOCK_NB);
		
		if ($lockAcquired) {
			// The lock has been acquired
			// Registers a hook
			$app->hook('slim.after', function() use ($file) {
				// Releases the lock
				flock($file, LOCK_UN);
			}, HOOK_PRIORITY_LOCK);
		}
		
		return $lockAcquired;
	}
	
}
