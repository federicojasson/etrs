/**
 * NEU-CO - Neuro-Cognitivo
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
		'inputValidator',
		'Input',
		'router',
		'server',
		'utility',
		EditConsultationViewController
	]);
	
	/**
	 * Represents the edit-consultation view.
	 */
	function EditConsultationViewController($filter, $q, $scope, $stateParams, EditConsultationAction, data, inputValidator, Input, router, server, utility) {
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
		 * Edits the consultation.
		 */
		function editConsultation() {
			// Prepares the edit-consultation action to be executed
			
			$scope.editConsultationAction.input.medicalAntecedents.value = [];
			for (var i = 0; i < $scope.medicalAntecedents.length; i++) {
				if ($scope.medicalAntecedents[i].checked) {
					$scope.editConsultationAction.input.medicalAntecedents.value.push($scope.medicalAntecedents[i].medicalAntecedent.id);
				}
			}
			
			$scope.editConsultationAction.input.medicines.value = [];
			for (var i = 0; i < $scope.medicines.length; i++) {
				if ($scope.medicines[i].checked) {
					$scope.editConsultationAction.input.medicines.value.push($scope.medicines[i].medicine.id);
				}
			}
			
			$scope.editConsultationAction.input.laboratoryTestResults.value = [];
			for (var i = 0; i < $scope.laboratoryTests.length; i++) {
				if ($scope.laboratoryTests[i].checked) {
					$scope.editConsultationAction.input.laboratoryTestResults.value.push({
						laboratoryTest: $scope.laboratoryTests[i].laboratoryTest.id,
						value: $scope.laboratoryTests[i].input.value
					});
				}
			}
			
			$scope.editConsultationAction.input.laboratoryTestResults.validator = function() {
				var valid = true;
				
				for (var i = 0; i < $scope.laboratoryTests.length; i++) {
					if ($scope.laboratoryTests[i].checked) {
						valid &= inputValidator.isInputValid($scope.laboratoryTests[i].input);
					}
				}
				
				return valid;
			};
			
			$scope.editConsultationAction.input.imagingTestResults.value = [];
			for (var i = 0; i < $scope.imagingTests.length; i++) {
				if ($scope.imagingTests[i].checked) {
					$scope.editConsultationAction.input.imagingTestResults.value.push({
						imagingTest: $scope.imagingTests[i].imagingTest.id,
						value: $scope.imagingTests[i].input.value
					});
				}
			}
			
			$scope.editConsultationAction.input.imagingTestResults.validator = function() {
				var valid = true;
				
				for (var i = 0; i < $scope.imagingTests.length; i++) {
					if ($scope.imagingTests[i].checked) {
						valid &= inputValidator.isInputValid($scope.imagingTests[i].input);
					}
				}
				
				return valid;
			};
			
			$scope.editConsultationAction.input.cognitiveTestResults.value = [];
			for (var i = 0; i < $scope.cognitiveTests.length; i++) {
				if ($scope.cognitiveTests[i].checked) {
					$scope.editConsultationAction.input.cognitiveTestResults.value.push({
						cognitiveTest: $scope.cognitiveTests[i].cognitiveTest.id,
						value: $scope.cognitiveTests[i].input.value
					});
				}
			}
			
			$scope.editConsultationAction.input.cognitiveTestResults.validator = function() {
				var valid = true;
				
				for (var i = 0; i < $scope.cognitiveTests.length; i++) {
					if ($scope.cognitiveTests[i].checked) {
						valid &= inputValidator.isInputValid($scope.cognitiveTests[i].input);
					}
				}
				
				return valid;
			};
			
			$scope.editConsultationAction.input.treatments.value = [];
			for (var i = 0; i < $scope.treatments.length; i++) {
				if ($scope.treatments[i].checked) {
					$scope.editConsultationAction.input.treatments.value.push($scope.treatments[i].treatment.id);
				}
			}
			
			// Executes the action
			$scope.editConsultationAction.execute();
			
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
				utility.filterArray(cognitiveTests, function(cognitiveTest) {
					var checked = false;
					var input = new Input();
					
					var cognitiveTestResult = null;
					for (var i = 0; i < $scope.consultation.cognitiveTestResults.length; i++) {
						if ($scope.consultation.cognitiveTestResults[i].cognitiveTest === cognitiveTest.id) {
							cognitiveTestResult = $scope.consultation.cognitiveTestResults[i];
							break;
						}
					}
					
					if (cognitiveTestResult !== null) {
						checked = true;
						input.value = cognitiveTestResult.value;
					}
					
					return {
						cognitiveTest: cognitiveTest,
						checked: checked,
						input: input
					};
				});
				
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
				utility.filterArray(imagingTests, function(imagingTest) {
					var checked = false;
					var input = new Input();
					
					var imagingTestResult = null;
					for (var i = 0; i < $scope.consultation.imagingTestResults.length; i++) {
						if ($scope.consultation.imagingTestResults[i].imagingTest === imagingTest.id) {
							imagingTestResult = $scope.consultation.imagingTestResults[i];
							break;
						}
					}
					
					if (imagingTestResult !== null) {
						checked = true;
						input.value = imagingTestResult.value;
					}
					
					return {
						imagingTest: imagingTest,
						checked: checked,
						input: input
					};
				});
				
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
				utility.filterArray(laboratoryTests, function(laboratoryTest) {
					var checked = false;
					var input = new Input();
					
					var laboratoryTestResult = null;
					for (var i = 0; i < $scope.consultation.laboratoryTestResults.length; i++) {
						if ($scope.consultation.laboratoryTestResults[i].laboratoryTest === laboratoryTest.id) {
							laboratoryTestResult = $scope.consultation.laboratoryTestResults[i];
							break;
						}
					}
					
					if (laboratoryTestResult !== null) {
						checked = true;
						input.value = laboratoryTestResult.value;
					}
					
					return {
						laboratoryTest: laboratoryTest,
						checked: checked,
						input: input
					};
				});
				
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
				// Adds metadata to the medical antecedents
				utility.filterArray(medicalAntecedents, function(medicalAntecedent) {
					return {
						medicalAntecedent: medicalAntecedent,
						checked: utility.inArray(medicalAntecedent.id, $scope.consultation.medicalAntecedents)
					};
				});
				
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
				// Adds metadata to the medicines
				utility.filterArray(medicines, function(medicine) {
					return {
						medicine: medicine,
						checked: utility.inArray(medicine.id, $scope.consultation.medicines)
					};
				});
				
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
				utility.filterArray(treatments, function(treatment) {
					return {
						treatment: treatment,
						checked: utility.inArray(treatment.id, $scope.consultation.treatments)
					};
				});
				
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
			$scope.editConsultation = editConsultation;
			$scope.hideInvalidInputAlert = hideInvalidInputAlert;
			$scope.setSection = setSection;
			
			// Resets the data service
			data.reset();
			
			// Gets the consultation
			data.getConsultation(id).then(function(consultation) {
				// Includes the consultation
				$scope.consultation = consultation;
				
				// Initializes actions
				initializeEditConsultationAction(consultation);
				
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
			action.input.patientImpression.value = consultation.patientImpression;
			action.input.presentingProblem.value = consultation.presentingProblem;
			action.input.comments.value = consultation.comments;
			action.input.clinicalImpression.value = consultation.clinicalImpression;
			action.input.diagnosis.value = consultation.diagnosis;
			
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
