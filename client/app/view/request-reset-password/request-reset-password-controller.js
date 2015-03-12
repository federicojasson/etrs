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
	angular.module('app.view.requestResetPassword').controller('RequestResetPasswordViewController', [
		'$scope',
		'RequestResetPasswordAction',
		'dialog',
		'router',
		RequestResetPasswordViewController
	]);
	
	/**
	 * Represents the request-reset-password view.
	 */
	function RequestResetPasswordViewController($scope, RequestResetPasswordAction, dialog, router) {
		var _this = this;
		
		/**
		 * Indicates whether the view is ready, considering the local factors.
		 * 
		 * Since it considers only the local factors, it doesn't necessarily
		 * determine on its own whether the view is ready.
		 */
		var ready = true;
		
		/**
		 * Returns the URL of the template.
		 */
		_this.getTemplateUrl = function() {
			return 'app/view/request-reset-password/request-reset-password.html';
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
			// Initializes the request-reset-password action
			var requestResetPasswordAction = new RequestResetPasswordAction();
			requestResetPasswordAction.notAuthenticatedCallback = onNotAuthenticated;
			requestResetPasswordAction.startCallback = onStart;
			requestResetPasswordAction.successCallback = onSuccess;
			
			// Includes the actions
			$scope.action = {
				requestResetPassword: requestResetPasswordAction
			};
		}
		
		/**
		 * Invoked when the user is not authenticated during the execution of
		 * the request-reset-password action.
		 */
		function onNotAuthenticated() {
			ready = true;
			
			// Opens an information dialog
			dialog.openInformation(
				'Credenciales rechazadas',
				'No fue posible autenticar su identidad.\n' +
				'\n' +
				'Reingrese su nombre de usuario y su dirección de correo electrónico.\n' +
				'Asegúrese de que la dirección proporcionada corresponda a la utilizada en el sistema.'
			);
		}
		
		/**
		 * Invoked at the start of the request-reset-password action.
		 */
		function onStart() {
			ready = false;
		}
		
		/**
		 * Invoked when the request-reset-password action is successful.
		 */
		function onSuccess() {
			ready = true;
			
			// Opens an information dialog
			dialog.openInformation(
				'Correo electrónico enviado',
				'Se ha enviado un correo electrónico a su casilla.\n' +
				'Para restablecer su contraseña, siga los pasos indicados en el mismo.',
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
