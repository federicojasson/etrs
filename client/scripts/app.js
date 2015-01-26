// Uses strict mode in the whole script
'use strict';

(function() {
	angular.module('app', [
		'ngResource',
		'angularFileUpload',
		'app.authentication',
		'app.communications',
		'app.experiments',
		'app.patients',
		'app.routing',
		'app.title',
		'app.users',
		'app.utilities'
	]);
})();
