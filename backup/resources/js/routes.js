(function() {
	var module = angular.module('routes', ['ngRoute', 'views']);
	module.config(['$routeProvider', config]);
	
	function config($routeProvider) {
		// TODO
		$routeProvider.when('/', {
			templateUrl: 'views/main.html'
		});
		
		// TODO
		$routeProvider.when('/edit-patient/:patientId', {
			controller: 'EditPatientController',
			controllerAs: 'view',
			templateUrl: 'views/edit-patient.html'
		});
		
		// TODO
		$routeProvider.when('/new-patient', {
			templateUrl: 'views/new-patient.html'
		});
		
		// TODO
		$routeProvider.otherwise({
			redirectTo: '/'
		});
	};
})();

