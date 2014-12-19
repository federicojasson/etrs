// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: filters
	var module = angular.module('filters');
	
	// Filter: honorificName
	module.filter('honorificName', [
		'contents',
		honorificNameFilter
	]);
	
	/*
	 * Filter: honorificName
	 * 
	 * Given a user, it returns her honorific name.
	 */
	function honorificNameFilter(contents) {
		/*
		 * Filters the input.
		 */
		function filter(user) {
			// Gets the user's main data
			var mainData = user.mainData;
			
			// Gets the user's gender, last names and role
			var userGender = mainData.gender;
			var userLastNames = mainData.lastNames;
			var userRole = mainData.role;
			
			// Gets the user's honorific title
			var honorificTitle = contents.getHonorificTitle(userRole, userGender);

			// Returns the user's honorific name
			return honorificTitle + ' ' + userLastNames;
		}
		
		return filter;
	}
})();
