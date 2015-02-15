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
	
	$id = generateRandomId();
	$hash = uploadFile($id, 'Reporte.pdf', $directory . '/output/Reporte.pdf');
	createFile($pdo0, $id, $sandbox['creator'], 'Reporte.pdf', $hash);
	updateStudy($pdo0, $study['id'], $sandbox['creator'], $id);
	deleteSandbox($pdo1, $sandbox['id']);
	
	// TODO: remove sandbox physically
}

// TODO: clean code

// TODO: non deleted only (RECHECK!)

function deleteSandbox($pdo, $id) {
	// Defines the statement
	$statement = '
		DELETE
		FROM sandboxes
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
}

function updateStudy($pdo, $id, $lastEditor, $output) {
	// Defines the statement
	$statement = '
		UPDATE studies
		SET
			last_editor = :lastEditor,
			last_edition_datetime = UTC_TIMESTAMP(),
			output = :output
		WHERE id = :id
		LIMIT 1
	';

	// Defines the parameters
	$parameters = [
		':id' => $id,
		':lastEditor' => $lastEditor,
		':output' => $output
	];

	// Prepares and executes the statement
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute($parameters);
}

function generateRandomId() {
	return openssl_random_pseudo_bytes(LENGTH_RANDOM_ID);
}

function hashFile($path) {
	return md5_file($path, true);
}

function uploadFile($id, $name, $temporaryPath) {
	$path = getFilePath($id, $name);
	
	// TODO: checkFileNonExistence($path);
	
	$directory = dirname($path);
	mkdir($directory, ACCESS_PERMISSIONS_DIRECTORY, true);
	rename($temporaryPath, $path);
	$hash = hashFile($path);
	
	return $hash;
}

function createFile($pdo, $id, $creator, $name, $hash) {
	// Defines the statement
	$statement = '
		INSERT INTO files (
			id,
			deleted,
			creator,
			last_editor,
			creation_datetime,
			last_edition_datetime,
			name,
			hash
		)
		VALUES (
			:id,
			FALSE,
			:creator,
			:lastEditor,
			UTC_TIMESTAMP(),
			UTC_TIMESTAMP(),
			:name,
			:hash
		)
	';

	// Defines the parameters
	$parameters = [
		':id' => $id,
		':creator' => $creator,
		':lastEditor' => $creator,
		':name' => $name,
		':hash' => $hash
	];

	// Prepares and executes the statement
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute($parameters);
}

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
	return ROOT_DIRECTORY . '/private/files/' . implode('/', $subdirectories) . '/' . $name;
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
