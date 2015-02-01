<?php

namespace App\Helpers;

/*
 * This helper offers file-related functionalities.
 */
class Files extends \App\Helpers\Helper {
	
	/*
	 * TODO: comments
	 */
	public function commitTemporaryFile($temporaryFile) { // TODO: it receives the file or the ID?
		// TODO: comments
		
		// TODO: remove temporary file from the database
		// TODO: add file into the database
		
		do {
			// Generates a random ID
			$id = $app->cryptography->generateRandomId();
		} while ($app->businessLogicDatabase->fileExists($id));
		
		// Gets the temporary file's path and the new path
		$path = $this->getTemporaryFilePath($temporaryFile['id'], $temporaryFile['name']);
		$newPath = $this->getFilePath($id, $temporaryFile['name']);
		
		// Moves the temporary file to its new location
		rename($path, $newPath);
	}
	
	/*
	 * TODO: comments
	 */
	public function downloadFile($id) {
		// TODO: set headers? http://php.net/manual/en/function.readfile.php
		
		readfile($file);
	}
	
	/*
	 * TODO: comments
	 */
	public function uploadTemporaryFile() {
		// TODO: implement
	}
	
	/*
	 * TODO: comments
	 */
	private function getFilePath($id, $name) {
		// TODO: comments
		
		$path = '';
		$path .= 'private/files/';
		$path .= $this->getRelativePath($id, $name);
		
		return $path;
	}
	
	/*
	 * TODO: Comments
	 */
	private function getRelativePath($id, $name) {
		// Converts the ID to hexadecimal
		$id = bin2hex($id);
		
		// Splits the ID in fragments of 4 characters each
		$fragments = str_split($id, 4);
		
		// Builds and returns the path
		return implode('/', $fragments) . '/' . $name;
	}
	
	/*
	 * TODO: comments
	 */
	private function getTemporaryFilePath($id, $name) {
		// TODO: comments
		
		$path = '';
		$path .= 'private/temporary-files/';
		$path .= $this->getRelativePath($id, $name);
		
		return $path;
	}
	
}
