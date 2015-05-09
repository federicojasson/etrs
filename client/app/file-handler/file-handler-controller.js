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
	angular.module('app.fileHandler').controller('FileHandlerController', [
		'$controller',
		'$scope',
		'EditFileAction',
		'server',
		'utility',
		FileHandlerController
	]);
	
	/**
	 * Implements the logic of a file-handler.
	 */
	function FileHandlerController($controller, $scope, EditFileAction, server, utility) {
		var _this = this;
		
		/**
		 * Indicates whether the file is being edited.
		 */
		_this.editing = false;
		
		/**
		 * Indicates whether the file handler is ready.
		 */
		_this.ready = true;
		
		/**
		 * Disables the edition.
		 */
		_this.disableEdition = function() {
			_this.editing = false;
		};
		
		/**
		 * Enables the edition.
		 */
		_this.enableEdition = function() {
			// Initializes actions
			initializeEditFileAction($scope.file);
			
			_this.editing = true;
		};
		
		/**
		 * Performs initialization tasks.
		 */
		function initialize() {
			// Includes controllers
			$scope.account = $controller('AccountController');
			
			// Sets the file's icon
			setFileIcon();
		}
		
		/**
		 * Initializes the edit-file action.
		 * 
		 * Receives the file.
		 */
		function initializeEditFileAction(file) {
			// Initializes the action
			var action = new EditFileAction();
			
			// Sets inputs' initial values
			action.input.id.value = file.id;
			action.input.version.value = file.version;
			action.input.name.value = file.name;
			
			// Registers callbacks
			
			action.startCallback = function() {
				_this.ready = false;
			};
			
			action.successCallback = function() {
				// Gets the file
				server.file.get({
					id: $scope.file.id
				}).then(function(output) {
					// Refreshes the file
					$scope.file = output;
					
					// Sets the file's icon
					setFileIcon();
					
					_this.editing = false;
					_this.ready = true;
				});
			};
			
			// Includes the action
			$scope.editFileAction = action;
		}
		
		/**
		 * Sets the file's icon.
		 */
		function setFileIcon() {
			// Gets the file's extension
			var extension = utility.getFileExtension($scope.file.name);
			
			if (extension !== '') {
				// Builds the file-icon class
				$scope.fileIconClass = 'file-icon-' + extension;
			}
		}
		
		// ---------------------------------------------------------------------
		
		// Initializes the controller
		initialize();
	}
})();
