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
	 * It represents the name of a person.
	 */
	function NameFactory() {
		/*
		 * Creates an instance of this class.
		 */
		function Name(firstName, lastName) {
			this.firstName = firstName;
			this.lastName = lastName;
		}
		
		/*
		 * Creates a name from a data object.
		 */
		Name.createFromDataObject = function(dataObject) {
			// Initializes the name data
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
		 * Returns an honorific name from an honorific title.
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
		
		return Name;
	}
})();
