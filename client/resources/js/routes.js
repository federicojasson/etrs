(function() {
	// Module
	var module = angular.module('routes', [ 'ngRoute', 'views' ]);
	
	// Configuration
	module.config([ '$locationProvider', '$routeProvider', configuration ]);
	
	/*
	 * Applies the route configurations.
	 * Defines the actions to take according to the received route. This may be,
	 * for example, load a controller or render a view.
	 */
	function configuration($locationProvider, $routeProvider) {
		/*
		 * Uses the HTML5 history API. This allows for use of regular URL path
		 * and search segments, instead of their hashbang equivalents. If the
		 * HTML5 history API is not supported by a browser, the service will
		 * fall back to using the hashbang URLs automatically.
		 */
		$locationProvider.html5Mode(true);
		
		/*
		 * Route: '/edit-patient/:patientId'.
		 * Renders the edit patient view and loads its controller.
		 */
		$routeProvider.when('/edit-patient/:patientId', {
			controller: 'EditPatientViewController',
			controllerAs: 'view',
			templateUrl: 'internal/templates/views/edit-patient.html'
		});
		
		/*
		 * Route: '/'.
		 * Renders the main view.
		 */
		$routeProvider.when('/', {
			templateUrl: 'internal/templates/views/main.html'
		});
		
		/*
		 * Route: '/new-patient'.
		 * Renders the new patient view.
		 */
		$routeProvider.when('/new-patient', {
			templateUrl: 'internal/templates/views/new-patient.html'
		});
		
		/*
		 * Route: '/patient'.
		 * Renders the patient view.
		 */
		$routeProvider.when('/patient/:patientId', {
			// TODO
			templateUrl: 'internal/templates/views/patient.html'
		});
		
		/*
		 * Route: '/patients'.
		 * Renders the patients view.
		 */
		$routeProvider.when('/patients', {
			templateUrl: 'internal/templates/views/patients.html'
		});
		
		/*
		 * Default action.
		 * Redirects to the root route.
		 */
		$routeProvider.otherwise({
			redirectTo: '/'
		});
	};
})();
