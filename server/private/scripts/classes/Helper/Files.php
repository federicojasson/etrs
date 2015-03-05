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
 * Offers file-related functionalities.
 * TODO: check class
 */
class Files {
	
	/**
	 * TODO: comment
	 */
	public function download($file) {
		global $app;
		
		// Gets the path of the file
		$path = $this->getFilePath($file->getId());
		
		// Asserts conditions
		$app->assertor->fileExists($path);
		$app->assertor->fileNotCorrupted($file, $path);
		
		// Sets the appropriate headers
		$app->response->headers->set('Content-Disposition', 'attachment; filename=' . $file->getName());
		$app->response->headers->set('Content-Length', filesize($path));
		$app->response->headers->set('Content-Type', 'application/octet-stream');
		
		// Sets an Apache environment variable to allow the download
		apache_setenv(APACHE_ENVIRONMENT_VARIABLE_ETRS_SUBREQUEST, '1');
		
		// Initiates the download
		virtual($path);
	}
	
	/**
	 * TODO: comment
	 */
	public function upload($id, $temporaryPath) {
		global $app;
		
		// Gets the path where the file will be permanently located
		$path = $this->getFilePath($id);
		
		// Asserts conditions
		$app->assertor->fileDoesNotExist($path); // TODO: unnecesary?
		
		// Moves the file to its permanent location
		$this->moveFile($temporaryPath, $path, 'move_uploaded_file');
		
		// Computes the hash of the file
		$hash = $app->cryptography->hashFile($path);
		
		return $hash;
	}
	
	/**
	 * TODO: comment
	 */
	private function getFilePath($id) {
		// Converts the ID to hexadecimal
		$id = bin2hex($id);
		
		// Gets the subdirectories
		$subdirectories = str_split($id, 8);
		
		// Builds the path of the file
		$path = '';
		$path .= DIRECTORY_FILES;
		$path .= '/' . implode('/', $subdirectories);
		$path .= '/' . $id;
		
		return $path;
	}
	
	/**
	 * TODO: comment
	 */
	private function moveFile($sourcePath, $destionationPath, $function) {
		// TODO: implement
	}
	
}
