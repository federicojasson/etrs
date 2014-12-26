// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: app
	angular.module('app', [
		'ui.bootstrap',
		'authentication',
		'forms',
		'layouts',
		'router',
		'utilities',
		'views'
	]);
	
	// TODO: debug
	angular.module('app').run(['$timeout', 'data', function($timeout, data) {
		/*$timeout(function() {
			data.prepare([
				'backgrounds',
				'clinicalImpressions',
				'consultations',
				'diagnoses',
				'experiments',
				'files',
				'imageTests',
				'laboratoryTests',
				'medications',
				'neurocognitiveEvaluations',
				'patients',
				'studies',
				'treatments',
				'users'
			]);

			data.getBackground('fed917638d304431a12d4670af9bca9d').then(function() {
				return data.getClinicalImpression('67f86454a18a4d2d88a7185b78e7aaae');
			}).then(function() {
				return data.getConsultation('283db1dad6004f059e527bd9626a1f28');
			}).then(function() {
				return data.getDiagnosis('b6aff0cecc964aab848c3539f8c56f14');
			}).then(function() {
				return data.getExperiment('a16f4de5cf164c508fec3a1aa45455fd');
			}).then(function() {
				return data.getFile('5d4a52954eb440899df7474154b96ba0');
			}).then(function() {
				return data.getImageTest('0b7b260b05584ac992494ee548770b4e');
			}).then(function() {
				return data.getLaboratoryTest('57f76e03c90445049f1e3222a17a72f0');
			}).then(function() {
				return data.getMedication('5c7bafdf4aaf459f9eda4e6d991e03a4');
			}).then(function() {
				return data.getNeurocognitiveEvaluation('9deea86b950e484f809e532d0a0196a4');
			}).then(function() {
				return data.getPatient('1894068380304e0ca7ebf25d25e72dca');
			}).then(function() {
				return data.getStudy('cb34783c21264abfb4fc0b371bd2b2fa');
			}).then(function() {
				return data.getTreatment('076ded42464b4a3cb4a284c6b969bd1e');
			}).then(function() {
				return data.getUser('federicojasson');
			}).then(function() {
				data.getBackground('fed917638d304431a12d4670af9bca9d').then(function(object) {
					console.log(object);
				});
				data.getClinicalImpression('67f86454a18a4d2d88a7185b78e7aaae').then(function(object) {
					console.log(object);
				});
				data.getConsultation('283db1dad6004f059e527bd9626a1f28').then(function(object) {
					console.log(object);
				});
				data.getDiagnosis('b6aff0cecc964aab848c3539f8c56f14').then(function(object) {
					console.log(object);
				});
				data.getExperiment('a16f4de5cf164c508fec3a1aa45455fd').then(function(object) {
					console.log(object);
				});
				data.getFile('5d4a52954eb440899df7474154b96ba0').then(function(object) {
					console.log(object);
				});
				data.getImageTest('0b7b260b05584ac992494ee548770b4e').then(function(object) {
					console.log(object);
				});
				data.getLaboratoryTest('57f76e03c90445049f1e3222a17a72f0').then(function(object) {
					console.log(object);
				});
				data.getMedication('5c7bafdf4aaf459f9eda4e6d991e03a4').then(function(object) {
					console.log(object);
				});
				data.getNeurocognitiveEvaluation('9deea86b950e484f809e532d0a0196a4').then(function(object) {
					console.log(object);
				});
				data.getPatient('1894068380304e0ca7ebf25d25e72dca').then(function(object) {
					console.log(object);
				});
				data.getStudy('cb34783c21264abfb4fc0b371bd2b2fa').then(function(object) {
					console.log(object);
				});
				data.getTreatment('076ded42464b4a3cb4a284c6b969bd1e').then(function(object) {
					console.log(object);
				});
				data.getUser('federicojasson').then(function(object) {
					console.log(object);
				});
			});
		}, 1000);*/
	}]);
})();
