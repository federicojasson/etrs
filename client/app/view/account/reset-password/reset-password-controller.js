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
	angular.module('app.view.account.resetPassword').controller('ViewAccountResetPasswordController', [
		'$scope',
		'$stateParams',
		'ActionAccountResetPassword',
		'dialog',
		'router',
		'server',
		ViewAccountResetPasswordController
	]);
	
	/**
	 * Represents the account.resetPassword view.
	 */
	function ViewAccountResetPasswordController($scope, $stateParams, ActionAccountResetPassword, dialog, router, server) {
		var _this = this;
		
		/**
		 * Indicates whether the view is ready.
		 */
		var ready = false;
		
		/**
		 * Returns the URL of the template.
		 */
		_this.getTemplateUrl = function() {
			return 'app/view/account/reset-password/reset-password.html';
		};
		
		/**
		 * Returns the title to be shown on the site when the view is ready.
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
		 * TODO: comment
		 */
		function checkOutput(output) {
			// Unlocks the view
			ready = true;
			
			if (output.authenticated) {
				// The reset-password permission has been authenticated
				// Shows an information dialog
				dialog.showInformationDialog(
					'Contraseña restablecida',
					'Su contraseña ha sido modificada.',
					function() {
						// Redirects the user to the home route
						router.redirect('/');
					}
				);
			} else {
				// The reset-password permission has not been authenticated
				// Shows an information dialog
				dialog.showInformationDialog(
					'Credenciales rechazadas',
					'El permiso para restablecer su contraseña ha expirado.'
				);
			}
		}
		
		/**
		 * Performs initialization tasks.
		 */
		function initialize() {
			// Defines the credentials
			var credentials = {
				id: $stateParams.id,
				password: $stateParams.password
			};
			
			// TODO: clean
			server.account.resetPassword.authenticate({
				credentials: credentials
			}).then(function(output) {
				if (output.authenticated) {
					// The reset-password permission has been authenticated
					// Unlocks the view
					ready = true;
				} else {
					// The reset-password permission has not been authenticated
					// Redirects the user to the home route
					router.redirect('/');
				}
			});
			
			// Defines the actions to include
			var actions = {
				account: {
					resetPassword: new ActionAccountResetPassword(credentials)
				}
			};
			
			// Includes the necessary resources
			$scope.actions = actions;
			$scope.checkOutput = checkOutput;
			$scope.lock = lock;
		}
		
		/**
		 * Locks the view.
		 */
		function lock() {
			ready = false;
		}
		
		// ---------------------------------------------------------------------
		
		// Initializes the view
		initialize();
	}
})();
