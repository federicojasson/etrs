// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: views
	var module = angular.module('views');
	
	// Controller: ManageBackgroundsViewController
	module.controller('ManageBackgroundsViewController', [
		'$q',
		'data',
		'errorHandler',
		'Error',
		'server',
		ManageBackgroundsViewController
	]);
	
	/*
	 * TODO: don't do it in the view
	 * 
	 * Controller: ManageBackgroundsViewController
	 * 
	 * Offers functions for the manage backgrounds view.
	 */
	function ManageBackgroundsViewController($q, data, errorHandler, Error, server) {
		var controller = this;
		
		/*
		 * TODO: comments
		 */
		var backgrounds = [];
		
		/*
		 * TODO: comments
		 */
		function loadDependencies() {
			// Gets the backgrounds
			server.getBackgrounds().then(function(output) {
				// Initializes an array for the deferred tasks' promises
				var promises = [];
				
				// Prepares the data service
				data.prepare([
					'backgrounds'
				]);
				
				// Gets the backgrounds
				for (var i = 0; i < output.length; i++) {
					promises.push(data.getBackground(output[i].id)); // TODO: don't use .id, it will be an array of IDs
				}
				
				return $q.all(promises);
			}).then(function(newBackgrounds) {
				// Sets the backgrounds
				backgrounds = newBackgrounds;
			}, function(serverResponse) {
				// The server responded with an HTTP error
				var error = Error.createFromServerResponse(serverResponse);
				errorHandler.reportError(error);
			});
		}
		
		/*
		 * TODO: comments
		 */
		controller.getBackgrounds = function() {
			return backgrounds;
		};
		
		/*
		 * Returns the URL of the view's template.
		 */
		controller.getTemplateUrl = function() {
			return 'templates/views/manage-backgrounds-view.html';
		};
		
		/*
		 * Returns the title of the page when the view is active.
		 */
		controller.getTitle = function() {
			return 'Administrar antecedentes patológicos - ETRS';
		};
		
		// Loads the view's dependencies
		loadDependencies();
	}
})();
