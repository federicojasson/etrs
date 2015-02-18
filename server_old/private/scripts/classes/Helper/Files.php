<?php

namespace App\Helper;

/*
 * This helper offers file-related functionalities.
 */
class Files extends Helper {
	
	/*
	 * Copies a file out of the file system.
	 * 
	 * It receives the file and the destination path.
	 */
	public function copy($file, $destinationPath) {
		// Gets the file's path
		$path = $this->getFilePath($file['id'], $file['name']);
		
		// Checks the existence of the file
		$this->checkFileExistence($path);
		
		// Checks the integrity of the file
		$this->checkFileIntegrity($file);
		
		// Copies the file
		$this->copyFile($path, $destinationPath);
	}
	
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
		$app->response->headers->set('Content-Disposition', 'attachment; filename=' . $file['name']);
		$app->response->headers->set('Content-Length', filesize($path));
		$app->response->headers->set('Content-Type', 'application/octet-stream');
		
		// Sets an Apache environment variable to allow the download
		apache_setenv('APACHE_ENVIRONMENT_VARIABLE_ETRS_SUBREQUEST', '1');
		
		// Initiates the download
		virtual($path);
	}
	
	/*
	 * Moves a file into the file system and returns its hash.
	 * 
	 * It receives the file's ID, name and source path.
	 */
	public function move($id, $name, $sourcePath) {
		$app = $this->app;
		
		// Gets the path where the file will be located permanently
		$path = $this->getFilePath($id, $name);
		
		// Checks the non-existence of the file
		$this->checkFileNonExistence($path);
		
		// Moves the file to its permanent location
		$this->moveFile($sourcePath, $path, 'rename');
		
		// Computes the hash of the file
		$hash = $app->cryptography->hashFile($path);
		
		return $hash;
	}
	
	/*
	 * Removes a file. If the operation fails, the execution is halted.
	 * 
	 * It receives the file's path.
	 */
	public function remove($path) {
		$app = $this->app;
		
		// Removes the file
		$removed = unlink($path);
		
		if (! $removed) {
			// The file could not be removed
			
			// Logs the event
			$app->log->critical('The file ' . $path . ' could not be removed.');
			
			// Halts the execution
			$app->halt(HTTP_STATUS_INTERNAL_SERVER_ERROR, [
				'error' => ERROR_FILE_SYSTEM_PROBLEM
			]);
		}
	}
	
	/*
	 * Uploads a file and returns its hash.
	 * 
	 * It receives the file's ID, name and source path.
	 */
	public function upload($id, $name, $sourcePath) {
		$app = $this->app;
		
		// Gets the path where the file will be located permanently
		$path = $this->getFilePath($id, $name);
		
		// Checks the non-existence of the file
		$this->checkFileNonExistence($path);
		
		// Moves the file to its permanent location
		$this->moveFile($sourcePath, $path, 'move_uploaded_file');
		
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
	 * Copies a file to a certain location. If the operation fails, the
	 * execution is halted.
	 * 
	 * It receives the source path and the destination path.
	 */
	private function copyFile($sourcePath, $destinationPath) {
		$app = $this->app;
		
		// Creates the destination directory
		$this->createFileDirectory($destinationPath);
		
		// Copies the file
		$copied = copy($sourcePath, $destinationPath);
		
		if (! $copied) {
			// The file could not be copied
			
			// Logs the event
			$app->log->critical('The file ' . $sourcePath . ' could not be copied to the location ' . $destinationPath . '.');
			
			// Halts the execution
			$app->halt(HTTP_STATUS_INTERNAL_SERVER_ERROR, [
				'error' => ERROR_FILE_SYSTEM_PROBLEM
			]);
		}
		
		// Sets the file's access permissions
		$this->setFileAccessPermissions($destinationPath, ACCESS_PERMISSIONS_FILE);
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
		return ROOT_DIRECTORY . '/private/files/' . $relativePath;
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
	 * Moves a file to a certain location. If the operation fails, the execution
	 * is halted.
	 * 
	 * It receives the source path, the destination path and a moving function
	 * to be invoked in order to move the file.
	 */
	private function moveFile($sourcePath, $destinationPath, $movingFunction) {
		$app = $this->app;
		
		// Creates the destination directory
		$this->createFileDirectory($destinationPath);
		
		// Invokes the moving function
		$moved = call_user_func($movingFunction, $sourcePath, $destinationPath);
		
		if (! $moved) {
			// The file could not be moved
			
			// Logs the event
			$app->log->critical('The file ' . $sourcePath . ' could not be moved to the location ' . $destinationPath . '.');
			
			// Halts the execution
			$app->halt(HTTP_STATUS_INTERNAL_SERVER_ERROR, [
				'error' => ERROR_FILE_SYSTEM_PROBLEM
			]);
		}
		
		// Sets the file's access permissions
		$this->setFileAccessPermissions($destinationPath, ACCESS_PERMISSIONS_FILE);
	}
	
	/*
	 * Sets the access permissions of a file.
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
