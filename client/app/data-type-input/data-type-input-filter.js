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
	angular.module('app.dataTypeInput').filter('dataTypeInput', [
		'DataTypeInput',
		'utility',
		dataTypeInputFilter
	]);
	
	/**
	 * Returns the label of a data-type value.
	 */
	function dataTypeInputFilter(DataTypeInput, utility) {
		/**
		 * Applies the filter.
		 * 
		 * Receives the value and the formatted definition of the data type.
		 */
		function filter(value, formattedDefinition) {
			if (value === null) {
				// The value is null
				return '';
			}
			
			// Creates the data-type input
			var dataTypeInput = DataTypeInput.create(formattedDefinition);
			
			if (dataTypeInput.dataType === DataTypeInput.INTEGER_RANGE) {
				// It is an integer_range data type
				return value;
			}
			
			// Searches the value
			var label = utility.searchInObject(value, dataTypeInput.definition);
			
			if (label === null) {
				// The value is not defined
				return 'Desconocido';
			}
			
			return label;
		}
		
		// ---------------------------------------------------------------------
		
		return filter;
	}
})();
