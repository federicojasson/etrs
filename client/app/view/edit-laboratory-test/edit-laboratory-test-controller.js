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
	angular.module('app.view.editLaboratoryTest').controller('EditLaboratoryTestViewController', [
		'$scope',
		'$stateParams',
		'EditLaboratoryTestAction',
		'data',
		'router',
		EditLaboratoryTestViewController
	]);
	
	/**
	 * Represents the edit-laboratory-test view.
	 */
	function EditLaboratoryTestViewController($scope, $stateParams, EditLaboratoryTestAction, data, router) {
		var _this = this;
		
		/**
		 * Indicates whether the view is ready.
		 */
		var ready = false;
		
		/**
		 * Returns the template's URL.
		 */
		_this.getTemplateUrl = function() {
			return 'app/view/edit-laboratory-test/edit-laboratory-test.html';
		};
		
		/**
		 * Returns the title to be set when the view is ready.
		 */
		_this.getTitle = function() {
			return $scope.laboratoryTest.name;
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
			
			// Gets the laboratory test
			data.getLaboratoryTest(id).then(function(laboratoryTest) {
				// Includes the laboratory test
				$scope.laboratoryTest = laboratoryTest;
				
				// Initializes the actions
				initializeEditLaboratoryTestAction(laboratoryTest);
				
				ready = true;
			});
		}
		
		/**
		 * Initializes the edit-laboratory-test action.
		 * 
		 * Receives the laboratory test.
		 */
		function initializeEditLaboratoryTestAction(laboratoryTest) {
			// Initializes the action
			var action = new EditLaboratoryTestAction();
			
			// Sets inputs' initial values
			action.input.id.value = laboratoryTest.id;
			action.input.version.value = laboratoryTest.version;
			action.input.dataTypeDefinition.value = laboratoryTest.dataTypeDefinition;
			action.input.name.value = laboratoryTest.name;
			
			// Registers the callbacks
			
			action.startCallback = function() {
				ready = false;
			};
			
			action.successCallback = function() {
				// Redirects the user to the laboratory-test state
				router.redirect('laboratoryTest', {
					id: laboratoryTest.id
				});
			};
			
			// Includes the action
			$scope.editLaboratoryTestAction = action;
		}
		
		// ---------------------------------------------------------------------
		
		// Initializes the controller
		initialize();
	}
})();
