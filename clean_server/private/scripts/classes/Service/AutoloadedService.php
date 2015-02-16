<?php

/*
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

namespace App\Service;

/*
 * This class represents a service whose URI is automatically derived from the
 * fully qualified name of the class.
 */
abstract class AutoloadedService extends Service {
	
	/*
	 * Returns the URI of the service.
	 */
	public function getUri() {
		// Gets the fully qualified name of the class
		$class = get_class($this);
		
		// Defines the namespace of the services and gets its length
		$namespace = 'App\\Service\\';
		$length = strlen($namespace);
		
		// Gets the prefix and the suffix of the class
		$prefix = substr($class, 0, $length);
		$suffix = substr($class, $length);
		
		if ($prefix !== $namespace) {
			// The class is not a service
			return '';
		}
		
		// Replaces suffix's backslashes by slashes
		$suffixWithSlashes = str_replace('\\', '/', $suffix);
		
		// Gets the fragments of the suffix
		$fragments = explode('/', $suffixWithSlashes);
		
		// Converts the fragments to spinal-case
		foreach ($fragments as &$fragment) {
			$fragment = toSpinalCase($fragment);
		}
		
		// Builds and returns the URI
		return '/' . implode('/', $fragments);
	}
	
}
