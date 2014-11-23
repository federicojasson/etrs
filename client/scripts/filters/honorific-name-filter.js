// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: filters
	var module = angular.module('filters');
	
	// Filter: honorificName
	module.filter('honorificName', [
		'contentManager',
		honorificNameFilter
	]);
	
	/*
	 * Filter: honorificName
	 * 
	 * Given the information of a person, it returns its honorific name.
	 */
	function honorificNameFilter(contentManager) {
		/*
		 * Filters the input.
		 */
		function filter(input) {
			var honorificTitle = contentManager.getHonorificTitles()[input.role][input.gender];
			return honorificTitle + ' ' + input.lastNames;
		}
		
		return filter;
	}
})();
