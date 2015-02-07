<?php

namespace App\Auxiliar\EntityModel;

/*
 * This class offers operations to manage logs.
 */
class LogModel extends EntityModel {
	
	/*
	 * Creates a log.
	 * 
	 * It receives the log's data.
	 */
	public function create($id, $level, $message) {
		$app = $this->app;
		
		// Creates the log
		$app->webServerDatabase->createLog($id, $level, $message);
	}
	
}
