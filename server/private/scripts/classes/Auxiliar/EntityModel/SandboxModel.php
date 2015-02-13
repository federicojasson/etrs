<?php

namespace App\Auxiliar\EntityModel;

/*
 * This class offers operations to manage sandboxes.
 */
class SandboxModel extends EntityModel {
	
	/*
	 * Creates a sandbox.
	 * 
	 * It receives the sandbox's data.
	 */
	public function create($id, $creator) {
		$app = $this->app;
		
		// Creates the sandbox
		$app->webServerDatabase->createSandbox($id, $creator);
	}
	
}
