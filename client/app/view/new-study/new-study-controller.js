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
	angular.module('app.view.newStudy').controller('NewStudyViewController', [
		'$q',
		'$scope',
		'$stateParams',
		'CreateStudyAction',
		'data',
		'router',
		'server',
		NewStudyViewController
	]);
	
	/**
	 * Represents the new-study view.
	 */
	function NewStudyViewController($q, $scope, $stateParams, CreateStudyAction, data, router, server) {
		var _this = this;
		
		/**
		 * Indicates whether the view is ready.
		 */
		var ready = false;
		
		/**
		 * Returns the template's URL.
		 */
		_this.getTemplateUrl = function() {
			return 'app/view/new-study/new-study.html';
		};
		
		/**
		 * Returns the title to be set when the view is ready.
		 */
		_this.getTitle = function() {
			return 'Nuevo estudio';
		};
		
		/**
		 * Determines whether the view is ready.
		 */
		_this.isReady = function() {
			return ready;
		};
		
		/**
		 * Creates the study.
		 */
		function createStudy() {
			// Prepares the create-study action to be executed
			
			if ($scope.input.length === 0) {
				$scope.createStudyAction.input.input.value = '';
			} else {
				$scope.createStudyAction.input.input.value = $scope.input[0];
			}
			
			// Executes the action
			$scope.createStudyAction.execute();
		}
		
		/**
		 * Gets all experiments.
		 */
		function getAllExperiments() {
			// Initializes a deferred task
			var deferredTask = $q.defer();
			
			// Gets all experiments
			server.experiment.getAll().then(function(output) {
				// Gets the experiments
				return data.getExperimentArray(output.ids);
			}).then(function(experiments) {
				// Includes the experiments
				$scope.experiments = experiments;
				
				// Resolves the deferred task
				deferredTask.resolve(experiments);
			});
			
			// Gets the promise of the deferred task
			return deferredTask.promise;
		}
		
		/**
		 * Performs initialization tasks.
		 */
		function initialize() {
			// Gets the URL parameters
			var id = $stateParams.id;
			
			// Includes auxiliary variables
			$scope.input = [];
			
			// Includes auxiliary functions
			$scope.createStudy = createStudy;
			
			// Initializes actions
			initializeCreateStudyAction(id);
			
			// Resets the data service
			data.reset();
			
			// Gets resources
			getAllExperiments().then(function() {
				ready = true;
			});
		}
		
		/**
		 * Initializes the create-study action.
		 * 
		 * Receives the consultation's ID.
		 */
		function initializeCreateStudyAction(id) {
			// Initializes the action
			var action = new CreateStudyAction();
			
			// Sets inputs' initial values
			action.input.consultation.value = id;
			action.input.files.value = [];
			
			// Registers callbacks
			
			action.startCallback = function() {
				ready = false;
			};
			
			action.successCallback = function(id) {
				// Redirects the user to the study state
				router.redirect('study', {
					id: id
				});
			};
			
			// Includes the action
			$scope.createStudyAction = action;
		}
		
		// ---------------------------------------------------------------------
		
		// Initializes the controller
		initialize();
	}
})();
