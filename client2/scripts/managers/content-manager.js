// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('managers');
	
	// Services
	module.service('contentManager', [
		'communication',
		contentManagerService
	]);
	
	/*
	 * Service: contentManager.
	 * 
	 * Offers functions to manage the application's content.
	 * This service should be used whenever is necessary to get dynamic content.
	 * The load function must be called in order to fetch initially the
	 * mentioned content.
	 */
	function contentManagerService(communication) {
		/*
		 * TODO
		 */
		this.isLoading = false;
		
		/*
		 * Adds a listener function for when the load function ends its
		 * execution.
		 */
		this.addListener = function(listener) {
			listeners.push(listener);
		};
		
		/*
		 * Returns a predefined error.
		 * It receives the error ID.
		 */
		this.getError = function(errorId) {
			// TODO
		};
		
		/*
		 * Returns the tasks corresponding to a certain user role.
		 * It receives the user role.
		 */
		this.getTasks = function(userRole) {
			// TODO
		};
		
		/*
		 * Loads the application's content.
		 */
		this.load = function() {
			this.isLoading = true;
			
			// Initializes the loaded count
			loadedCount = 0;
			
			// Loads the different content
			loadContent('errors', 'content/errors.json');
			loadContent('tasks', 'content/tasks.json');
		};
		
		/*
		 * The content.
		 */
		var content = {};
		
		/*
		 * The listener functions.
		 */
		var listeners = [];
		
		/*
		 * Indicates how many content files have been loaded.
		 */
		var loadedCount;
		
		/*
		 * TODO
		 */
		function loadContent(id, url) {
			/*
			 * TODO
			 */
			var onFailure = function() {};
			
			/*
			 * TODO
			 */
			var onSuccess = function(response) {
				// Saves the content
				content[id] = response;
				
				// Increments the loaded count
				loadedCount++;
				
				if (loadedCount === 2) { // TODO: don't hardcore 2 in here
					// All the content has been loaded
					this.isLoading = false;
					notifyListeners();
				}
			};
			
			var callbacks = {
				onFailure: onFailure,
				onSuccess: onSuccess
			};
			
			// Sends a request to get the content
			communication.sendHttpGetRequest(url, {}, true, callbacks);
		}
		
		/*
		 * Notifies the listener.
		 */
		function notifyListeners() {
			for (var i = 0; i < listeners.length; i++) {
				listeners[i]();
			}
		}
	}
})();
