// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('classes');
	
	// Factories
	module.factory('Name', NameFactory);
	
	/*
	 * Factory: Name.
	 * 
	 * Name class.
	 * It represents the name of a person.
	 */
	function NameFactory() {
		/*
		 * Creates a name object from a data object.
		 */
		Name.createFromDataObject = function(dataObject) {
			// Gets the first and last names
			var firstName = dataObject.firstName;
			var lastName = dataObject.lastName;
			
			// Creates and returns the name object
			return new Name(firstName, lastName);
		};
		
		/*
		 * The first name.
		 */
		Name.prototype.firstName = null;
		
		/*
		 * The last name.
		 */
		Name.prototype.lastName = null;
		
		/*
		 * Creates an instance of this class.
		 */
		function Name(firstName, lastName) {
			this.firstName = firstName;
			this.lastName = lastName;
		}
		
		/*
		 * Returns the first name.
		 * TODO: remove if not used
		 */
		Name.prototype.getFirstName = function() {
			return this.firstName;
		};
		
		/*
		 * Returns the full name.
		 * TODO: remove if not used
		 */
		Name.prototype.getFullName = function() {
			return this.firstName + ' ' + this.lastName;
		};
		
		/*
		 * Returns the honorific name.
		 */
		Name.prototype.getHonorificName = function(honorificTitle) {
			return honorificTitle + ' ' + this.lastName;
		};
		
		/*
		 * Returns the last name.
		 * TODO: remove if not used
		 */
		Name.prototype.getLastName = function() {
			return this.lastName;
		};
		
		// Returns the constructor function
		return Name;
	}
})();
