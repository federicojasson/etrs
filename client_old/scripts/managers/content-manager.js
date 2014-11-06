// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('managers');
	
	// Services
	module.service('contentManager', contentManagerService);
	
	/*
	 * Service: contentManager.
	 * 
	 * TODO
	 */
	function contentManagerService() {
		var service = this;
		
		/*
		 * TODO
		 */
		service.errors = null;
		
		/*
		 * TODO
		 */
		service.getError = function(errorCode) {
			if (service.errors === null) {
				
			}
			
			var errors = service.errors;
			for (var i = 0; i < errors.length; i++) {
				var error = errors[i];
				
				if (error.code === errorCode) {
					return error;
				}
			}
		};
		
		// TODO
	}
})();
