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
	angular.module('app.view.newImagingTest').controller('NewImagingTestViewController', [
		'$scope',
		'CreateImagingTestAction',
		'router',
		NewImagingTestViewController
	]);
	
	/**
	 * Represents the new-imaging-test view.
	 */
	function NewImagingTestViewController($scope, CreateImagingTestAction, router) {
		var _this = this;
		
		/**
		 * Indicates whether the view is ready.
		 */
		var ready = true;
		
		/**
		 * Returns the template's URL.
		 */
		_this.getTemplateUrl = function() {
			return 'app/view/new-imaging-test/new-imaging-test.html';
		};
		
		/**
		 * Returns the title to be set when the view is ready.
		 */
		_this.getTitle = function() {
			return 'Nuevo examen de imágenes';
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
			$scope.showDataTypeDefinitionAlert = false;
			
			// Includes auxiliary functions
			$scope.toggleDataTypeDefinitionAlert = toggleDataTypeDefinitionAlert;
			
			// Initializes actions
			initializeCreateImagingTestAction();
		}
		
		/**
		 * Initializes the create-imaging-test action.
		 */
		function initializeCreateImagingTestAction() {
			// Initializes the action
			var action = new CreateImagingTestAction();
			
			// Registers callbacks
			
			action.startCallback = function() {
				ready = false;
			};
			
			action.successCallback = function(id) {
				// Redirects the user to the imaging-test state
				router.redirect('imagingTest', {
					id: id
				});
			};
			
			// Includes the action
			$scope.createImagingTestAction = action;
		}
		
		/**
		 * Toggles the data-type-definition alert.
		 */
		function toggleDataTypeDefinitionAlert() {
			$scope.showDataTypeDefinitionAlert = ! $scope.showDataTypeDefinitionAlert;
		}
		
		// ---------------------------------------------------------------------
		
		// Initializes the controller
		initialize();
	}
})();
