// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('classes');
	
	// Factories
	module.factory('Task', TaskFactory);
	
	/*
	 * Factory: Task.
	 * 
	 * It represents a user task.
	 */
	function TaskFactory() {
		/*
		 * Creates an instance of this class.
		 */
		function Task(description, title, url) {
			this.description = description;
			this.title = title;
			this.url = url;
		}
		
		/*
		 * Creates a task array from an array of data.
		 */
		Task.createFromDataArray = function(dataArray) {
			// Initializes the task array
			var tasks = [];
			
			// Fills the task array with task objects
			for (var i = 0; i < dataArray.length; i++) {
				tasks[i] = Task.createFromData(dataArray[i]);
			}
			
			// Returns the task array
			return tasks;
		};
		
		/*
		 * Creates a task using its data.
		 */
		Task.createFromData = function(data) {
			// Initializes the task data
			var description = data.description;
			var title = data.title;
			var url = data.url;
			
			// Creates and returns the task object
			return new Task(description, title, url);
		};
		
		/*
		 * The task description.
		 */
		Task.prototype.description = null;
		
		/*
		 * The task title.
		 */
		Task.prototype.title = null;
		
		/*
		 * The task URL.
		 */
		Task.prototype.url = null;
		
		/*
		 * Returns the task description.
		 */
		Task.prototype.getDescription = function() {
			return this.description;
		};
		
		/*
		 * Returns the task title.
		 */
		Task.prototype.getTitle = function() {
			return this.title;
		};
		
		/*
		 * Returns the task URL.
		 */
		Task.prototype.getUrl = function() {
			return this.url;
		};
		
		return Task;
	}
})();
