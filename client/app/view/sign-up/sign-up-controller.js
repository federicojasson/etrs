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
	angular.module('app.view.signUp').controller('SignUpViewController', [
		'$scope',
		'$stateParams',
		'SignUpAction',
		'dialog',
		'router',
		'server',
		SignUpViewController
	]);
	
	/**
	 * Represents the sign-up view.
	 */
	function SignUpViewController($scope, $stateParams, SignUpAction, dialog, router, server) {
		var _this = this;
		
		/**
		 * Indicates whether the view is ready.
		 */
		var ready = false;
		
		/**
		 * Returns the template's URL.
		 */
		_this.getTemplateUrl = function() {
			return 'app/view/sign-up/sign-up.html';
		};
		
		/**
		 * Returns the title to set when the view is ready.
		 */
		_this.getTitle = function() {
			return 'Registrarse';
		};
		
		/**
		 * Determines whether the view is ready.
		 */
		_this.isReady = function() {
			return ready;
		};
		
		/**
		 * Includes the sign-up action.
		 * 
		 * Receives the sign-up permission's ID and password.
		 */
		function includeSignUpAction(id, password) {
			// Initializes the action
			var action = new SignUpAction();
			action.input.credentials.id.value = id;
			action.input.credentials.password.value = password;
			action.notAuthenticatedCallback = onSignUpNotAuthenticated;
			action.notAvailableCallback = onSignUpNotAvailable;
			action.startCallback = onSignUpStart;
			action.successCallback = onSignUpSuccess;
			
			// Includes the action
			$scope.signUpAction = action;
		}
		
		/**
		 * Performs initialization tasks.
		 */
		function initialize() {
			// Gets the URL parameters
			var id = $stateParams.id;
			var password = $stateParams.password;
			
			// Authenticates the sign-up permission
			server.permission.signUp.authenticate({
				credentials: {
					id: id,
					password: password
				}
			}).then(function(output) {
				if (! output.authenticated) {
					// The sign-up permission has not been authenticated
					
					// Invokes the not-authenticated callback
					onSignUpNotAuthenticated();
					
					return;
				}
				
				// Includes the actions
				includeSignUpAction(id, password);
				
				ready = true;
			});
		}
		
		/**
		 * Invoked when the sign-up permission is not authenticated during the
		 * execution of the sign-up action.
		 */
		function onSignUpNotAuthenticated() {
			// Redirects the user to the home route
			router.redirect('home');
			
			// Opens an error dialog
			dialog.openError(
				'Credenciales rechazadas',
				'El permiso para registrarse ha expirado.'
			);
		}
		
		/**
		 * Invoked when the user ID provided to the sign-up action is not
		 * available.
		 */
		function onSignUpNotAvailable() {
			ready = true;
			
			// Opens an error dialog
			dialog.openError(
				'Nombre de usuario no disponible',
				'El nombre de usuario elegido ya se encuentra en uso.\n' +
				'Ingrese otro.'
			);
		}
		
		/**
		 * Invoked at the start of the sign-up action.
		 */
		function onSignUpStart() {
			ready = false;
		}
		
		/**
		 * Invoked when the sign-up action is successful.
		 */
		function onSignUpSuccess() {
			// Redirects the user to the home route
			router.redirect('home');
			
			// Opens an information dialog
			dialog.openInformation(
				'Cuenta de usuario creada',
				'Su cuenta de usuario ha sido creada.\n' +
				'No revele nunca su contraseña.\n' +
				'\n' +
				'La seguridad de la información es responsabilidad de todos.'
			);
		}
		
		// ---------------------------------------------------------------------
		
		// Initializes the controller
		initialize();
	}
})();
