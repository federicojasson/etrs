<?php

namespace App\Auxiliar\EntityModel;

/*
 * This class offers operations to manage files.
 */
class FileModel extends EntityModel {
	
	/*
	 * Creates a file.
	 * 
	 * It receives the file's data.
	 */
	public function create($id, $creator, $name, $hash) {
		$app = $this->app;
		
		// Creates the file
		$app->businessLogicDatabase->createFile($id, $creator, $name, $hash);
	}
	
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
		$app = $this->app;
		
		// Gets the accessible fields
		$accessibleFields = $app->accessValidator->getAccessibleFields(ENTITY_MODEL_FILE);
		
		// Filters the file's fields
		$newFile = filterArray($file, $accessibleFields);
		
		// Applies conversions
		
		if (isset($newFile['id'])) {
			$newFile['id'] = bin2hex($file['id']);
		}
		
		if (isset($newFile['hash'])) {
			$newFile['hash'] = bin2hex($file['hash']);
		}
		
		return $newFile;
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
