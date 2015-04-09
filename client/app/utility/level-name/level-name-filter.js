/**
 * ETRS - Eye Tracking Record System
 * Copyright (C) 2015 Federico Jasson
 * 
 * The JavaScript code in this page is free software: you can redistribute it
 * and/or modify it under the terms of the GNU General Public License (GNU GPL)
 * as published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version. The code is distributed
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE. See the GNU GPL for more details.
 * 
 * As additional permission under GNU GPL version 3 section 7, you may
 * distribute non-source (e.g., minimized or compacted) forms of that code
 * without the copy of the GNU GPL normally required by section 4, provided you
 * include this license notice and a URL through which recipients can access the
 * Corresponding Source.
 */

'use strict';

(function() {
	angular.module('app.utility.levelName').filter('levelName', levelNameFilter);
	
	/**
	 * Returns the name of a log's level.
	 */
	function levelNameFilter() {
		/**
		 * Applies the filter.
		 * 
		 * Receives the log.
		 */
		function filter(log) {
			// Gets the level names
			var levelNames = getLevelNames();
			
			// Gets the name of the log's level
			return levelNames[log.level];
		}
		
		/**
		 * Returns the level names.
		 */
		function getLevelNames() {
			return {
				1: 'EMERGENCY',
				2: 'ALERT',
				3: 'CRITICAL',
				4: 'ERROR',
				5: 'WARNING',
				6: 'NOTICE',
				7: 'INFORMATION',
				8: 'DEBUG'
			};
		}
		
		// ---------------------------------------------------------------------
		
		return filter;
	}
})();
