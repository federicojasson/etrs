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
	angular.module('app.view.medicalAntecedent').controller('MedicalAntecedentViewController', [
		'$scope',
		'$stateParams',
		'DeleteMedicalAntecedentAction',
		'data',
		'router',
		MedicalAntecedentViewController
	]);
	
	/**
	 * Represents the medical-antecedent view.
	 */
	function MedicalAntecedentViewController($scope, $stateParams, DeleteMedicalAntecedentAction, data, router) {
		var _this = this;
		
		/**
		 * Indicates whether the view is ready.
		 */
		var ready = false;
		
		/**
		 * Returns the template's URL.
		 */
		_this.getTemplateUrl = function() {
			return 'app/view/medical-antecedent/medical-antecedent.html';
		};
		
		/**
		 * Returns the title to be set when the view is ready.
		 */
		_this.getTitle = function() {
			return $scope.medicalAntecedent.name;
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
			data.reset(1, {
				MedicalAntecedent: [
					'creator',
					'lastEditor'
				]
			});
			
			// Gets the medical antecedent
			data.getMedicalAntecedent(id).then(function(medicalAntecedent) {
				// Includes the medical antecedent
				$scope.medicalAntecedent = medicalAntecedent;
				
				// Initializes actions
				initializeDeleteMedicalAntecedentAction(medicalAntecedent);
				
				ready = true;
			});
		}
		
		/**
		 * Initializes the delete-medical-antecedent action.
		 * 
		 * Receives the medical antecedent.
		 */
		function initializeDeleteMedicalAntecedentAction(medicalAntecedent) {
			// Initializes the action
			var action = new DeleteMedicalAntecedentAction();
			
			// Sets inputs' initial values
			action.input.id.value = medicalAntecedent.id;
			action.input.version.value = medicalAntecedent.version;
			
			// Registers callbacks
			
			action.startCallback = function() {
				ready = false;
			};
			
			action.successCallback = function() {
				// Redirects the user to the medical-antecedents state
				router.redirect('medicalAntecedents');
			};
			
			// Includes the action
			$scope.deleteMedicalAntecedentAction = action;
		}
		
		// ---------------------------------------------------------------------
		
		// Initializes the controller
		initialize();
	}
})();
