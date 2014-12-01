// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: helpers
	var module = angular.module('helpers');
	
	// Service: resources
	module.service('resources', [
		'$q',
		'server',
		resourcesService
	]);
	
	/*
	 * Service: resources
	 * 
	 * TODO: comments
	 */
	function resourcesService($q, server) {
		var service = this;
		
		/*
		 * TODO
		 */
		var fields;
		
		/*
		 * TODO
		 */
		var resources;
		
		/*
		 * TODO
		 */
		function loadConsultation(consultationId) {
			// Gets the loaded consultations
			var consultations = resources.consultations;
			
			if (angular.isDefined(consultations[consultationId])) {
				// The consultation has already been loaded
				return consultations[consultationId];
			}
			
			// Initializes the consultation
			var consultation = {
				id: consultationId
			};
			
			// Stores the consultation
			consultations[consultationId] = consultation;
			
			//  Initializes an array for the promises
			var promises = [];
			
			// Loads the data according to the specified fields
			var consultationFields = fields.consultation;
			
			if (consultationFields.imageAnalysis) {
				var promise = server.getConsultationImageAnalysis(consultationId);
				promises.push(promise);
				
				promise.then(function(imageAnalysis) {
					consultation.imageAnalysis = imageAnalysis;
				});
			}
			
			if (consultationFields.laboratoryResults) {
				var promise = server.getConsultationLaboratoryResults(consultationId);
				promises.push(promise);
				
				promise.then(function(laboratoryResults) {
					consultation.laboratoryResults = laboratoryResults;
				});
			}
			
			if (consultationFields.mainData) {
				var promise = server.getConsultationMainData(consultationId);
				promises.push(promise);
				
				promise.then(function(mainData) {
					consultation.mainData = mainData;
				});
			}
			
			if (consultationFields.metadata) {
				var promise = server.getConsultationMetadata(consultationId);
				promises.push(promise);
				
				promise.then(function(metadata) {
					consultation.metadata = metadata;
					promises.push(loadConsultationMetadata(consultation));
				});
			}
			
			if (consultationFields.neurocognitiveAssessment) {
				var promise = server.getConsultationNeurocognitiveAssessment(consultationId);
				promises.push(promise);
				
				promise.then(function(neurocognitiveAssessment) {
					consultation.neurocognitiveAssessment = neurocognitiveAssessment;
				});
			}
			
			if (consultationFields.patientBackground) {
				var promise = server.getConsultationPatientBackground(consultationId);
				promises.push(promise);
				
				promise.then(function(patientBackground) {
					consultation.patientBackground = patientBackground;
				});
			}
			
			if (consultationFields.patientMedications) {
				var promise = server.getConsultationPatientMedications(consultationId);
				promises.push(promise);
				
				promise.then(function(patientMedications) {
					consultation.patientMedications = patientMedications;
				});
			}
			
			if (consultationFields.treatments) {
				var promise = server.getConsultationTreatments(consultationId);
				promises.push(promise);
				
				promise.then(function(treatments) {
					consultation.treatments = treatments;
				});
			}
			
			// Waits for the consultation to get loaded
			return waitTasks(promises, consultation);
		}
		
		/*
		 * TODO
		 */
		function loadConsultationMetadata(consultation) {
			// Gets the metadata
			var metadata = consultation.metadata;
			
			//  Initializes an array for the promises
			var promises = [];
			
			// Loads the metadata
			
			{
				var promise = loadUser(metadata.creator);
				promises.push(promise);
				
				promise.then(function(creator) {
					metadata.creator = creator;
				});
			}
			
			{
				var promise = loadPatient(metadata.patient);
				promises.push(promise);
				
				promise.then(function(patient) {
					metadata.patient = patient;
				});
			}
			
			// Waits for the metadata to get loaded
			return waitTasks(promises);
		}
		
		/*
		 * TODO
		 */
		function loadExperiment(experimentId) {
			// Gets the loaded experiments
			var experiments = resources.experiments;
			
			if (angular.isDefined(experiments[experimentId])) {
				// The experiment has already been loaded
				return experiments[experimentId];
			}
			
			// Initializes the experiment
			var experiment = {
				id: experimentId
			};
			
			// Stores the experiment
			experiments[experimentId] = experiment;
			
			//  Initializes an array for the promises
			var promises = [];
			
			// Loads the data according to the specified fields
			var experimentFields = fields.experiment;
			
			if (experimentFields.files) {
				var promise = server.getExperimentFiles(experimentId);
				promises.push(promise);
				
				promise.then(function(files) {
					experiment.files = files;
					promises.push(loadExperimentFiles(experiment));
				});
			}
			
			if (experimentFields.mainData) {
				var promise = server.getExperimentMainData(experimentId);
				promises.push(promise);
				
				promise.then(function(mainData) {
					experiment.mainData = mainData;
				});
			}
			
			if (experimentFields.metadata) {
				var promise = server.getExperimentMetadata(experimentId);
				promises.push(promise);
				
				promise.then(function(metadata) {
					experiment.metadata = metadata;
					promises.push(loadExperimentMetadata(experiment));
				});
			}
			
			// Waits for the experiment to get loaded
			return waitTasks(promises, experiment);
		}
		
		/*
		 * TODO
		 */
		function loadExperimentFiles(experiment) {
			// Gets the files
			var files = experiment.files;
			
			//  Initializes an array for the promises
			var promises = [];
			
			// Loads the files
			for (var i = 0; i < files.length; i++) {
				var promise = loadFile(files[i]);
				promises.push(promise);
				
				promise.then(function(file) {
					files[i] = file;
				});
			}
			
			// Waits for the files to get loaded
			return waitTasks(promises);
		}
		
		/*
		 * TODO
		 */
		function loadExperimentMetadata(experiment) {
			// Gets the metadata
			var metadata = experiment.metadata;
			
			//  Initializes an array for the promises
			var promises = [];
			
			// Loads the metadata
			
			{
				var promise = loadUser(metadata.creator);
				promises.push(promise);
				
				promise.then(function(creator) {
					metadata.creator = creator;
				});
			}
			
			// Waits for the metadata to get loaded
			return waitTasks(promises);
		}
		
		/*
		 * TODO
		 */
		function loadFile(fileId) {
			// Gets the loaded files
			var files = resources.files;
			
			if (angular.isDefined(files[fileId])) {
				// The file has already been loaded
				return files[fileId];
			}
			
			// Initializes the file
			var file = {
				id: fileId
			};
			
			// Stores the file
			files[fileId] = file;
			
			//  Initializes an array for the promises
			var promises = [];
			
			// Loads the data according to the specified fields
			var fileFields = fields.file;
			
			if (fileFields.mainData) {
				var promise = server.getFileMainData(fileId);
				promises.push(promise);
				
				promise.then(function(mainData) {
					file.mainData = mainData;
				});
			}
			
			if (fileFields.metadata) {
				var promise = server.getFileMetadata(fileId);
				promises.push(promise);
				
				promise.then(function(metadata) {
					file.metadata = metadata;
					promises.push(loadFileMetadata(file));
				});
			}
			
			// Waits for the file to get loaded
			return waitTasks(promises, file);
		}
		
		/*
		 * TODO
		 */
		function loadFileMetadata(file) {
			// Gets the metadata
			var metadata = file.metadata;
			
			//  Initializes an array for the promises
			var promises = [];
			
			// Loads the metadata
			
			{
				var promise = loadUser(metadata.creator);
				promises.push(promise);
				
				promise.then(function(creator) {
					metadata.creator = creator;
				});
			}
			
			// Waits for the metadata to get loaded
			return waitTasks(promises);
		}
		
		/*
		 * TODO
		 */
		function loadPatient(patientId) {
			// Gets the loaded patients
			var patients = resources.patients;
			
			if (angular.isDefined(patients[patientId])) {
				// The patient has already been loaded
				return patients[patientId];
			}
			
			// Initializes the patient
			var patient = {
				id: patientId
			};
			
			// Stores the patient
			patients[patientId] = patient;
			
			//  Initializes an array for the promises
			var promises = [];
			
			// Loads the data according to the specified fields
			var patientFields = fields.patient;
			
			if (patientFields.mainData) {
				var promise = server.getPatientMainData(patientId);
				promises.push(promise);
				
				promise.then(function(mainData) {
					patient.mainData = mainData;
				});
			}
			
			if (patientFields.metadata) {
				var promise = server.getPatientMetadata(patientId);
				promises.push(promise);
				
				promise.then(function(metadata) {
					patient.metadata = metadata;
					promises.push(loadPatientMetadata(patient));
				});
			}
			
			// Waits for the patient to get loaded
			return waitTasks(promises, patient);
		}
		
		/*
		 * TODO
		 */
		function loadPatientMetadata(patient) {
			// Gets the metadata
			var metadata = patient.metadata;
			
			//  Initializes an array for the promises
			var promises = [];
			
			// Loads the metadata
			
			{
				var promise = loadUser(metadata.creator);
				promises.push(promise);
				
				promise.then(function(creator) {
					metadata.creator = creator;
				});
			}
			
			// Waits for the metadata to get loaded
			return waitTasks(promises);
		}
		
		/*
		 * TODO
		 */
		function loadStudy(studyId) {
			// Gets the loaded studies
			var studies = resources.studies;
			
			if (angular.isDefined(studies[studyId])) {
				// The study has already been loaded
				return studies[studyId];
			}
			
			// Initializes the study
			var study = {
				id: studyId
			};
			
			// Stores the study
			studies[studyId] = study;
			
			//  Initializes an array for the promises
			var promises = [];
			
			// Loads the data according to the specified fields
			var studyFields = fields.study;
			
			if (studyFields.files) {
				var promise = server.getStudyFiles(studyId);
				promises.push(promise);
				
				promise.then(function(files) {
					study.files = files;
					promises.push(loadStudyFiles(study));
				});
			}
			
			if (studyFields.mainData) {
				var promise = server.getStudyMainData(studyId);
				promises.push(promise);
				
				promise.then(function(mainData) {
					study.mainData = mainData;
				});
			}
			
			if (studyFields.metadata) {
				var promise = server.getStudyMetadata(studyId);
				promises.push(promise);
				
				promise.then(function(metadata) {
					study.metadata = metadata;
					promises.push(loadStudyMetadata(study));
				});
			}
			
			// Waits for the study to get loaded
			return waitTasks(promises, study);
		}
		
		/*
		 * TODO
		 */
		function loadStudyFiles(study) {
			// Gets the files
			var files = study.files;
			
			//  Initializes an array for the promises
			var promises = [];
			
			// Loads the files
			for (var i = 0; i < files.length; i++) {
				var promise = loadFile(files[i]);
				promises.push(promise);
				
				promise.then(function(file) {
					files[i] = file;
				});
			}
			
			// Waits for the files to get loaded
			return waitTasks(promises);
		}
		
		/*
		 * TODO
		 */
		function loadStudyMetadata(study) {
			// Gets the metadata
			var metadata = study.metadata;
			
			//  Initializes an array for the promises
			var promises = [];
			
			// Loads the metadata
			
			{
				var promise = loadConsultation(metadata.consultation);
				promises.push(promise);
				
				promise.then(function(consultation) {
					metadata.consultation = consultation;
				});
			}
			
			{
				var promise = loadUser(metadata.creator);
				promises.push(promise);
				
				promise.then(function(creator) {
					metadata.creator = creator;
				});
			}
			
			{
				var promise = loadExperiment(metadata.experiment);
				promises.push(promise);
				
				promise.then(function(experiment) {
					metadata.experiment = experiment;
				});
			}
			
			if (angular.isDefined(metadata.report)) {
				var promise = loadFile(metadata.report);
				promises.push(promise);
				
				promise.then(function(report) {
					metadata.report = report;
				});
			}
			
			// Waits for the metadata to get loaded
			return waitTasks(promises);
		}
		
		/*
		 * TODO
		 */
		function loadUser(userId) {
			// Gets the loaded users
			var users = resources.users;
			
			if (angular.isDefined(users[userId])) {
				// The user has already been loaded
				return users[userId];
			}
			
			// Initializes the user
			var user = {
				id: userId
			};
			
			// Stores the user
			users[userId] = user;
			
			//  Initializes an array for the promises
			var promises = [];
			
			// Loads the data according to the specified fields
			var userFields = fields.user;
			
			if (userFields.mainData) {
				var promise = server.getUserMainData(userId);
				promises.push(promise);
				
				promise.then(function(mainData) {
					user.mainData = mainData;
				});
			}
			
			if (userFields.metadata) {
				var promise = server.getUserMetadata(userId);
				promises.push(promise);
				
				promise.then(function(metadata) {
					user.metadata = metadata;
				});
			}
			
			// Waits for the user to get loaded
			return waitTasks(promises, user);
		}
		
		/*
		 * TODO: comments
		 * TODO: name?
		 */
		function prepareContext(newFields) {
			// Sets the fields to take into account when loading the resources
			fields = newFields;
			
			// Clears the previously loaded resources
			resources = {
				consultations: [],
				experiments: [],
				files: [],
				patients: [],
				studies: [],
				users: []
			};
		}
		
		/*
		 * Waits until a set of tasks get resolved. Optionally, a certain
		 * resource can be returned when this happens.
		 * 
		 * It receives the promises corresponding to the tasks and returns a
		 * promise of the resource.
		 */
		function waitTasks(promises, resource) {
			// Initializes undefined optional parameters with default values
			resource = (angular.isDefined(resource))? resource : null;
			
			// Initializes a deferred task
			var deferred = $q.defer();
			
			// Waits until all tasks are completed
			$q.all(promises).then(function() {
				// Resolves the deferred task
				deferred.resolve(resource);
			}, function() {
				// Rejects the deferred task
				deferred.reject();
			});
			
			// Returns the promise of the deferred task
			return deferred.promise;
		}
		
		/*
		 * TODO
		 */
		service.getConsultation = function(consultationId, fields) {
			prepareContext(fields);
			return loadConsultation(consultationId);
		};
		
		/*
		 * TODO
		 */
		service.getExperiment = function(experimentId, fields) {
			prepareContext(fields);
			return loadExperiment(experimentId);
		};
		
		/*
		 * TODO
		 */
		service.getFile = function(fileId, fields) {
			prepareContext(fields);
			return loadFile(fileId);
		};
		
		/*
		 * TODO
		 */
		service.getPatient = function(patientId, fields) {
			prepareContext(fields);
			return loadPatient(patientId);
		};
		
		/*
		 * TODO
		 */
		service.getStudy = function(studyId, fields) {
			prepareContext(fields);
			return loadStudy(studyId);
		};
		
		/*
		 * TODO
		 */
		service.getUser = function(userId, fields) {
			prepareContext(fields);
			return loadUser(userId);
		};
	}
})();
