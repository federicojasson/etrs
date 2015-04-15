/**
 * ETRS - Eye Tracking Record System
 * Copyright (C) 2015 Federico Jasson
 * 
 * The JavaScript code in this page is free software: you can redistribute it
 * and/or modify it under the terms of the GNU General Public License (GNU GPL)
 * as published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version. The code is distributed
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE. See the GNU GPL for more details.
 * 
 * As additional permission under GNU GPL version 3 section 7, you may
 * distribute non-source (e.g., minimized or compacted) forms of that code
 * without the copy of the GNU GPL normally required by section 4, provided you
 * include this license notice and a URL through which recipients can access the
 * Corresponding Source.
 */

'use strict';

(function() {
	angular.module('app.navigationBar').config([
		'navigationBarProvider',
		config
	]);
	
	/**
	 * Configures the module.
	 */
	function config(navigationBarProvider) {
		/**
		 * Returns the menu items.
		 */
		function getMenuItems() {
			return {
				clinicalImpressions: {
					name: 'Administrar',
					state: 'clinicalImpressions',
					description: 'Administre las impresiones clínicas'
				},
				
				diagnoses: {
					name: 'Administrar',
					state: 'diagnoses',
					description: 'Administre los diagnósticos'
				},
				
				invitation: {
					name: 'Enviar invitación',
					state: 'invitation',
					description: 'Invite a una persona a registrarse en ETRS'
				},
				
				logs: {
					name: 'Ver',
					state: 'logs',
					description: 'Vea los registros del sistema'
				},
				
				medicalAntecedents: {
					name: 'Administrar',
					state: 'medicalAntecedents',
					description: 'Administre los antecedentes médicos'
				},
				
				medicines: {
					name: 'Administrar',
					state: 'medicines',
					description: 'Administre los medicamentos'
				},
				
				newClinicalImpression: {
					name: 'Nueva',
					state: 'newClinicalImpression',
					description: 'Cree una nueva impresión clínica'
				},
				
				newDiagnosis: {
					name: 'Nuevo',
					state: 'newDiagnosis',
					description: 'Cree un nuevo diagnóstico'
				},
				
				newMedicalAntecedent: {
					name: 'Nuevo',
					state: 'newMedicalAntecedent',
					description: 'Cree un nuevo antecedente médico'
				},
				
				newMedicine: {
					name: 'Nuevo',
					state: 'newMedicine',
					description: 'Cree un nuevo medicamento'
				},
				
				newTreatment: {
					name: 'Nuevo',
					state: 'newTreatment',
					description: 'Cree un nuevo tratamiento'
				},
				
				treatments: {
					name: 'Administrar',
					state: 'treatments',
					description: 'Administre los tratamientos'
				}
				
				// DEFINEHERE: define menu items here
			};
		}
		
		/**
		 * Returns the menus.
		 */
		function getMenus() {
			// Gets the menu items
			var menuItems = getMenuItems();
			
			return {
				// DEFINEHERE: define menus here
				ad: [
					{
						name: 'Usuarios',
						items: [
							menuItems.invitation
						]
					},
					
					{
						name: 'Antecedentes médicos',
						items: [
							menuItems.medicalAntecedents,
							menuItems.newMedicalAntecedent
						]
					},
					
					{
						name: 'Medicamentos',
						items: [
							menuItems.medicines,
							menuItems.newMedicine
						]
					},
					
					{
						name: 'Impresiones clínicas',
						items: [
							menuItems.clinicalImpressions,
							menuItems.newClinicalImpression
						]
					},
					
					{
						name: 'Diagnósticos',
						items: [
							menuItems.diagnoses,
							menuItems.newDiagnosis
						]
					},
					
					{
						name: 'Tratamientos',
						items: [
							menuItems.treatments,
							menuItems.newTreatment
						]
					},
					
					{
						name: 'Registros',
						items: [
							menuItems.logs
						]
					}
				],
				
				dr: [],
				op: []
			};
		}
		
		// ---------------------------------------------------------------------
		
		// Gets the menus
		var menus = getMenus();
		
		// Registers the menus
		for (var userRole in menus) {
			if (! menus.hasOwnProperty(userRole)) {
				continue;
			}
			
			var userRoleMenus = menus[userRole];
			for (var i = 0; i < userRoleMenus.length; i++) {
				navigationBarProvider.registerMenu(userRoleMenus[i], userRole);
			}
		}
	}
})();
