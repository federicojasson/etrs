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
	angular.module('app.view.logs').controller('LogsViewController', [
		'$scope',
		'SearchLogsAction',
		'data',
		'SearchHandler',
		LogsViewController
	]);
	
	/**
	 * Represents the logs view.
	 */
	function LogsViewController($scope, SearchLogsAction, data, SearchHandler) {
		var _this = this;
		
		/**
		 * Indicates whether the view is ready.
		 */
		var ready = true;
		
		/**
		 * Returns the template's URL.
		 */
		_this.getTemplateUrl = function() {
			return 'app/view/logs/logs.html';
		};
		
		/**
		 * Returns the title to be set when the view is ready.
		 */
		_this.getTitle = function() {
			return 'Registros';
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
			// Includes the logs
			$scope.logs = [];
			
			// Includes the total number of results
			$scope.total = 0;
			
			// Includes auxiliary variables
			$scope.searching = false;
			
			// Initializes the actions
			initializeSearchLogsAction();
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
		 * Initializes the search-logs action.
		 */
		function initializeSearchLogsAction() {
			// Initializes the action
			var action = new SearchLogsAction();
			
			// Sets inputs' initial values
			action.input.expression.value = null;
			action.input.sortingCriteria.value = [];
			action.input.page.value = 1;
			action.input.resultsPerPage.value = 10;
			
			// Registers the callbacks
			
			action.startCallback = function() {
				$scope.searching = true;
			};
			
			action.successCallback = function(results, total) {
				// Refreshes the total number of results
				$scope.total = total;
				
				// Resets the data service
				data.reset();
				
				// Gets the logs
				data.getLogArray(results).then(function(logs) {
					// Refreshes the logs
					$scope.logs = logs;
					
					$scope.searching = false;
				});
			};
			
			// Executes the action
			action.execute();
			
			// Includes the action
			$scope.searchLogsAction = action;
			
			// Initializes the search handler
			initializeSearchHandler(action);
		}
		
		// ---------------------------------------------------------------------
		
		// Initializes the controller
		initialize();
	}
})();
