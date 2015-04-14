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
				ClinicalImpression: [
					'$q',
					'data',
					function($q, data) {
						return function(clinicalImpression, depth) {
							// Initializes a deferred task
							var deferredTask = $q.defer();
							
							// Gets the references
							var creatorPromise = data.getReference('ClinicalImpression', 'User', 'creator', clinicalImpression.creator, depth);
							var lastEditorPromise = data.getReference('ClinicalImpression', 'User', 'lastEditor', clinicalImpression.lastEditor, depth);
							
							$q.all({
								creator: creatorPromise,
								lastEditor: lastEditorPromise
							}).then(function(values) {
								// Sets the references
								clinicalImpression.creator = values.creator;
								clinicalImpression.lastEditor = values.lastEditor;
								
								// Resolves the deferred task
								deferredTask.resolve(clinicalImpression);
							});
							
							// Gets the promise of the deferred task
							return deferredTask.promise;
						};
					}
				],
				
				Diagnosis: [
					'$q',
					'data',
					function($q, data) {
						return function(diagnosis, depth) {
							// Initializes a deferred task
							var deferredTask = $q.defer();
							
							// Gets the references
							var creatorPromise = data.getReference('Diagnosis', 'User', 'creator', diagnosis.creator, depth);
							var lastEditorPromise = data.getReference('Diagnosis', 'User', 'lastEditor', diagnosis.lastEditor, depth);
							
							$q.all({
								creator: creatorPromise,
								lastEditor: lastEditorPromise
							}).then(function(values) {
								// Sets the references
								diagnosis.creator = values.creator;
								diagnosis.lastEditor = values.lastEditor;
								
								// Resolves the deferred task
								deferredTask.resolve(diagnosis);
							});
							
							// Gets the promise of the deferred task
							return deferredTask.promise;
						};
					}
				],
				
				Log: [
					'$q',
					function($q) {
						return function(log, depth) {
							// Initializes a deferred task
							var deferredTask = $q.defer();
							
							// Resolves the deferred task
							deferredTask.resolve(log);
							
							// Gets the promise of the deferred task
							return deferredTask.promise;
						};
					}
				],
				
				Medicine: [
					'$q',
					'data',
					function($q, data) {
						return function(medicine, depth) {
							// Initializes a deferred task
							var deferredTask = $q.defer();
							
							// Gets the references
							var creatorPromise = data.getReference('Medicine', 'User', 'creator', medicine.creator, depth);
							var lastEditorPromise = data.getReference('Medicine', 'User', 'lastEditor', medicine.lastEditor, depth);
							
							$q.all({
								creator: creatorPromise,
								lastEditor: lastEditorPromise
							}).then(function(values) {
								// Sets the references
								medicine.creator = values.creator;
								medicine.lastEditor = values.lastEditor;
								
								// Resolves the deferred task
								deferredTask.resolve(medicine);
							});
							
							// Gets the promise of the deferred task
							return deferredTask.promise;
						};
					}
				],
				
				Treatment: [
					'$q',
					'data',
					function($q, data) {
						return function(treatment, depth) {
							// Initializes a deferred task
							var deferredTask = $q.defer();
							
							// Gets the references
							var creatorPromise = data.getReference('Treatment', 'User', 'creator', treatment.creator, depth);
							var lastEditorPromise = data.getReference('Treatment', 'User', 'lastEditor', treatment.lastEditor, depth);
							
							$q.all({
								creator: creatorPromise,
								lastEditor: lastEditorPromise
							}).then(function(values) {
								// Sets the references
								treatment.creator = values.creator;
								treatment.lastEditor = values.lastEditor;
								
								// Resolves the deferred task
								deferredTask.resolve(treatment);
							});
							
							// Gets the promise of the deferred task
							return deferredTask.promise;
						};
					}
				],
				
				User: [
					'$q',
					'data',
					function($q, data) {
						return function(user, depth) {
							// Initializes a deferred task
							var deferredTask = $q.defer();
							
							// Gets the references
							var creatorPromise = data.getReference('User', 'User', 'creator', user.creator, depth);
							
							$q.all({
								creator: creatorPromise
							}).then(function(values) {
								// Sets the references
								user.creator = values.creator;
								
								// Resolves the deferred task
								deferredTask.resolve(user);
							});
							
							// Gets the promise of the deferred task
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
