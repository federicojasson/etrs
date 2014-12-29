// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: utilities
	var module = angular.module('utilities');
	
	// Controller: TitleController
	module.controller('TitleController', [
		'title',
		TitleController
	]);
	
	// Service: title
	module.service('title', titleService);
	
	/*
	 * Controller: TitleController
	 * 
	 * Offers functions to display the title of the page.
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
	
	/*
	 * Service: title
	 * 
	 * Offers functions to obtain and change the title of the page.
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
		 * It receives the title.
		 */
		service.set = function(newTitle) {
			title = newTitle;
		};
	}
})();
