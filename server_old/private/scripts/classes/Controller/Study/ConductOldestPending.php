<?php

namespace App\Controller\Study;

/*
 * This controller is responsible for the following service:
 * 
 * URI:		/server/study/conduct-oldest-pending
 * Method:	POST
 */
class ConductOldestPending extends \App\Controller\SynchronizedInternalController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Gets the oldest pending study
		$study = $app->data->study->getOldestPending();
		
		if (is_null($study)) {
			// There is no pending study
			return;
		}
		
		// Edits the study
		$app->data->study->edit($study['id'], false, $study['lastEditor'], $study['output'], $study['observations']);
		
		// Gets the study's experiment
		$experiment = $app->data->experiment->get($study['experiment']);
		
		// Gets the experiment's files
		$files = $app->data->experiment->getFiles($experiment['id']);
		foreach ($files as &$file) {
			$file = $app->data->file->get($file['id']);
		}
		
		// Gets the study's input
		$input = $app->data->file->get($study['input']);
		
		// Constructs the sandbox where the study will be conducted
		$this->constructSandbox($files, $input);
		
		// Conducts the study
		$this->conductStudy($experiment, $input);
		
		// Generates a random ID
		$id = $app->cryptography->generateRandomId();
		
		// Defines the output file's name
		$name = STUDY_OUTPUT_FILE_NAME;
		
		// Builds the output file's path
		$path = ROOT_DIRECTORY . '/private/sandbox/output/' . $name;
		
		// Moves the output file into the file system
		$hash = $app->files->move($id, $name, $path);
		
		// Creates the file
		$app->data->file->create($id, $study['lastEditor'], $name, $hash);
		
		// Edits the study
		$app->data->study->edit($study['id'], false, $study['lastEditor'], $id, $study['observations']);
		
		// Destroys the sandbox
		$this->destroySandbox($files, $input);
	}

	/*
	 * Returns the path of the file used as lock.
	 */
	protected function getLockFilePath() {
		// The service corresponds to a long cron job
		return ROOT_DIRECTORY . '/private/locks/long-cron-job.lock';
	}
	
	/*
	 * Conducts a study.
	 * 
	 * It receives the experiment and the study's input.
	 */
	private function conductStudy($experiment, $input) {
		$app = $this->app;
		
		// Builds the sandbox's directory
		$directory = ROOT_DIRECTORY . '/private/sandbox';
		
		// Defines the command line
		$commandLine = replacePlaceholders($experiment['commandLine'], [
			':input' => 'input/' . $input['name']
		]);
		
		// Executes the command line
		$app->webServer->executeCommandLine($directory, $commandLine);
	}
	
	/*
	 * Constructs the sandbox where the study will be conducted.
	 * 
	 * It receives the experiment's files and the study's input.
	 */
	private function constructSandbox($files, $input) {
		$app = $this->app;
		
		// Builds the sandbox's directory
		$directory = ROOT_DIRECTORY . '/private/sandbox';
		
		// Copies the experiment's files
		foreach ($files as $file) {
			$app->files->copy($file, $directory . '/' . $file['name']);
		}
		
		// Copies the study's input
		$app->files->copy($input, $directory . '/input/' . $input['name']);
	}
	
	/*
	 * Destroys the sandbox.
	 * 
	 * It receives the experiment's files and the study's input.
	 */
	private function destroySandbox($files, $input) {
		$app = $this->app;
		
		// Builds the sandbox's directory
		$directory = ROOT_DIRECTORY . '/private/sandbox';
		
		// Removes the copies of the experiment's files
		foreach ($files as $file) {
			$app->files->remove($directory . '/' . $file['name']);
		}
		
		// Removes the copies of the study's input
		$app->files->remove($directory . '/input/' . $input['name']);
	}

}
