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
	angular.module('app.view.medicine').controller('MedicineViewController', [
		'$scope',
		'$stateParams',
		'EditMedicineAction',
		'data',
		MedicineViewController
	]);
	
	/**
	 * Represents the medicine view.
	 */
	function MedicineViewController($scope, $stateParams, EditMedicineAction, data) {
		var _this = this;
		
		/**
		 * The medicine.
		 */
		var medicine = null;
		
		/**
		 * Indicates whether the view is ready.
		 */
		var ready = false;
		
		/**
		 * Returns the template's URL.
		 */
		_this.getTemplateUrl = function() {
			return 'app/view/medicine/medicine.html';
		};
		
		/**
		 * Returns the title to set when the view is ready.
		 */
		_this.getTitle = function() {
			return medicine.name;
		};
		
		/**
		 * Determines whether the view is ready.
		 */
		_this.isReady = function() {
			return ready;
		};
		
		/**
		 * TODO: comment
		 */
		function getMedicine(id) { // TODO: get or load?
			// TODO: prepare data service?
			
			// Gets the medicine
			data.getMedicine(id).then(function(loadedMedicine) {
				// Sets the medicine
				medicine = loadedMedicine;
				
				ready = true;
			});
		}
		
		/**
		 * Performs initialization tasks.
		 */
		function initialize() {
			// Gets the URL parameters
			var id = $stateParams.id;
			
			// Initializes the edit-medicine action
			var editMedicineAction = new EditMedicineAction();
			editMedicineAction.startCallback = onEditMedicineStart;
			editMedicineAction.successCallback = onEditMedicineSuccess;
			
			// Includes the actions
			$scope.editMedicineAction = editMedicineAction;
			
			// Gets the medicine
			getMedicine(id);
		}
		
		/**
		 * Invoked at the start of the edit-medicine action.
		 */
		function onEditMedicineStart() {
			ready = false;
		}
		
		/**
		 * Invoked when the edit-medicine action is successful.
		 */
		function onEditMedicineSuccess() {
			ready = true;
		}
		
		// ---------------------------------------------------------------------
		
		// Initializes the controller
		initialize();
	}
})();
