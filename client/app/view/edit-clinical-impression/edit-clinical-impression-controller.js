/**
 * NEU-CO - Neuro-Cognitivo
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
	angular.module('app.view.editClinicalImpression').controller('EditClinicalImpressionViewController', [
		'$scope',
		'$stateParams',
		'EditClinicalImpressionAction',
		'data',
		'router',
		EditClinicalImpressionViewController
	]);
	
	/**
	 * Represents the edit-clinical-impression view.
	 */
	function EditClinicalImpressionViewController($scope, $stateParams, EditClinicalImpressionAction, data, router) {
		var _this = this;
		
		/**
		 * Indicates whether the view is ready.
		 */
		var ready = false;
		
		/**
		 * Returns the template's URL.
		 */
		_this.getTemplateUrl = function() {
			return 'app/view/edit-clinical-impression/edit-clinical-impression.html';
		};
		
		/**
		 * Returns the title to be set when the view is ready.
		 */
		_this.getTitle = function() {
			return $scope.clinicalImpression.name;
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
			
			// Gets the clinical impression
			data.getClinicalImpression(id).then(function(clinicalImpression) {
				// Includes the clinical impression
				$scope.clinicalImpression = clinicalImpression;
				
				// Initializes actions
				initializeEditClinicalImpressionAction(clinicalImpression);
				
				ready = true;
			});
		}
		
		/**
		 * Initializes the edit-clinical-impression action.
		 * 
		 * Receives the clinical impression.
		 */
		function initializeEditClinicalImpressionAction(clinicalImpression) {
			// Initializes the action
			var action = new EditClinicalImpressionAction();
			
			// Sets inputs' initial values
			action.input.id.value = clinicalImpression.id;
			action.input.version.value = clinicalImpression.version;
			action.input.name.value = clinicalImpression.name;
			
			// Registers callbacks
			
			action.startCallback = function() {
				ready = false;
			};
			
			action.successCallback = function() {
				// Redirects the user to the clinical-impression state
				router.redirect('clinicalImpression', {
					id: clinicalImpression.id
				});
			};
			
			// Includes the action
			$scope.editClinicalImpressionAction = action;
		}
		
		// ---------------------------------------------------------------------
		
		// Initializes the controller
		initialize();
	}
})();
