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
	angular.module('app.action.searchLogs').factory('SearchLogsAction', [
		'inputValidator',
		'Input',
		'server',
		SearchLogsActionFactory
	]);
	
	/**
	 * Defines the SearchLogsAction class.
	 */
	function SearchLogsActionFactory(inputValidator, Input, server) {
		/**
		 * The input.
		 */
		SearchLogsAction.prototype.input;
		
		/**
		 * The start callback.
		 */
		SearchLogsAction.prototype.startCallback;
		
		/**
		 * The success callback.
		 */
		SearchLogsAction.prototype.successCallback;
		
		/**
		 * Initializes an instance of the class.
		 */
		function SearchLogsAction() {
			this.startCallback = new Function();
			this.successCallback = new Function();
			
			// Initializes the input
			this.input = {
				expression: new Input(function() {
					if (this.value === null) {
						return true;
					}
					
					return inputValidator.isValidString(this, 0, 128);
				}),
				
				sortingCriteria: new Input(),
				page: new Input(),
				resultsPerPage: new Input()
			};
		}
		
		/**
		 * Executes the action.
		 */
		SearchLogsAction.prototype.execute = function() {
			if (! inputValidator.isInputValid(this.input)) {
				// The input is invalid
				return;
			}
			
			// Invokes the start callback
			this.startCallback();
			
			// Searches the logs
			server.log.search({
				expression: this.input.expression.value,
				sortingCriteria: this.input.sortingCriteria.value,
				page: this.input.page.value,
				resultsPerPage: this.input.resultsPerPage.value
			}).then(function(output) {
				// Invokes the success callback
				this.successCallback(output.results, output.total);
			}.bind(this));
		};
		
		// ---------------------------------------------------------------------
		
		return SearchLogsAction;
	}
})();
