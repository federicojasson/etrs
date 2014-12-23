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
	 * Offers functions to display the title of the document.
	 */
	function TitleController(title) {
		var controller = this;
		
		/*
		 * Returns the title of the document.
		 */
		controller.get = function() {
			return title.get();
		};
	}
	
	/*
	 * Service: title
	 * 
	 * Offers functions to obtain and change the title of the document.
	 */
	function titleService() {
		var service = this;
		
		/*
		 * The title of the document.
		 */
		var title = 'ETRS';
		
		/*
		 * Returns the title of the document.
		 */
		service.get = function() {
			return title;
		};
		
		/*
		 * Sets the title of the document.
		 * 
		 * It receives the new title.
		 */
		service.set = function(newTitle) {
			title = newTitle;
		};
	}
})();
