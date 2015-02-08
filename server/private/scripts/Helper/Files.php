<?php

namespace App\Helper;

/*
 * This helper offers file-related functionalities.
 */
class Files extends Helper {
	
	/*
	 * Downloads a file.
	 * 
	 * It receives the file.
	 */
	public function download($file) {
		// Checks the existence of the file
		$this->checkFileExistence($file);
		
		// Checks the integrity of the file
		$this->checkFileIntegrity($file);
		
		// Initiates the download
		$this->initiateDownload($file);
	}
	
	/*
	 * Checks the existence of a file. If it doesn't exist, the execution is
	 * halted.
	 * 
	 * It receives the file.
	 */
	private function checkFileExistence($file) {
		$app = $this->app;
		
		// Gets the file's path
		$path = $this->getFilePath($file['id'], $file['name']);
		
		if (! file_exists($path)) {
			// The file doesn't exist
			
			// Logs the event
			$app->log->critical('The file ' . $path . ' has not been found.');
			
			// Halts the execution
			$app->halt(HTTP_STATUS_INTERNAL_SERVER_ERROR, [
				'error' => ERROR_NON_EXISTENT_FILE
			]);
		}
	}
	
	/*
	 * Checks the integrity of a file. If it is corrupted, the execution is
	 * halted.
	 * 
	 * It receives the file.
	 */
	private function checkFileIntegrity($file) {
		$app = $this->app;
		
		// Gets the file's path
		$path = $this->getFilePath($file['id'], $file['name']);
		
		// Computes the hash of the file
		$hash = $app->cryptography->hashFile($path);
		
		if ($hash !== $file['hash']) {
			// The file is corrupted
			
			// Logs the event
			$app->log->alert('The file ' . $path . ' is corrupted.');
			
			// Halts the execution
			$app->halt(HTTP_STATUS_INTERNAL_SERVER_ERROR, [
				'error' => ERROR_CORRUPTED_FILE
			]);
		}
	}
	
	/*
	 * Returns a file's path.
	 * 
	 * It receives the file's ID and name.
	 */
	private function getFilePath($id, $name) {
		$app = $this->app;
		
		// Gets the directory's path
		$path = $app->parameters->paths['files'];
		
		// Gets the file's relative path
		$relativePath = $this->getRelativeFilePath($id, $name);
		
		// Builds and returns the path
		return $path . $relativePath;
	}
	
	/*
	 * Returns a file's relative path.
	 * 
	 * It receives the file's ID and name.
	 */
	private function getRelativeFilePath($id, $name) {
		// Converts the ID to hexadecimal
		$id = bin2hex($id);
		
		// Gets the directories
		$directories = str_split($id, 4);
		
		// Builds and returns the path
		return implode('/', $directories) . '/' . $name;
	}
	
	/*
	 * Initiates the download of a file.
	 * 
	 * It receives the file.
	 */
	private function initiateDownload($file) {
		// Gets the file's path
		$path = $this->getFilePath($file['id'], $file['name']);
		
		// TODO: headers
		readfile($path);
	}
	
}
