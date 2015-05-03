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
	angular.module('app.view.clinicalImpressions').controller('ClinicalImpressionsViewController', [
		'$scope',
		'DeleteClinicalImpressionAction',
		'SearchClinicalImpressionsAction',
		'data',
		'SearchHandler',
		'utility',
		ClinicalImpressionsViewController
	]);
	
	/**
	 * Represents the clinical-impressions view.
	 */
	function ClinicalImpressionsViewController($scope, DeleteClinicalImpressionAction, SearchClinicalImpressionsAction, data, SearchHandler, utility) {
		var _this = this;
		
		/**
		 * Returns the template's URL.
		 */
		_this.getTemplateUrl = function() {
			return 'app/view/clinical-impressions/clinical-impressions.html';
		};
		
		/**
		 * Returns the title to be set when the view is ready.
		 */
		_this.getTitle = function() {
			return 'Impresiones clínicas';
		};
		
		/**
		 * Determines whether the view is ready.
		 */
		_this.isReady = function() {
			return true;
		};
		
		/**
		 * Deletes a clinical impresion.
		 * 
		 * Receives the clinical impresion.
		 */
		function deleteClinicalImpression(clinicalImpression) {
			// Initializes the action
			var action = new DeleteClinicalImpressionAction();
			
			// Sets inputs' initial values
			action.input.id.value = clinicalImpression.id;
			action.input.version.value = clinicalImpression.version;
			
			// Registers callbacks
			
			action.startCallback = function() {
				// Removes the clinical impresion
				utility.removeFromArray(clinicalImpression, $scope.clinicalImpressions);
			};
			
			// Executes the action
			action.execute();
		}
		
		/**
		 * Performs initialization tasks.
		 */
		function initialize() {
			// Includes the clinical impressions
			$scope.clinicalImpressions = [];
			
			// Includes the total number of results
			$scope.total = 0;
			
			// Includes auxiliary variables
			$scope.searching = false;
			
			// Includes auxiliary functions
			$scope.deleteClinicalImpression = deleteClinicalImpression;
			
			// Initializes the actions
			initializeSearchClinicalImpressionsAction();
		}
		
		/**
		 * Initializes the search-clinical-impressions action.
		 */
		function initializeSearchClinicalImpressionsAction() {
			// Initializes the action
			var action = new SearchClinicalImpressionsAction();
			
			// Sets inputs' initial values
			action.input.expression.value = null;
			action.input.sortingCriteria.value = [
				{
					field: 'creationDateTime',
					direction: 'descending'
				}
			];
			action.input.page.value = 1;
			action.input.resultsPerPage.value = 10;
			
			// Registers callbacks
			
			action.startCallback = function() {
				// Refreshes the clinical impressions
				$scope.clinicalImpressions = [];
				
				$scope.searching = true;
			};
			
			action.successCallback = function(results, total) {
				// Refreshes the total number of results
				$scope.total = total;
				
				// Resets the data service
				data.reset();
				
				// Gets the clinical impressions
				data.getClinicalImpressionArray(results).then(function(clinicalImpressions) {
					// Refreshes the clinical impressions
					$scope.clinicalImpressions = clinicalImpressions;
					
					$scope.searching = false;
				});
			};
			
			// Executes the action
			action.execute();
			
			// Includes the action
			$scope.searchClinicalImpressionsAction = action;
			
			// Initializes the search handler
			initializeSearchHandler(action);
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
		
		// ---------------------------------------------------------------------
		
		// Initializes the controller
		initialize();
	}
})();
