// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: utilities
	var module = angular.module('utilities');
	
	// Filter: honorificName
	module.filter('honorificName', honorificNameFilter);
	
	/*
	 * Filter: honorificName
	 * 
	 * Given a user, it returns her honorific name.
	 */
	function honorificNameFilter() {
		/*
		 * Filters the input.
		 * 
		 * It receives the input.
		 */
		function filter(user) {
			var userGender = user.gender;
			var userLastNames = user.lastNames;
			var userRole = user.role;
			
			// Gets the user's honorific title
			var honorificTitle = 'Dr.'; // TODO: get honorific title

			// Composes and returns the user's honorific name
			return honorificTitle + ' ' + userLastNames;
		}
		
		return filter;
	}
})();
