<?php

namespace App\Auxiliar\EntityModel;

/*
 * This class offers operations to manage pending studies.
 */
class PendingStudyModel extends EntityModel {
	
	/*
	 * Creates a pending study.
	 * 
	 * It receives the pending study's data.
	 */
	public function create($id, $creator) {
		$app = $this->app;
		
		// Creates the pending study
		$app->webServerDatabase->createPendingStudy($id, $creator);
	}
	
}
