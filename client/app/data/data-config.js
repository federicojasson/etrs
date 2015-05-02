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
							}).then(function(references) {
								// Sets the references
								setEntityReferences(clinicalImpression, references);
								
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
							}).then(function(references) {
								// Sets the references
								setEntityReferences(cognitiveTest, references);
								
								// Resolves the deferred task
								deferredTask.resolve(cognitiveTest);
							});
							
							// Gets the promise of the deferred task
							return deferredTask.promise;
						};
					}
				],
				
				Consultation: [
					'$q',
					'data',
					'utility',
					function($q, data, utility) {
						return function(consultation, depth) {
							// Filters the appropriate fields
							consultation.date = utility.stringToDate(consultation.date);
							
							// Defines a function to get test results
							var getTestResults = function(type, referenceType, field, testResults, depth) {
								var testResultPromises = [];
								
								// Gets the test field
								var testField = utility.pascalToCamelCase(referenceType);
								
								// Gets the test results
								for (var i = 0; i < testResults.length; i++) {
									var testResult = testResults[i];
									
									// Gets the test result
									var testResultPromise = {};
									testResultPromise[testField] = data.getReference(type, referenceType, field, testResult[testField], depth);
									testResultPromise['value'] = $q.when(testResult.value);
									
									// Adds the promise of the test result
									testResultPromises.push($q.all(testResultPromise));
								}
								
								return $q.all(testResultPromises);
							};
							
							// Initializes a deferred task
							var deferredTask = $q.defer();
							
							// Gets the references
							var creatorPromise = data.getReference('Consultation', 'User', 'creator', consultation.creator, depth);
							var lastEditorPromise = data.getReference('Consultation', 'User', 'lastEditor', consultation.lastEditor, depth);
							var patientPromise = data.getReference('Consultation', 'Patient', 'patient', consultation.patient, depth);
							var clinicalImpressionPromise = data.getReference('Consultation', 'ClinicalImpression', 'clinicalImpression', consultation.clinicalImpression, depth);
							var diagnosisPromise = data.getReference('Consultation', 'Diagnosis', 'diagnosis', consultation.diagnosis, depth);
							var medicalAntecedentsPromise = data.getReferences('Consultation', 'MedicalAntecedent', 'medicalAntecedents', consultation.medicalAntecedents, depth);
							var medicinesPromise = data.getReferences('Consultation', 'Medicine', 'medicines', consultation.medicines, depth);
							var laboratoryTestResultsPromise = getTestResults('Consultation', 'LaboratoryTest', 'laboratoryTestResults', consultation.laboratoryTestResults, depth);
							var imagingTestResultsPromise = getTestResults('Consultation', 'ImagingTest', 'imagingTestResults', consultation.imagingTestResults, depth);
							var cognitiveTestResultsPromise = getTestResults('Consultation', 'CognitiveTest', 'cognitiveTestResults', consultation.cognitiveTestResults, depth);
							var treatmentsPromise = data.getReferences('Consultation', 'Treatment', 'treatments', consultation.treatments, depth);
							var studiesPromise = data.getReferences('Consultation', 'Study', 'studies', consultation.studies, depth);
							
							$q.all({
								creator: creatorPromise,
								lastEditor: lastEditorPromise,
								patient: patientPromise,
								clinicalImpression: clinicalImpressionPromise,
								diagnosis: diagnosisPromise,
								medicalAntecedents: medicalAntecedentsPromise,
								medicines: medicinesPromise,
								laboratoryTestResults: laboratoryTestResultsPromise,
								imagingTestResults: imagingTestResultsPromise,
								cognitiveTestResults: cognitiveTestResultsPromise,
								treatments: treatmentsPromise,
								studies: studiesPromise
							}).then(function(references) {
								// Sets the references
								setEntityReferences(consultation, references);
								
								// Resolves the deferred task
								deferredTask.resolve(consultation);
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
							}).then(function(references) {
								// Sets the references
								setEntityReferences(diagnosis, references);
								
								// Resolves the deferred task
								deferredTask.resolve(diagnosis);
							});
							
							// Gets the promise of the deferred task
							return deferredTask.promise;
						};
					}
				],
				
				Experiment: [
					'$q',
					'data',
					function($q, data) {
						return function(experiment, depth) {
							// Initializes a deferred task
							var deferredTask = $q.defer();
							
							// Gets the references
							var creatorPromise = data.getReference('Experiment', 'User', 'creator', experiment.creator, depth);
							var lastEditorPromise = data.getReference('Experiment', 'User', 'lastEditor', experiment.lastEditor, depth);
							var filesPromise = data.getReferences('Experiment', 'File', 'files', experiment.files, depth);
							
							$q.all({
								creator: creatorPromise,
								lastEditor: lastEditorPromise,
								files: filesPromise
							}).then(function(references) {
								// Sets the references
								setEntityReferences(experiment, references);
								
								// Resolves the deferred task
								deferredTask.resolve(experiment);
							});
							
							// Gets the promise of the deferred task
							return deferredTask.promise;
						};
					}
				],
				
				File: [
					'$q',
					'data',
					function($q, data) {
						return function(file, depth) {
							// Initializes a deferred task
							var deferredTask = $q.defer();
							
							// Gets the references
							var creatorPromise = data.getReference('File', 'User', 'creator', file.creator, depth);
							var lastEditorPromise = data.getReference('File', 'User', 'lastEditor', file.lastEditor, depth);
							
							$q.all({
								creator: creatorPromise,
								lastEditor: lastEditorPromise
							}).then(function(references) {
								// Sets the references
								setEntityReferences(file, references);
								
								// Resolves the deferred task
								deferredTask.resolve(file);
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
							}).then(function(references) {
								// Sets the references
								setEntityReferences(imagingTest, references);
								
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
							}).then(function(references) {
								// Sets the references
								setEntityReferences(laboratoryTest, references);
								
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
						return function(log) {
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
							}).then(function(references) {
								// Sets the references
								setEntityReferences(medicalAntecedent, references);
								
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
							}).then(function(references) {
								// Sets the references
								setEntityReferences(medicine, references);
								
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
							var consultationsPromise = data.getReferences('Patient', 'Consultation', 'consultations', patient.consultations, depth);
							
							$q.all({
								creator: creatorPromise,
								lastEditor: lastEditorPromise,
								consultations: consultationsPromise
							}).then(function(references) {
								// Sets the references
								setEntityReferences(patient, references);
								
								// Resolves the deferred task
								deferredTask.resolve(patient);
							});
							
							// Gets the promise of the deferred task
							return deferredTask.promise;
						};
					}
				],
				
				Study: [
					'$q',
					'data',
					function($q, data) {
						return function(study, depth) {
							// Initializes a deferred task
							var deferredTask = $q.defer();
							
							// Gets the references
							var creatorPromise = data.getReference('Study', 'User', 'creator', study.creator, depth);
							var lastEditorPromise = data.getReference('Study', 'User', 'lastEditor', study.lastEditor, depth);
							var consultationPromise = data.getReference('Study', 'Consultation', 'consultation', study.consultation, depth);
							var experimentPromise = data.getReference('Study', 'Experiment', 'experiment', study.experiment, depth);
							var inputPromise = data.getReference('Study', 'File', 'input', study.input, depth);
							var outputPromise = data.getReference('Study', 'File', 'output', study.output, depth);
							var filesPromise = data.getReferences('Study', 'File', 'files', study.files, depth);
							
							$q.all({
								creator: creatorPromise,
								lastEditor: lastEditorPromise,
								consultation: consultationPromise,
								experiment: experimentPromise,
								input: inputPromise,
								output: outputPromise,
								files: filesPromise
							}).then(function(references) {
								// Sets the references
								setEntityReferences(study, references);
								
								// Resolves the deferred task
								deferredTask.resolve(study);
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
							}).then(function(references) {
								// Sets the references
								setEntityReferences(treatment, references);
								
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
							}).then(function(references) {
								// Sets the references
								setEntityReferences(user, references);
								
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
		
		/**
		 * Sets an entity's references.
		 * 
		 * Receives the entity and the references.
		 */
		function setEntityReferences(entity, references) {
			// Sets the references
			for (var field in references) {
				if (! references.hasOwnProperty(field)) {
					continue;
				}
				
				entity[field] = references[field];
			}
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
