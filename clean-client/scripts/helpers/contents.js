// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: helpers
	var module = angular.module('helpers');
	
	// Service: contents
	module.service('contents', contentsService);
	
	/*
	 * Service: contents
	 * 
	 * Offers functions to obtain site contents.
	 */
	function contentsService() {
		var service = this;
		
		/*
		 * The actions.
		 */
		var actions = {
			createExperiment: {
				description: 'TODO: description',
				title: 'Ingresar nuevo experimento',
				url: '/create-experiment'
			},
			
			createPatient: {
				description: 'TODO: description',
				title: 'Ingresar nuevo paciente',
				url: '/create-patient'
			},
			
			createUser: {
				description: 'TODO: description',
				title: 'Ingresar nuevo usuario',
				url: '/create-user'
			},
			
			searchPatients: {
				description: 'TODO: description',
				title: 'Buscar pacientes',
				url: '/search-patients'
			}
		};
		
		/*
		 * The action sets.
		 */
		var actionSets = {
			administrator: [
				{
					actions: [
						actions.searchPatients,
						actions.createPatient
					],
					title: 'Pacientes'
				},

				{
					actions: [
						actions.createUser
					],
					title: 'Usuarios'
				},

				{
					actions: [
						actions.createExperiment
					],
					title: 'Experimentos'
				}
			],
			
			doctor: [
				{
					actions: [
						actions.searchPatients,
						actions.createPatient
					],
					title: 'Pacientes'
				}
			],
			
			operator: [
				{
					actions: [
						actions.searchPatients
					],
					title: 'Pacientes'
				}
			]
		};
		
		/*
		 * Returns the administrator action set.
		 */
		service.getAdministratorActionSet = function() {
			return actionSets.administrator;
		};
		
		/*
		 * Returns the doctor action set.
		 */
		service.getDoctorActionSet = function() {
			return actionSets.doctor;
		};
		
		/*
		 * Returns the operator action set.
		 */
		service.getOperatorActionSet = function() {
			return actionSets.operator;
		};
	}
})();
