// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('classes');
	
	// Factories
	module.factory('TaskGroup', [
		'Task',
		TaskGroupFactory
	]);
	
	/*
	 * Factory: TaskGroup.
	 * 
	 * It represents a user task group.
	 */
	function TaskGroupFactory(Task) {
		/*
		 * Creates a task group array from an array of data objects.
		 */
		TaskGroup.createFromArray = function(dataObjectsArray) {
			// Initializes the task group array
			var taskGroups = [];
			
			// Fills the task group array with task group objects
			for (var i = 0; i < dataObjectsArray.length; i++) {
				taskGroups[i] = TaskGroup.createFromDataObject(dataObjectsArray[i]);
			}
			
			// Returns the task group array
			return taskGroups;
		};
		
		/*
		 * Creates a task group from a data object.
		 */
		TaskGroup.createFromDataObject = function(dataObject) {
			// Initializes the task group data
			var tasks = Task.createFromArray(dataObject.tasks);
			var title = dataObject.title;
			
			// Creates and returns the task group object
			return new TaskGroup(tasks, title);
		};
		
		/*
		 * The task group tasks.
		 */
		TaskGroup.prototype.tasks = null;
		
		/*
		 * The task group title.
		 */
		TaskGroup.prototype.title = null;
		
		/*
		 * Creates an instance of this class.
		 */
		function TaskGroup(tasks, title) {
			this.tasks = tasks;
			this.title = title;
		}
		
		/*
		 * Returns the task group tasks.
		 */
		TaskGroup.prototype.getTasks = function() {
			return this.tasks;
		};
		
		/*
		 * Returns the task group title.
		 */
		TaskGroup.prototype.getTitle = function() {
			return this.title;
		};
		
		// Returns the constructor function
		return TaskGroup;
	}
})();
