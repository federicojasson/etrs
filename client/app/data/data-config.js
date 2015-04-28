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
				
				CognitiveTest: [
					'$q',
					'data',
					function($q, data) {
						return function(cognitiveTest, depth) {
							// Initializes a deferred task
							var deferredTask = $q.defer();
							
							// Gets the references
							var creatorPromise = data.getReference('CognitiveTest', 'User', 'creator', cognitiveTest.creator, depth);
							var lastEditorPromise = data.getReference('CognitiveTest', 'User', 'lastEditor', cognitiveTest.lastEditor, depth);
							
							$q.all({
								creator: creatorPromise,
								lastEditor: lastEditorPromise
							}).then(function(values) {
								// Sets the references
								cognitiveTest.creator = values.creator;
								cognitiveTest.lastEditor = values.lastEditor;
								
								// Resolves the deferred task
								deferredTask.resolve(cognitiveTest);
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
				
				ImagingTest: [
					'$q',
					'data',
					function($q, data) {
						return function(imagingTest, depth) {
							// Initializes a deferred task
							var deferredTask = $q.defer();
							
							// Gets the references
							var creatorPromise = data.getReference('ImagingTest', 'User', 'creator', imagingTest.creator, depth);
							var lastEditorPromise = data.getReference('ImagingTest', 'User', 'lastEditor', imagingTest.lastEditor, depth);
							
							$q.all({
								creator: creatorPromise,
								lastEditor: lastEditorPromise
							}).then(function(values) {
								// Sets the references
								imagingTest.creator = values.creator;
								imagingTest.lastEditor = values.lastEditor;
								
								// Resolves the deferred task
								deferredTask.resolve(imagingTest);
							});
							
							// Gets the promise of the deferred task
							return deferredTask.promise;
						};
					}
				],
				
				LaboratoryTest: [
					'$q',
					'data',
					function($q, data) {
						return function(laboratoryTest, depth) {
							// Initializes a deferred task
							var deferredTask = $q.defer();
							
							// Gets the references
							var creatorPromise = data.getReference('LaboratoryTest', 'User', 'creator', laboratoryTest.creator, depth);
							var lastEditorPromise = data.getReference('LaboratoryTest', 'User', 'lastEditor', laboratoryTest.lastEditor, depth);
							
							$q.all({
								creator: creatorPromise,
								lastEditor: lastEditorPromise
							}).then(function(values) {
								// Sets the references
								laboratoryTest.creator = values.creator;
								laboratoryTest.lastEditor = values.lastEditor;
								
								// Resolves the deferred task
								deferredTask.resolve(laboratoryTest);
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
				
				MedicalAntecedent: [
					'$q',
					'data',
					function($q, data) {
						return function(medicalAntecedent, depth) {
							// Initializes a deferred task
							var deferredTask = $q.defer();
							
							// Gets the references
							var creatorPromise = data.getReference('MedicalAntecedent', 'User', 'creator', medicalAntecedent.creator, depth);
							var lastEditorPromise = data.getReference('MedicalAntecedent', 'User', 'lastEditor', medicalAntecedent.lastEditor, depth);
							
							$q.all({
								creator: creatorPromise,
								lastEditor: lastEditorPromise
							}).then(function(values) {
								// Sets the references
								medicalAntecedent.creator = values.creator;
								medicalAntecedent.lastEditor = values.lastEditor;
								
								// Resolves the deferred task
								deferredTask.resolve(medicalAntecedent);
							});
							
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
				
				Patient: [
					'$q',
					'data',
					'utility',
					function($q, data, utility) {
						return function(patient, depth) {
							// Filters the appropriate fields
							patient.birthDate = utility.stringToDate(patient.birthDate);
							
							// Initializes a deferred task
							var deferredTask = $q.defer();
							
							// Gets the references
							var creatorPromise = data.getReference('Patient', 'User', 'creator', patient.creator, depth);
							var lastEditorPromise = data.getReference('Patient', 'User', 'lastEditor', patient.lastEditor, depth);
							
							$q.all({
								creator: creatorPromise,
								lastEditor: lastEditorPromise
							}).then(function(values) {
								// Sets the references
								patient.creator = values.creator;
								patient.lastEditor = values.lastEditor;
								
								// Resolves the deferred task
								deferredTask.resolve(patient);
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
							var inviterPromise = data.getReference('User', 'User', 'inviter', user.inviter, depth);
							
							$q.all({
								inviter: inviterPromise
							}).then(function(values) {
								// Sets the references
								user.inviter = values.inviter;
								
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
