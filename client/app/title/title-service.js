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
	angular.module('app.title').service('title', titleService);
	
	/**
	 * Manages the title.
	 */
	function titleService() {
		var _this = this;
		
		/**
		 * The current title.
		 */
		var title = '';
		
		/**
		 * Returns the current title.
		 */
		_this.get = function() {
			return title;
		};
		
		/**
		 * Sets the title.
		 * 
		 * The function appends the acronym of the application, so this must not
		 * be included.
		 * 
		 * Receives the title to be set.
		 */
		_this.set = function(newTitle) {
			if (newTitle.length > 0) {
				// The title is not empty
				// Appends a dash
				newTitle += ' - ';
			}
			
			// Appends the acronym of the application
			newTitle += 'ETRS';
			
			// Sets the title
			title = newTitle;
		};
	}
})();
