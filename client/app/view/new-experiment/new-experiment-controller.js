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
	angular.module('app.view.newExperiment').controller('NewExperimentViewController', [
		'$scope',
		'CreateExperimentAction',
		'dialog',
		'fileUploader',
		'router',
		NewExperimentViewController
	]);
	
	/**
	 * Represents the new-experiment view.
	 */
	function NewExperimentViewController($scope, CreateExperimentAction, dialog, fileUploader, router) {
		var _this = this;
		
		/**
		 * Indicates whether the view is ready.
		 */
		var ready = true;
		
		/**
		 * Returns the template's URL.
		 */
		_this.getTemplateUrl = function() {
			return 'app/view/new-experiment/new-experiment.html';
		};
		
		/**
		 * Returns the title to be set when the view is ready.
		 */
		_this.getTitle = function() {
			return 'Nuevo experimento';
		};
		
		/**
		 * Determines whether the view is ready.
		 */
		_this.isReady = function() {
			return ready;
		};
		
		/**
		 * Performs initialization tasks.
		 */
		function initialize() {
			// Includes auxiliary variables
			$scope.showCommandLineExplanation = false;
			
			// Includes auxiliary functions
			$scope.toggleCommandLineExplanation = toggleCommandLineExplanation;
			
			// Initializes actions
			initializeCreateExperimentAction();
		}
		
		/**
		 * Initializes the create-experiment action.
		 */
		function initializeCreateExperimentAction() {
			// Initializes the action
			var action = new CreateExperimentAction();
			
			// Sets inputs' initial values
			action.input.files.value = [];
			
			// Registers callbacks
			
			action.startCallback = function() {
				// Saves the uploader in case the user is not authenticated
				fileUploader.saveUploader();
				
				ready = false;
			};
			
			action.notAuthenticatedCallback = function() {
				// Resets inputs' values
				action.input.credentials.password.value = '';
				
				// Opens an error dialog
				dialog.openError(
					'Credenciales rechazadas',
					'No fue posible autenticar su identidad.\n' +
					'Reingrese su contraseña.'
				);
				
				ready = true;
			};
			
			action.successCallback = function(id) {
				// Clears the saved uploader
				fileUploader.clearSavedUploader();
				
				// Redirects the user to the experiment state
				router.redirect('experiment', {
					id: id
				});
			};
			
			// Includes the action
			$scope.createExperimentAction = action;
		}
		
		/**
		 * Toggles the command-line explanation.
		 */
		function toggleCommandLineExplanation() {
			$scope.showCommandLineExplanation = ! $scope.showCommandLineExplanation;
		}
		
		// ---------------------------------------------------------------------
		
		// Initializes the controller
		initialize();
	}
})();
