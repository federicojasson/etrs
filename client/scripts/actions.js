// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: actions
	var module = angular.module('actions', [
		'app'
	]);
	
	// Controller: ActionsController
	module.controller('ActionsController', [
		'actions',
		ActionsController
	]);
	
	// Service: actions
	module.service('actions', [
		'authentication',
		actionsService
	]);
	
	/*
	 * Controller: ActionsController
	 * 
	 * TODO: comments
	 */
	function ActionsController(actions) {
		var controller = this;
		
		/*
		 * TODO: comments
		 */
		controller.get = function() {
			return actions.get();
		};
	}
	
	/*
	 * Service: actions
	 * 
	 * TODO: comments
	 */
	function actionsService(authentication) {
		var service = this;
		
		/*
		 * TODO: comments
		 */
		var actions = {
			createPatient: {
				title: 'Ingresar paciente',
				description: 'TODO: description. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably havent heard of them accusamus labore sustainable VHS.',
				url: '/create-patient'
			},
			
			searchPatients: {
				title: 'Buscar pacientes',
				description: 'TODO: description. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably havent heard of them accusamus labore sustainable VHS.',
				url: '/search-patients'
			}
		};
		
		/*
		 * The action sets, organized according to user role.
		 */
		var actionSets = {
			ad: [
				{
					title: 'Pacientes',
					actions: [
						actions.searchPatients,
						actions.createPatient
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
		 * TODO: comments
		 */
		service.get = function() {
			// Gets the logged in user's role
			var userRole = authentication.getLoggedInUser().role;
			
			// Returns the action set
			return actionSets[userRole];
		};
	}
})();
