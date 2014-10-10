(function() {
	// Module
	var module = angular.module('utilities', []);
	
	// Controllers
	module.controller('NoYesInputController', NoYesInputController);
	
	// Directives
	module.directive('inputFormSection', inputFormSectionDirective);
	module.directive('noYesInput', noYesInputDirective);
	
	// Services
	module.service('stringProcessor', stringProcessorService);
	
	/*
	 * TODO
	 */
	function NoYesInputController() {
		/*
		 * TODO
		 */
		this.values = [
			true,
			false,
			''
		];
	};
	
	/*
	 * TODO
	 */
	function inputFormSectionDirective() {
		var scope = {
			label: '@'
		};
		
		var options = {
			restrict: 'E',
			scope: scope,
			templateUrl: 'internal/templates/components/input-form-section.html',
			transclude: true
		};
		
		return options;
	};
	
	/*
	 * TODO
	 */
	function noYesInputDirective() {
		var scope = {
			model: '=',
			name: '@'
		};
		
		var options = {
			controller: 'NoYesInputController',
			controllerAs: 'input',
			restrict: 'E',
			scope: scope,
			templateUrl: 'internal/templates/components/no-yes-input.html'
		};
		
		return options;
	};
	
	/*
	 * Service: stringProcessor.
	 * Offers functions to process strings.
	 */
	function stringProcessorService() {
		/*
		 * Given a string, it replaces all its consecutive whitespaces by a
		 * single one.
		 */
		this.removeMultipleWhitespaces = function(string) {
			return string.replace(/\s+/g, ' ');
		};
		
		/*
		 * Given a string, it removes all its non-numeric characters.
		 */
		this.removeNonNumberCharacters = function(string) {
			return string.replace(/[^0-9]/g, '');
		};
		
		/*
		 * Given a string, it converts its lowercase characters to uppercase.
		 */
		this.toUpperCase = function(string) {
			return string.toUpperCase();
		};
		
		/*
		 * Given a string, it trims it.
		 */
		this.trim = function(string) {
			if (String.prototype.trim)
				// string.trim() is defined
				return string.trim();
			else
				// string.trim() is undefined; a custom trim is performed
				return string.replace(/^\s+|\s+$/g, '');
		};
	};
})();
