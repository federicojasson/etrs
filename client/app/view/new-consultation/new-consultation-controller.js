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
	angular.module('app.view.newConsultation').controller('NewConsultationViewController', [
		'$q',
		'$scope',
		'$stateParams',
		'CreateConsultationAction',
		'data',
		'Input',
		'router',
		'server',
		'utility',
		NewConsultationViewController
	]);
	
	/**
	 * Represents the new-consultation view.
	 */
	function NewConsultationViewController($q, $scope, $stateParams, CreateConsultationAction, data, Input, router, server, utility) {
		var _this = this;
		
		/**
		 * Indicates whether the view is ready.
		 */
		var ready = false;
		
		/**
		 * Returns the template's URL.
		 */
		_this.getTemplateUrl = function() {
			return 'app/view/new-consultation/new-consultation.html';
		};
		
		/**
		 * Returns the title to be set when the view is ready.
		 */
		_this.getTitle = function() {
			return 'Nueva consulta médica';
		};
		
		/**
		 * Determines whether the view is ready.
		 */
		_this.isReady = function() {
			return ready;
		};
		
		/**
		 * Creates the consultation.
		 */
		function createConsultation() {
			// Prepares the create-consultation action to be executed
			
			$scope.createConsultationAction.input.medicalAntecedents.value = [];
			for (var i = 0; i < $scope.medicalAntecedents.length; i++) {
				if ($scope.medicalAntecedents[i].checked) {
					$scope.createConsultationAction.input.medicalAntecedents.value.push($scope.medicalAntecedents[i].medicalAntecedent.id);
				}
			}
			
			$scope.createConsultationAction.input.medicines.value = [];
			for (var i = 0; i < $scope.medicines.length; i++) {
				if ($scope.medicines[i].checked) {
					$scope.createConsultationAction.input.medicines.value.push($scope.medicines[i].medicine.id);
				}
			}
			
			$scope.createConsultationAction.input.laboratoryTestResults.value = [];
			for (var i = 0; i < $scope.laboratoryTests.length; i++) {
				if ($scope.laboratoryTests[i].checked) {
					$scope.createConsultationAction.input.laboratoryTestResults.value.push({
						laboratoryTest: $scope.laboratoryTests[i].laboratoryTest.id,
						value: $scope.laboratoryTests[i].input.value
					});
				}
			}
			
			$scope.createConsultationAction.input.laboratoryTestResults.validator = function() {
				var valid = true;
				
				for (var i = 0; i < $scope.laboratoryTests.length; i++) {
					if ($scope.laboratoryTests[i].checked) {
						var input = $scope.laboratoryTests[i].input;
						input.message = '';
						input.validate();
						valid &= input.valid;
					}
				}
				
				return valid;
			};
			
			$scope.createConsultationAction.input.imagingTestResults.value = [];
			for (var i = 0; i < $scope.imagingTests.length; i++) {
				if ($scope.imagingTests[i].checked) {
					$scope.createConsultationAction.input.imagingTestResults.value.push({
						imagingTest: $scope.imagingTests[i].imagingTest.id,
						value: $scope.imagingTests[i].input.value
					});
				}
			}
			
			$scope.createConsultationAction.input.imagingTestResults.validator = function() {
				var valid = true;
				
				for (var i = 0; i < $scope.imagingTests.length; i++) {
					if ($scope.imagingTests[i].checked) {
						var input = $scope.imagingTests[i].input;
						input.message = '';
						input.validate();
						valid &= input.valid;
					}
				}
				
				return valid;
			};
			
			$scope.createConsultationAction.input.cognitiveTestResults.value = [];
			for (var i = 0; i < $scope.cognitiveTests.length; i++) {
				if ($scope.cognitiveTests[i].checked) {
					$scope.createConsultationAction.input.cognitiveTestResults.value.push({
						cognitiveTest: $scope.cognitiveTests[i].cognitiveTest.id,
						value: $scope.cognitiveTests[i].input.value
					});
				}
			}
			
			$scope.createConsultationAction.input.cognitiveTestResults.validator = function() {
				var valid = true;
				
				for (var i = 0; i < $scope.cognitiveTests.length; i++) {
					if ($scope.cognitiveTests[i].checked) {
						var input = $scope.cognitiveTests[i].input;
						input.message = '';
						input.validate();
						valid &= input.valid;
					}
				}
				
				return valid;
			};
			
			$scope.createConsultationAction.input.treatments.value = [];
			for (var i = 0; i < $scope.treatments.length; i++) {
				if ($scope.treatments[i].checked) {
					$scope.createConsultationAction.input.treatments.value.push($scope.treatments[i].treatment.id);
				}
			}
			
			// Executes the action
			$scope.createConsultationAction.execute();
			
			$scope.showInvalidInputAlert = true;
		}
		
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
				// Adds metadata to the cognitive tests
				for (var i = 0; i < cognitiveTests.length; i++) {
					cognitiveTests[i] = {
						cognitiveTest: cognitiveTests[i],
						checked: false,
						input: new Input()
					};
				}
				
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
				// Adds metadata to the imaging tests
				for (var i = 0; i < imagingTests.length; i++) {
					imagingTests[i] = {
						imagingTest: imagingTests[i],
						checked: false,
						input: new Input()
					};
				}
				
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
				// Adds metadata to the laboratory tests
				for (var i = 0; i < laboratoryTests.length; i++) {
					laboratoryTests[i] = {
						laboratoryTest: laboratoryTests[i],
						checked: false,
						input: new Input()
					};
				}
				
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
		 * 
		 * Receives the patient's ID.
		 */
		function getAllMedicalAntecedents(id) {
			// Initializes a deferred task
			var deferredTask = $q.defer();
			
			// Gets all medical antecedents
			server.medicalAntecedent.getAll().then(function(output) {
				// Gets the medical antecedents
				return data.getMedicalAntecedentArray(output.ids);
			}).then(function(medicalAntecedents) {
				// Adds metadata to the medical antecedents
				for (var i = 0; i < medicalAntecedents.length; i++) {
					medicalAntecedents[i] = {
						medicalAntecedent: medicalAntecedents[i],
						checked: false
					};
				}
				
				// Includes the medical antecedents
				$scope.medicalAntecedents = medicalAntecedents;
				
				// Gets the patient
				return data.getPatient(id);
			}).then(function(patient) {
				// Gets the number of consultations of the patient
				var length = patient.consultations.length;
				
				if (length > 0) {
					// The patient has at least one consultation
					
					// Gets the medical antecedents of the most recent
					var medicalAntecedents = patient.consultations[length - 1].medicalAntecedents;
					
					// Checks the medical antecedents
					for (var i = 0; i < $scope.medicalAntecedents.length; i++) {
						if (utility.inArray($scope.medicalAntecedents[i].medicalAntecedent.id, medicalAntecedents)) {
							$scope.medicalAntecedents[i].checked = true;
						}
					}
				}
				
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
				// Adds metadata to the medicines
				for (var i = 0; i < medicines.length; i++) {
					medicines[i] = {
						medicine: medicines[i],
						checked: false
					};
				}
				
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
				// Adds metadata to the treatments
				for (var i = 0; i < treatments.length; i++) {
					treatments[i] = {
						treatment: treatments[i],
						checked: false
					};
				}
				
				// Includes the treatments
				$scope.treatments = treatments;
				
				// Resolves the deferred task
				deferredTask.resolve();
			});
			
			// Gets the promise of the deferred task
			return deferredTask.promise;
		}
		
		/**
		 * Hides the invalid-input alert.
		 */
		function hideInvalidInputAlert() {
			$scope.showInvalidInputAlert = false;
		}
		
		/**
		 * Performs initialization tasks.
		 */
		function initialize() {
			// Gets the URL parameters
			var id = $stateParams.id;
			
			// Includes auxiliary variables
			$scope.section = 0;
			$scope.showInvalidInputAlert = false;
			
			// Includes auxiliary functions
			$scope.createConsultation = createConsultation;
			$scope.hideInvalidInputAlert = hideInvalidInputAlert;
			$scope.setSection = setSection;
			
			// Initializes actions
			initializeCreateConsultationAction(id);
			
			// Resets the data service
			data.reset(1, {
				Patient: [
					'consultations'
				]
			});
			
			// Gets resources
			$q.all([
				getAllClinicalImpressions(),
				getAllDiagnoses(),
				getAllMedicalAntecedents(id),
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
		 * Initializes the create-consultation action.
		 * 
		 * Receives the patient's ID.
		 */
		function initializeCreateConsultationAction(id) {
			// Initializes the action
			var action = new CreateConsultationAction();
			
			// Sets inputs' initial values
			action.input.patient.value = id;
			action.input.clinicalImpression.value = null;
			action.input.diagnosis.value = null;
			
			// Registers callbacks
			
			action.startCallback = function() {
				ready = false;
			};
			
			action.successCallback = function(id) {
				// Redirects the user to the consultation state
				router.redirect('consultation', {
					id: id
				});
			};
			
			// Includes the action
			$scope.createConsultationAction = action;
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
