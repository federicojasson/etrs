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
		LogsViewController
	]);
	
	/**
	 * Represents the logs view.
	 */
	function LogsViewController($scope, SearchLogsAction, data) {
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
		 * Includes the search-logs action.
		 */
		function includeSearchLogsAction() {
			// Initializes the action
			var action = new SearchLogsAction();
			action.input.sortingCriteria.value = [];
			action.input.page.value = 1; // TODO: remove from here
			action.input.resultsPerPage.value = 20;
			action.startCallback = onSearchLogsStart;
			action.successCallback = onSearchLogsSuccess;
			
			// Includes the action
			$scope.searchLogsAction = action;
		}
		
		/**
		 * Performs initialization tasks.
		 */
		function initialize() {
			// Includes the actions
			includeSearchLogsAction();
		}
		
		/**
		 * Invoked at the start of the search-logs action.
		 */
		function onSearchLogsStart() {
			ready = false;
		}
		
		/**
		 * Invoked when the search-logs action is successful.
		 * 
		 * Receives the results and the total number of results.
		 */
		function onSearchLogsSuccess(results, total) {
			// TODO: do something with total
			
			// Resets the data service
			data.reset();
			
			// TODO: comments
			
			data.getLogArray(results).then(function(loadedLogs) {
				// TODO: assign to array of logs
				ready = true;
			});
		}
		
		// ---------------------------------------------------------------------
		
		// Initializes the controller
		initialize();
	}
})();
