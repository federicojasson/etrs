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
			return 'app/view/sign-up/sign-up.html';
		};
		
		/**
		 * Returns the title to be set when the view is ready.
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
		 * TODO: comment
		 */
		function authenticateSignUpPermission(credentials) {
			// Defines the input to be sent to the server
			var input = {
				credentials: credentials
			};
			
			// Authenticates the sign-up permission
			server.account.signUp.authenticate(input).then(function(output) {
				if (output.authenticated) {
					// The sign-up permission has been authenticated
					// TODO: comment
					ready = true;
				} else {
					// The sign-up permission has not been authenticated
					// Redirects the user to the home route
					router.redirect('/');
				}
			});
		}
		
		/**
		 * TODO: comment
		 */
		function decideName1() { // TODO: rename function
			// TODO: comment
			ready = true;
			
			// Opens an information dialog
			dialog.openInformation(
				'Credenciales rechazadas',
				'El permiso para registrarse ha expirado.',
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
			ready = true;
			
			// Opens an information dialog
			dialog.openInformation(
				'Nombre de usuario no disponible',
				'El nombre de usuario elegido ya se encuentra en uso.\n' +
				'Ingrese otro.'
			);
		}
		
		/**
		 * TODO: comment
		 */
		function decideName3() { // TODO: rename function
			// TODO: comment
			ready = false;
		}
		
		/**
		 * TODO: comment
		 */
		function decideName4() { // TODO: rename function
			// TODO: comment
			ready = true;
			
			// Opens an information dialog
			dialog.openInformation(
				'Usuario registrado',
				'Su cuenta de usuario ha sido registrada.\n' +
				'\n' +
				'No revele nunca su contraseña.\n' +
				'La seguridad de la información es responsabilidad de todos.',
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
			// Initializes the credentials TODO: comment
			var credentials = {
				id: $stateParams.id,
				password: $stateParams.password
			};
			
			// Authenticates the sign-up permission
			authenticateSignUpPermission(credentials);
			
			// Initializes the sign-up action
			var signUpAction = new SignUpAction();
			signUpAction.credentials = credentials;
			signUpAction.notAuthenticatedCallback = decideName1;
			signUpAction.notAvailableCallback = decideName2;
			signUpAction.startCallback = decideName3;
			signUpAction.successCallback = decideName4;
			
			// Includes the actions
			$scope.action = {
				signUp: signUpAction
			};
		}
		
		// ---------------------------------------------------------------------
		
		// Initializes the view
		initialize();
	}
})();
