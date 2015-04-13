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
	angular.module('app.utility.sortingCriteriaHandler').factory('SortingCriteriaHandler', SortingCriteriaHandlerFactory);
	
	/**
	 * Defines the SortingCriteriaHandler class.
	 */
	function SortingCriteriaHandlerFactory() {
		/**
		 * The action that performs the search.
		 * 
		 * It must have a sortingCriteria input.
		 */
		SortingCriteriaHandler.prototype.action;
		
		/**
		 * The fields and their respective directions.
		 */
		SortingCriteriaHandler.prototype.fields;
		
		/**
		 * Initializes an instance of the class.
		 * 
		 * Receives the action.
		 */
		function SortingCriteriaHandler(action) {
			this.fields = {};
			this.action = action;
		}
		
		/**
		 * Computes the sorting criteria from the fields and their respective
		 * directions.
		 */
		SortingCriteriaHandler.prototype.compute = function() {
			// TODO: comments
			
			var sortingCriteria = [];
			
			for (var field in this.fields) {
				if (! this.fields.hasOwnProperty(field)) {
					continue;
				}
				
				var direction = this.fields[field];
				
				sortingCriteria.push({
					field: field,
					direction: direction
				});
			}
			
			return sortingCriteria;
		};
		
		/**
		 * Returns the direction corresponding to a field.
		 * 
		 * Receives the field.
		 */
		SortingCriteriaHandler.prototype.get = function(field) {
			return this.fields[field];
		};
		
		/**
		 * Toggles the direction corresponding to a field.
		 * 
		 * Receives the field.
		 */
		SortingCriteriaHandler.prototype.toggle = function(field) {
			// TODO: comments
			
			if (! this.fields.hasOwnProperty(field)) {
				this.fields[field] = 'asc';
			} else {
				if (this.fields[field] === 'asc') {
					this.fields[field] = 'desc';
				} else {
					delete this.fields[field];
				}
			}
			
			this.action.input.sortingCriteria.value = this.compute();
			this.action.execute();
		};
		
		// ---------------------------------------------------------------------
		
		return SortingCriteriaHandler;
	}
})();
