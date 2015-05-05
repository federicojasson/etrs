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
				
				cognitiveTests: {
					name: 'Administrar',
					state: 'cognitiveTests',
					description: 'Administre los exámenes cognitivos'
				},
				
				diagnoses: {
					name: 'Administrar',
					state: 'diagnoses',
					description: 'Administre los diagnósticos'
				},
				
				experiments: {
					name: 'Administrar',
					state: 'experiments',
					description: 'Administre los experimentos'
				},
				
				imagingTests: {
					name: 'Administrar',
					state: 'imagingTests',
					description: 'Administre los exámenes de imágenes'
				},
				
				invitation: {
					name: 'Enviar invitación',
					state: 'invitation',
					description: 'Invite a una persona a registrarse en ETRS'
				},
				
				laboratoryTests: {
					name: 'Administrar',
					state: 'laboratoryTests',
					description: 'Administre los exámenes de laboratorio'
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
				
				newCognitiveTest: {
					name: 'Nuevo',
					state: 'newCognitiveTest',
					description: 'Cree un nuevo examen cognitivo'
				},
				
				newDiagnosis: {
					name: 'Nuevo',
					state: 'newDiagnosis',
					description: 'Cree un nuevo diagnóstico'
				},
				
				newExperiment: {
					name: 'Nuevo',
					state: 'newExperiment',
					description: 'Cree un nuevo experimento'
				},
				
				newImagingTest: {
					name: 'Nuevo',
					state: 'newImagingTest',
					description: 'Cree un nuevo examen de imágenes'
				},
				
				newLaboratoryTest: {
					name: 'Nuevo',
					state: 'newLaboratoryTest',
					description: 'Cree un nuevo examen de laboratorio'
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
				
				newPatient: {
					name: 'Nuevo',
					state: 'newPatient',
					description: 'Cree un nuevo paciente'
				},
				
				newTreatment: {
					name: 'Nuevo',
					state: 'newTreatment',
					description: 'Cree un nuevo tratamiento'
				},
				
				patients: {
					name: 'Buscar',
					state: 'patients',
					description: 'Busque pacientes en el sistema'
				},
				
				treatments: {
					name: 'Administrar',
					state: 'treatments',
					description: 'Administre los tratamientos'
				},
				
				users: {
					name: 'Buscar',
					state: 'users',
					description: 'Busque usuarios en el sistema'
				}
			};
		}
		
		/**
		 * Returns the menus.
		 */
		function getMenus() {
			// Gets the menu items
			var menuItems = getMenuItems();
			
			return {
				ad: [
					{
						name: 'Pacientes',
						items: [
							menuItems.patients,
							menuItems.newPatient
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
						name: 'Exámenes de laboratorio',
						items: [
							menuItems.laboratoryTests,
							menuItems.newLaboratoryTest
						]
					},
					
					{
						name: 'Exámenes de imágenes',
						items: [
							menuItems.imagingTests,
							menuItems.newImagingTest
						]
					},
					
					{
						name: 'Exámenes cognitivos',
						items: [
							menuItems.cognitiveTests,
							menuItems.newCognitiveTest
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
						name: 'Experimentos',
						items: [
							menuItems.experiments,
							menuItems.newExperiment
						]
					},
					
					{
						name: 'Usuarios',
						items: [
							menuItems.users,
							menuItems.invitation
						]
					},
					
					{
						name: 'Registros',
						items: [
							menuItems.logs
						]
					}
				],
				
				dr: [
					{
						name: 'Pacientes',
						items: [
							menuItems.patients,
							menuItems.newPatient
						]
					}
				],
				
				op: [
					{
						name: 'Pacientes',
						items: [
							menuItems.patients
						]
					}
				]
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
