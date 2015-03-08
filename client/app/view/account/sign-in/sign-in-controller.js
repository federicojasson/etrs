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
	angular.module('app.view.account.signIn').controller('ViewAccountSignInController', [
		'$scope',
		'ActionAccountSignIn',
		'dialog',
		ViewAccountSignInController
	]);
	
	/**
	 * Represents the account.signIn view.
	 */
	function ViewAccountSignInController($scope, ActionAccountSignIn, dialog) {
		var _this = this;
		
		/**
		 * Indicates whether the view is ready.
		 */
		var ready = true;
		
		/**
		 * Returns the URL of the template.
		 */
		_this.getTemplateUrl = function() {
			return 'app/view/account/sign-in/sign-in.html';
		};
		
		/**
		 * Returns the title to be shown on the site when the view is ready.
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
		function checkOutput(output) {
			// Unlocks the view
			ready = true;
			
			if (! output.authenticated) {
				// The user has not been authenticated
				// Shows an information dialog
				dialog.showInformationDialog(
					'Error de autenticación',
					'No fue posible autenticarlo.\n' +
					'Reingrese su nombre de usuario y su contraseña.'
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
					signIn: new ActionAccountSignIn()
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
