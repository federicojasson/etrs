(function() {
	var module = angular.module('views', []);
	module.controller('EditPatientController', ['$routeParams', EditPatientController]);
	
	/*
	 * TODO
	 */
	function EditPatientController($routeParams) {
		var controller = this;
		
		/*
		 * TODO
		 */
		controller.patientId = $routeParams.patientId;
	};
})();
