(function() {
	// Module
	var module = angular.module('views', ['ngRoute']);
	
	// Controllers
	module.controller('EditPatientViewController', ['$routeParams', EditPatientViewController]);
	
	/*
	 * Controller: EditPatientViewController.
	 * Gets the patient ID received in the route and loads the patient data.
	 */
	function EditPatientViewController($routeParams) {
		/*
		 * The patient to be edited.
		 */
		this.patient = $routeParams.patientId; // TODO: load patient
	};
})();
