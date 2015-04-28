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
	angular.module('app.view.editStudy').controller('EditStudyViewController', [
		'$scope',
		'$stateParams',
		'EditStudyAction',
		'data',
		'router',
		EditStudyViewController
	]);
	
	/**
	 * Represents the edit-study view.
	 */
	function EditStudyViewController($scope, $stateParams, EditStudyAction, data, router) {
		var _this = this;
		
		/**
		 * Indicates whether the view is ready.
		 */
		var ready = false;
		
		/**
		 * Returns the template's URL.
		 */
		_this.getTemplateUrl = function() {
			return 'app/view/edit-study/edit-study.html';
		};
		
		/**
		 * Returns the title to be set when the view is ready.
		 */
		_this.getTitle = function() {
			// TODO
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
			
			// Gets the study
			data.getStudy(id).then(function(study) {
				// Includes the study
				$scope.study = study;
				
				// Initializes the actions
				initializeEditStudyAction(study);
				
				ready = true;
			});
		}
		
		/**
		 * Initializes the edit-study action.
		 * 
		 * Receives the study.
		 */
		function initializeEditStudyAction(study) {
			// Initializes the action
			var action = new EditStudyAction();
			
			// Sets inputs' initial values
			// TODO
			
			// Registers the callbacks
			
			action.startCallback = function() {
				ready = false;
			};
			
			action.successCallback = function() {
				// Redirects the user to the study state
				router.redirect('study', {
					id: study.id
				});
			};
			
			// Includes the action
			$scope.editStudyAction = action;
		}
		
		// ---------------------------------------------------------------------
		
		// Initializes the controller
		initialize();
	}
})();
