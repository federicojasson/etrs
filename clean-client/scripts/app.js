// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: app
	var module = angular.module('app', [
		'ui.bootstrap',
		'ui.router'
	]);
	
	// Config
	module.config([
		'$locationProvider',
		'$stateProvider',
		'$urlRouterProvider',
		config
	]);
	
	// Controller: AccessController
	module.controller('AccessController', [
		'$state',
		AccessController
	]);
	
	// Run
	module.run([
		'$rootScope',
		run
	]);
	
	/*
	 * Applies application-wide configurations.
	 */
	function config($locationProvider, $stateProvider, $urlRouterProvider) {
		// TODO: comments
		
		var inclusionTemplate = '<span ui-view></span>';
		
		// Activates the HTML5 history API
		$locationProvider.html5Mode(true);
		
		$stateProvider.state('default', {
			abstract: true,
			templateUrl: 'templates/layouts/default-layout.html'
		});
		
		$stateProvider.state('default.contact', {
			templateUrl: 'templates/views/contact-view.html',
			url: '/contact'
		});
		
		$stateProvider.state('default.index', {
			controller: 'AccessController',
			template: inclusionTemplate,
			url: '/'
		});
		
		$stateProvider.state('default.index.private', {
			templateUrl: 'templates/views/index-view.html'
		});
		
		$stateProvider.state('default.index.public', {
			templateUrl: 'templates/views/log-in-view.html'
		});
		
		$stateProvider.state('default.tasks', {
			controller: 'AccessController',
			template: inclusionTemplate,
			url: '/tasks'
		});
		
		$stateProvider.state('default.tasks.private', {
			templateUrl: 'templates/views/tasks-view.html'
		});
		
		$stateProvider.state('default.tasks.public', {
			templateUrl: 'templates/views/log-in-view.html'
		});
		
		$urlRouterProvider.otherwise('/');
	}
	
	/*
	 * Controller: AccessController
	 * 
	 * TODO: comments
	 */
	function AccessController($state) {
		// TODO: chequear si esta logueado
		var loggedIn = false;
		
		if (loggedIn) {
			$state.go('.private');
		} else {
			$state.go('.public');
		}
	}
	
	/*
	 * TODO: comments
	 */
	function run($rootScope) {
		$rootScope.$on('$stateChangeError', function() {
			console.log('$stateChangeError');
		});
		
		$rootScope.$on('$stateChangeStart', function() {
			console.log('$stateChangeStart');
		});
		
		$rootScope.$on('$stateChangeSuccess', function() {
			console.log('$stateChangeSuccess');
		});
		
		$rootScope.$on('$stateNotFound', function() {
			console.log('$stateNotFound');
		});
		
		$rootScope.$on('$viewContentLoaded', function() {
			console.log('$viewContentLoaded');
		});
		
		$rootScope.$on('$viewContentLoading', function() {
			console.log('$viewContentLoading');
		});
	}
})();

