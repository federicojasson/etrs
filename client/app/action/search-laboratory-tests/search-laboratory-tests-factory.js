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
	angular.module('app.action.searchLaboratoryTests').factory('SearchLaboratoryTestsAction', [
		'inputValidator',
		'Input',
		'server',
		SearchLaboratoryTestsActionFactory
	]);
	
	/**
	 * Defines the SearchLaboratoryTestsAction class.
	 */
	function SearchLaboratoryTestsActionFactory(inputValidator, Input, server) {
		/**
		 * The input.
		 */
		SearchLaboratoryTestsAction.prototype.input;
		
		/**
		 * The start callback.
		 */
		SearchLaboratoryTestsAction.prototype.startCallback;
		
		/**
		 * The success callback.
		 */
		SearchLaboratoryTestsAction.prototype.successCallback;
		
		/**
		 * Initializes an instance of the class.
		 */
		function SearchLaboratoryTestsAction() {
			this.startCallback = new Function();
			this.successCallback = new Function();
			
			// Initializes the input
			this.input = {
				expression: new Input(function() {
					return inputValidator.isNull(this) || inputValidator.isValidString(this, 0, 128);
				}),
				
				sortingCriteria: new Input(),
				page: new Input(),
				resultsPerPage: new Input()
			};
		}
		
		/**
		 * Executes the action.
		 */
		SearchLaboratoryTestsAction.prototype.execute = function() {
			if (! inputValidator.isInputValid(this.input)) {
				// The input is invalid
				return;
			}
			
			// Invokes the start callback
			this.startCallback();
			
			// Searches the laboratory tests
			server.laboratoryTest.search({
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
		
		return SearchLaboratoryTestsAction;
	}
})();
