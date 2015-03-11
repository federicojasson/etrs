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
	angular.module('app.view.signIn').controller('SignInViewController', [
		'$scope',
		'SignInAction',
		'dialog',
		SignInViewController
	]);
	
	/**
	 * Represents the sign-in view.
	 */
	function SignInViewController($scope, SignInAction, dialog) {
		var _this = this;
		
		/**
		 * Indicates whether the view is ready.
		 */
		var ready = true;
		
		/**
		 * Returns the URL of the template.
		 */
		_this.getTemplateUrl = function() {
			return 'app/view/sign-in/sign-in.html';
		};
		
		/**
		 * Returns the title to be set when the view is ready.
		 */
		_this.getTitle = function() {
			return 'Iniciar sesión';
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
				'No fue posible autenticar su identidad.\n' +
				'Reingrese su nombre de usuario y su contraseña.'
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
		 * Performs initialization tasks.
		 */
		function initialize() {
			// Initializes the sign-in action
			var signInAction = new SignInAction();
			signInAction.notAuthenticatedCallback = decideName1;
			signInAction.startCallback = decideName2;
			
			// Includes the actions
			$scope.action = {
				signIn: signInAction
			};
		}
		
		// ---------------------------------------------------------------------
		
		// Initializes the view
		initialize();
	}
})();
