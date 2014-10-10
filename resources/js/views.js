(function() {
	// Module
	var module = angular.module('views', ['ngRoute']);
	
	// Controllers
	module.controller('EditPatientViewController', ['$routeParams', EditPatientViewController]);
	
	/*
	 * Controller: EditPatientViewController.
	 * Holds the values received in the route.
	 */
	function EditPatientViewController($routeParams) {
		/*
		 * The ID of the patient to be edited.
		 */
		this.patientId = $routeParams.patientId;
	};
})();
