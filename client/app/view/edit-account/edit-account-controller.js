/**
 * NEU-CO - Neuro-Cognitivo
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
	angular.module('app.view.editAccount').controller('EditAccountViewController', [
		'$scope',
		'account',
		'EditAccountAction',
		'data',
		'dialog',
		'router',
		'fullNameFilter',
		EditAccountViewController
	]);
	
	/**
	 * Represents the edit-account view.
	 */
	function EditAccountViewController($scope, account, EditAccountAction, data, dialog, router, fullNameFilter) {
		var _this = this;
		
		/**
		 * Indicates whether the view is ready.
		 */
		var ready = false;
		
		/**
		 * Returns the template's URL.
		 */
		_this.getTemplateUrl = function() {
			return 'app/view/edit-account/edit-account.html';
		};
		
		/**
		 * Returns the title to be set when the view is ready.
		 */
		_this.getTitle = function() {
			return fullNameFilter($scope.user);
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

			// Gets the signed-in user's ID
			var id = account.getSignedInUser().id;
			
			// Resets the data service
			data.reset();
			
			// Gets the user
			data.getUser(id).then(function(user) {
				// Includes the user
				$scope.user = user;
				
				// Initializes actions
				initializeEditAccountAction(user);
				
				ready = true;
			});
		}
		
		/**
		 * Initializes the edit-account action.
		 * 
		 * Receives the user.
		 */
		function initializeEditAccountAction(user) {
			// Initializes the action
			var action = new EditAccountAction();
			
			// Sets inputs' initial values
			action.input.emailAddress.value = user.emailAddress;
			action.input.firstName.value = user.firstName;
			action.input.lastName.value = user.lastName;
			action.input.gender.value = user.gender;
			
			// Registers callbacks
			
			action.startCallback = function() {
				ready = false;
			};
			
			action.notAuthenticatedCallback = function() {
				// Resets inputs' values
				action.input.credentials.password.value = '';
				
				// Opens an error dialog
				dialog.openError(
					'Credenciales rechazadas',
					'No fue posible autenticar su identidad.\n' +
					'Reingrese su contraseña.'
				);
				
				ready = true;
			};
			
			action.successCallback = function() {
				// Refreshes the account
				account.refresh();
				
				// Redirects the user to the account state
				router.redirect('account');
			};
			
			// Includes the action
			$scope.editAccountAction = action;
		}
		
		// ---------------------------------------------------------------------
		
		// Initializes the controller
		initialize();
	}
})();
