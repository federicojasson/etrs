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

namespace App\Helper;

/**
 * Provides file-related functionalities.
 */
class File {
	
	/**
	 * Downloads a file.
	 * 
	 * Receives the file's ID, hash and name.
	 */
	public function download($id, $hash, $name) {
		global $app;
		
		// Gets the path
		$path = $this->getPath($id);
		
		// Determines whether the file exists
		$exists = file_exists($path);
		
		if (! $exists) {
			// The file doesn't exist
			// Logs the event
			$app->log->critical('The file ' . $path . ' doesn\'t exist.');
		}
		
		// Asserts conditions
		$app->assertion->fileExists($exists);
		
		// Checks the integrity
		$this->checkIntegrity($path, $hash);
		
		// Gets the size
		$size = filesize($path);
		
		// Sets the appropriate headers
		$app->response->headers->set('Content-Type', 'application/octet-stream');
		$app->response->headers->set('Content-Length', $size);
		$app->response->headers->set('Content-Disposition', 'attachment; filename=' . $name);
		
		// Sets an Apache environment variable to allow the download
		apache_setenv(APACHE_ENVIRONMENT_VARIABLE_ETRS_SUBREQUEST, 1);
		
		// Initiates the download
		virtual($path);
	}
	
	/**
	 * Uploads a file.
	 * 
	 * Receives the file's ID and temporary path.
	 */
	public function upload($id, $temporaryPath) {
		global $app;
		
		// Determines whether the file has been uploaded
		$uploaded = is_uploaded_file($temporaryPath);
		
		if (! $uploaded) {
			// The file has not been uploaded
			// Logs the event
			$app->log->emergency('The file ' . $temporaryPath . ' has not been uploaded. Possible security breach.');
		}
		
		// Asserts conditions
		$app->assertion->fileUploaded($uploaded);
		
		// Gets the path
		$path = $this->getPath($id);
		
		// Determines whether the file already exists
		$exists = file_exists($path);
		
		if ($exists) {
			// The file already exists
			// Logs the event
			$app->log->critical('The file ' . $path . ' already exists.');
		}
		
		// Asserts conditions
		$app->assertion->fileDoesNotExist($exists);
		
		// Moves the file
		$this->move($temporaryPath, $path);
	}
	
	/**
	 * Checks a file's integrity.
	 * 
	 * Receives the file's path and hash.
	 */
	private function checkIntegrity($path, $hash) {
		global $app;
		
		// Computes the hash
		$currentHash = $app->cryptography->computeFileHash($path);
		
		// Compares the hashes
		$corrupted = $hash !== $currentHash;
		
		if ($corrupted) {
			// The file is corrupted
			// Logs the event
			$app->log->alert('The file ' . $path . ' is corrupted.');
		}
		
		// Asserts conditions
		$app->assertion->fileNotCorrupted($corrupted);
	}
	
	/**
	 * Creates a file's directory if it doesn't exist.
	 * 
	 * Receives the file's path.
	 */
	private function createDirectory($path) {
		global $app;
		
		// Gets the directory
		$directory = dirname($path);
		
		if (is_dir($directory)) {
			// The directory already exists
			return;
		}
		
		// Creates the directory
		$created = mdkir($directory, '', true); // TODO: define access permissions (constant?)
		
		if (! $created) {
			// The directory could not be created
			// Logs the event
			$app->log->critical('The directory ' . $directory . ' could not be created.');
		}
		
		// Asserts conditions
		$app->assertion->directoryCreated($created);
	}
	
	/**
	 * Returns a file's path.
	 * 
	 * Receives the file's ID.
	 */
	private function getPath($id) {
		// Converts the ID from binary to hexadecimal
		$id = bin2hex($id);
		
		// Builds the path
		$path = '';
		$path .= DIRECTORY_FILES;
		$path .= '/' . implode('/', str_split($id, 4)) . '/' . $id;
		
		return $path;
	}
	
	/**
	 * Moves a file.
	 * 
	 * Receives the source and destination paths.
	 */
	private function move($sourcePath, $destinationPath) {
		global $app;
		
		// Creates the destination directory
		$this->createDirectory($destinationPath);
		
		// Moves the file
		$moved = rename($sourcePath, $destinationPath);
		
		if (! $moved) {
			// The file could not be moved
			// Logs the event
			$app->log->critical('The file ' . $sourcePath . ' could not be moved to ' . $destinationPath . '.');
		}
		
		// Asserts conditions
		$app->assertion->fileMoved($moved);
		
		// Sets the access permissions
		$this->setAccessPermissions($destinationPath, ''); // TODO: define access permissions (constant?)
	}
	
	/**
	 * Sets a file's access permissions.
	 * 
	 * Receives the file's path and the access permissions to be set.
	 */
	private function setAccessPermissions($path, $accessPermissions) {
		global $app;
		
		// Sets the access permissions
		$set = chmod($path, $accessPermissions);
		
		if (! $set) {
			// The access permissions could not be set
			// Logs the event
			$app->log->critical('The access permissions of the file ' . $path . ' could not be set.');
		}
		
		// Asserts conditions
		$app->assertion->fileAccessPermissionsSet($set);
	}
	
}
