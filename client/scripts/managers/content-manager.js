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
	 * Service: contentManager
	 * 
	 * Offers functions to manage the application's contents.
	 * 
	 * This service should be used whenever is necessary to get dynamic content.
	 * The loadContents function must be called in order to fetch initially the
	 * mentioned contents.
	 */
	function contentManagerService($q, communicator) {
		var service = this;
		
		/*
		 * The contents.
		 */
		var contents = {
			errors: null,
			honorificTitles: null,
			tasks: null
		};
		
		/*
		 * The deferred object used to asynchronously load the contents.
		 */
		var deferred = null;
		
		/*
		 * Loads the errors and returns a promise.
		 */
		function loadErrors() {
			var request = {
				method: 'GET',
				responseIsArray: false,
				url: 'client/contents/errors.json'
			};
			
			var promise = communicator.sendHttpRequest(request).then(function(response) {
				// Sets the errors
				contents.errors = response;
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
				url: 'client/contents/honorific-titles.json'
			};
			
			var promise = communicator.sendHttpRequest(request).then(function(response) {
				// Sets the honorific titles
				contents.honorificTitles = response;
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
				url: 'client/contents/tasks.json'
			};
			
			var promise = communicator.sendHttpRequest(request).then(function(response) {
				// Sets the tasks
				contents.tasks = response;
			});
			
			return promise;
		}
		
		/*
		 * Returns the errors.
		 */
		service.getErrors = function() {
			return contents.errors;
		};
		
		/*
		 * Returns the honorific titles.
		 */
		service.getHonorificTitles = function() {
			return contents.honorificTitles;
		};
		
		/*
		 * Returns the promise.
		 */
		service.getPromise = function() {
			return deferred.promise;
		};
		
		/*
		 * Returns the tasks.
		 */
		service.getTasks = function() {
			return contents.tasks;
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
