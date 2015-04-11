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
	angular.module('app.view.editMedicine').controller('EditMedicineViewController', [
		'$scope',
		'$stateParams',
		'EditMedicineAction',
		'data',
		'router',
		EditMedicineViewController
	]);
	
	/**
	 * Represents the edit-medicine view.
	 */
	function EditMedicineViewController($scope, $stateParams, EditMedicineAction, data, router) {
		var _this = this;
		
		/**
		 * Indicates whether the view is ready.
		 */
		var ready = false;
		
		/**
		 * Returns the template's URL.
		 */
		_this.getTemplateUrl = function() {
			return 'app/view/edit-medicine/edit-medicine.html';
		};
		
		/**
		 * Returns the title to be set when the view is ready.
		 */
		_this.getTitle = function() {
			return $scope.medicine.name;
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
			
			// Gets the medicine
			data.getMedicine(id).then(function(loadedMedicine) {
				// Includes the medicine
				$scope.medicine = loadedMedicine;
				
				// Initializes the actions
				initializeEditMedicineAction(loadedMedicine);
				
				ready = true;
			});
		}
		
		/**
		 * Initializes the edit-medicine action.
		 * 
		 * Receives the medicine.
		 */
		function initializeEditMedicineAction(medicine) {
			// Initializes the action
			var action = new EditMedicineAction();
			
			// Sets inputs' initial values
			action.input.id.value = medicine.id;
			action.input.version.value = medicine.version;
			action.input.name.value = medicine.name;
			
			// Registers the callbacks
			
			action.startCallback = function() {
				ready = false;
			};
			
			action.successCallback = function() {
				// Redirects the user to the medicine route
				router.redirect('medicine', {
					id: medicine.id
				});
			};
			
			// Includes the action
			$scope.editMedicineAction = action;
		}
		
		// ---------------------------------------------------------------------
		
		// Initializes the controller
		initialize();
	}
})();
