/**
 * ETRS - Eye Tracking Record System
 * Copyright (C) 2015 Federico Jasson
 * 
 * The JavaScript code in this page is free software: you can redistribute it
 * and/or modify it under the terms of the GNU General Public License (GNU GPL)
 * as published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version. The code is distributed
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE. See the GNU GPL for more details.
 * 
 * As additional permission under GNU GPL version 3 section 7, you may
 * distribute non-source (e.g., minimized or compacted) forms of that code
 * without the copy of the GNU GPL normally required by section 4, provided you
 * include this license notice and a URL through which recipients can access the
 * Corresponding Source.
 */

'use strict';

(function() {
	angular.module('app.view.editExperiment').controller('EditExperimentViewController', [
		'$scope',
		'$stateParams',
		'EditExperimentAction',
		'data',
		'router',
		EditExperimentViewController
	]);
	
	/**
	 * Represents the edit-experiment view.
	 */
	function EditExperimentViewController($scope, $stateParams, EditExperimentAction, data, router) {
		var _this = this;
		
		/**
		 * Indicates whether the view is ready.
		 */
		var ready = false;
		
		/**
		 * Returns the template's URL.
		 */
		_this.getTemplateUrl = function() {
			return 'app/view/edit-experiment/edit-experiment.html';
		};
		
		/**
		 * Returns the title to be set when the view is ready.
		 */
		_this.getTitle = function() {
			return $scope.experiment.name;
		};
		
		/**
		 * Determines whether the view is ready.
		 */
		_this.isReady = function() {
			return ready;
		};
		
		/**
		 * Performs initialization tasks.
		 */
		function initialize() {
			// Gets the URL parameters
			var id = $stateParams.id;
			
			// Resets the data service
			data.reset();
			
			// Gets the experiment
			data.getExperiment(id).then(function(experiment) {
				// Includes the experiment
				$scope.experiment = experiment;
				
				// Initializes actions
				initializeEditExperimentAction(experiment);
				
				ready = true;
			});
		}
		
		/**
		 * Initializes the edit-experiment action.
		 * 
		 * Receives the experiment.
		 */
		function initializeEditExperimentAction(experiment) {
			// Initializes the action
			var action = new EditExperimentAction();
			
			// Sets inputs' initial values
			action.input.id.value = experiment.id;
			action.input.version.value = experiment.version;
			action.input.deprecated.value = experiment.deprecated;
			action.input.outputName.value = experiment.outputName;
			action.input.name.value = experiment.name;
			
			// Registers callbacks
			
			action.startCallback = function() {
				ready = false;
			};
			
			action.successCallback = function() {
				// Redirects the user to the experiment state
				router.redirect('experiment', {
					id: experiment.id
				});
			};
			
			// Includes the action
			$scope.editExperimentAction = action;
		}
		
		// ---------------------------------------------------------------------
		
		// Initializes the controller
		initialize();
	}
})();
