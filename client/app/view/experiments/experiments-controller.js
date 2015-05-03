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
	angular.module('app.view.experiments').controller('ExperimentsViewController', [
		'$scope',
		'DeleteExperimentAction',
		'SearchExperimentsAction',
		'data',
		'SearchHandler',
		'utility',
		ExperimentsViewController
	]);
	
	/**
	 * Represents the experiments view.
	 */
	function ExperimentsViewController($scope, DeleteExperimentAction, SearchExperimentsAction, data, SearchHandler, utility) {
		var _this = this;
		
		/**
		 * Returns the template's URL.
		 */
		_this.getTemplateUrl = function() {
			return 'app/view/experiments/experiments.html';
		};
		
		/**
		 * Returns the title to be set when the view is ready.
		 */
		_this.getTitle = function() {
			return 'Experimentos';
		};
		
		/**
		 * Determines whether the view is ready.
		 */
		_this.isReady = function() {
			return true;
		};
		
		/**
		 * Deletes an experiment.
		 * 
		 * Receives the experiment.
		 */
		function deleteExperiment(experiment) {
			// Initializes the action
			var action = new DeleteExperimentAction();
			
			// Sets inputs' initial values
			action.input.id.value = experiment.id;
			action.input.version.value = experiment.version;
			
			// Registers callbacks
			
			action.startCallback = function() {
				// Removes the experiment
				utility.removeFromArray(experiment, $scope.experiments);
			};
			
			// Executes the action
			action.execute();
		}
		
		/**
		 * Performs initialization tasks.
		 */
		function initialize() {
			// Includes the experiments
			$scope.experiments = [];
			
			// Includes the total number of results
			$scope.total = 0;
			
			// Includes auxiliary variables
			$scope.searching = false;
			
			// Includes auxiliary functions
			$scope.deleteExperiment = deleteExperiment;
			
			// Initializes the actions
			initializeSearchExperimentsAction();
		}
		
		/**
		 * Initializes the search-experiments action.
		 */
		function initializeSearchExperimentsAction() {
			// Initializes the action
			var action = new SearchExperimentsAction();
			
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
				// Refreshes the experiments
				$scope.experiments = [];
				
				$scope.searching = true;
			};
			
			action.successCallback = function(results, total) {
				// Refreshes the total number of results
				$scope.total = total;
				
				// Resets the data service
				data.reset();
				
				// Gets the experiments
				data.getExperimentArray(results).then(function(experiments) {
					// Refreshes the experiments
					$scope.experiments = experiments;
					
					$scope.searching = false;
				});
			};
			
			// Executes the action
			action.execute();
			
			// Includes the action
			$scope.searchExperimentsAction = action;
			
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
