(function() {
	// Module
	var module = angular.module('routes', [ 'ngRoute', 'views' ]);
	
	// Configuration
	module.config([ '$routeProvider', config ]);
	
	/*
	 * Applies the route configurations.
	 * Defines the actions to take according to the received route. This may be,
	 * for example, load a controller or render a view.
	 */
	function config($routeProvider) {
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
		 * Default action.
		 * Redirects to the root route.
		 */
		$routeProvider.otherwise({
			redirectTo: '/'
		});
	};
})();
