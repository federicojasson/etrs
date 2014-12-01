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
	 * TODO: comments
	 */
	function contentsService() {
		var service = this;
		
		/*
		 * TODO
		 */
		var actions = {
			createPatient: {
				description: 'Ingrese un nuevo paciente en el sistema.\nAntes de utilizar esta herramienta, verifique que el paciente no haya sido ya ingresado, para evitar duplicados.',
				title: 'Ingresar nuevo paciente',
				url: '/create-patient'
			},
			
			createUser: {
				description: 'TODO: description',
				title: 'Ingresar nuevo usuario',
				url: '/create-user'
			},
			
			searchPatients: {
				description: 'Encuentre pacientes ingresando palabras clave.\nLa aplicación realizará automáticamente una búsqueda inteligente y mostrará los resultados ordenados de acuerdo a su relevancia.',
				title: 'Buscar pacientes',
				url: '/search-patients'
			}
		};
		
		/*
		 * TODO
		 */
		var administratorActions = [
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
			}
		];
		
		/*
		 * TODO
		 */
		var doctorActions = [
			{
				actions: [
					actions.searchPatients,
					actions.createPatient
				],
				title: 'Pacientes'
			}
		];
		
		/*
		 * TODO
		 */
		var operatorActions = [
			{
				actions: [
					actions.searchPatients
				],
				title: 'Pacientes'
			}
		];
		
		/*
		 * TODO
		 */
		service.getAdministratorActions = function() {
			return administratorActions;
		};
		
		/*
		 * TODO
		 */
		service.getDoctorActions = function() {
			return doctorActions;
		};
		
		/*
		 * TODO
		 */
		service.getOperatorActions = function() {
			return operatorActions;
		};
	}
})();
