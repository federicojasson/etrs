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
		var files = [];
		
		/*
		 * TODO
		 */
		var studies = [];
		
		/*
		 * TODO
		 */
		var users = [];
		
		/*
		 * TODO
		 */
		function loadFile(id, fields) {
			if (angular.isDefined(files[id])) {
				// The file has already been loaded
				return files[id];
			}
			
			// Initializes a deferred task
			var deferred = $q.defer();
			
			// Initializes an array to fill it with promises
			var promises = [];
			
			// Initializes the file
			var file = {};
			
			if (fields.mainData) {
				var promise = server.getFileMainData(id);
				
				promise.then(function(mainData) {
					file.mainData = mainData;
				});
				
				promises.push(promise);
			}
			
			if (fields.metadata) {
				var promise = server.getFileMetadata(id);
				
				promise.then(function(metadata) {
					file.metadata = metadata;
					
					if (fields.metadata.creator) {
						metadata.creator = loadUser(metadata.creator, fields.metadata.creator);
					}
				});
				
				promises.push(promise);
			}
			
			// Waits until all tasks are completed
			$q.all(promises).then(function() {
				// Stores the file
				files[id] = file;
				
				// Resolves the deferred task
				deferred.resolve(file);
			}, function() {
				// Rejects the deferred task
				deferred.reject();
			});
			
			return deferred.promise;
		}
		
		/*
		 * TODO
		 */
		function loadStudy(id, fields) {
			if (angular.isDefined(studies[id])) {
				// The study has already been loaded
				return studies[id];
			}
			
			// Initializes a deferred task
			var deferred = $q.defer();
			
			// Initializes an array to fill it with promises
			var promises = [];
			
			// Initializes the study
			var study = {};
			
			if (fields.files) {
				var promise = server.getStudyFiles(id);
				
				promise.then(function(files) {
					study.files = files;
					
					if (fields.files.file) {
						for (var i = 0; i < files.length; i++) {
							files[i] = loadFile(files[i], fields.files.file);
						}
					}
				});
				
				promises.push(promise);
			}
			
			if (fields.mainData) {
				var promise = server.getStudyMainData(id);
				
				promise.then(function(mainData) {
					study.mainData = mainData;
				});
				
				promises.push(promise);
			}
			
			if (fields.metadata) {
				var promise = server.getStudyMetadata(id);
				
				promise.then(function(metadata) {
					study.metadata = metadata;
					
					if (fields.metadata.consultation) {
						metadata.consultation = loadConsultation(metadata.consultation, fields.metadata.consultation);
					}
					
					if (fields.metadata.experiment) {
						metadata.experiment = loadExperiment(metadata.experiment, fields.metadata.experiment);
					}
					
					if (fields.metadata.creator) {
						metadata.creator = loadUser(metadata.creator, fields.metadata.creator);
					}
					
					if (angular.isDefined(metadata.report) && fields.metadata.report) {
						metadata.report = loadFile(metadata.report, fields.metadata.report);
					}
				});
				
				promises.push(promise);
			}
			
			// Waits until all tasks are completed
			$q.all(promises).then(function() {
				// Stores the study
				studies[id] = study;
				
				// Resolves the deferred task
				deferred.resolve(study);
			}, function() {
				// Rejects the deferred task
				deferred.reject();
			});
			
			return deferred.promise;
		}
		
		/*
		 * TODO
		 */
		function loadUser(id, fields) {
			if (id in users) {
				// The user has already been loaded
				return users[id];
			}
			
			// Initializes a deferred task
			var deferred = $q.defer();
			
			// Initializes an array to fill it with promises
			var promises = [];
			
			// Initializes the user
			var user = {};
			
			if (fields.mainData) {
				var promise = server.getUserMainData(id);
				
				promise.then(function(mainData) {
					user.mainData = mainData;
				});
				
				promises.push(promise);
			}
			
			if (fields.metadata) {
				var promise = server.getUserMetadata(id);
				
				promise.then(function(metadata) {
					user.metadata = metadata;
				});
				
				promises.push(promise);
			}
			
			// Waits until all tasks are completed
			$q.all(promises).then(function() {
				// Stores the user
				users[id] = user;
				
				// Resolves the deferred task
				deferred.resolve(user);
			}, function() {
				// Rejects the deferred task
				deferred.reject();
			});
			
			return deferred.promise;
		}
		
		
		// TODO: test
		loadStudy('id', {
			files: {
				file: {
					mainData: true,
					metadata: {
						creator: true
					}
				}
			},
			mainData: true,
			metadata: {
				
			}
		});
	}
})();

