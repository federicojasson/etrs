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
	angular.module('app.utility.searchHandler').factory('SearchHandler', [
		'$timeout',// TODO: remember to clean http://www.bennadel.com/blog/2548-don-t-forget-to-cancel-timeout-timers-in-your-destroy-events-in-angularjs.htm
		SearchHandlerFactory
	]);
	
	/**
	 * Defines the SearchHandler class.
	 */
	function SearchHandlerFactory($timeout) {
		/**
		 * The action that performs the search.
		 * 
		 * It must have the page and sortingCriteria inputs.
		 */
		SearchHandler.prototype.action;
		
		/**
		 * TODO: comment
		 */
		SearchHandler.prototype.searchPromise;
		
		/**
		 * TODO: comment
		 */
		SearchHandler.prototype.sortingCriteria;
		
		/**
		 * Initializes an instance of the class.
		 * 
		 * Receives the action.
		 */
		function SearchHandler(action) {
			this.action = action;
			this.searchPromise = null;
			this.sortingCriteria = {};
		}
		
		/**
		 * TODO: comment
		 */
		SearchHandler.prototype.computeSortingCriteria = function() {
			// TODO: comments
			
			var sortingCriteria = [];
			
			for (var field in this.sortingCriteria) {
				if (! this.sortingCriteria.hasOwnProperty(field)) {
					continue;
				}
				
				var direction = this.sortingCriteria[field];
				
				sortingCriteria.push({
					field: field,
					direction: direction
				});
			}
			
			return sortingCriteria;
		};
		
		/**
		 * TODO: comment
		 */
		SearchHandler.prototype.getSortingDirection = function(field) {
			return this.sortingCriteria[field];
		};
		
		/**
		 * TODO: comment
		 */
		SearchHandler.prototype.notifyExpressionChange = function() {
			// TODO: comments
			
			if (this.searchPromise !== null) {
				$timeout.cancel(this.searchPromise);
			}
			
			this.searchPromise = $timeout(this.search.bind(this), 750);
		};
		
		/**
		 * TODO: comment
		 */
		SearchHandler.prototype.search = function() {
			// TODO: comments
			
			if (this.searchPromise !== null) {
				$timeout.cancel(this.searchPromise);
				this.searchPromise = null;
				
				this.action.input.page.value = 1;
			}
			
			this.action.execute();
		};
		
		/**
		 * TODO: comment
		 */
		SearchHandler.prototype.toggleSortingDirection = function(field) {
			// TODO: comments
			
			if (! this.sortingCriteria.hasOwnProperty(field)) {
				this.sortingCriteria[field] = 'asc';
			} else {
				if (this.sortingCriteria[field] === 'asc') {
					this.sortingCriteria[field] = 'desc';
				} else {
					delete this.sortingCriteria[field];
				}
			}
			
			this.action.input.sortingCriteria.value = this.computeSortingCriteria();
			this.search();
		};
		
		// ---------------------------------------------------------------------
		
		return SearchHandler;
	}
})();
