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
	angular.module('app.view.requestSignUp').controller('RequestSignUpViewController', [
		'$scope',
		'RequestSignUpAction',
		'dialog',
		'router',
		RequestSignUpViewController
	]);
	
	/**
	 * Represents the request-sign-up view.
	 */
	function RequestSignUpViewController($scope, RequestSignUpAction, dialog, router) {
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
			return 'app/view/request-sign-up/request-sign-up.html';
		};
		
		/**
		 * Returns the title to be set when the view is ready.
		 */
		_this.getTitle = function() {
			return 'Enviar invitación';
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
				'\n' +
				'Reingrese su contraseña.'
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
				'Invitación enviada',
				'Se ha enviado una invitación a la casilla de correo electrónico indicada.',
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
			// Initializes the request-sign-up action
			var requestSignUpAction = new RequestSignUpAction();
			requestSignUpAction.notAuthenticatedCallback = decideName1;
			requestSignUpAction.startCallback = decideName2;
			requestSignUpAction.successCallback = decideName3;
			
			// Includes the actions
			$scope.action = {
				requestSignUp: requestSignUpAction
			};
		}
		
		// ---------------------------------------------------------------------
		
		// Initializes the view
		initialize();
	}
})();
