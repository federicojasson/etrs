// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('filters');
	
	// Filters
	module.filter('logInUserId', [
		'stringProcessor',
		logInUserIdFilter
	]);
	
	/*
	 * Filter: logInUserId.
	 * 
	 * Processes a user ID entered when logging in.
	 */
	function logInUserIdFilter(stringProcessor) {
		var filter = this;
		
		/*
		 * Applies the filter.
		 */
		filter.applyFilter = function(string) {
			var userId = string;
			
			userId = stringProcessor.trim(userId);
			
			return userId;
		};
		
		// Returns the filter's application function
		return filter.applyFilter;
	}
})();
