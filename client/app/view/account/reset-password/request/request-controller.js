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
	angular.module('app.view.account.resetPassword.request').controller('ViewAccountResetPasswordRequestController', [
		'$scope',
		'ActionAccountResetPasswordRequest',
		'dialog',
		'router',
		ViewAccountResetPasswordRequestController
	]);
	
	/**
	 * Represents the account.resetPassword.request view.
	 */
	function ViewAccountResetPasswordRequestController($scope, ActionAccountResetPasswordRequest, dialog, router) {
		var _this = this;
		
		/**
		 * Returns the URL of the template.
		 */
		_this.getTemplateUrl = function() {
			return 'app/view/account/reset-password/request/request.html';
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
			return true;
		};
		
		/**
		 * TODO: comment
		 */
		function checkRequestResetPasswordPermissionOutput(output) {
			if (output.authenticated) {
				// The user has been authenticated
				// Shows an information dialog
				dialog.showInformationDialog(
					'Solicitud aceptada',
					'Se ha enviado un correo electrónico a su casilla.\n' +
					'Para continuar con el proceso, siga los pasos indicados en el mismo.',
					function() {
						// Redirects the user to the home route
						router.redirect('/');
					}
				);
			} else {
				// The user has not been authenticated
				// Shows an information dialog
				dialog.showInformationDialog(
					'Error de autenticación',
					'No fue posible autenticarlo.\n' +
					'Reingrese su nombre de usuario y su dirección de correo electrónico.\n' +
					'Asegúrese de que la dirección proporcionada corresponda a la utilizada en ETRS.'
				);
			}
		}
		
		/**
		 * Performs initialization tasks.
		 */
		function initialize() {
			// Defines the actions to include
			var actions = {
				account: {
					resetPassword: {
						request: new ActionAccountResetPasswordRequest()
					}
				}
			};
			
			// Includes the necessary resources
			$scope.actions = actions;
			$scope.checkRequestResetPasswordPermissionOutput = checkRequestResetPasswordPermissionOutput;
		}
		
		// ---------------------------------------------------------------------
		
		// Initializes the view
		initialize();
	}
})();
