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
	angular.module('app.router').config([
		'$locationProvider',
		'$stateProvider',
		'$urlRouterProvider',
		config
	]);
	
	/**
	 * Configures the module.
	 */
	function config($locationProvider, $stateProvider, $urlRouterProvider) {
		/**
		 * Returns the states.
		 */
		function getStates() {
			return [
				// DEFINEHERE: define states in here
				
				{
					name: 'account',
					url: '/account',
					data: {
						views: {
							__: 'SignInViewController',
							ad: 'AccountViewController',
							dr: 'AccountViewController',
							op: 'AccountViewController'
						}
					}
				},
				
				{
					name: 'changePassword',
					url: '/account/change-password',
					data: {
						views: {
							__: 'SignInViewController',
							ad: 'ChangePasswordViewController',
							dr: 'ChangePasswordViewController',
							op: 'ChangePasswordViewController'
						}
					}
				},
				
				{
					name: 'clinicalImpression',
					url: '/clinical-impression/{id:[0-9A-Fa-f]{32}}',
					data: {
						views: {
							__: 'SignInViewController',
							ad: 'ClinicalImpressionViewController'
						}
					}
				},
				
				{
					name: 'clinicalImpressions',
					url: '/clinical-impressions',
					data: {
						views: {
							__: 'SignInViewController',
							ad: 'ClinicalImpressionsViewController'
						}
					}
				},
				
				{
					name: 'diagnoses',
					url: '/diagnoses',
					data: {
						views: {
							__: 'SignInViewController',
							ad: 'DiagnosesViewController'
						}
					}
				},
				
				{
					name: 'diagnosis',
					url: '/diagnosis/{id:[0-9A-Fa-f]{32}}',
					data: {
						views: {
							__: 'SignInViewController',
							ad: 'DiagnosisViewController'
						}
					}
				},
				
				{
					name: 'editAccount',
					url: '/account/edit',
					data: {
						views: {
							__: 'SignInViewController',
							ad: 'EditAccountViewController',
							dr: 'EditAccountViewController',
							op: 'EditAccountViewController'
						}
					}
				},
				
				{
					name: 'editClinicalImpression',
					url: '/clinical-impression/{id:[0-9A-Fa-f]{32}}/edit',
					data: {
						views: {
							__: 'SignInViewController',
							ad: 'EditClinicalImpressionViewController'
						}
					}
				},
				
				{
					name: 'editDiagnosis',
					url: '/diagnosis/{id:[0-9A-Fa-f]{32}}/edit',
					data: {
						views: {
							__: 'SignInViewController',
							ad: 'EditDiagnosisViewController'
						}
					}
				},
				
				{
					name: 'editMedicalAntecedent',
					url: '/medical-antecedent/{id:[0-9A-Fa-f]{32}}/edit',
					data: {
						views: {
							__: 'SignInViewController',
							ad: 'EditMedicalAntecedentViewController'
						}
					}
				},
				
				{
					name: 'editMedicine',
					url: '/medicine/{id:[0-9A-Fa-f]{32}}/edit',
					data: {
						views: {
							__: 'SignInViewController',
							ad: 'EditMedicineViewController'
						}
					}
				},
				
				{
					name: 'editTreatment',
					url: '/treatment/{id:[0-9A-Fa-f]{32}}/edit',
					data: {
						views: {
							__: 'SignInViewController',
							ad: 'EditTreatmentViewController'
						}
					}
				},
				
				{
					name: 'forgotPassword',
					url: '/account/forgot-password',
					data: {
						views: {
							__: 'ForgotPasswordViewController'
						}
					}
				},
				
				{
					name: 'home',
					url: '/',
					data: {
						views: {
							__: 'SignInViewController',
							ad: 'HomeViewController',
							dr: 'HomeViewController',
							op: 'HomeViewController'
						}
					}
				},
				
				{
					name: 'invitation',
					url: '/account/invitation',
					data: {
						views: {
							__: 'SignInViewController',
							ad: 'InvitationViewController'
						}
					}
				},
				
				{
					name: 'logs',
					url: '/logs',
					data: {
						views: {
							__: 'SignInViewController',
							ad: 'LogsViewController'
						}
					}
				},
				
				{
					name: 'medicalAntecedent',
					url: '/medical-antecedent/{id:[0-9A-Fa-f]{32}}',
					data: {
						views: {
							__: 'SignInViewController',
							ad: 'MedicalAntecedentViewController'
						}
					}
				},
				
				{
					name: 'medicalAntecedents',
					url: '/medical-antecedents',
					data: {
						views: {
							__: 'SignInViewController',
							ad: 'MedicalAntecedentsViewController'
						}
					}
				},
				
				{
					name: 'medicine',
					url: '/medicine/{id:[0-9A-Fa-f]{32}}',
					data: {
						views: {
							__: 'SignInViewController',
							ad: 'MedicineViewController'
						}
					}
				},
				
				{
					name: 'medicines',
					url: '/medicines',
					data: {
						views: {
							__: 'SignInViewController',
							ad: 'MedicinesViewController'
						}
					}
				},
				
				{
					name: 'newClinicalImpression',
					url: '/clinical-impression/new',
					data: {
						views: {
							__: 'SignInViewController',
							ad: 'NewClinicalImpressionViewController'
						}
					}
				},
				
				{
					name: 'newDiagnosis',
					url: '/diagnosis/new',
					data: {
						views: {
							__: 'SignInViewController',
							ad: 'NewDiagnosisViewController'
						}
					}
				},
				
				{
					name: 'newMedicalAntecedent',
					url: '/medical-antecedent/new',
					data: {
						views: {
							__: 'SignInViewController',
							ad: 'NewMedicalAntecedentViewController'
						}
					}
				},
				
				{
					name: 'newMedicine',
					url: '/medicine/new',
					data: {
						views: {
							__: 'SignInViewController',
							ad: 'NewMedicineViewController'
						}
					}
				},
				
				{
					name: 'newTreatment',
					url: '/treatment/new',
					data: {
						views: {
							__: 'SignInViewController',
							ad: 'NewTreatmentViewController'
						}
					}
				},
				
				{
					name: 'resetPassword',
					url: '/account/reset-password/{id:[0-9A-Fa-f]{32}}/{password:[0-9A-Fa-f]{256}}',
					data: {
						views: {
							__: 'ResetPasswordViewController'
						}
					}
				},
				
				{
					name: 'signIn',
					url: '/account/sign-in',
					data: {
						views: {
							__: 'SignInViewController'
						}
					}
				},
				
				{
					name: 'signUp',
					url: '/account/sign-up/{id:[0-9A-Fa-f]{32}}/{password:[0-9A-Fa-f]{256}}',
					data: {
						views: {
							__: 'SignUpViewController'
						}
					}
				},
				
				{
					name: 'treatment',
					url: '/treatment/{id:[0-9A-Fa-f]{32}}',
					data: {
						views: {
							__: 'SignInViewController',
							ad: 'TreatmentViewController'
						}
					}
				},
				
				{
					name: 'treatments',
					url: '/treatments',
					data: {
						views: {
							__: 'SignInViewController',
							ad: 'TreatmentsViewController'
						}
					}
				}
			];
		}
		
		// ---------------------------------------------------------------------
		
		// Enables the HTML5 history API
		$locationProvider.html5Mode(true);
		
		// Sets the default URL
		$urlRouterProvider.otherwise('/');
		
		// Gets the states
		var states = getStates();
		
		// Registers the states
		for (var i = 0; i < states.length; i++) {
			var state = states[i];
			
			// Makes the URL absolute
			state.url = '^' + state.url;
			
			// Sets a template that includes the layout
			state.template = '<layout></layout>';
			
			// Registers the state
			$stateProvider.state(state);
		}
	}
})();
