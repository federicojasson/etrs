// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: data
	var module = angular.module('data', [
		'server',
		'utilities'
	]);
	
	// Service: data
	module.service('data', [
		'$q',
		'server',
		'utilities',
		dataService
	]);
	
	/*
	 * Service: data
	 * 
	 * Offers functions to obtain data resources.
	 * 
	 * This service should be used whenever is necessary to get data from the
	 * server. It automatically sends requests and builds the proper objects.
	 * 
	 * The service also offers a cache feature, to avoid unnecessary requests.
	 */
	function dataService($q, server, utilities) {
		var service = this;
		
		/*
		 * The data cache.
		 */
		var cache;
		
		/*
		 * The entities to consider when loading the data.
		 */
		var consideredEntities;
		
		/*
		 * Gets an entity asynchronously and returns a promise that gets
		 * resolved when the object is ready.
		 * 
		 * The function makes use of the cache to avoid unnecesary requests.
		 * 
		 * It receives the entity's ID, its corresponding cache and its load
		 * function, in case it hasn't been loaded yet.
		 */
		function getEntity(entityId, entityCache, entityLoadFunction) {
			// Initializes a deferred task
			var deferredTask = $q.defer();
			
			if (angular.isDefined(entityCache[entityId])) {
				// The entity has already been loaded
				
				// Resolves the deferred task
				deferredTask.resolve(entityCache[entityId]);
			} else {
				// The entity has not been loaded yet
				
				// Loads the entity
				entityLoadFunction(entityId).then(function(entity) {
					// Resolves the deferred task
					deferredTask.resolve(entity);
				}, function(response) {
					// Rejects the deferred task
					deferredTask.reject(response);
				});
			}
			
			// Returns the promise of the deferred task
			return deferredTask.promise;
		}
		
		/*
		 * Loads a background asynchronously and returns a promise that gets
		 * resolved when the object is completely built. The background is
		 * stored in the cache for future requests.
		 * 
		 * Any other data connected with the background is also loaded, taking
		 * into account the entities indicated when the service was prepared.
		 * 
		 * It receives the background's ID.
		 */
		function loadBackground(backgroundId) {
			// Initializes a deferred task
			var deferredTask = $q.defer();
			
			if (consideredEntities.backgrounds) {
				// The backgrounds should be loaded
				
				// Gets the background
				server.getBackground({
					id: backgroundId
				}).then(function(output) {
					var background = output;
					var creator = background.creator;
					
					// Initializes undefined fields with default values
					creator = (angular.isDefined(creator))? creator : null;
					
					// Stores the background in the cache
					cache.backgrounds[backgroundId] = background;
					
					// Initializes an array for the deferred tasks' promises
					var promises = [];
					
					if (creator !== null) {
						// Gets the creator
						promises.push(service.getUser(creator));
					}
					
					$q.all(promises).then(function(values) {
						var index = 0;
						
						if (creator !== null) {
							// Sets the creator
							background.creator = values[index++];
						}
						
						// Resolves the deferred task
						deferredTask.resolve(background);
					}, function(response) {
						// Rejects the deferred task
						deferredTask.reject(response);
					});
				}, function(response) {
					// Rejects the deferred task
					deferredTask.reject(response);
				});
			} else {
				// The backgrounds should not be loaded
				
				// Resolves the deferred task
				deferredTask.resolve(backgroundId);
			}
			
			// Returns the promise of the deferred task
			return deferredTask.promise;
		}
		
		/*
		 * Loads a clinical impression asynchronously and returns a promise that
		 * gets resolved when the object is completely built. The clinical
		 * impression is stored in the cache for future requests.
		 * 
		 * Any other data connected with the clinical impression is also loaded,
		 * taking into account the entities indicated when the service was
		 * prepared.
		 * 
		 * It receives the clinical impression's ID.
		 */
		function loadClinicalImpression(clinicalImpressionId) {
			// Initializes a deferred task
			var deferredTask = $q.defer();
			
			if (consideredEntities.clinicalImpressions) {
				// The clinical impressions should be loaded
				
				// Gets the clinical impression
				server.getClinicalImpression({
					id: clinicalImpressionId
				}).then(function(output) {
					var clinicalImpression = output;
					var creator = clinicalImpression.creator;
					
					// Initializes undefined fields with default values
					creator = (angular.isDefined(creator))? creator : null;
					
					// Stores the clinical impression in the cache
					cache.clinicalImpressions[clinicalImpressionId] = clinicalImpression;
					
					// Initializes an array for the deferred tasks' promises
					var promises = [];
					
					if (creator !== null) {
						// Gets the creator
						promises.push(service.getUser(creator));
					}
					
					$q.all(promises).then(function(values) {
						var index = 0;
						
						if (creator !== null) {
							// Sets the creator
							clinicalImpression.creator = values[index++];
						}
						
						// Resolves the deferred task
						deferredTask.resolve(clinicalImpression);
					}, function(response) {
						// Rejects the deferred task
						deferredTask.reject(response);
					});
				}, function(response) {
					// Rejects the deferred task
					deferredTask.reject(response);
				});
			} else {
				// The clinical impressions should not be loaded
				
				// Resolves the deferred task
				deferredTask.resolve(clinicalImpressionId);
			}
			
			// Returns the promise of the deferred task
			return deferredTask.promise;
		}
		
		/*
		 * Loads a consultation asynchronously and returns a promise that gets
		 * resolved when the object is completely built. The consultation is
		 * stored in the cache for future requests.
		 * 
		 * Any other data connected with the consultation is also loaded, taking
		 * into account the entities indicated when the service was prepared.
		 * 
		 * It receives the consultation's ID.
		 */
		function loadConsultation(consultationId) {
			// Initializes a deferred task
			var deferredTask = $q.defer();
			
			if (consideredEntities.consultations) {
				// The consultations should be loaded
				
				// Gets the consultation
				server.getConsultation({
					id: consultationId
				}).then(function(output) {
					var consultation = output;
					var clinicalImpression = consultation.clinicalImpression;
					var creator = consultation.creator;
					var diagnosis = consultation.diagnosis;
					var patient = consultation.patient;
					var backgrounds = consultation.backgrounds;
					var imageTests = consultation.imageTests;
					var laboratoryTests = consultation.laboratoryTests;
					var medications = consultation.medications;
					var neurocognitiveEvaluations = consultation.neurocognitiveEvaluations;
					var treatments = consultation.treatments;
					
					// Initializes undefined fields with default values
					clinicalImpression = (angular.isDefined(clinicalImpression))? clinicalImpression : null;
					creator = (angular.isDefined(creator))? creator : null;
					diagnosis = (angular.isDefined(diagnosis))? diagnosis : null;
					patient = (angular.isDefined(patient))? patient : null;
					backgrounds = (angular.isDefined(backgrounds))? backgrounds : [];
					imageTests = (angular.isDefined(imageTests))? imageTests : [];
					laboratoryTests = (angular.isDefined(laboratoryTests))? laboratoryTests : [];
					medications = (angular.isDefined(medications))? medications : [];
					neurocognitiveEvaluations = (angular.isDefined(neurocognitiveEvaluations))? neurocognitiveEvaluations : [];
					treatments = (angular.isDefined(treatments))? treatments : [];
					
					// Stores the consultation in the cache
					cache.consultations[consultationId] = consultation;
					
					// Initializes an array for the deferred tasks' promises
					var promises = [];
					
					if (clinicalImpression !== null) {
						// Gets the clinical impression
						promises.push(service.getClinicalImpression(clinicalImpression));
					}
					
					if (creator !== null) {
						// Gets the creator
						promises.push(service.getUser(creator));
					}
					
					if (diagnosis !== null) {
						// Gets the diagnosis
						promises.push(service.getDiagnosis(diagnosis));
					}
					
					if (patient !== null) {
						// Gets the patient
						promises.push(service.getPatient(patient));
					}
					
					// Gets the backgrounds
					for (var i = 0; i < backgrounds.length; i++) {
						promises.push(service.getBackground(backgrounds[i]));
					}
					
					// Gets the image tests
					for (var i = 0; i < imageTests.length; i++) {
						promises.push(service.getImageTest(imageTests[i]));
					}
					
					// Gets the laboratory tests
					for (var i = 0; i < laboratoryTests.length; i++) {
						promises.push(service.getLaboratoryTest(laboratoryTests[i]));
					}
					
					// Gets the medications
					for (var i = 0; i < medications.length; i++) {
						promises.push(service.getMedication(medications[i]));
					}
					
					// Gets the neurocognitive evaluations
					for (var i = 0; i < neurocognitiveEvaluations.length; i++) {
						promises.push(service.getNeurocognitiveEvaluation(neurocognitiveEvaluations[i]));
					}
					
					// Gets the treatments
					for (var i = 0; i < treatments.length; i++) {
						promises.push(service.getTreatment(treatments[i]));
					}
					
					$q.all(promises).then(function(values) {
						var index = 0;
						
						if (clinicalImpression !== null) {
							// Sets the clinical impression
							consultation.clinicalImpression = values[index++];
						}
						
						if (creator !== null) {
							// Sets the creator
							consultation.creator = values[index++];
						}
						
						if (diagnosis !== null) {
							// Sets the diagnosis
							consultation.diagnosis = values[index++];
						}
						
						if (patient !== null) {
							// Sets the patient
							consultation.patient = values[index++];
						}
						
						// Sets the backgrounds
						for (var i = 0; i < backgrounds.length; i++) {
							backgrounds[i] = values[index++];
						}
						
						// Sets the image tests
						for (var i = 0; i < imageTests.length; i++) {
							imageTests[i] = values[index++];
						}
						
						// Sets the laboratory tests
						for (var i = 0; i < laboratoryTests.length; i++) {
							laboratoryTests[i] = values[index++];
						}
						
						// Sets the medications
						for (var i = 0; i < medications.length; i++) {
							medications[i] = values[index++];
						}
						
						// Sets the neurocognitive evaluations
						for (var i = 0; i < neurocognitiveEvaluations.length; i++) {
							neurocognitiveEvaluations[i] = values[index++];
						}
						
						// Sets the treatments
						for (var i = 0; i < treatments.length; i++) {
							treatments[i] = values[index++];
						}
						
						// Resolves the deferred task
						deferredTask.resolve(consultation);
					}, function(response) {
						// Rejects the deferred task
						deferredTask.reject(response);
					});
				}, function(response) {
					// Rejects the deferred task
					deferredTask.reject(response);
				});
			} else {
				// The consultations should not be loaded
				
				// Resolves the deferred task
				deferredTask.resolve(consultationId);
			}
			
			// Returns the promise of the deferred task
			return deferredTask.promise;
		}
		
		/*
		 * Loads a diagnosis asynchronously and returns a promise that gets
		 * resolved when the object is completely built. The diagnosis is stored
		 * in the cache for future requests.
		 * 
		 * Any other data connected with the diagnosis is also loaded, taking
		 * into account the entities indicated when the service was prepared.
		 * 
		 * It receives the diagnosis's ID.
		 */
		function loadDiagnosis(diagnosisId) {
			// Initializes a deferred task
			var deferredTask = $q.defer();
			
			if (consideredEntities.diagnoses) {
				// The diagnoses should be loaded
				
				// Gets the diagnosis
				server.getDiagnosis({
					id: diagnosisId
				}).then(function(output) {
					var diagnosis = output;
					var creator = diagnosis.creator;
					
					// Initializes undefined fields with default values
					creator = (angular.isDefined(creator))? creator : null;
					
					// Stores the diagnosis in the cache
					cache.diagnoses[diagnosisId] = diagnosis;
					
					// Initializes an array for the deferred tasks' promises
					var promises = [];
					
					if (creator !== null) {
						// Gets the creator
						promises.push(service.getUser(creator));
					}
					
					$q.all(promises).then(function(values) {
						var index = 0;
						
						if (creator !== null) {
							// Sets the creator
							diagnosis.creator = values[index++];
						}
						
						// Resolves the deferred task
						deferredTask.resolve(diagnosis);
					}, function(response) {
						// Rejects the deferred task
						deferredTask.reject(response);
					});
				}, function(response) {
					// Rejects the deferred task
					deferredTask.reject(response);
				});
			} else {
				// The diagnoses should not be loaded
				
				// Resolves the deferred task
				deferredTask.resolve(diagnosisId);
			}
			
			// Returns the promise of the deferred task
			return deferredTask.promise;
		}
		
		/*
		 * Loads an experiment asynchronously and returns a promise that gets
		 * resolved when the object is completely built. The experiment is
		 * stored in the cache for future requests.
		 * 
		 * Any other data connected with the experiment is also loaded, taking
		 * into account the entities indicated when the service was prepared.
		 * 
		 * It receives the experiment's ID.
		 */
		function loadExperiment(experimentId) {
			// Initializes a deferred task
			var deferredTask = $q.defer();
			
			if (consideredEntities.experiments) {
				// The experiments should be loaded
				
				// Gets the experiment
				server.getExperiment({
					id: experimentId
				}).then(function(output) {
					var experiment = output;
					var creator = experiment.creator;
					var files = experiment.files;
					
					// Initializes undefined fields with default values
					creator = (angular.isDefined(creator))? creator : null;
					files = (angular.isDefined(files))? files : [];
					
					// Stores the experiment in the cache
					cache.experiments[experimentId] = experiment;
					
					// Initializes an array for the deferred tasks' promises
					var promises = [];
					
					if (creator !== null) {
						// Gets the creator
						promises.push(service.getUser(creator));
					}
					
					// Gets the files
					for (var i = 0; i < files.length; i++) {
						promises.push(service.getFile(files[i]));
					}
					
					$q.all(promises).then(function(values) {
						var index = 0;
						
						if (creator !== null) {
							// Sets the creator
							experiment.creator = values[index++];
						}
						
						// Sets the files
						for (var i = 0; i < files.length; i++) {
							files[i] = values[index++];
						}
						
						// Resolves the deferred task
						deferredTask.resolve(experiment);
					}, function(response) {
						// Rejects the deferred task
						deferredTask.reject(response);
					});
				}, function(response) {
					// Rejects the deferred task
					deferredTask.reject(response);
				});
			} else {
				// The experiments should not be loaded
				
				// Resolves the deferred task
				deferredTask.resolve(experimentId);
			}
			
			// Returns the promise of the deferred task
			return deferredTask.promise;
		}
		
		/*
		 * Loads a file asynchronously and returns a promise that gets resolved
		 * when the object is completely built. The file is stored in the cache
		 * for future requests.
		 * 
		 * Any other data connected with the file is also loaded, taking into
		 * account the entities indicated when the service was prepared.
		 * 
		 * It receives the file's ID.
		 */
		function loadFile(fileId) {
			// Initializes a deferred task
			var deferredTask = $q.defer();
			
			if (consideredEntities.files) {
				// The files should be loaded
				
				// Gets the file
				server.getFile({
					id: fileId
				}).then(function(output) {
					var file = output;
					var creator = file.creator;
					
					// Initializes undefined fields with default values
					creator = (angular.isDefined(creator))? creator : null;
					
					// Stores the file in the cache
					cache.files[fileId] = file;
					
					// Initializes an array for the deferred tasks' promises
					var promises = [];
					
					if (creator !== null) {
						// Gets the creator
						promises.push(service.getUser(creator));
					}
					
					$q.all(promises).then(function(values) {
						var index = 0;
						
						if (creator !== null) {
							// Sets the creator
							file.creator = values[index++];
						}
						
						// Resolves the deferred task
						deferredTask.resolve(file);
					}, function(response) {
						// Rejects the deferred task
						deferredTask.reject(response);
					});
				}, function(response) {
					// Rejects the deferred task
					deferredTask.reject(response);
				});
			} else {
				// The files should not be loaded
				
				// Resolves the deferred task
				deferredTask.resolve(fileId);
			}
			
			// Returns the promise of the deferred task
			return deferredTask.promise;
		}
		
		/*
		 * Loads an image test asynchronously and returns a promise that gets
		 * resolved when the object is completely built. The image test is
		 * stored in the cache for future requests.
		 * 
		 * Any other data connected with the image test is also loaded, taking
		 * into account the entities indicated when the service was prepared.
		 * 
		 * It receives the image test's ID.
		 */
		function loadImageTest(imageTestId) {
			// Initializes a deferred task
			var deferredTask = $q.defer();
			
			if (consideredEntities.imageTests) {
				// The image tests should be loaded
				
				// Gets the image test
				server.getImageTest({
					id: imageTestId
				}).then(function(output) {
					var imageTest = output;
					var creator = imageTest.creator;
					
					// Initializes undefined fields with default values
					creator = (angular.isDefined(creator))? creator : null;
					
					// Stores the image test in the cache
					cache.imageTests[imageTestId] = imageTest;
					
					// Initializes an array for the deferred tasks' promises
					var promises = [];
					
					if (creator !== null) {
						// Gets the creator
						promises.push(service.getUser(creator));
					}
					
					$q.all(promises).then(function(values) {
						var index = 0;
						
						if (creator !== null) {
							// Sets the creator
							imageTest.creator = values[index++];
						}
						
						// Resolves the deferred task
						deferredTask.resolve(imageTest);
					}, function(response) {
						// Rejects the deferred task
						deferredTask.reject(response);
					});
				}, function(response) {
					// Rejects the deferred task
					deferredTask.reject(response);
				});
			} else {
				// The image tests should not be loaded
				
				// Resolves the deferred task
				deferredTask.resolve(imageTestId);
			}
			
			// Returns the promise of the deferred task
			return deferredTask.promise;
		}
		
		/*
		 * Loads a laboratory test asynchronously and returns a promise that
		 * gets resolved when the object is completely built. The laboratory
		 * test is stored in the cache for future requests.
		 * 
		 * Any other data connected with the laboratory test is also loaded,
		 * taking into account the entities indicated when the service was
		 * prepared.
		 * 
		 * It receives the laboratory test's ID.
		 */
		function loadLaboratoryTest(laboratoryTestId) {
			// Initializes a deferred task
			var deferredTask = $q.defer();
			
			if (consideredEntities.laboratoryTests) {
				// The laboratory tests should be loaded
				
				// Gets the laboratory test
				server.getLaboratoryTest({
					id: laboratoryTestId
				}).then(function(output) {
					var laboratoryTest = output;
					var creator = laboratoryTest.creator;
					
					// Initializes undefined fields with default values
					creator = (angular.isDefined(creator))? creator : null;
					
					// Stores the laboratory test in the cache
					cache.laboratoryTests[laboratoryTestId] = laboratoryTest;
					
					// Initializes an array for the deferred tasks' promises
					var promises = [];
					
					if (creator !== null) {
						// Gets the creator
						promises.push(service.getUser(creator));
					}
					
					$q.all(promises).then(function(values) {
						var index = 0;
						
						if (creator !== null) {
							// Sets the creator
							laboratoryTest.creator = values[index++];
						}
						
						// Resolves the deferred task
						deferredTask.resolve(laboratoryTest);
					}, function(response) {
						// Rejects the deferred task
						deferredTask.reject(response);
					});
				}, function(response) {
					// Rejects the deferred task
					deferredTask.reject(response);
				});
			} else {
				// The laboratory tests should not be loaded
				
				// Resolves the deferred task
				deferredTask.resolve(laboratoryTestId);
			}
			
			// Returns the promise of the deferred task
			return deferredTask.promise;
		}
		
		/*
		 * Loads a medication asynchronously and returns a promise that gets
		 * resolved when the object is completely built. The medication is
		 * stored in the cache for future requests.
		 * 
		 * Any other data connected with the medication is also loaded, taking
		 * into account the entities indicated when the service was prepared.
		 * 
		 * It receives the medication's ID.
		 */
		function loadMedication(medicationId) {
			// Initializes a deferred task
			var deferredTask = $q.defer();
			
			if (consideredEntities.medications) {
				// The medications should be loaded
				
				// Gets the medication
				server.getMedication({
					id: medicationId
				}).then(function(output) {
					var medication = output;
					var creator = medication.creator;
					
					// Initializes undefined fields with default values
					creator = (angular.isDefined(creator))? creator : null;
					
					// Stores the medication in the cache
					cache.medications[medicationId] = medication;
					
					// Initializes an array for the deferred tasks' promises
					var promises = [];
					
					if (creator !== null) {
						// Gets the creator
						promises.push(service.getUser(creator));
					}
					
					$q.all(promises).then(function(values) {
						var index = 0;
						
						if (creator !== null) {
							// Sets the creator
							medication.creator = values[index++];
						}
						
						// Resolves the deferred task
						deferredTask.resolve(medication);
					}, function(response) {
						// Rejects the deferred task
						deferredTask.reject(response);
					});
				}, function(response) {
					// Rejects the deferred task
					deferredTask.reject(response);
				});
			} else {
				// The medications should not be loaded
				
				// Resolves the deferred task
				deferredTask.resolve(medicationId);
			}
			
			// Returns the promise of the deferred task
			return deferredTask.promise;
		}
		
		/*
		 * Loads a neurocognitive evaluation asynchronously and returns a
		 * promise that gets resolved when the object is completely built. The
		 * neurocognitive evaluation is stored in the cache for future requests.
		 * 
		 * Any other data connected with the neurocognitive evaluation is also
		 * loaded, taking into account the entities indicated when the service
		 * was prepared.
		 * 
		 * It receives the neurocognitive evaluation's ID.
		 */
		function loadNeurocognitiveEvaluation(neurocognitiveEvaluationId) {
			// Initializes a deferred task
			var deferredTask = $q.defer();
			
			if (consideredEntities.neurocognitiveEvaluations) {
				// The neurocognitive evaluations should be loaded
				
				// Gets the neurocognitive evaluation
				server.getNeurocognitiveEvaluation({
					id: neurocognitiveEvaluationId
				}).then(function(output) {
					var neurocognitiveEvaluation = output;
					var creator = neurocognitiveEvaluation.creator;
					
					// Initializes undefined fields with default values
					creator = (angular.isDefined(creator))? creator : null;
					
					// Stores the neurocognitive evaluation in the cache
					cache.neurocognitiveEvaluations[neurocognitiveEvaluationId] = neurocognitiveEvaluation;
					
					// Initializes an array for the deferred tasks' promises
					var promises = [];
					
					if (creator !== null) {
						// Gets the creator
						promises.push(service.getUser(creator));
					}
					
					$q.all(promises).then(function(values) {
						var index = 0;
						
						if (creator !== null) {
							// Sets the creator
							neurocognitiveEvaluation.creator = values[index++];
						}
						
						// Resolves the deferred task
						deferredTask.resolve(neurocognitiveEvaluation);
					}, function(response) {
						// Rejects the deferred task
						deferredTask.reject(response);
					});
				}, function(response) {
					// Rejects the deferred task
					deferredTask.reject(response);
				});
			} else {
				// The neurocognitive evaluations should not be loaded
				
				// Resolves the deferred task
				deferredTask.resolve(neurocognitiveEvaluationId);
			}
			
			// Returns the promise of the deferred task
			return deferredTask.promise;
		}
		
		/*
		 * Loads a patient asynchronously and returns a promise that gets
		 * resolved when the object is completely built. The patient is stored
		 * in the cache for future requests.
		 * 
		 * Any other data connected with the patient is also loaded, taking into
		 * account the entities indicated when the service was prepared.
		 * 
		 * It receives the patient's ID.
		 */
		function loadPatient(patientId) {
			// Initializes a deferred task
			var deferredTask = $q.defer();
			
			if (consideredEntities.patients) {
				// The patients should be loaded
				
				// Gets the patient
				server.getPatient({
					id: patientId
				}).then(function(output) {
					var patient = output;
					var creator = patient.creator;
					
					// Initializes undefined fields with default values
					creator = (angular.isDefined(creator))? creator : null;
					
					// Stores the patient in the cache
					cache.patients[patientId] = patient;
					
					// Initializes an array for the deferred tasks' promises
					var promises = [];
					
					if (creator !== null) {
						// Gets the creator
						promises.push(service.getUser(creator));
					}
					
					$q.all(promises).then(function(values) {
						var index = 0;
						
						if (creator !== null) {
							// Sets the creator
							patient.creator = values[index++];
						}
						
						// Resolves the deferred task
						deferredTask.resolve(patient);
					}, function(response) {
						// Rejects the deferred task
						deferredTask.reject(response);
					});
				}, function(response) {
					// Rejects the deferred task
					deferredTask.reject(response);
				});
			} else {
				// The patients should not be loaded
				
				// Resolves the deferred task
				deferredTask.resolve(patientId);
			}
			
			// Returns the promise of the deferred task
			return deferredTask.promise;
		}
		
		/*
		 * Loads a study asynchronously and returns a promise that gets resolved
		 * when the object is completely built. The study is stored in the cache
		 * for future requests.
		 * 
		 * Any other data connected with the study is also loaded, taking into
		 * account the entities indicated when the service was prepared.
		 * 
		 * It receives the study's ID.
		 */
		function loadStudy(studyId) {
			// Initializes a deferred task
			var deferredTask = $q.defer();
			
			if (consideredEntities.studies) {
				// The studies should be loaded
				
				// Gets the study
				server.getStudy({
					id: studyId
				}).then(function(output) {
					var study = output;
					var consultation = study.consultation;
					var creator = study.creator;
					var experiment = study.experiment;
					var report = study.report;
					var files = study.files;
					
					// Initializes undefined fields with default values
					consultation = (angular.isDefined(consultation))? consultation : null;
					creator = (angular.isDefined(creator))? creator : null;
					experiment = (angular.isDefined(experiment))? experiment : null;
					report = (angular.isDefined(report))? report : null;
					files = (angular.isDefined(files))? files : [];
					
					// Stores the study in the cache
					cache.studies[studyId] = study;
					
					// Initializes an array for the deferred tasks' promises
					var promises = [];
					
					if (consultation !== null) {
						// Gets the consultation
						promises.push(service.getConsultation(consultation));
					}
					
					if (creator !== null) {
						// Gets the creator
						promises.push(service.getUser(creator));
					}
					
					if (experiment !== null) {
						// Gets the experiment
						promises.push(service.getExperiment(experiment));
					}
					
					if (report !== null) {
						// Gets the report
						promises.push(service.getFile(report));
					}
					
					// Gets the files
					for (var i = 0; i < files.length; i++) {
						promises.push(service.getFile(files[i]));
					}
					
					$q.all(promises).then(function(values) {
						var index = 0;
						
						if (consultation !== null) {
							// Sets the consultation
							study.consultation = values[index++];
						}
						
						if (creator !== null) {
							// Sets the creator
							study.creator = values[index++];
						}
						
						if (experiment !== null) {
							// Sets the experiment
							study.experiment = values[index++];
						}
						
						if (report !== null) {
							// Sets the report
							study.report = values[index++];
						}
						
						// Sets the files
						for (var i = 0; i < files.length; i++) {
							files[i] = values[index++];
						}
						
						// Resolves the deferred task
						deferredTask.resolve(study);
					}, function(response) {
						// Rejects the deferred task
						deferredTask.reject(response);
					});
				}, function(response) {
					// Rejects the deferred task
					deferredTask.reject(response);
				});
			} else {
				// The studies should not be loaded
				
				// Resolves the deferred task
				deferredTask.resolve(studyId);
			}
			
			// Returns the promise of the deferred task
			return deferredTask.promise;
		}
		
		/*
		 * Loads a treatment asynchronously and returns a promise that gets
		 * resolved when the object is completely built. The treatment is stored
		 * in the cache for future requests.
		 * 
		 * Any other data connected with the treatment is also loaded, taking
		 * into account the entities indicated when the service was prepared.
		 * 
		 * It receives the treatment's ID.
		 */
		function loadTreatment(treatmentId) {
			// Initializes a deferred task
			var deferredTask = $q.defer();
			
			if (consideredEntities.treatments) {
				// The treatments should be loaded
				
				// Gets the treatment
				server.getTreatment({
					id: treatmentId
				}).then(function(output) {
					var treatment = output;
					var creator = treatment.creator;
					
					// Initializes undefined fields with default values
					creator = (angular.isDefined(creator))? creator : null;
					
					// Stores the treatment in the cache
					cache.treatments[treatmentId] = treatment;
					
					// Initializes an array for the deferred tasks' promises
					var promises = [];
					
					if (creator !== null) {
						// Gets the creator
						promises.push(service.getUser(creator));
					}
					
					$q.all(promises).then(function(values) {
						var index = 0;
						
						if (creator !== null) {
							// Sets the creator
							treatment.creator = values[index++];
						}
						
						// Resolves the deferred task
						deferredTask.resolve(treatment);
					}, function(response) {
						// Rejects the deferred task
						deferredTask.reject(response);
					});
				}, function(response) {
					// Rejects the deferred task
					deferredTask.reject(response);
				});
			} else {
				// The treatments should not be loaded
				
				// Resolves the deferred task
				deferredTask.resolve(treatmentId);
			}
			
			// Returns the promise of the deferred task
			return deferredTask.promise;
		}
		
		/*
		 * Loads a user asynchronously and returns a promise that gets resolved
		 * when the object is completely built. The user is stored in the cache
		 * for future requests.
		 * 
		 * Any other data connected with the user is also loaded, taking into
		 * account the entities indicated when the service was prepared.
		 * 
		 * It receives the user's ID.
		 */
		function loadUser(userId) {
			// Initializes a deferred task
			var deferredTask = $q.defer();
			
			if (consideredEntities.users) {
				// The users should be loaded
				
				// Gets the user
				server.getUser({
					id: userId
				}).then(function(output) {
					var user = output;
					
					// Stores the user in the cache
					cache.users[userId] = user;
					
					// Resolves the deferred task
					deferredTask.resolve(user);
				}, function(response) {
					// Rejects the deferred task
					deferredTask.reject(response);
				});
			} else {
				// The users should not be loaded
				
				// Resolves the deferred task
				deferredTask.resolve(userId);
			}
			
			// Returns the promise of the deferred task
			return deferredTask.promise;
		}
		
		/*
		 * Gets a background asynchronously and returns a promise that gets
		 * resolved when the object is ready.
		 * 
		 * It receives the background's ID.
		 */
		service.getBackground = function(backgroundId) {
			return getEntity(backgroundId, cache.backgrounds, loadBackground);
		};
		
		/*
		 * Gets a clinical impression asynchronously and returns a promise that
		 * gets resolved when the object is ready.
		 * 
		 * It receives the clinical impression's ID.
		 */
		service.getClinicalImpression = function(clinicalImpressionId) {
			return getEntity(clinicalImpressionId, cache.clinicalImpressions, loadClinicalImpression);
		};
		
		/*
		 * Gets a consultation asynchronously and returns a promise that gets
		 * resolved when the object is ready.
		 * 
		 * It receives the consultation's ID.
		 */
		service.getConsultation = function(consultationId) {
			return getEntity(consultationId, cache.consultations, loadConsultation);
		};
		
		/*
		 * Gets a diagnosis asynchronously and returns a promise that gets
		 * resolved when the object is ready.
		 * 
		 * It receives the diagnosis's ID.
		 */
		service.getDiagnosis = function(diagnosisId) {
			return getEntity(diagnosisId, cache.diagnoses, loadDiagnosis);
		};
		
		/*
		 * Gets an experiment asynchronously and returns a promise that gets
		 * resolved when the object is ready.
		 * 
		 * It receives the experiment's ID.
		 */
		service.getExperiment = function(experimentId) {
			return getEntity(experimentId, cache.experiments, loadExperiment);
		};
		
		/*
		 * Gets a file asynchronously and returns a promise that gets resolved
		 * when the object is ready.
		 * 
		 * It receives the file's ID.
		 */
		service.getFile = function(fileId) {
			return getEntity(fileId, cache.files, loadFile);
		};
		
		/*
		 * Gets an image test asynchronously and returns a promise that gets
		 * resolved when the object is ready.
		 * 
		 * It receives the image test's ID.
		 */
		service.getImageTest = function(imageTestId) {
			return getEntity(imageTestId, cache.imageTests, loadImageTest);
		};
		
		/*
		 * Gets a laboratory test asynchronously and returns a promise that gets
		 * resolved when the object is ready.
		 * 
		 * It receives the laboratory test's ID.
		 */
		service.getLaboratoryTest = function(laboratoryTestId) {
			return getEntity(laboratoryTestId, cache.laboratoryTests, loadLaboratoryTest);
		};
		
		/*
		 * Gets a medication asynchronously and returns a promise that gets
		 * resolved when the object is ready.
		 * 
		 * It receives the medication's ID.
		 */
		service.getMedication = function(medicationId) {
			return getEntity(medicationId, cache.medications, loadMedication);
		};
		
		/*
		 * Gets a neurocognitive evaluation asynchronously and returns a promise
		 * that gets resolved when the object is ready.
		 * 
		 * It receives the neurocognitive evaluation's ID.
		 */
		service.getNeurocognitiveEvaluation = function(neurocognitiveEvaluationId) {
			return getEntity(neurocognitiveEvaluationId, cache.neurocognitiveEvaluations, loadNeurocognitiveEvaluation);
		};
		
		/*
		 * Gets a patient asynchronously and returns a promise that gets
		 * resolved when the object is ready.
		 * 
		 * It receives the patient's ID.
		 */
		service.getPatient = function(patientId) {
			return getEntity(patientId, cache.patients, loadPatient);
		};
		
		/*
		 * Gets a study asynchronously and returns a promise that gets resolved
		 * when the object is ready.
		 * 
		 * It receives the study's ID.
		 */
		service.getStudy = function(studyId) {
			return getEntity(studyId, cache.studies, loadStudy);
		};
		
		/*
		 * Gets a treatment asynchronously and returns a promise that gets
		 * resolved when the object is ready.
		 * 
		 * It receives the treatment's ID.
		 */
		service.getTreatment = function(treatmentId) {
			return getEntity(treatmentId, cache.treatments, loadTreatment);
		};
		
		/*
		 * Gets a user asynchronously and returns a promise that gets resolved
		 * when the object is ready.
		 * 
		 * It receives the user's ID.
		 */
		service.getUser = function(userId) {
			return getEntity(userId, cache.users, loadUser);
		};
		
		/*
		 * Prepares the service to start fetching data. The function clears the
		 * cache and sets the entities to consider when loading the data.
		 * 
		 * It receives the entities to consider.
		 */
		service.prepare = function(newConsideredEntities) {
			// Clears the cache
			cache = {
				backgrounds: [],
				clinicalImpressions: [],
				consultations: [],
				diagnoses: [],
				experiments: [],
				files: [],
				imageTests: [],
				laboratoryTests: [],
				medications: [],
				neurocognitiveEvaluations: [],
				patients: [],
				studies: [],
				treatments: [],
				users: []
			};
			
			// Sets the entities to consider
			consideredEntities = utilities.mergeObjects(newConsideredEntities, {
				backgrounds: false,
				clinicalImpressions: false,
				consultations: false,
				diagnoses: false,
				experiments: false,
				files: false,
				imageTests: false,
				laboratoryTests: false,
				medications: false,
				neurocognitiveEvaluations: false,
				patients: false,
				studies: false,
				treatments: false,
				users: false
			});
		};
	}
})();
