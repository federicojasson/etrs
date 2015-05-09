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
	angular.module('app.view.cognitiveTest').controller('CognitiveTestViewController', [
		'$scope',
		'$stateParams',
		'DeleteCognitiveTestAction',
		'data',
		'router',
		CognitiveTestViewController
	]);
	
	/**
	 * Represents the cognitive-test view.
	 */
	function CognitiveTestViewController($scope, $stateParams, DeleteCognitiveTestAction, data, router) {
		var _this = this;
		
		/**
		 * Indicates whether the view is ready.
		 */
		var ready = false;
		
		/**
		 * Returns the template's URL.
		 */
		_this.getTemplateUrl = function() {
			return 'app/view/cognitive-test/cognitive-test.html';
		};
		
		/**
		 * Returns the title to be set when the view is ready.
		 */
		_this.getTitle = function() {
			return $scope.cognitiveTest.name;
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
			data.reset(1, {
				CognitiveTest: [
					'creator',
					'lastEditor'
				]
			});
			
			// Gets the cognitive test
			data.getCognitiveTest(id).then(function(cognitiveTest) {
				// Includes the cognitive test
				$scope.cognitiveTest = cognitiveTest;
				
				// Initializes actions
				initializeDeleteCognitiveTestAction(cognitiveTest);
				
				ready = true;
			});
		}
		
		/**
		 * Initializes the delete-cognitive-test action.
		 * 
		 * Receives the cognitive test.
		 */
		function initializeDeleteCognitiveTestAction(cognitiveTest) {
			// Initializes the action
			var action = new DeleteCognitiveTestAction();
			
			// Sets inputs' initial values
			action.input.id.value = cognitiveTest.id;
			action.input.version.value = cognitiveTest.version;
			
			// Registers callbacks
			
			action.startCallback = function() {
				ready = false;
			};
			
			action.successCallback = function() {
				// Redirects the user to the cognitive-tests state
				router.redirect('cognitiveTests');
			};
			
			// Includes the action
			$scope.deleteCognitiveTestAction = action;
		}
		
		// ---------------------------------------------------------------------
		
		// Initializes the controller
		initialize();
	}
})();
