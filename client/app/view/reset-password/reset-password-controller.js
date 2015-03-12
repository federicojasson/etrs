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
		 * Indicates whether the view is ready, considering the local factors.
		 * 
		 * Since it considers only the local factors, it doesn't necessarily
		 * determine on its own whether the view is ready.
		 */
		var ready = false;
		
		/**
		 * Returns the URL of the template.
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
		 * Authenticates the reset-password permission.
		 * 
		 * Receives the credentials of the reset-password permission.
		 */
		function authenticateResetPasswordPermission(credentials) {
			// Defines the input to be sent to the server
			var input = {
				credentials: credentials
			};
			
			// Authenticates the reset-password permission
			server.account.resetPassword.authenticate(input).then(function(output) {
				if (! output.authenticated) {
					// The reset-password permission has not been authenticated
					
					// Redirects the user to the home route
					router.redirect('/');
					
					return;
				}
				
				ready = true;
			});
		}
		
		/**
		 * Performs initialization tasks.
		 */
		function initialize() {
			// Defines the credentials of the reset-password permission
			var credentials = {
				id: $stateParams.id,
				password: $stateParams.password
			};
			
			// Initializes the reset-password action
			var resetPasswordAction = new ResetPasswordAction();
			resetPasswordAction.credentials = credentials;
			resetPasswordAction.notAuthenticatedCallback = onNotAuthenticated;
			resetPasswordAction.startCallback = onStart;
			resetPasswordAction.successCallback = onSuccess;
			
			// Includes the actions
			$scope.action = {
				resetPassword: resetPasswordAction
			};
			
			// Authenticates the reset-password permission
			authenticateResetPasswordPermission(credentials);
		}
		
		/**
		 * Invoked when the reset-password permission is not authenticated
		 * during the execution of the reset-password action.
		 */
		function onNotAuthenticated() {
			ready = true;
			
			// Opens an information dialog
			dialog.openInformation(
				'Credenciales rechazadas',
				'El permiso para restablecer su contraseña ha expirado.',
				function() {
					// Redirects the user to the home route
					router.redirect('/');
				}
			);
		}
		
		/**
		 * Invoked at the start of the reset-password action.
		 */
		function onStart() {
			ready = false;
		}
		
		/**
		 * Invoked when the reset-password action is successful.
		 */
		function onSuccess() {
			ready = true;
			
			// Opens an information dialog
			dialog.openInformation(
				'Contraseña restablecida',
				'Su contraseña ha sido modificada.',
				function() {
					// Redirects the user to the home route
					router.redirect('/');
				}
			);
		}
		
		// ---------------------------------------------------------------------
		
		// Initializes the view
		initialize();
	}
})();
