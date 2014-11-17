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
		 * Creates an instance of this class.
		 */
		function TaskGroup(tasks, title) {
			this.tasks = tasks;
			this.title = title;
		}
		
		/*
		 * Creates a task group array from an array of data.
		 */
		TaskGroup.createFromDataArray = function(dataArray) {
			// Initializes the task group array
			var taskGroups = [];
			
			// Fills the task group array with task group objects
			for (var i = 0; i < dataArray.length; i++) {
				taskGroups[i] = TaskGroup.createFromData(dataArray[i]);
			}
			
			// Returns the task group array
			return taskGroups;
		};
		
		/*
		 * Creates a task group using its data.
		 */
		TaskGroup.createFromData = function(data) {
			// Initializes the task group data
			var tasks = Task.createFromDataArray(data.tasks);
			var title = data.title;
			
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
		
		return TaskGroup;
	}
})();
