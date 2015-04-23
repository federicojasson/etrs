<?php

/**
 * ETRS - Eye Tracking Record System
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
			'creationDateTime' => 'asc'
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
		try {
			// TODO: comment and order
			
			$directory = DIRECTORY_SANDBOX;
			$experiment = $study->getExperiment();
			$input = $study->getInput();
			
			$this->createSandbox($directory, $experiment, $input);
			$this->executeExperiment($directory, $experiment, $input);
			$this->processOutput($directory, $study);
		} finally {
			$this->destroySandbox($directory);
		}
	}
	
	/**
	 * TODO: comment
	 */
	private function createSandbox($directory, $experiment, $input) {
		// TODO: comment and order
		global $app;
		
		$files = [];
		foreach ($experiment->getFiles() as $file) {
			$sourcePath = $app->file->getPath($file->getId());
			$destinationPath = $directory . '/' . $file->getName();
			$files[$sourcePath] = $destinationPath;
		}
		
		$files[$app->file->getPath($input->getId())] = $directory . '/input/' . $input->getName();
		
		foreach ($files as $sourcePath => $destinationPath) {
			$app->file->copy($sourcePath, $destinationPath);
		}
	}
	
	/**
	 * TODO: comment
	 */
	private function destroySandbox($directory) {
		// TODO
	}
	
	/**
	 * TODO: comemnt
	 */
	private function executeExperiment($directory, $experiment, $input) {
		// TODO: comment and order
		
		$commandLine = replacePlaceholders($experiment->getCommandLine(), [
			'input' => 'input/' . $input->getName()
		]);
		
		$workingDirectory = getcwd();
		chdir($directory);
		exec($commandLine);
		chdir($workingDirectory);
	}
	
	/**
	 * TODO: comment
	 */
	private function processOutput($directory, $study) {
		global $app;
		// TODO: comment and order
		
		$name = 'report.pdf'; // TODO
		$temporaryPath = $directory . '/output/' . $name;
		
		$app->file->checkExistence($temporaryPath);
		
		$hash = $app->cryptography->computeFileHash($temporaryPath);
		
		$output = new \App\Data\Entity\File();
		$output->setHash($hash);
		$output->setName($name);
		$output->setCreator($study->getCreator());
		$app->data->persist($output);
		
		$id = $output->getId();
		
		$app->file->admit($id, $temporaryPath);
		
		$study->setOutput($output);
		$app->data->merge($study);
	}
	
}
