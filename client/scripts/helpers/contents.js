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
				title: 'Ingresar nuevo experimento',
				description: 'TODO: description',
				url: '/create-experiment'
			},
			
			createPatient: {
				title: 'Ingresar nuevo paciente',
				description: 'TODO: description',
				url: '/create-patient'
			},
			
			requestUserCreation: {
				title: 'Ingresar nuevo usuario',
				description: 'TODO: description',
				url: '/request-user-creation'
			},
			
			searchPatients: {
				title: 'Buscar pacientes',
				description: 'TODO: description',
				url: '/search-patients'
			}
		};
		
		/*
		 * The action sets, in function of the user roles.
		 */
		var actionSets = {
			ad: [
				{
					title: 'Pacientes',
					actions: [
						actions.searchPatients,
						actions.createPatient
					]
				},

				{
					title: 'Usuarios',
					actions: [
						actions.requestUserCreation
					]
				},

				{
					title: 'Experimentos',
					actions: [
						actions.createExperiment
					]
				}
			],
			
			dr: [
				{
					title: 'Pacientes',
					actions: [
						actions.searchPatients,
						actions.createPatient
					]
				}
			],
			
			op: [
				{
					title: 'Pacientes',
					actions: [
						actions.searchPatients
					]
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
