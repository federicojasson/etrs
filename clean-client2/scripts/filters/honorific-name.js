// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: filters
	var module = angular.module('filters');
	
	// Filter: honorificName
	module.filter('honorificName', honorificNameFilter);
	
	/*
	 * Filter: honorificName
	 * 
	 * Given a user, it returns its honorific name.
	 */
	function honorificNameFilter() {
		/*
		 * Filters the input.
		 */
		function filter(user) {
			// Gets the user's honorificTitle
			var honorificTitle = getHonorificTitle(user);
			
			// Gets the user's last names
			var lastNames = user.mainData.lastNames;

			// Returns the user's honorific name
			return honorificTitle + ' ' + lastNames;
		}
		
		/*
		 * TODO
		 */
		function getHonorificTitle(user) {
			// Gets the user's main data
			var mainData = user.mainData;
			
			// Gets the user's gender and role
			var gender = mainData.gender;
			var role = mainData.role;
			
			if (role === 'dr') {
				// The user is a doctor
				if (gender === 'f') {
					// The user is a female
					return 'Dra.';
				} else {
					// The user is a male
					return 'Dr.';
				}
			} else {
				// The user is not a doctor
				if (gender === 'f') {
					// The user is a female
					return 'Sra.';
				} else {
					// The user is a male
					return 'Sr.';
				}
			}
		}
		
		return filter;
	}
})();
