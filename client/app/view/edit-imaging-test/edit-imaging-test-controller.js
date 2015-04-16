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
	angular.module('app.view.editImagingTest').controller('EditImagingTestViewController', [
		'$scope',
		'$stateParams',
		'EditImagingTestAction',
		'data',
		'router',
		EditImagingTestViewController
	]);
	
	/**
	 * Represents the edit-imaging-test view.
	 */
	function EditImagingTestViewController($scope, $stateParams, EditImagingTestAction, data, router) {
		var _this = this;
		
		/**
		 * Indicates whether the view is ready.
		 */
		var ready = false;
		
		/**
		 * Returns the template's URL.
		 */
		_this.getTemplateUrl = function() {
			return 'app/view/edit-imaging-test/edit-imaging-test.html';
		};
		
		/**
		 * Returns the title to be set when the view is ready.
		 */
		_this.getTitle = function() {
			return $scope.imagingTest.name;
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
			// Gets the URL parameters
			var id = $stateParams.id;
			
			// Resets the data service
			data.reset();
			
			// Gets the imaging test
			data.getImagingTest(id).then(function(imagingTest) {
				// Includes the imaging test
				$scope.imagingTest = imagingTest;
				
				// Initializes the actions
				initializeEditImagingTestAction(imagingTest);
				
				ready = true;
			});
		}
		
		/**
		 * Initializes the edit-imaging-test action.
		 * 
		 * Receives the imaging test.
		 */
		function initializeEditImagingTestAction(imagingTest) {
			// Initializes the action
			var action = new EditImagingTestAction();
			
			// Sets inputs' initial values
			action.input.id.value = imagingTest.id;
			action.input.version.value = imagingTest.version;
			action.input.dataTypeDefinition.value = imagingTest.dataTypeDefinition;
			action.input.name.value = imagingTest.name;
			
			// Registers the callbacks
			
			action.startCallback = function() {
				ready = false;
			};
			
			action.successCallback = function() {
				// Redirects the user to the imaging-test state
				router.redirect('imagingTest', {
					id: imagingTest.id
				});
			};
			
			// Includes the action
			$scope.editImagingTestAction = action;
		}
		
		// ---------------------------------------------------------------------
		
		// Initializes the controller
		initialize();
	}
})();
