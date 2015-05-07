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
	angular.module('app.dataTypeInput').controller('DataTypeInputController', [
		'$scope',
		'DataTypeInput',
		DataTypeInputController
	]);
	
	/**
	 * Implements the logic of a data-type input.
	 */
	function DataTypeInputController($scope, DataTypeInput) {
		var _this = this;
		
		/**
		 * The data-type input.
		 */
		_this.dataTypeInput = null;
		
		/**
		 * Performs initialization tasks.
		 */
		function initialize() {
			// Initializes the data-type input
			initializeDataTypeInput($scope.dataTypeDefinition);
		}
		
		/**
		 * Initializes the data-type input.
		 * 
		 * Receives the formatted definition.
		 */
		function initializeDataTypeInput(formattedDefinition) {
			// Creates the data-type input
			_this.dataTypeInput = DataTypeInput.create(formattedDefinition);
			
			// Sets the input's validator
			$scope.input.validator = _this.dataTypeInput.validator;
			
			if ($scope.input.value === '' && _this.dataTypeInput.dataType !== 'integer_range') {
				// Sets the input's initial value
				$scope.input.value = null;
			}
		}
		
		// ---------------------------------------------------------------------
		
		// Initializes the controller
		initialize();
	}
})();
