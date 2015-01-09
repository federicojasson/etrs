// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: router
	var module = angular.module('router', [
		'app'
	]);
	
	// Config
	module.config([
		'$locationProvider',
		'$stateProvider',
		'$urlRouterProvider',
		config
	]);
	
	// Run
	module.run([
		'$rootScope',
		'$state',
		'authentication',
		'errorHandler',
		'layout',
		'router',
		'view',
		run
	]);
	
	// Service: router
	module.service('router', [
		'$location',
		routerService
	]);
	
	/*
	 * Configures the module.
	 */
	function config($locationProvider, $stateProvider, $urlRouterProvider) {
		// Activates the HTML5 history API
		$locationProvider.html5Mode(true);
		
		// Defines the states
		var states = [
			{
				name: 'actions',
				definition: {
					url: '/actions',
					controllers: {
						__: 'LogInViewController',
						ad: 'ActionsViewController',
						dr: 'ActionsViewController',
						op: 'ActionsViewController'
					}
				}
			},
			
			{
				name: 'changeEmailAddress',
				definition: {
					url: '/change-email-address',
					controllers: {
						__: 'LogInViewController',
						ad: 'ChangeEmailAddressViewController',
						dr: 'ChangeEmailAddressViewController',
						op: 'ChangeEmailAddressViewController'
					}
				}
			},
			
			{
				name: 'changePassword',
				definition: {
					url: '/change-password',
					controllers: {
						__: 'LogInViewController',
						ad: 'ChangePasswordViewController',
						dr: 'ChangePasswordViewController',
						op: 'ChangePasswordViewController'
					}
				}
			},
			
			{
				name: 'contact',
				definition: {
					url: '/contact',
					controllers: {
						__: 'ContactViewController',
						ad: 'ContactViewController',
						dr: 'ContactViewController',
						op: 'ContactViewController'
					}
				}
			},
			
			{
				name: 'createBackground',
				definition: {
					url: '/create-background',
					controllers: {
						__: 'LogInViewController',
						ad: 'CreateBackgroundViewController'
					}
				}
			},
			
			{
				name: 'createClinicalImpression',
				definition: {
					url: '/create-clinical-impression',
					controllers: {
						__: 'LogInViewController',
						ad: 'CreateClinicalImpressionViewController'
					}
				}
			},
			
			{
				name: 'createDiagnosis',
				definition: {
					url: '/create-diagnosis',
					controllers: {
						__: 'LogInViewController',
						ad: 'CreateDiagnosisViewController'
					}
				}
			},
			
			{
				name: 'createExperiment',
				definition: {
					url: '/create-experiment',
					controllers: {
						__: 'LogInViewController',
						ad: 'CreateExperimentViewController'
					}
				}
			},
			
			{
				name: 'createImageTest',
				definition: {
					url: '/create-image-test',
					controllers: {
						__: 'LogInViewController',
						ad: 'CreateImageTestViewController'
					}
				}
			},
			
			{
				name: 'createLaboratoryTest',
				definition: {
					url: '/create-laboratory-test',
					controllers: {
						__: 'LogInViewController',
						ad: 'CreateLaboratoryTestViewController'
					}
				}
			},
			
			{
				name: 'createMedication',
				definition: {
					url: '/create-medication',
					controllers: {
						__: 'LogInViewController',
						ad: 'CreateMedicationViewController'
					}
				}
			},
			
			{
				name: 'createNeurocognitiveEvaluation',
				definition: {
					url: '/create-neurocognitive-evaluation',
					controllers: {
						__: 'LogInViewController',
						ad: 'CreateNeurocognitiveEvaluationViewController'
					}
				}
			},
			
			{
				name: 'createPatient',
				definition: {
					url: '/create-patient',
					controllers: {
						__: 'LogInViewController',
						ad: 'CreatePatientViewController',
						dr: 'CreatePatientViewController'
					}
				}
			},
			
			{
				name: 'createTreatment',
				definition: {
					url: '/create-treatment',
					controllers: {
						__: 'LogInViewController',
						ad: 'CreateTreatmentViewController'
					}
				}
			},
			
			{
				name: 'help',
				definition: {
					url: '/help',
					controllers: {
						__: 'HelpViewController',
						ad: 'HelpViewController',
						dr: 'HelpViewController',
						op: 'HelpViewController'
					}
				}
			},
			
			{
				name: 'home',
				definition: {
					url: '/',
					controllers: {
						__: 'LogInViewController',
						ad: 'HomeViewController',
						dr: 'HomeViewController',
						op: 'HomeViewController'
					}
				}
			},
			
			{
				name: 'logIn',
				definition: {
					url: '/log-in',
					controllers: {
						__: 'LogInViewController'
					}
				}
			},
			
			{
				name: 'manageBackgrounds',
				definition: {
					url: '/manage-backgrounds',
					controllers: {
						__: 'LogInViewController',
						ad: 'ManageBackgroundsViewController'
					}
				}
			},
			
			{
				name: 'manageClinicalImpressions',
				definition: {
					url: '/manage-clinical-impressions',
					controllers: {
						__: 'LogInViewController',
						ad: 'ManageClinicalImpressionsViewController'
					}
				}
			},
			
			{
				name: 'manageDiagnoses',
				definition: {
					url: '/manage-diagnoses',
					controllers: {
						__: 'LogInViewController',
						ad: 'ManageDiagnosesViewController'
					}
				}
			},
			
			{
				name: 'manageExperiments',
				definition: {
					url: '/manage-experiments',
					controllers: {
						__: 'LogInViewController',
						ad: 'ManageExperimentsViewController'
					}
				}
			},
			
			{
				name: 'manageImageTests',
				definition: {
					url: '/manage-image-tests',
					controllers: {
						__: 'LogInViewController',
						ad: 'ManageImageTestsViewController'
					}
				}
			},
			
			{
				name: 'manageLaboratoryTests',
				definition: {
					url: '/manage-laboratory-tests',
					controllers: {
						__: 'LogInViewController',
						ad: 'ManageLaboratoryTestsViewController'
					}
				}
			},
			
			{
				name: 'manageMedications',
				definition: {
					url: '/manage-medications',
					controllers: {
						__: 'LogInViewController',
						ad: 'ManageMedicationsViewController'
					}
				}
			},
			
			{
				name: 'manageNeurocognitiveEvaluations',
				definition: {
					url: '/manage-neurocognitive-evaluations',
					controllers: {
						__: 'LogInViewController',
						ad: 'ManageNeurocognitiveEvaluationsViewController'
					}
				}
			},
			
			{
				name: 'manageTreatments',
				definition: {
					url: '/manage-treatments',
					controllers: {
						__: 'LogInViewController',
						ad: 'ManageTreatmentsViewController'
					}
				}
			},
			
			{
				name: 'patient',
				definition: {
					url: '/patient/{patientId:[0-9A-Fa-f]{32}}',
					controllers: {
						__: 'LogInViewController',
						ad: 'PatientViewController',
						dr: 'PatientViewController',
						op: 'PatientViewController'
					}
				}
			},
			
			{
				name: 'profile',
				definition: {
					url: '/profile',
					controllers: {
						__: 'LogInViewController',
						ad: 'ProfileViewController',
						dr: 'ProfileViewController',
						op: 'ProfileViewController'
					}
				}
			},
			
			{
				name: 'requestPasswordRecovery',
				definition: {
					url: '/request-password-recovery',
					controllers: {
						__: 'RequestPasswordRecoveryViewController'
					}
				}
			},
			
			{
				name: 'searchPatients',
				definition: {
					url: '/search-patients',
					controllers: {
						__: 'LogInViewController',
						ad: 'SearchPatientsViewController',
						dr: 'SearchPatientsViewController',
						op: 'SearchPatientsViewController'
					}
				}
			},
			
			{
				name: 'user',
				definition: {
					url: '/user/{userId:(?!.*[.]{2})(?![.])(?!.*[.]$)[.0-9A-Za-z]{1,32}}',
					controllers: {
						__: 'LogInViewController',
						ad: 'UserViewController',
						dr: 'UserViewController',
						op: 'UserViewController'
					}
				}
			}
		];
		
		// Registers the states, applying general configurations first
		for (var i = 0; i < states.length; i++) {
			var state = states[i];
			var definition = state.definition;
			
			// Sets a template to include the layout
			definition.template = '<span layout></span>';
			
			// Registers the state
			$stateProvider.state(state.name, definition);
		}
		
		// Sets the default route
		$urlRouterProvider.otherwise('/');
	}
	
	/*
	 * Performs module initialization tasks.
	 */
	function run($rootScope, $state, authentication, errorHandler, layout, router, view) {
		/*
		 * Sets the layout and view.
		 */
		function setLayoutAndView() {
			setLayout();
			setView();
		}
		
		/*
		 * Sets the layout, according to the state of the application.
		 */
		function setLayout() {
			// Gets the name of the layout's controller
			var controllerName;
			if (errorHandler.errorOccurred()) {
				// An error occurred
				controllerName = 'ErrorLayoutController';
			} else {
				// No error occurred
				if (authentication.isReady()) {
					// The authentication service is ready	
					controllerName = 'SiteLayoutController';
				} else {
					// The authentication service is not ready
					controllerName = 'LoadingLayoutController';
				}
			}
			
			// Sets the name of the layout's controller
			layout.setControllerName(controllerName);
		}
		
		/*
		 * Sets the view, according to the state of the application.
		 * 
		 * If the current state doesn't have a controller intended for the
		 * requesting user, it redirects her to the root route.
		 */
		function setView() {
			var controllers = $state.current.controllers;
			
			if (! authentication.isReady()) {
				// The authentication service is not ready
				return;
			}

			// Gets the user's role
			var userRole;
			if (authentication.isUserLoggedIn()) {
				// The user is logged in
				userRole = authentication.getLoggedInUser().role;
			} else {
				// The user is not logged in
				userRole = '__';
			}

			if (! controllers.hasOwnProperty(userRole)) {
				// The user is not authorized to access the current route

				// Redirects the user to the root route
				router.redirect('/');

				return;
			}

			// Sets the name of the view's controller
			var controllerName = controllers[userRole];
			view.setControllerName(controllerName);
		}
		
		// Listens for state transitions
		$rootScope.$on('$stateChangeSuccess', function() {
			// Sets the layout and view
			setLayoutAndView();
		});
		
		// Listens for changes in the authentication service
		$rootScope.$watch(authentication.isReady, function() {
			// Sets the layout and view
			setLayoutAndView();
		});
		
		// Listens for changes in the error handler service
		$rootScope.$watch(errorHandler.errorOccurred, function() {
			// Sets the layout and view
			setLayoutAndView();
		});
	}
	
	/*
	 * Service: router
	 * 
	 * Offers functions to perform routing actions.
	 */
	function routerService($location) {
		var service = this;
		
		/*
		 * Redirects the user to a certain route.
		 * 
		 * It receives the redirect route.
		 */
		service.redirect = function(route) {
			$location.path(route);
		};
	}
})();
