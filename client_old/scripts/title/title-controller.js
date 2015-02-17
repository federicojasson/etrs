// Uses strict mode in the whole script
'use strict';

(function() {
	angular.module('app.title').controller('TitleController', [
		'title',
		TitleController
	]);
	
	/*
	 * Offers functions to access the page's title.
	 */
	function TitleController(title) {
		var controller = this;
		
		/*
		 * Returns the title of the page.
		 */
		controller.get = function() {
			return title.get();
		};
	}
})();
