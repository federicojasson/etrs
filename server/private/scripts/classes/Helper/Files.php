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
		$app = $this->app;
		
		// Gets the file's path
		$path = $this->getFilePath($file['id'], $file['name']);
		
		// Checks the existence of the file
		$this->checkFileExistence($path);
		
		// Checks the integrity of the file
		$this->checkFileIntegrity($file);
		
		// Sets the proper headers
		$app->response->headers->set('Content-Disposition', 'attachment; filename=' . $file['name']); // TODO: is Content-Disposition safe?
		$app->response->headers->set('Content-Length', filesize($path));
		$app->response->headers->set('Content-Type', 'application/octet-stream');
		
		// Sets an Apache environment variable to allow the download
		apache_setenv('APACHE_ENVIRONMENT_VARIABLE_DOWNLOAD', '1');
		
		// Initiates the download
		virtual($path);
	}
	
	/*
	 * Uploads a file and returns its hash.
	 * 
	 * It receives the file's ID, name and temporary path.
	 */
	public function upload($id, $name, $temporaryPath) {
		$app = $this->app;
		
		// Gets the path where the file should be permanently located
		$path = $this->getFilePath($id, $name);
		
		// Checks the non-existence of the file
		$this->checkFileNonExistence($path);
		
		// Moves the temporary file to its permanent location
		$this->moveTemporaryFile($temporaryPath, $path);
		
		// Computes the hash of the file
		$hash = $app->cryptography->hashFile($path);
		
		return $hash;
	}
	
	/*
	 * Checks the existence of a file. If it doesn't exist, the execution is
	 * halted.
	 * 
	 * It receives the file's path.
	 */
	private function checkFileExistence($path) {
		$app = $this->app;
		
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
	 * Checks the non-existence of a file. If it exists, the execution is
	 * halted.
	 * 
	 * It receives the file's path.
	 */
	private function checkFileNonExistence($path) {
		$app = $this->app;
		
		if (file_exists($path)) {
			// The file exists
			
			// Logs the event
			$app->log->critical('The file ' . $path . ' already exists.');
			
			// Halts the execution
			$app->halt(HTTP_STATUS_INTERNAL_SERVER_ERROR, [
				'error' => ERROR_ALREADY_EXISTING_FILE
			]);
		}
	}
	
	/*
	 * Creates a file's directory, if it doesn't exist already. If the operation
	 * fails, the execution is halted.
	 * 
	 * It receives the file's path.
	 */
	private function createFileDirectory($path) {
		$app = $this->app;
		
		// Gets the directory
		$directory = dirname($path);
		
		if (is_dir($directory)) {
			// The directory already exists
			return;
		}
		
		// Creates the directory
		$created = mkdir($directory, ACCESS_PERMISSIONS_DIRECTORY, true);
		
		if (! $created) {
			// The directory could not be created
			
			// Logs the event
			$app->log->critical('The directory ' . $directory . ' could not be created.');
			
			// Halts the execution
			$app->halt(HTTP_STATUS_INTERNAL_SERVER_ERROR, [
				'error' => ERROR_FILE_SYSTEM_PROBLEM
			]);
		}
	}
	
	/*
	 * Returns a file's path.
	 * 
	 * It receives the file's ID and name.
	 */
	private function getFilePath($id, $name) {
		// Gets the file's relative path
		$relativePath = $this->getRelativeFilePath($id, $name);
		
		// Builds and returns the path
		return ROOT_PATH . 'private/files/' . $relativePath;
	}
	
	/*
	 * Returns a file's relative path.
	 * 
	 * It receives the file's ID and name.
	 */
	private function getRelativeFilePath($id, $name) {
		// Converts the ID to hexadecimal
		$id = bin2hex($id);
		
		// Gets the subdirectories
		$subdirectories = str_split($id, 4);
		
		// Builds and returns the path
		return implode('/', $subdirectories) . '/' . $name;
	}
	
	/*
	 * Moves a temporary file to a permanent location. If the operation fails,
	 * the execution is halted.
	 * 
	 * It receives the file's temporary path and the destination path.
	 */
	private function moveTemporaryFile($temporaryPath, $path) {
		$app = $this->app;
		
		// Creates the destination directory
		$this->createFileDirectory($path);
		
		// Moves the file
		$moved = move_uploaded_file($temporaryPath, $path);
		
		if (! $moved) {
			// The file could not be moved
			
			// Logs the event
			$app->log->critical('The temporary file ' . $temporaryPath . ' could not be moved to its permanent location ' . $path . '.');
			
			// Halts the execution
			$app->halt(HTTP_STATUS_INTERNAL_SERVER_ERROR, [
				'error' => ERROR_FILE_SYSTEM_PROBLEM
			]);
		}
		
		// Sets the file's access permissions
		$this->setFileAccessPermissions($path, ACCESS_PERMISSIONS_FILE);
	}
	
	/*
	 * Sets a file's access permissions.
	 * 
	 * It receives the file's path and the access permissions to be set.
	 */
	private function setFileAccessPermissions($path, $accessPermissions) {
		$app = $this->app;
		
		// Sets the file's access permissions
		$set = chmod($path, $accessPermissions);
		
		if (! $set) {
			// The access permissions could not be set
			
			// Logs the event
			$app->log->warning('The access permissions of the file ' . $path . ' could not be set.');
		}
	}
	
}
