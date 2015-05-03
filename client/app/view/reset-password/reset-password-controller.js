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
	angular.module('app.view.resetPassword').controller('ResetPasswordViewController', [
		'$scope',
		'$stateParams',
		'ResetPasswordAction',
		'dialog',
		'router',
		'server',
		ResetPasswordViewController
	]);
	
	/**
	 * Represents the reset-password view.
	 */
	function ResetPasswordViewController($scope, $stateParams, ResetPasswordAction, dialog, router, server) {
		var _this = this;
		
		/**
		 * Indicates whether the view is ready.
		 */
		var ready = false;
		
		/**
		 * Returns the template's URL.
		 */
		_this.getTemplateUrl = function() {
			return 'app/view/reset-password/reset-password.html';
		};
		
		/**
		 * Returns the title to be set when the view is ready.
		 */
		_this.getTitle = function() {
			return 'Restablecer contraseña';
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
			var password = $stateParams.password;
			
			// Authenticates the password-reset permission
			server.permission.passwordReset.authenticate({
				credentials: {
					id: id,
					password: password
				}
			}).then(function(output) {
				if (! output.authenticated) {
					// The password-reset permission has not been authenticated
					
					// Redirects the user to the home state
					router.redirect('home');

					// Opens an error dialog
					dialog.openError(
						'Credenciales rechazadas',
						'El permiso para restablecer su contraseña ha sido rechazado.'
					);
					
					return;
				}
				
				// Initializes the actions
				initializeResetPasswordAction(id, password);
				
				ready = true;
			});
		}
		
		/**
		 * Initializes the reset-password action.
		 * 
		 * Receives the password-reset permission's ID and password.
		 */
		function initializeResetPasswordAction(id, password) {
			// Initializes the action
			var action = new ResetPasswordAction();
			
			// Sets inputs' initial values
			action.input.credentials.id.value = id;
			action.input.credentials.password.value = password;
			
			// Registers callbacks
			
			action.startCallback = function() {
				ready = false;
			};
			
			action.notAuthenticatedCallback = function() {
				// Redirects the user to the home state
				router.redirect('home');
				
				// Opens an error dialog
				dialog.openError(
					'Credenciales rechazadas',
					'El permiso para restablecer su contraseña ha expirado.'
				);
			};
			
			action.successCallback = function() {
				// Redirects the user to the home state
				router.redirect('home');
				
				// Opens an information dialog
				dialog.openInformation(
					'Contraseña restablecida',
					'Su contraseña ha sido restablecida.'
				);
			};
			
			// Includes the action
			$scope.resetPasswordAction = action;
		}
		
		// ---------------------------------------------------------------------
		
		// Initializes the controller
		initialize();
	}
})();
