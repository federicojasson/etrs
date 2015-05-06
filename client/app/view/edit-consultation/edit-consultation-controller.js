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
	angular.module('app.view.editConsultation').controller('EditConsultationViewController', [
		'$filter',
		'$q',
		'$scope',
		'$stateParams',
		'EditConsultationAction',
		'data',
		'router',
		'server',
		EditConsultationViewController
	]);
	
	/**
	 * Represents the edit-consultation view.
	 */
	function EditConsultationViewController($filter, $q, $scope, $stateParams, EditConsultationAction, data, router, server) {
		var _this = this;
		
		/**
		 * Indicates whether the view is ready.
		 */
		var ready = false;
		
		/**
		 * Returns the template's URL.
		 */
		_this.getTemplateUrl = function() {
			return 'app/view/edit-consultation/edit-consultation.html';
		};
		
		/**
		 * Returns the title to be set when the view is ready.
		 */
		_this.getTitle = function() {
			return 'Consulta médica del ' + $filter('date')($scope.consultation.date, 'dd/MM/yyyy');
		};
		
		/**
		 * Determines whether the view is ready.
		 */
		_this.isReady = function() {
			return ready;
		};
		
		/**
		 * Gets all clinical impressions.
		 */
		function getAllClinicalImpressions() {
			// Initializes a deferred task
			var deferredTask = $q.defer();
			
			// Gets all clinical impressions
			server.clinicalImpression.getAll().then(function(output) {
				// Gets the clinical impressions
				return data.getClinicalImpressionArray(output.ids);
			}).then(function(clinicalImpressions) {
				// Includes the clinical impressions
				$scope.clinicalImpressions = clinicalImpressions;
				
				// Resolves the deferred task
				deferredTask.resolve();
			});
			
			// Gets the promise of the deferred task
			return deferredTask.promise;
		}
		
		/**
		 * Gets all cognitive tests.
		 */
		function getAllCognitiveTests() {
			// Initializes a deferred task
			var deferredTask = $q.defer();
			
			// Gets all cognitive tests
			server.cognitiveTest.getAll().then(function(output) {
				// Gets the cognitive tests
				return data.getCognitiveTestArray(output.ids);
			}).then(function(cognitiveTests) {
				// Includes the cognitive tests
				$scope.cognitiveTests = cognitiveTests;
				
				// Resolves the deferred task
				deferredTask.resolve();
			});
			
			// Gets the promise of the deferred task
			return deferredTask.promise;
		}
		
		/**
		 * Gets all diagnoses.
		 */
		function getAllDiagnoses() {
			// Initializes a deferred task
			var deferredTask = $q.defer();
			
			// Gets all diagnoses
			server.diagnosis.getAll().then(function(output) {
				// Gets the diagnoses
				return data.getDiagnosisArray(output.ids);
			}).then(function(diagnoses) {
				// Includes the diagnoses
				$scope.diagnoses = diagnoses;
				
				// Resolves the deferred task
				deferredTask.resolve();
			});
			
			// Gets the promise of the deferred task
			return deferredTask.promise;
		}
		
		/**
		 * Gets all imaging tests.
		 */
		function getAllImagingTests() {
			// Initializes a deferred task
			var deferredTask = $q.defer();
			
			// Gets all imaging tests
			server.imagingTest.getAll().then(function(output) {
				// Gets the imaging tests
				return data.getImagingTestArray(output.ids);
			}).then(function(imagingTests) {
				// Includes the imaging tests
				$scope.imagingTests = imagingTests;
				
				// Resolves the deferred task
				deferredTask.resolve();
			});
			
			// Gets the promise of the deferred task
			return deferredTask.promise;
		}
		
		/**
		 * Gets all laboratory tests.
		 */
		function getAllLaboratoryTests() {
			// Initializes a deferred task
			var deferredTask = $q.defer();
			
			// Gets all laboratory tests
			server.laboratoryTest.getAll().then(function(output) {
				// Gets the laboratory tests
				return data.getLaboratoryTestArray(output.ids);
			}).then(function(laboratoryTests) {
				// Includes the laboratory tests
				$scope.laboratoryTests = laboratoryTests;
				
				// Resolves the deferred task
				deferredTask.resolve();
			});
			
			// Gets the promise of the deferred task
			return deferredTask.promise;
		}
		
		/**
		 * Gets all medical antecedents.
		 */
		function getAllMedicalAntecedents() {
			// Initializes a deferred task
			var deferredTask = $q.defer();
			
			// Gets all medical antecedents
			server.medicalAntecedent.getAll().then(function(output) {
				// Gets the medical antecedents
				return data.getMedicalAntecedentArray(output.ids);
			}).then(function(medicalAntecedents) {
				// Includes the medical antecedents
				$scope.medicalAntecedents = medicalAntecedents;
				
				// Resolves the deferred task
				deferredTask.resolve();
			});
			
			// Gets the promise of the deferred task
			return deferredTask.promise;
		}
		
		/**
		 * Gets all medicines.
		 */
		function getAllMedicines() {
			// Initializes a deferred task
			var deferredTask = $q.defer();
			
			// Gets all medicines
			server.medicine.getAll().then(function(output) {
				// Gets the medicines
				return data.getMedicineArray(output.ids);
			}).then(function(medicines) {
				// Includes the medicines
				$scope.medicines = medicines;
				
				// Resolves the deferred task
				deferredTask.resolve();
			});
			
			// Gets the promise of the deferred task
			return deferredTask.promise;
		}
		
		/**
		 * Gets all treatments.
		 */
		function getAllTreatments() {
			// Initializes a deferred task
			var deferredTask = $q.defer();
			
			// Gets all treatments
			server.treatment.getAll().then(function(output) {
				// Gets the treatments
				return data.getTreatmentArray(output.ids);
			}).then(function(treatments) {
				// Includes the treatments
				$scope.treatments = treatments;
				
				// Resolves the deferred task
				deferredTask.resolve();
			});
			
			// Gets the promise of the deferred task
			return deferredTask.promise;
		}
		
		/**
		 * Performs initialization tasks.
		 */
		function initialize() {
			// Gets the URL parameters
			var id = $stateParams.id;
			
			// Includes auxiliary variables
			$scope.section = 0;
			
			// Includes auxiliary functions
			$scope.setSection = setSection;
			
			// Resets the data service
			data.reset();
			
			// Gets the consultation
			data.getConsultation(id).then(function(consultation) {
				// Includes the consultation
				$scope.consultation = consultation;
				
				// Initializes actions
				initializeEditConsultationAction(consultation);
				
				ready = true;
			});
			
			// Gets resources
			$q.all([
				getAllClinicalImpressions(),
				getAllDiagnoses(),
				getAllMedicalAntecedents(),
				getAllMedicines(),
				getAllLaboratoryTests(),
				getAllImagingTests(),
				getAllCognitiveTests(),
				getAllTreatments()
			]).then(function() {
				ready = true;
			});
		}
		
		/**
		 * Initializes the edit-consultation action.
		 * 
		 * Receives the consultation.
		 */
		function initializeEditConsultationAction(consultation) {
			// Initializes the action
			var action = new EditConsultationAction();
			
			// Sets inputs' initial values
			action.input.id.value = consultation.id;
			action.input.version.value = consultation.version;
			action.input.date.value = consultation.date;
			action.input.presentingProblem.value = consultation.presentingProblem;
			action.input.comments.value = consultation.comments;
			action.input.clinicalImpression.value = consultation.clinicalImpression;
			action.input.diagnosis.value = consultation.diagnosis;
			action.input.medicalAntecedents.value = consultation.medicalAntecedents;
			action.input.medicines.value = consultation.medicines;
			action.input.laboratoryTestResults.value = consultation.laboratoryTestResults;
			action.input.imagingTestResults.value = consultation.imagingTestResults;
			action.input.cognitiveTestResults.value = consultation.cognitiveTestResults;
			action.input.treatments.value = consultation.treatments;
			
			// Registers callbacks
			
			action.startCallback = function() {
				ready = false;
			};
			
			action.successCallback = function() {
				// Redirects the user to the consultation state
				router.redirect('consultation', {
					id: consultation.id
				});
			};
			
			// Includes the action
			$scope.editConsultationAction = action;
		}
		
		/**
		 * Sets a section.
		 * 
		 * Receives the section to be set.
		 */
		function setSection(section) {
			$scope.section = section;
		}
		
		// ---------------------------------------------------------------------
		
		// Initializes the controller
		initialize();
	}
})();
