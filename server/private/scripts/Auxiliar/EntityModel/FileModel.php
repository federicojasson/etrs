<?php

namespace App\Auxiliar\EntityModel;

/*
 * This class offers an interface to perform operations on files.
 */
class FileModel extends EntityModel {
	
	/*
	 * Returns an entity of the type of this model. If it doesn't exist, null is
	 * returned.
	 * 
	 * It receives the entity's ID.
	 */
	public function get($id) {
		$app = $this->app;
		
		// Gets the file
		return $app->businessLogicDatabase->getNonDeletedFile($id);
	}
	
}
