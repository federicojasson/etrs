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
	angular.module('app.data').config([
		'dataProvider',
		config
	]);
	
	/**
	 * Configures the module.
	 */
	function config(dataProvider) {
		/**
		 * Returns the types.
		 */
		function getTypes() {
			return {
				Medicine: [
					'$q',
					'data',
					function($q, data) {
						return function(medicine) {
							// TODO
						};
					}
				],
				
				User: [
					'$q',
					'data',
					function($q, data) {
						return function(user) {
							// TODO: comments

							var deferredTask = $q.defer();

							var creator = user.creator;

							var promises = {
								creator: data.getAssociation('User', 'creator', creator)
							};

							$q.all(promises).then(function(values) {
								user.creator = values.creator;

								deferredTask.resolve(user);
							});

							return deferredTask.promise;
						};
					}
				]
			};
		}
		
		// ---------------------------------------------------------------------
		
		// Gets the types
		var types = getTypes();
		
		// Registers the types
		for (var type in types) {
			if (! types.hasOwnProperty(type)) {
				continue;
			}
			
			dataProvider.registerType(type, types[type]);
		}
	}
})();
