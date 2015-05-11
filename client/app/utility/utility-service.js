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
	angular.module('app.utility').service('utility', utilityService);
	
	/**
	 * Provides utility functions.
	 */
	function utilityService() {
		var _this = this;
		
		/**
		 * Applies a filter to an array's elements.
		 * 
		 * Receives the array and a filter for the elements.
		 */
		_this.filterArray = function(array, filter) {
			// Filters the array's elements
			for (var i = 0; i < array.length; i++) {
				array[i] = filter(array[i]);
			}
			
			return array;
		};
		
		/**
		 * Applies a filter to an object's properties.
		 * 
		 * Receives the object and a filter for the properties.
		 */
		_this.filterObject = function(object, filter) {
			// Filters the object's properties
			for (var property in object) {
				if (! object.hasOwnProperty(property)) {
					continue;
				}
				
				object[property] = filter(object[property]);
			}
			
			return object;
		};
		
		/**
		 * Returns a file's extension.
		 * 
		 * Receives the file's name.
		 */
		_this.getFileExtension = function(name) {
			// Gets the fragments of the name separated by dots
			var fragments = name.split('.');
			
			if (fragments.length === 1) {
				// The file has no extension
				return '';
			}
			
			// Gets the extension
			var extension = fragments.pop();
			
			if (! /^[0-9A-Za-z]*$/.test(extension)) {
				// The extension is invalid
				return '';
			}
			
			// Converts the extension to lowercase
			return extension.toLowerCase();
		};
		
		/**
		 * Returns an object's length.
		 * 
		 * Receives the object.
		 */
		_this.getObjectLength = function(object) {
			var length = 0;
			
			// Counts the number of properties of the object
			for (var property in object) {
				if (! object.hasOwnProperty(property)) {
					continue;
				}
				
				// Increments the count
				length++;
			}
			
			return length;
		};
		
		/**
		 * Determines whether a certain element is present in an array.
		 * 
		 * Receives the element and the array.
		 */
		_this.inArray = function(element, array) {
			return _this.searchInArray(element, array) !== -1;
		};
		
		/**
		 * Determines whether a certain element is present in an object.
		 * 
		 * Receives the element and the object.
		 */
		_this.inObject = function(element, object) {
			// Searches the element
			for (var property in object) {
				if (! object.hasOwnProperty(property)) {
					continue;
				}
				
				if (object[property] === element) {
					// The element has been found
					return true;
				}
			}
			
			return false;
		};
		
		/**
		 * Determines whether a string represents an integer.
		 * 
		 * Receives the string.
		 */
		_this.isStringAnInteger = function(string) {
			// Converts the string to integer
			var integer = _this.stringToInteger(string);
			
			if (isNaN(integer)) {
				// The string is not an integer
				return false;
			}
			
			// Converts the integer back to string and compares it
			return integer.toString() === string;
		};
		
		/**
		 * Determines whether an object contains duplicate elements.
		 * 
		 * Receives the object.
		 */
		_this.objectContainsDuplicates = function(object) {
			var elements = [];
			
			// Checks if any element is duplicated
			for (var property in object) {
				if (! object.hasOwnProperty(property)) {
					continue;
				}
				
				var element = object[property];
				
				if (_this.inArray(element, elements)) {
					// The element is duplicated
					return true;
				}
				
				// Adds the element
				elements.push(element);
			}
			
			return false;
		};
		
		/**
		 * Converts a string from PascalCase to camelCase.
		 * 
		 * Receives the string.
		 */
		_this.pascalToCamelCase = function(string) {
			// Converts the first character to lowercase
			return string.substring(0, 1).toLowerCase() + string.substring(1);
		};
		
		/**
		 * Removes an array's element.
		 * 
		 * Receives the element and the array.
		 */
		_this.removeFromArray = function(element, array) {
			// Searches the element
			var index = _this.searchInArray(element, array);
			
			// Removes the element
			_this.removeFromArrayByIndex(index, array);
		};
		
		/**
		 * Removes an array's element by index.
		 * 
		 * Receives the index and the array.
		 */
		_this.removeFromArrayByIndex = function(index, array) {
			array.splice(index, 1);
		};
		
		/**
		 * Searches an array's element.
		 * 
		 * Receives the element and the array.
		 */
		_this.searchInArray = function(element, array) {
			if (Array.prototype.indexOf) {
				// The indexOf function is defined
				return array.indexOf(element);
			}
			
			// Searches the element
			for (var i = 0; i < array.length; i++) {
				if (array[i] === element) {
					// The element has been found
					return i;
				}
			}
			
			return -1;
		};
		
		/**
		 * Searches an object's element.
		 * 
		 * Receives the element and the object.
		 */
		_this.searchInObject = function(element, object) {
			// Searches the element
			for (var property in object) {
				if (! object.hasOwnProperty(property)) {
					continue;
				}
				
				if (object[property] === element) {
					// The element has been found
					return property;
				}
			}
			
			return null;
		};
		
		/**
		 * Converts a string from spinal-case to camelCase.
		 * 
		 * Receives the string.
		 */
		_this.spinalToCamelCase = function(string) {
			// Replaces dashes with spaces
			string = string.replace(/-/g, ' ');

			// Converts the first character of each word, except the first one,
			// to uppercase
			string = string.replace(/ [a-z]/g, function(character) {
				return character.toUpperCase();
			});
			
			// Removes the spaces
			return string.replace(/ /g, '');
		};
		
		/**
		 * Converts a string to boolean.
		 * 
		 * Receives the string.
		 */
		_this.stringToBoolean = function(string) {
			return string === 'true';
		};
		
		/**
		 * Converts a string to date.
		 * 
		 * Receives the string.
		 */
		_this.stringToDate = function(string) {
			// Gets the year, the month and the day
			var year = string.substring(0, 4);
			var month = string.substring(5, 7) - 1;
			var day = string.substring(8, 10);
			
			// Initializes the date
			return new Date(year, month, day);
		};
		
		/**
		 * Converts a string to integer.
		 * 
		 * Receives the string.
		 */
		_this.stringToInteger = function(string) {
			if (string === '') {
				// The string is empty
				return NaN;
			}
			
			if (/[\.BEOXbeox]/.test(string)) {
				// The string contains invalid characters
				return NaN;
			}
			
			// Converts the string to integer
			return parseInt(Number(string), 10);
		};
		
		/**
		 * Trims and shrinks a string.
		 * 
		 * Receives the string.
		 */
		_this.trimAndShrink = function(string) {
			// Trims the string
			string = string.trim();
			
			// Shrinks the string
			return string.replace(/ +/g, ' ');
		};
	}
})();
