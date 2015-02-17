// Uses strict mode in the whole script
'use strict';

(function() {
	angular.module('app.title').service('title', titleService);
	
	/*
	 * Offers functions to manage the state of the page's title.
	 */
	function titleService() {
		var service = this;
		
		/*
		 * The title of the page.
		 */
		var title;
		
		/*
		 * Returns the title of the page.
		 */
		service.get = function() {
			return title;
		};
		
		/*
		 * Sets the title of the page.
		 * 
		 * It receives the title to be set.
		 */
		service.set = function(newTitle) {
			title = newTitle;
		};
	}
})();
