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
		 * The fields to take into account when loading the data.
		 */
		var fields;
		
		/*
		 * Loads a consultation asynchronously and returns a promise that gets
		 * resolved when the object is completely built. The consultation is
		 * stored in the cache for future requests.
		 * 
		 * Any other data connected with the consultation is also loaded, taking
		 * into account the fields indicated when the service was prepared.
		 * 
		 * It receives the consultation's ID.
		 */
		function loadConsultation(consultationId) {
			// Initializes a deferred task
			var deferredTask = $q.defer();
			
			// Initializes the consultation
			var consultation = {
				id: consultationId
			};
			
			// Stores the consultation in the cache
			cache.consultations[consultationId] = consultation;
			
			// Initializes an array for the deferred tasks' promises
			var promises = [];
			
			// Loads the data according to the specified fields
			var consultationFields = fields.consultation;
			
			if (consultationFields.imageAnalysis) {
				promises.push(server.getConsultationImageAnalysis({
					id: consultationId
				}));
			}
			
			if (consultationFields.laboratoryResults) {
				promises.push(server.getConsultationLaboratoryResults({
					id: consultationId
				}));
			}
			
			if (consultationFields.mainData) {
				promises.push(server.getConsultationMainData({
					id: consultationId
				}));
			}
			
			if (consultationFields.metadata) {
				promises.push(server.getConsultationMetadata({
					id: consultationId
				}));
			}
			
			if (consultationFields.neurocognitiveAssessment) {
				promises.push(server.getConsultationNeurocognitiveAssessment({
					id: consultationId
				}));
			}
			
			if (consultationFields.patientBackground) {
				promises.push(server.getConsultationPatientBackground({
					id: consultationId
				}));
			}
			
			if (consultationFields.patientMedications) {
				promises.push(server.getConsultationPatientMedications({
					id: consultationId
				}));
			}
			
			if (consultationFields.treatments) {
				promises.push(server.getConsultationTreatments({
					id: consultationId
				}));
			}
			
			// Waits until all tasks are completed
			$q.all(promises).then(function(values) {
				// Sets the obtained values
				var index = 0;
				
				// Initializes an array for the deferred tasks' promises
				var promises = [];
				
				if (consultationFields.imageAnalysis) {
					consultation.imageAnalysis = values[index++];
				}
				
				if (consultationFields.laboratoryResults) {
					consultation.laboratoryResults = values[index++];
				}
				
				if (consultationFields.mainData) {
					consultation.mainData = values[index++];
				}
				
				if (consultationFields.metadata) {
					var metadata = values[index++];
					consultation.metadata = metadata;
					
					var creator = metadata.creator;
					if (creator !== null) {
						promises.push(service.getUser(creator));
					}
					
					var patient = metadata.patient;
					if (patient !== null) {
						promises.push(service.getPatient(patient));
					}
				}
				
				if (consultationFields.neurocognitiveAssessment) {
					consultation.neurocognitiveAssessment = values[index++];
				}
				
				if (consultationFields.patientBackground) {
					consultation.patientBackground = values[index++];
				}
				
				if (consultationFields.patientMedications) {
					consultation.patientMedications = values[index++];
				}
				
				if (consultationFields.treatments) {
					consultation.treatments = values[index++];
				}
				
				return $q.all(promises);
			}).then(function(values) {
				// Sets the obtained values
				var index = 0;
				
				if (consultationFields.metadata) {
					var metadata = consultation.metadata;
					
					if (metadata.creator !== null) {
						metadata.creator = values[index++];
					}
					
					if (metadata.patient !== null) {
						metadata.patient = values[index++];
					}
				}
				
				// Resolves the deferred task
				deferredTask.resolve(consultation);
			}, function(response) {
				// Rejects the deferred task
				deferredTask.reject(response);
			});
			
			// Returns the promise of the deferred task
			return deferredTask.promise;
		}
		
		/*
		 * Loads an experiment asynchronously and returns a promise that gets
		 * resolved when the object is completely built. The experiment is
		 * stored in the cache for future requests.
		 * 
		 * Any other data connected with the experiment is also loaded, taking
		 * into account the fields indicated when the service was prepared.
		 * 
		 * It receives the experiment's ID.
		 */
		function loadExperiment(experimentId) {
			// Initializes a deferred task
			var deferredTask = $q.defer();
			
			// Initializes the experiment
			var experiment = {
				id: experimentId
			};
			
			// Stores the experiment in the cache
			cache.experiments[experimentId] = experiment;
			
			// Initializes an array for the deferred tasks' promises
			var promises = [];
			
			// Loads the data according to the specified fields
			var experimentFields = fields.experiment;
			
			if (experimentFields.files) {
				promises.push(server.getExperimentFiles({
					id: experimentId
				}));
			}
			
			if (experimentFields.mainData) {
				promises.push(server.getExperimentMainData({
					id: experimentId
				}));
			}
			
			if (experimentFields.metadata) {
				promises.push(server.getExperimentMetadata({
					id: experimentId
				}));
			}
			
			// Waits until all tasks are completed
			$q.all(promises).then(function(values) {
				// Sets the obtained values
				var index = 0;
				
				// Initializes an array for the deferred tasks' promises
				var promises = [];
				
				if (experimentFields.files) {
					var files = values[index++];
					experiment.files = files;
					
					for (var i = 0; i < files.length; i++) {
						promises.push(service.getFile(files[i]));
					}
				}
				
				if (experimentFields.mainData) {
					experiment.mainData = values[index++];
				}
				
				if (experimentFields.metadata) {
					var metadata = values[index++];
					experiment.metadata = metadata;
					
					var creator = metadata.creator;
					if (creator !== null) {
						promises.push(service.getUser(creator));
					}
				}
				
				return $q.all(promises);
			}).then(function(values) {
				// Sets the obtained values
				var index = 0;
				
				if (experimentFields.files) {
					var files = experiment.files;
					
					for (var i = 0; i < files.length; i++) {
						files[i] = values[index++];
					}
				}
				
				if (experimentFields.metadata) {
					var metadata = experiment.metadata;
					
					if (metadata.creator !== null) {
						metadata.creator = values[index++];
					}
				}
				
				// Resolves the deferred task
				deferredTask.resolve(experiment);
			}, function(response) {
				// Rejects the deferred task
				deferredTask.reject(response);
			});
			
			// Returns the promise of the deferred task
			return deferredTask.promise;
		}
		
		/*
		 * Loads a file asynchronously and returns a promise that gets resolved
		 * when the object is completely built. The file is stored in the cache
		 * for future requests.
		 * 
		 * Any other data connected with the file is also loaded, taking into
		 * account the fields indicated when the service was prepared.
		 * 
		 * It receives the file's ID.
		 */
		function loadFile(fileId) {
			// Initializes a deferred task
			var deferredTask = $q.defer();
			
			// Initializes the file
			var file = {
				id: fileId
			};
			
			// Stores the file in the cache
			cache.files[fileId] = file;
			
			// Initializes an array for the deferred tasks' promises
			var promises = [];
			
			// Loads the data according to the specified fields
			var fileFields = fields.file;
			
			if (fileFields.mainData) {
				promises.push(server.getFileMainData({
					id: fileId
				}));
			}
			
			if (fileFields.metadata) {
				promises.push(server.getFileMetadata({
					id: fileId
				}));
			}
			
			// Waits until all tasks are completed
			$q.all(promises).then(function(values) {
				// Sets the obtained values
				var index = 0;
				
				// Initializes an array for the deferred tasks' promises
				var promises = [];
				
				if (fileFields.mainData) {
					file.mainData = values[index++];
				}
				
				if (fileFields.metadata) {
					var metadata = values[index++];
					file.metadata = metadata;
					
					var creator = metadata.creator;
					if (creator !== null) {
						promises.push(service.getUser(creator));
					}
				}
				
				return $q.all(promises);
			}).then(function(values) {
				// Sets the obtained values
				var index = 0;
				
				if (fileFields.metadata) {
					var metadata = file.metadata;
					
					if (metadata.creator !== null) {
						metadata.creator = values[index++];
					}
				}
				
				// Resolves the deferred task
				deferredTask.resolve(file);
			}, function(response) {
				// Rejects the deferred task
				deferredTask.reject(response);
			});
			
			// Returns the promise of the deferred task
			return deferredTask.promise;
		}
		
		/*
		 * Loads a patient asynchronously and returns a promise that gets
		 * resolved when the object is completely built. The patient is stored
		 * in the cache for future requests.
		 * 
		 * Any other data connected with the patient is also loaded, taking into
		 * account the fields indicated when the service was prepared.
		 * 
		 * It receives the patient's ID.
		 */
		function loadPatient(patientId) {
			// Initializes a deferred task
			var deferredTask = $q.defer();
			
			// Initializes the patient
			var patient = {
				id: patientId
			};
			
			// Stores the patient in the cache
			cache.patients[patientId] = patient;
			
			// Initializes an array for the deferred tasks' promises
			var promises = [];
			
			// Loads the data according to the specified fields
			var patientFields = fields.patient;
			
			if (patientFields.mainData) {
				promises.push(server.getPatientMainData({
					id: patientId
				}));
			}
			
			if (patientFields.metadata) {
				promises.push(server.getPatientMetadata({
					id: patientId
				}));
			}
			
			// Waits until all tasks are completed
			$q.all(promises).then(function(values) {
				// Sets the obtained values
				var index = 0;
				
				// Initializes an array for the deferred tasks' promises
				var promises = [];
				
				if (patientFields.mainData) {
					patient.mainData = values[index++];
				}
				
				if (patientFields.metadata) {
					var metadata = values[index++];
					patient.metadata = metadata;
					
					var creator = metadata.creator;
					if (creator !== null) {
						promises.push(service.getUser(creator));
					}
				}
				
				return $q.all(promises);
			}).then(function(values) {
				// Sets the obtained values
				var index = 0;
				
				if (patientFields.metadata) {
					var metadata = patient.metadata;
					
					if (metadata.creator !== null) {
						metadata.creator = values[index++];
					}
				}
				
				// Resolves the deferred task
				deferredTask.resolve(patient);
			}, function(response) {
				// Rejects the deferred task
				deferredTask.reject(response);
			});
			
			// Returns the promise of the deferred task
			return deferredTask.promise;
		}
		
		/*
		 * Loads a study asynchronously and returns a promise that gets resolved
		 * when the object is completely built. The study is stored in the cache
		 * for future requests.
		 * 
		 * Any other data connected with the study is also loaded, taking into
		 * account the fields indicated when the service was prepared.
		 * 
		 * It receives the study's ID.
		 */
		function loadStudy(studyId) {
			// Initializes a deferred task
			var deferredTask = $q.defer();
			
			// Initializes the study
			var study = {
				id: studyId
			};
			
			// Stores the study in the cache
			cache.studies[studyId] = study;
			
			// Initializes an array for the deferred tasks' promises
			var promises = [];
			
			// Loads the data according to the specified fields
			var studyFields = fields.study;
			
			if (studyFields.files) {
				promises.push(server.getStudyFiles({
					id: studyId
				}));
			}
			
			if (studyFields.mainData) {
				promises.push(server.getStudyMainData({
					id: studyId
				}));
			}
			
			if (studyFields.metadata) {
				promises.push(server.getStudyMetadata({
					id: studyId
				}));
			}
			
			// Waits until all tasks are completed
			$q.all(promises).then(function(values) {
				// Sets the obtained values
				var index = 0;
				
				// Initializes an array for the deferred tasks' promises
				var promises = [];
				
				if (studyFields.files) {
					var files = values[index++];
					study.files = files;
					
					for (var i = 0; i < files.length; i++) {
						promises.push(service.getFile(files[i]));
					}
				}
				
				if (studyFields.mainData) {
					study.mainData = values[index++];
				}
				
				if (studyFields.metadata) {
					var metadata = values[index++];
					study.metadata = metadata;
					
					var consultation = metadata.consultation;
					if (consultation !== null) {
						promises.push(service.getConsultation(consultation));
					}
					
					var creator = metadata.creator;
					if (creator !== null) {
						promises.push(service.getUser(creator));
					}
					
					var experiment = metadata.experiment;
					if (experiment !== null) {
						promises.push(service.getExperiment(experiment));
					}
					
					var report = metadata.report;
					if (report !== null) {
						promises.push(service.getFile(report));
					}
				}
				
				return $q.all(promises);
			}).then(function(values) {
				// Sets the obtained values
				var index = 0;
				
				if (studyFields.files) {
					var files = study.files;
					
					for (var i = 0; i < files.length; i++) {
						files[i] = values[index++];
					}
				}
				
				if (studyFields.metadata) {
					var metadata = study.metadata;
					
					if (metadata.consultation !== null) {
						metadata.consultation = values[index++];
					}
					
					if (metadata.creator !== null) {
						metadata.creator = values[index++];
					}
					
					if (metadata.experiment !== null) {
						metadata.experiment = values[index++];
					}
					
					if (metadata.report !== null) {
						metadata.report = values[index++];
					}
				}
				
				// Resolves the deferred task
				deferredTask.resolve(study);
			}, function(response) {
				// Rejects the deferred task
				deferredTask.reject(response);
			});
			
			// Returns the promise of the deferred task
			return deferredTask.promise;
		}
		
		/*
		 * Loads a user asynchronously and returns a promise that gets resolved
		 * when the object is completely built. The user is stored in the cache
		 * for future requests.
		 * 
		 * Any other data connected with the user is also loaded, taking into
		 * account the fields indicated when the service was prepared.
		 * 
		 * It receives the user's ID.
		 */
		function loadUser(userId) {
			// Initializes a deferred task
			var deferredTask = $q.defer();
			
			// Initializes the user
			var user = {
				id: userId
			};
			
			// Stores the user in the cache
			cache.users[userId] = user;
			
			// Initializes an array for the deferred tasks' promises
			var promises = [];
			
			// Loads the data according to the specified fields
			var userFields = fields.user;
			
			if (userFields.mainData) {
				promises.push(server.getUserMainData({
					id: userId
				}));
			}
			
			if (userFields.metadata) {
				promises.push(server.getUserMetadata({
					id: userId
				}));
			}
			
			// Waits until all tasks are completed
			$q.all(promises).then(function(values) {
				// Sets the obtained values
				var index = 0;
				
				if (userFields.mainData) {
					user.mainData = values[index++];
				}
				
				if (userFields.metadata) {
					user.metadata = values[index++];
				}
				
				// Resolves the deferred task
				deferredTask.resolve(user);
			}, function(response) {
				// Rejects the deferred task
				deferredTask.reject(response);
			});
			
			// Returns the promise of the deferred task
			return deferredTask.promise;
		}
		
		/*
		 * Gets a consultation asynchronously and returns a promise that gets
		 * resolved when the object is ready. The function makes use of the
		 * cache to avoid unnecesary requests.
		 * 
		 * It receives the consultation's ID.
		 */
		service.getConsultation = function(consultationId) {
			// Initializes a deferred task
			var deferredTask = $q.defer();
			
			// Gets the consultations in cache
			var consultations = cache.consultations;
			
			if (angular.isDefined(consultations[consultationId])) {
				// The consultation has already been loaded
				
				// Resolves the deferred task
				deferredTask.resolve(consultations[consultationId]);
			} else {
				// The consultation has not been loaded yet
				
				// Loads the consultation
				loadConsultation(consultationId).then(function(consultation) {
					// Resolves the deferred task
					deferredTask.resolve(consultation);
				}, function(response) {
					// Rejects the deferred task
					deferredTask.reject(response);
				});
			}
			
			// Returns the promise of the deferred task
			return deferredTask.promise;
		};
		
		/*
		 * Gets an experiment asynchronously and returns a promise that gets
		 * resolved when the object is ready. The function makes use of the
		 * cache to avoid unnecesary requests.
		 * 
		 * It receives the experiment's ID.
		 */
		service.getExperiment = function(experimentId) {
			// Initializes a deferred task
			var deferredTask = $q.defer();
			
			// Gets the experiments in cache
			var experiments = cache.experiments;
			
			if (angular.isDefined(experiments[experimentId])) {
				// The experiment has already been loaded
				
				// Resolves the deferred task
				deferredTask.resolve(experiments[experimentId]);
			} else {
				// The experiment has not been loaded yet
				
				// Loads the experiment
				loadExperiment(experimentId).then(function(experiment) {
					// Resolves the deferred task
					deferredTask.resolve(experiment);
				}, function(response) {
					// Rejects the deferred task
					deferredTask.reject(response);
				});
			}
			
			// Returns the promise of the deferred task
			return deferredTask.promise;
		};
		
		/*
		 * Gets a file asynchronously and returns a promise that gets resolved
		 * when the object is ready. The function makes use of the cache to
		 * avoid unnecesary requests.
		 * 
		 * It receives the file's ID.
		 */
		service.getFile = function(fileId) {
			// Initializes a deferred task
			var deferredTask = $q.defer();
			
			// Gets the files in cache
			var files = cache.files;
			
			if (angular.isDefined(files[fileId])) {
				// The file has already been loaded
				
				// Resolves the deferred task
				deferredTask.resolve(files[fileId]);
			} else {
				// The file has not been loaded yet
				
				// Loads the file
				loadFile(fileId).then(function(file) {
					// Resolves the deferred task
					deferredTask.resolve(file);
				}, function(response) {
					// Rejects the deferred task
					deferredTask.reject(response);
				});
			}
			
			// Returns the promise of the deferred task
			return deferredTask.promise;
		};
		
		/*
		 * Gets a patient asynchronously and returns a promise that gets
		 * resolved when the object is ready. The function makes use of the
		 * cache to avoid unnecesary requests.
		 * 
		 * It receives the patient's ID.
		 */
		service.getPatient = function(patientId) {
			// Initializes a deferred task
			var deferredTask = $q.defer();
			
			// Gets the patients in cache
			var patients = cache.patients;
			
			if (angular.isDefined(patients[patientId])) {
				// The patient has already been loaded
				
				// Resolves the deferred task
				deferredTask.resolve(patients[patientId]);
			} else {
				// The patient has not been loaded yet
				
				// Loads the patient
				loadPatient(patientId).then(function(patient) {
					// Resolves the deferred task
					deferredTask.resolve(patient);
				}, function(response) {
					// Rejects the deferred task
					deferredTask.reject(response);
				});
			}
			
			// Returns the promise of the deferred task
			return deferredTask.promise;
		};
		
		/*
		 * Gets a study asynchronously and returns a promise that gets resolved
		 * when the object is ready. The function makes use of the cache to
		 * avoid unnecesary requests.
		 * 
		 * It receives the study's ID.
		 */
		service.getStudy = function(studyId) {
			// Initializes a deferred task
			var deferredTask = $q.defer();
			
			// Gets the studies in cache
			var studies = cache.studies;
			
			if (angular.isDefined(studies[studyId])) {
				// The study has already been loaded
				
				// Resolves the deferred task
				deferredTask.resolve(studies[studyId]);
			} else {
				// The study has not been loaded yet
				
				// Loads the study
				loadStudy(studyId).then(function(study) {
					// Resolves the deferred task
					deferredTask.resolve(study);
				}, function(response) {
					// Rejects the deferred task
					deferredTask.reject(response);
				});
			}
			
			// Returns the promise of the deferred task
			return deferredTask.promise;
		};
		
		/*
		 * Gets a user asynchronously and returns a promise that gets resolved
		 * when the object is ready. The function makes use of the cache to
		 * avoid unnecesary requests.
		 * 
		 * It receives the user's ID.
		 */
		service.getUser = function(userId) {
			// Initializes a deferred task
			var deferredTask = $q.defer();
			
			// Gets the users in cache
			var users = cache.users;
			
			if (angular.isDefined(users[userId])) {
				// The user has already been loaded
				
				// Resolves the deferred task
				deferredTask.resolve(users[userId]);
			} else {
				// The user has not been loaded yet
				
				// Loads the user
				loadUser(userId).then(function(user) {
					// Resolves the deferred task
					deferredTask.resolve(user);
				}, function(response) {
					// Rejects the deferred task
					deferredTask.reject(response);
				});
			}
			
			// Returns the promise of the deferred task
			return deferredTask.promise;
		};
		
		/*
		 * Prepares the service to start fetching data. The function clears the
		 * cache and sets the fields to take into account when loading the data.
		 * 
		 * It receives the fields.
		 */
		service.prepare = function(newFields) {
			// Clears the cache
			cache = {
				consultations: [],
				experiments: [],
				files: [],
				patients: [],
				studies: [],
				users: []
			};
			
			// Sets the fields to take into account
			fields = utilities.mergeObjects(newFields, {
				consultation: {
					imageAnalysis: false,
					laboratoryResults: false,
					mainData: false,
					metadata: false,
					neurocognitiveAssessment: false,
					patientBackground: false,
					patientMedications: false,
					treatments: false
				},
				
				experiment: {
					files: false,
					mainData: false,
					metadata: false
				},
				
				file: {
					mainData: false,
					metadata: false
				},
				
				patient: {
					mainData: false,
					metadata: false
				},
				
				study: {
					files: false,
					mainData: false,
					metadata: false
				},
				
				user: {
					mainData: false,
					metadata: false
				}
			});
		};
	}
})();
