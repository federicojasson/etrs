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
			
			requestUserCreation: {
				description: 'TODO: description',
				title: 'Ingresar nuevo usuario',
				url: '/request-user-creation'
			},
			
			searchPatients: {
				description: 'TODO: description',
				title: 'Buscar pacientes',
				url: '/search-patients'
			}
		};
		
		/*
		 * The action sets, in function of the user roles.
		 */
		var actionSets = {
			ad: [
				{
					actions: [
						actions.searchPatients,
						actions.createPatient
					],
					title: 'Pacientes'
				},

				{
					actions: [
						actions.requestUserCreation
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
			
			dr: [
				{
					actions: [
						actions.searchPatients,
						actions.createPatient
					],
					title: 'Pacientes'
				}
			],
			
			op: [
				{
					actions: [
						actions.searchPatients
					],
					title: 'Pacientes'
				}
			]
		};
		
		/*
		 * The user honorific titles, in function of the user roles and genders.
		 */
		var honorificTitles = {
			ad: {
				f: 'Sra.',
				m: 'Sr.'
			},
			
			dr: {
				f: 'Dra.',
				m: 'Dr.'
			},
			
			op: {
				f: 'Sra.',
				m: 'Sr.'
			}
		};
		
		/*
		 * Returns an action set.
		 * 
		 * It receives the user's role.
		 */
		service.getActionSet = function(userRole) {
			return actionSets[userRole];
		};
		
		/*
		 * Returns an honorific title.
		 * 
		 * It receives the user's role and gender.
		 */
		service.getHonorificTitle = function(userRole, userGender) {
			return honorificTitles[userRole][userGender];
		};
	}
})();
