<?php

namespace App\Auxiliar\EntityModel;

/*
 * This class offers operations to manage files.
 */
class FileModel extends EntityModel {
	
	/*
	 * Deletes a file.
	 * 
	 * It receives the file's ID.
	 */
	public function delete($id) {
		$app = $this->app;
		
		// Deletes the file
		$app->businessLogicDatabase->deleteFile($id);
	}
	
	/*
	 * Determines whether a file exists.
	 * 
	 * It receives the file's ID.
	 */
	public function exists($id) {
		$app = $this->app;
		
		// Determines whether the file exists
		return $app->businessLogicDatabase->nonDeletedFileExists($id);
	}
	
	/*
	 * Filters a file for presentation and returns the result.
	 * 
	 * It receives the file.
	 */
	public function filter($file) {
		// TODO: implement
		return $file;
	}
	
	/*
	 * Returns a file. If it doesn't exist, null is returned.
	 * 
	 * It receives the file's ID.
	 */
	public function get($id) {
		$app = $this->app;
		
		// Gets the file
		return $app->businessLogicDatabase->getNonDeletedFile($id);
	}
	
}
