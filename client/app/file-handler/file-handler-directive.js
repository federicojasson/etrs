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
	angular.module('app.fileHandler').directive('fileHandler', [
		'utility',
		fileHandlerDirective
	]);
	
	/**
	 * Includes a file handler.
	 */
	function fileHandlerDirective(utility) {
		/**
		 * Returns the settings.
		 */
		function getSettings() {
			return {
				restrict: 'E',
				scope: {
					file: '=file',
					onRemove: '=onRemove'
				},
				link: onPostLink,
				templateUrl: 'app/file-handler/file-handler.html'
			};
		}
		
		/**
		 * Invoked after the linking phase.
		 * 
		 * Receives the scope of the directive.
		 */
		function onPostLink(scope) {
			// Gets the file
			var file = scope.file;
			
			// Gets the file's extension
			var extension = utility.getFileExtension(file.name);
			
			if (extension !== '') {
				// Builds the file-icon class
				scope.fileIconClass = 'file-icon-' + extension;
			}
		}
		
		// ---------------------------------------------------------------------
		
		// Gets the settings
		return getSettings();
	}
})();
