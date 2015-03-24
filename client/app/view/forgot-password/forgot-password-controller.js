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
	angular.module('app.view.forgotPassword').controller('ForgotPasswordViewController', [
		'$scope',
		'RequestPasswordResetAction',
		'dialog',
		'router',
		ForgotPasswordViewController
	]);
	
	/**
	 * Represents the forgot-password view.
	 */
	function ForgotPasswordViewController($scope, RequestPasswordResetAction, dialog, router) {
		var _this = this;
		
		/**
		 * Indicates whether the view is ready.
		 */
		var ready = true;
		
		/**
		 * Returns the template's URL.
		 */
		_this.getTemplateUrl = function() {
			return 'app/view/forgot-password/forgot-password.html';
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
		 * Includes the request-password-reset action.
		 */
		function includeRequestPasswordResetAction() {
			// Initializes the action
			var action = new RequestPasswordResetAction();
			action.notAuthenticatedCallback = onRequestPasswordResetNotAuthenticated;
			action.startCallback = onRequestPasswordResetStart;
			action.successCallback = onRequestPasswordResetSuccess;
			
			// Includes the action
			$scope.requestPasswordResetAction = action;
		}
		
		/**
		 * Performs initialization tasks.
		 */
		function initialize() {
			// Includes the actions
			includeRequestPasswordResetAction();
		}
		
		/**
		 * Invoked when the user is not authenticated during the execution of
		 * the request-password-reset action.
		 */
		function onRequestPasswordResetNotAuthenticated() {
			ready = true;
			
			// Opens an error dialog
			dialog.openError(
				'Credenciales rechazadas',
				'No fue posible autenticar su identidad.\n' +
				'Reingrese su nombre de usuario y su dirección de correo electrónico.\n' +
				'Asegúrese de que la dirección proporcionada sea la utilizada en el sistema.'
			);
		}
		
		/**
		 * Invoked at the start of the request-password-reset action.
		 */
		function onRequestPasswordResetStart() {
			ready = false;
		}
		
		/**
		 * Invoked when the request-password-reset action is successful.
		 */
		function onRequestPasswordResetSuccess() {
			ready = true;
			
			// TODO: redirect before?
			
			// Opens an information dialog
			dialog.openInformation(
				'Correo electrónico enviado',
				'Se ha enviado un correo electrónico a su casilla.\n' +
				'Para restablecer su contraseña, siga los pasos indicados en el mismo.',
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
