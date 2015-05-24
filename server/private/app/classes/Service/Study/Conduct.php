<?php

/**
 * NEU-CO - Neuro-Cognitivo
 * Copyright (C) 2015 Federico Jasson
 * 
 * This program is free software: you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation, either version 3 of the License, or (at your option) any later
 * version.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU General Public License along with
 * this program. If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Service\Study;

/**
 * Represents the /study/conduct service.
 */
class Conduct extends \App\Service\Internal {
	
	/**
	 * Executes the service.
	 */
	protected function execute() {
		global $app;
		
		// Acquires a lock
		$lockAcquired = $app->lock->acquire('study-conduct');
		
		if (! $lockAcquired) {
			// The lock could not be acquired
			return;
		}
		
		// Gets the oldest pending study
		$studies = $app->data->getRepository('Entity:Study')->findNonDeletedBy([
			'state' => STUDY_STATE_PENDING
		], [
			'creationDateTime' => 'ASC'
		], 1);
		
		if (count($studies) === 0) {
			// No pending study has been found
			return;
		}
		
		// Gets the study
		$study = $studies[0];
		
		// Edits the study
		$study->setState(STUDY_STATE_CONDUCTING);
		$app->data->merge($study);

		// Commits the data changes
		$app->data->flush();
		
		try {
			// Conducts the study
			$this->conductStudy($study);
			
			// Edits the study
			$study->setState(STUDY_STATE_SUCCESS);
			$app->data->merge($study);
		} catch (\Exception $exception) {
			// The operation failed
			
			// Edits the study
			$study->setState(STUDY_STATE_FAILURE);
			$app->data->merge($study);
			
			// Rethrows the exception
			throw $exception;
		} finally {
			// Commits the data changes
			$app->data->flush();
		}
	}
	
	/**
	 * Determines whether the request is valid.
	 */
	protected function isRequestValid() {
		return true;
	}
	
	/**
	 * Conducts a study.
	 * 
	 * Receives the study.
	 */
	private function conductStudy($study) {
		global $app;
		
		try {
			// Defines the directory
			$directory = DIRECTORY_SANDBOX;
			
			// Gets the study's experiment
			$experiment = $study->getExperiment();
			
			// Gets the study's input
			$input = $study->getInput();
			
			// Destroys the sandbox
			$this->destroySandbox($directory);
			
			// Creates the sandbox
			$this->createSandbox($directory, $experiment, $input);
			
			// Executes the experiment
			$this->executeExperiment($directory, $experiment, $input);
			
			// Processes the output of the experiment
			$output = $this->processExperimentOutput($directory, $experiment);
			
			// Edits the study
			$study->setOutput($output);
			$app->data->merge($study);
		} finally {
			// Destroys the sandbox
			$this->destroySandbox($directory);
		}
	}
	
	/**
	 * Creates a sandbox.
	 * 
	 * Receives the sandbox's directory, the experiment and the input.
	 */
	private function createSandbox($directory, $experiment, $input) {
		global $app;
		
		$destinationPaths = [];
		$hashes = [];
		
		// Adds the destination paths and the hashes of the experiment's files
		foreach ($experiment->getFiles() as $file) {
			$destinationPath = buildPath($directory, $file->getName());
			$destinationPaths[$file->getId()] = $destinationPath;
			$hashes[$file->getId()] = $file->getHash();
		}
		
		// Adds the destination path and the hash of the input
		$destinationPath = buildPath($directory, 'input', $input->getName());
		$destinationPaths[$input->getId()] = $destinationPath;
		$hashes[$input->getId()] = $input->getHash();
		
		// Copies the files to the sandbox
		foreach ($destinationPaths as $id => $destinationPath) {
			// Gets the path
			$path = $app->file->getPath($id);
			
			// Checks the file's integrity
			$app->file->checkIntegrity($path, $hashes[$id]);
			
			// Copies the file
			$app->file->copy($path, $destinationPath);
		}
		
		// Creates the output directory
		$app->file->createDirectory(buildPath($directory, 'output', $experiment->getOutputName()));
	}
	
	/**
	 * Destroys a sandbox.
	 * 
	 * Receives the sandbox's directory.
	 */
	private function destroySandbox($directory) {
		global $app;
		
		// Clears the directory
		$app->file->clearDirectory($directory);
	}
	
	/**
	 * Executes an experiment.
	 * 
	 * Receives the sandbox's directory, the experiment and the input.
	 */
	private function executeExperiment($directory, $experiment, $input) {
		// Builds the definitive command line
		$commandLine = replacePlaceholders($experiment->getCommandLine(), [
			'input' => '"' . buildPath('input', $input->getName()) . '"'
		]);
		
		// Saves the current working directory
		$workingDirectory = getcwd();
		
		// Sets the directory as the working directory
		chdir($directory);
		
		// Executes the command line
		exec($commandLine);
		
		// Restores the working directory
		chdir($workingDirectory);
	}
	
	/**
	 * Processes the output of an experiment.
	 * 
	 * Receives the sandbox's directory and the experiment.
	 */
	private function processExperimentOutput($directory, $experiment) {
		global $app;
		
		// Gets the name of the experiment's output
		$name = $experiment->getOutputName();
		
		// Builds the temporary path
		$temporaryPath = buildPath($directory, 'output', $name);
		
		// Checks the file's existence
		$app->file->checkExistence($temporaryPath);
		
		// Computes the file's hash
		$hash = $app->cryptography->computeFileHash($temporaryPath);
		
		// Creates the file
		$file = new \App\Data\Entity\File();
		$file->setHash($hash);
		$file->setName($name);
		$app->data->persist($file);
		
		// Gets the file's ID
		$id = $file->getId();
		
		// Admits the file
		$app->file->admit($id, $temporaryPath);
		
		return $file;
	}
	
}
