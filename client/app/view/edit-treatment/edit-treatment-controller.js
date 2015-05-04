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
	angular.module('app.view.editTreatment').controller('EditTreatmentViewController', [
		'$scope',
		'$stateParams',
		'EditTreatmentAction',
		'data',
		'router',
		EditTreatmentViewController
	]);
	
	/**
	 * Represents the edit-treatment view.
	 */
	function EditTreatmentViewController($scope, $stateParams, EditTreatmentAction, data, router) {
		var _this = this;
		
		/**
		 * Indicates whether the view is ready.
		 */
		var ready = false;
		
		/**
		 * Returns the template's URL.
		 */
		_this.getTemplateUrl = function() {
			return 'app/view/edit-treatment/edit-treatment.html';
		};
		
		/**
		 * Returns the title to be set when the view is ready.
		 */
		_this.getTitle = function() {
			return $scope.treatment.name;
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
			
			// Gets the treatment
			data.getTreatment(id).then(function(treatment) {
				// Includes the treatment
				$scope.treatment = treatment;
				
				// Initializes actions
				initializeEditTreatmentAction(treatment);
				
				ready = true;
			});
		}
		
		/**
		 * Initializes the edit-treatment action.
		 * 
		 * Receives the treatment.
		 */
		function initializeEditTreatmentAction(treatment) {
			// Initializes the action
			var action = new EditTreatmentAction();
			
			// Sets inputs' initial values
			action.input.id.value = treatment.id;
			action.input.version.value = treatment.version;
			action.input.name.value = treatment.name;
			
			// Registers callbacks
			
			action.startCallback = function() {
				ready = false;
			};
			
			action.successCallback = function() {
				// Redirects the user to the treatment state
				router.redirect('treatment', {
					id: treatment.id
				});
			};
			
			// Includes the action
			$scope.editTreatmentAction = action;
		}
		
		// ---------------------------------------------------------------------
		
		// Initializes the controller
		initialize();
	}
})();
