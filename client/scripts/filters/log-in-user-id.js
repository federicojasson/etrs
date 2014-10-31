// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('filters');
	
	// Filters
	module.filter('logInUserId', logInUserIdFilter);
	
	/*
	 * Filter: logInUserId.
	 * 
	 * Processes a user ID entered when logging in.
	 */
	function logInUserIdFilter() {
		var filter = this;
		
		/*
		 * Applies the filter.
		 */
		filter.applyFilter = function(userId) {
			// TODO: toUpperCase (wrong)
			return userId.toUpperCase();
		};
		
		// Returns the filter's application function
		return filter.applyFilter;
	};
})();
