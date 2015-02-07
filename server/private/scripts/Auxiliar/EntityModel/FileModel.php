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
