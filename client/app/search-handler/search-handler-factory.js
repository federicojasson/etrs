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
	angular.module('app.searchHandler').factory('SearchHandler', [
		'$timeout',
		SearchHandlerFactory
	]);
	
	/**
	 * Defines the SearchHandler class.
	 */
	function SearchHandlerFactory($timeout) {
		/**
		 * The action that performs the search.
		 * 
		 * It must have the expression, sortingCriteria and page inputs.
		 */
		SearchHandler.prototype.action;
		
		/**
		 * The search promise.
		 * 
		 * It is initialized when a search is scheduled.
		 */
		SearchHandler.prototype.searchPromise;
		
		/**
		 * The sorting-criteria structure.
		 * 
		 * Holds the sorting criteria in a convenient structure.
		 */
		SearchHandler.prototype.sortingCriteriaStructure;
		
		/**
		 * Initializes an instance of the class.
		 * 
		 * Receives the action.
		 */
		function SearchHandler(action) {
			this.action = action;
			this.searchPromise = null;
			
			// Gets the sorting criteria
			var sortingCriteria = this.action.input.sortingCriteria.value;
			
			// Initializes the sorting-criteria structure
			this.sortingCriteriaStructure = {};
			for (var i = 0; i < sortingCriteria.length; i++) {
				var sortingCriterion = sortingCriteria[i];
				
				// Adds the criterion
				this.sortingCriteriaStructure[sortingCriterion.field] = sortingCriterion.direction;
			}
		}
		
		/**
		 * Cancels the scheduled search.
		 */
		SearchHandler.prototype.cancelScheduledSearch = function() {
			// Cancels the search promise (if any)
			$timeout.cancel(this.searchPromise);
			
			// Nullifies the search promise
			this.searchPromise = null;
		};
		
		/**
		 * Clears the expression.
		 */
		SearchHandler.prototype.clearExpression = function() {
			// Sets a null expression
			this.action.input.expression.value = null;
			
			// Schedules a search
			this.scheduleSearch();
		};
		
		/**
		 * Computes the sorting criteria.
		 */
		SearchHandler.prototype.computeSortingCriteria = function() {
			var sortingCriteria = [];
			
			// Adds the criteria
			for (var field in this.sortingCriteriaStructure) {
				if (! this.sortingCriteriaStructure.hasOwnProperty(field)) {
					continue;
				}
				
				// Gets the direction of the field
				var direction = this.sortingCriteriaStructure[field];
				
				// Adds the criterion
				sortingCriteria.push({
					field: field,
					direction: direction
				});
			}
			
			return sortingCriteria;
		};
		
		/**
		 * Returns the sorting direction corresponding to a field.
		 * 
		 * Receives the field.
		 */
		SearchHandler.prototype.getSortingDirection = function(field) {
			return this.sortingCriteriaStructure[field];
		};
		
		/**
		 * Schedules a search to be performed after some delay.
		 * 
		 * Receives, optionally, the delay.
		 */
		SearchHandler.prototype.scheduleSearch = function(delay) {
			// Cancels the scheduled search
			this.cancelScheduledSearch();
			
			// Schedules a new search
			this.searchPromise = $timeout(this.search.bind(this), delay);
		};
		
		/**
		 * Performs a search.
		 */
		SearchHandler.prototype.search = function() {
			if (this.searchPromise !== null) {
				// There is a scheduled search
				// Sets the first page
				this.action.input.page.value = 1;
			}
			
			// Cancels the scheduled search
			this.cancelScheduledSearch();
			
			// Executes the action
			this.action.execute();
		};
		
		/**
		 * Toggles the sorting direction corresponding to a field.
		 * 
		 * Receives the field.
		 */
		SearchHandler.prototype.toggleSortingDirection = function(field) {
			// Toggles the direction of the field according to its current state
			if (! this.sortingCriteriaStructure.hasOwnProperty(field)) {
				// There is no direction
				this.sortingCriteriaStructure[field] = 'ascending';
			} else {
				// There is a direction
				if (this.sortingCriteriaStructure[field] === 'ascending') {
					// The direction is ascending
					this.sortingCriteriaStructure[field] = 'descending';
				} else {
					// The direction is descending
					delete this.sortingCriteriaStructure[field];
				}
			}
			
			// Sets the new sorting criteria
			this.action.input.sortingCriteria.value = this.computeSortingCriteria();
			
			// Performs a search
			this.search();
		};
		
		// ---------------------------------------------------------------------
		
		return SearchHandler;
	}
})();
