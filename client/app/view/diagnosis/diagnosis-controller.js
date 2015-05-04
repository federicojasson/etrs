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
	angular.module('app.view.diagnosis').controller('DiagnosisViewController', [
		'$scope',
		'$stateParams',
		'DeleteDiagnosisAction',
		'data',
		'router',
		DiagnosisViewController
	]);
	
	/**
	 * Represents the diagnosis view.
	 */
	function DiagnosisViewController($scope, $stateParams, DeleteDiagnosisAction, data, router) {
		var _this = this;
		
		/**
		 * Indicates whether the view is ready.
		 */
		var ready = false;
		
		/**
		 * Returns the template's URL.
		 */
		_this.getTemplateUrl = function() {
			return 'app/view/diagnosis/diagnosis.html';
		};
		
		/**
		 * Returns the title to be set when the view is ready.
		 */
		_this.getTitle = function() {
			return $scope.diagnosis.name;
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
			
			// Gets the diagnosis
			data.getDiagnosis(id).then(function(diagnosis) {
				// Includes the diagnosis
				$scope.diagnosis = diagnosis;
				
				// Initializes actions
				initializeDeleteDiagnosisAction(diagnosis);
				
				ready = true;
			});
		}
		
		/**
		 * Initializes the delete-diagnosis action.
		 * 
		 * Receives the diagnosis.
		 */
		function initializeDeleteDiagnosisAction(diagnosis) {
			// Initializes the action
			var action = new DeleteDiagnosisAction();
			
			// Sets inputs' initial values
			action.input.id.value = diagnosis.id;
			action.input.version.value = diagnosis.version;
			
			// Registers callbacks
			
			action.startCallback = function() {
				ready = false;
			};
			
			action.successCallback = function() {
				// Redirects the user to the diagnoses state
				router.redirect('diagnoses');
			};
			
			// Includes the action
			$scope.deleteDiagnosisAction = action;
		}
		
		// ---------------------------------------------------------------------
		
		// Initializes the controller
		initialize();
	}
})();
