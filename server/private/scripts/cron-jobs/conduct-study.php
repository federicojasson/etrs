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
 * Executes the cron job.
 */
function execute() {
	// TODO: clean code
	
	// Connects to the business logic database
	$pdo0 = connectToBusinessLogicDatabase();
	
	// Connects to the web server database
	$pdo1 = connectToWebServerDatabase();
	
	$sandbox = getSandbox($pdo1);
	
	if (is_null($sandbox)) {
		return;
	}
	
	$directory = getSandboxDirectory($sandbox['id']);
	
	if (! is_dir($directory)) {
		mkdir($directory, ACCESS_PERMISSIONS_DIRECTORY, true);
	}
	
	mkdir($directory . '/input', ACCESS_PERMISSIONS_DIRECTORY);
	mkdir($directory . '/output', ACCESS_PERMISSIONS_DIRECTORY);
	
	$study = getStudy($pdo0, $sandbox['id']);
	
	$input = getFile($pdo0, $study['input']);
	$path = getFilePath($input['id'], $input['name']);
	copy($path, $directory . '/input/' . $input['name']);
	
	$files = getExperimentFiles($pdo0, $study['experiment']);
	foreach ($files as $file) {
		$path = getFilePath($file['id'], $file['name']);
		copy($path, $directory . '/' . $file['name']);
	}
	
	$experiment = getExperiment($pdo0, $study['experiment']);
	
	$commandLine = replacePlaceholders($experiment['commandLine'], [
		':input' => 'input/' . $input['name']
	]);
	chdir($directory);
	exec($commandLine);
	
	// TODO: move file to the corresponding location
}

// TODO: clean code

// TODO: non deleted only (RECHECK!)

function getExperiment($pdo, $id) {
	// Defines the statement
	$statement = '
		SELECT
			id,
			deleted,
			creator,
			last_editor AS lastEditor,
			creation_datetime AS creationDatetime,
			name,
			command_line AS commandLine
		FROM experiments
		WHERE id = :id
		LIMIT 1
	';
	
	// Defines the parameters
	$parameters = [
		':id' => $id
	];
	
	// Prepares and executes the statement
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute($parameters);
	
	// Fetches the results
	$results = $preparedStatement->fetchAll();
	
	// Returns the first result, or null if there is none
	return getFirstElementOrNull($results);
}

function getFile($pdo, $id) {
	// Defines the statement
	$statement = '
		SELECT
			id,
			deleted,
			creator,
			last_editor AS lastEditor,
			creation_datetime AS creationDatetime,
			name,
			hash
		FROM files
		WHERE id = :id
		LIMIT 1
	';
	
	// Defines the parameters
	$parameters = [
		':id' => $id
	];
	
	// Prepares and executes the statement
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute($parameters);
	
	// Fetches the results
	$results = $preparedStatement->fetchAll();
	
	// Returns the first result, or null if there is none
	return getFirstElementOrNull($results);
}

function getExperimentFiles($pdo, $experiment) {
	// Defines the statement
	$statement = '
		SELECT
			files.id,
			files.deleted,
			files.creator,
			files.last_editor AS lastEditor,
			files.creation_datetime AS creationDatetime,
			files.name,
			files.hash
		FROM experiments_files
		INNER JOIN files ON experiments_files.file = files.id
		WHERE experiments_files.experiment = :experiment
		LIMIT 1
	';
	
	// Defines the parameters
	$parameters = [
		':experiment' => $experiment
	];
	
	// Prepares and executes the statement
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute($parameters);
	
	// Fetches and returns the results
	return $preparedStatement->fetchAll();
}

function getFilePath($id, $name) {
	$id = bin2hex($id);
	$subdirectories = str_split($id, 4);
	return ROOT_DIRECTORY . '/private/files/' . implode('/', $subdirectories)  . '/' . $name;
}

function getSandbox($pdo) {
	// Defines the statement
	$statement = '
		SELECT
			id,
			creator,
			creation_datetime
		FROM sandboxes
		ORDER BY creation_datetime ASC
		LIMIT 1
	';
	
	// Prepares and executes the statement
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute();
	
	// Fetches the results
	$results = $preparedStatement->fetchAll();
	
	// Returns the first result, or null if there is none
	return getFirstElementOrNull($results);
}

function getSandboxDirectory($id) {
	$id = bin2hex($id);
	$subdirectories = str_split($id, 4);
	return ROOT_DIRECTORY . '/private/sandboxes/' . implode('/', $subdirectories);
}

function getStudy($pdo, $id) {
	// Defines the statement
	$statement = '
		SELECT
			id,
			deleted,
			consultation,
			creator,
			experiment,
			input,
			last_editor AS lastEditor,
			output,
			creation_datetime AS creationDatetime,
			last_edition_datetime AS lastEditionDatetime,
			observations
		FROM studies
		WHERE id = :id
		LIMIT 1
	';
	
	// Defines the parameters
	$parameters = [
		':id' => $id
	];
	
	// Prepares and executes the statement
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute($parameters);
	
	// Fetches the results
	$results = $preparedStatement->fetchAll();
	
	// Returns the first result, or null if there is none
	return getFirstElementOrNull($results);
}
