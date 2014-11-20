// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('managers');
	
	// Services
	module.service('contentManager', [
		'$q',
		'TaskGroup',
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
	function contentManagerService($q, TaskGroup, communicator) {
		var service = this;
		
		/*
		 * The content.
		 */
		var content = {
			errors: null,
			honorificTitles: null,
			taskGroups: null
		};
		
		/*
		 * The deferred object used to asynchronously load the content.
		 */
		var deferred = null;
		
		/*
		 * Loads the errors and returns a promise.
		 */
		function loadErrors() {
			var request = {
				method: 'GET',
				responseIsArray: false,
				url: 'client/content/errors.json'
			};
			
			var promise = communicator.sendHttpRequest(request).then(function(response) {
				// TODO: how to handle this case? server error class?
				content.errors = response;
			});
			
			return promise;
		}
		
		/*
		 * Loads the honorific titles and returns a promise.
		 */
		function loadHonorificTitles() {
			var request = {
				method: 'GET',
				responseIsArray: false,
				url: 'client/content/honorific-titles.json'
			};
			
			var promise = communicator.sendHttpRequest(request).then(function(response) {
				content.honorificTitles = response;
			});
			
			return promise;
		}
		
		/*
		 * Loads the tasks and returns a promise.
		 */
		function loadTasks() {
			var request = {
				method: 'GET',
				responseIsArray: false,
				url: 'client/content/tasks.json'
			};
			
			var promise = communicator.sendHttpRequest(request).then(function(response) {
				// Initializes the task groups
				var taskGroups = {};
				
				// For each response property (user role), it creates a property
				for (var property in response) {
					if (response.hasOwnProperty(property) && property.lastIndexOf('$', 0) !== 0) {
						// It is not an Angular's property
						taskGroups[property] = TaskGroup.createFromDataArray(response[property]);
					}
				}
				
				// Sets the task groups
				content.taskGroups = taskGroups;
			});
			
			return promise;
		}
		
		/*
		 * Returns the information about an error.
		 * 
		 * It receives the error ID.
		 */
		service.getError = function(errorId) {
			return content.errors[errorId];
		};
		
		/*
		 * Returns the honorific title of a certain kind of user.
		 * 
		 * It receives the user's gender and role.
		 */
		service.getHonorificTitle = function(userGender, userRole) {
			return content.honorificTitles[userRole][userGender];
		};
		
		/*
		 * Returns the promise.
		 */
		service.getPromise = function() {
			return deferred.promise;
		};
		
		/*
		 * Returns the task groups corresponding to a certain kind of user.
		 * 
		 * It receives the user role.
		 */
		service.getTaskGroups = function(userRole) {
			return content.taskGroups[userRole];
		};
		
		/*
		 * Loads the content.
		 */
		service.loadContent = function() {
			// Initializes the deferred object
			deferred = $q.defer();
			
			// Loads the content
			$q.all([
				loadErrors(),
				loadHonorificTitles(),
				loadTasks()
			]).then(function() {
				// Resolves the deferred
				deferred.resolve(service);
			}, function() {
				// Rejects the deferred
				deferred.reject();
			});
		};
	}
})();
