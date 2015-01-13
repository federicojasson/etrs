// Uses strict mode in the whole script
'use strict';

(function() {
	angular.module('app', [
		'app.authentication',
		'app.experiments',
		'app.routing',
		'app.title',
		'app.users',
		'app.utilities'
	]);
})();
