// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('managers');
	
	// Services
	module.service('contentManager', [
		'$q',
		'communicator',
		contentManagerService
	]);
	
	/*
	 * Service: contentManager.
	 * 
	 * Offers functions to manage the application's content.
	 * 
	 * This service should be used whenever is necessary to get dynamic content.
	 * The loadContent function must be called in order to fetch initially the
	 * mentioned content.
	 */
	function contentManagerService($q, communicator) {
		var service = this;
		
		/*
		 * Returns the information about an error.
		 * 
		 * It receives the error ID.
		 */
		service.getError = function(errorId) {
			return content.errors[errorId];
		};
		
		/*
		 * Returns the promise.
		 */
		service.getPromise = function() {
			return deferred.promise;
		};
		
		/*
		 * Returns the tasks corresponding to a certain kind of user.
		 * 
		 * It receives the user role.
		 */
		service.getTasks = function(userRole) {
			return content.tasks[userRole];
		};
		
		/*
		 * Loads the content.
		 */
		service.loadContent = function() {
			// Loads the errors
			loadErrors().then(function(response) {
				// Stores the errors
				content.errors = response;
				
				// Loads the tasks
				return loadTasks();
			}).then(function(response) {
				// Stores the tasks
				content.tasks = response;
				
				// Resolves the deferred
				deferred.resolve(service);
			}, function() {
				// Rejects the deferred
				deferred.reject(); // TODO: set reason?
			});
		};
		
		/*
		 * The content.
		 */
		var content = {
			errors: null,
			tasks: null
		};
		
		/*
		 * The deferred object used to asynchronously load the content.
		 */
		var deferred = $q.defer();
		
		/*
		 * Loads the errors and returns a promise.
		 */
		function loadErrors() {
			var request = {
				method: 'GET',
				responseIsArray: false,
				url: 'content/errors.json'
			};
			
			return communicator.sendHttpRequest(request);
		}
		
		/*
		 * Loads the tasks and returns a promise.
		 */
		function loadTasks() {
			var request = {
				method: 'GET',
				responseIsArray: false,
				url: 'content/tasks.json'
			};
			
			return communicator.sendHttpRequest(request);
		}
	}
})();
