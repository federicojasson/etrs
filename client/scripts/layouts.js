// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: layouts
	var module = angular.module('layouts', [
		'authentication'
	]);
	
	// Directive: layout
	module.directive('layout', [
        '$controller',
        'authentication',
        layoutDirective
    ]);
	
	/*
	 * Directive: layout
	 * 
	 * Includes the layout.
	 */
	function layoutDirective($controller, authentication) {
        /*
         * TODO: comments
         * TODO: name
         */
        function getControllerName() {
            if (! authentication.isReady()) {
                // The authentication service is not ready
                return 'LoadingLayoutController';
            }
            
            // TODO: error
            
            return 'SiteLayoutController';
        }
        
		/*
		 * Returns the directive's options.
		 */
		function getOptions() {
			return {
                link: link,
				scope: {},
				template: '<span ng-include="layout.getTemplateUrl()"></span>'
			};
		}
        
        /*
         * TODO: comments
         */
        function link(scope) {
            // TODO: check
            var controllerName = getControllerName();
            scope.layout = $controller(controllerName);
        }
		
		// Gets and returns the directive's options
		return getOptions();
	}
})();
