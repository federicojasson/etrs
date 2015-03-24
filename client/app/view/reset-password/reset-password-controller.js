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
		 * Returns the title to set when the view is ready.
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
		 * Includes the reset-password action.
		 */
		function includeResetPasswordAction() {
			// Initializes the action
			var action = new ResetPasswordAction();
			action.notAuthenticatedCallback = onResetPasswordNotAuthenticated;
			action.startCallback = onResetPasswordStart;
			action.successCallback = onResetPasswordSuccess;
			
			// Includes the action
			$scope.resetPasswordAction = action;
		}
		
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
					
					// Redirects the user to the home route
					router.redirect('home');
					
					// TODO: show dialog?
					
					return;
				}
				
				// Includes the actions
				includeResetPasswordAction();
				
				ready = true;
			});
		}
		
		/**
		 * Invoked when the user is not authenticated during the execution of
		 * the reset-password action.
		 */
		function onResetPasswordNotAuthenticated() {
			ready = true;
			
			// TODO: redirect before?
			
			// Opens an error dialog
			dialog.openError(
				'Credenciales rechazadas',
				'El permiso para restablecer su contraseña ha expirado.',
				function() {
					// Redirects the user to the home route
					router.redirect('home');
				}
			);
		}
		
		/**
		 * Invoked at the start of the reset-password action.
		 */
		function onResetPasswordStart() {
			ready = false;
		}
		
		/**
		 * Invoked when the reset-password action is successful.
		 */
		function onResetPasswordSuccess() {
			ready = true;
			
			// TODO: redirect before?
			
			// Opens an information dialog
			dialog.openInformation(
				'Contraseña restablecida',
				'Su contraseña ha sido modificada.',
				function() {
					// Redirects the user to the home route
					router.redirect('home');
				}
			);
		}
		
		// ---------------------------------------------------------------------
		
		// Initializes the controller
		initialize();
	}
})();
