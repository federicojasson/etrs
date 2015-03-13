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
	angular.module('app.view.medication').controller('MedicationViewController', [
		'$stateParams',
		'server',
		MedicationViewController
	]);
	
	/**
	 * Represents the medication view.
	 */
	function MedicationViewController($stateParams, server) {
		var _this = this;
		
		/**
		 * The medication.
		 */
		var medication = null;
		
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
			return 'app/view/medication/medication.html';
		};
		
		/**
		 * Returns the title to be set when the view is ready.
		 */
		_this.getTitle = function() {
			return medication.name;
		};
		
		/**
		 * Determines whether the view is ready.
		 */
		_this.isReady = function() {
			return ready;
		};
		
		/**
		 * Gets the medication.
		 * 
		 * Receives the medication's ID.
		 */
		function getMedication(id) {
			// Defines the input to be sent to the server
			var input = {
				id: id
			};
			
			// TODO: use data service
			
			// Gets the medication
			server.medication.get(input).then(function(output) {
				// Sets the medication
				medication = output;
				
				ready = true;
			});
		}
		
		/**
		 * Performs initialization tasks.
		 */
		function initialize() {
			// Gets the URL parameters
			var id = $stateParams.id;
			
			// Gets the medication
			getMedication(id);
		}
		
		// ---------------------------------------------------------------------
		
		// Initializes the view
		initialize();
	}
})();
