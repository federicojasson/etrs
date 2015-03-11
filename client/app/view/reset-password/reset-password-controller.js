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
		'ResetPasswordAction',
		'dialog',
		'router',
		ResetPasswordViewController
	]);
	
	/**
	 * Represents the reset-password view.
	 */
	function ResetPasswordViewController($scope, ResetPasswordAction, dialog, router) {
		var _this = this;
		
		/**
		 * Indicates whether the view is ready.
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
		 * TODO: comment
		 */
		function decideName1() { // TODO: rename function
			// TODO: comment
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
		 * TODO: comment
		 */
		function decideName2() { // TODO: rename function
			// TODO: comment
			ready = false;
		}
		
		/**
		 * TODO: comment
		 */
		function decideName3() { // TODO: rename function
			// TODO: comment
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
		
		/**
		 * Performs initialization tasks.
		 */
		function initialize() {
			// TODO: credentials
			
			// Initializes the reset-password action
			var resetPasswordAction = new ResetPasswordAction();
			resetPasswordAction.notAuthenticatedCallback = decideName1;
			resetPasswordAction.startCallback = decideName2;
			resetPasswordAction.successCallback = decideName3;
			
			// Includes the actions
			$scope.action = {
				resetPassword: resetPasswordAction
			};
		}
		
		// ---------------------------------------------------------------------
		
		// Initializes the view
		initialize();
	}
})();
