<?php

/*
 * This script conducts the first pending study it finds.
 */

// Defines the root path
define('ROOT_DIRECTORY', __DIR__ . '/../../..');

// Includes resources
require ROOT_DIRECTORY . '/private/scripts/resources/cron-job-utilities.php';

// Executes the cron job
executeLongCronJob('execute');

/*
 * TODO: comments
 */
function createSandbox() {
	// TODO
}

/*
 * TODO: comments
 */
function deleteSandbox() {
	// TODO
}

/*
 * Executes the cron job.
 */
function execute() {
	// Connects to the business logic database
	$pdo0 = connectToBusinessLogicDatabase();
	
	// Connects to the web server database
	$pdo1 = connectToWebServerDatabase();
	
	// Gets the oldest sandbox
	$sandbox = getOldestStudy($pdo1);
	
	// Creates the sandbox
	createSandbox($sandbox);
	
	// Conducts the experiment
	conductExperiment($sandbox);
	
	// Deletes the sandbox
	deleteSandbox($sandbox);
}

/*
 * TODO: comments
 */
function getOldestSandbox() {
	// TODO
}

/*
 * TODO: comments
 */
function getSandboxRelativeDirectory($id) {
	// Converts the ID to hexadecimal
	$id = bin2hex($id);
	
	// Gets the subdirectories
	$subdirectories = str_split($id, 4);
	
	// Builds and returns the path
	return implode('/', $subdirectories) . '/' . $name;
}
