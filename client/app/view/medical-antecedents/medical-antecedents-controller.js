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
	angular.module('app.view.medicalAntecedents').controller('MedicalAntecedentsViewController', [
		'$scope',
		'DeleteMedicalAntecedentAction',
		'SearchMedicalAntecedentsAction',
		'data',
		'utility',
		'SearchHandler',
		MedicalAntecedentsViewController
	]);
	
	/**
	 * Represents the medical-antecedents view.
	 */
	function MedicalAntecedentsViewController($scope, DeleteMedicalAntecedentAction, SearchMedicalAntecedentsAction, data, utility, SearchHandler) {
		var _this = this;
		
		/**
		 * Returns the template's URL.
		 */
		_this.getTemplateUrl = function() {
			return 'app/view/medical-antecedents/medical-antecedents.html';
		};
		
		/**
		 * Returns the title to be set when the view is ready.
		 */
		_this.getTitle = function() {
			return 'Antecedentes médicos';
		};
		
		/**
		 * Determines whether the view is ready.
		 */
		_this.isReady = function() {
			return true;
		};
		
		/**
		 * Deletes a medical antecedent.
		 * 
		 * Receives the medical antecedent.
		 */
		function deleteMedicalAntecedent(medicalAntecedent) {
			// Initializes the action
			var action = new DeleteMedicalAntecedentAction();
			
			// Sets inputs' initial values
			action.input.id.value = medicalAntecedent.id;
			action.input.version.value = medicalAntecedent.version;
			
			// Registers the callbacks
			
			action.startCallback = function() {
				// Removes the medical antecedent
				utility.removeFromArray(medicalAntecedent, $scope.medicalAntecedents);
			};
			
			// Executes the action
			action.execute();
		}
		
		/**
		 * Performs initialization tasks.
		 */
		function initialize() {
			// Includes the medical antecedents
			$scope.medicalAntecedents = [];
			
			// Includes the total number of results
			$scope.total = 0;
			
			// Includes auxiliary variables
			$scope.searching = false;
			
			// Includes auxiliary functions
			$scope.deleteMedicalAntecedent = deleteMedicalAntecedent;
			
			// Initializes the actions
			initializeSearchMedicalAntecedentsAction();
		}
		
		/**
		 * Initializes the search handler.
		 * 
		 * Receives the action.
		 */
		function initializeSearchHandler(action) {
			// Initializes the search handler
			var searchHandler = new SearchHandler(action);
			
			// Registers a listener
			$scope.$on('$destroy', function() {
				// Cancels the scheduled search
				searchHandler.cancelScheduledSearch();
			});
			
			// Includes the search handler
			$scope.searchHandler = searchHandler;
		}
		
		/**
		 * Initializes the search-medical-antecedents action.
		 */
		function initializeSearchMedicalAntecedentsAction() {
			// Initializes the action
			var action = new SearchMedicalAntecedentsAction();
			
			// Sets inputs' initial values
			action.input.expression.value = null;
			action.input.sortingCriteria.value = [];
			action.input.page.value = 1;
			action.input.resultsPerPage.value = 10;
			
			// Registers the callbacks
			
			action.startCallback = function() {
				// Refreshes the medical antecedents
				$scope.medicalAntecedents = [];
				
				$scope.searching = true;
			};
			
			action.successCallback = function(results, total) {
				// Refreshes the total number of results
				$scope.total = total;
				
				// Resets the data service
				data.reset();
				
				// Gets the medical antecedents
				data.getMedicalAntecedentArray(results).then(function(medicalAntecedents) {
					// Refreshes the medical antecedents
					$scope.medicalAntecedents = medicalAntecedents;
					
					$scope.searching = false;
				});
			};
			
			// Executes the action
			action.execute();
			
			// Includes the action
			$scope.searchMedicalAntecedentsAction = action;
			
			// Initializes the search handler
			initializeSearchHandler(action);
		}
		
		// ---------------------------------------------------------------------
		
		// Initializes the controller
		initialize();
	}
})();
