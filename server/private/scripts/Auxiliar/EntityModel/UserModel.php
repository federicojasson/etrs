<?php

namespace App\Auxiliar\EntityModel;

/*
 * This class offers an interface to perform operations on users.
 */
class UserModel extends EntityModel {
	
	/*
	 * Creates an entity of the type of this model.
	 * 
	 * It receives the entity's data.
	 */
	public function create() {
		$app = $this->app;
		
		// Creates the user
		$function = [ $app->webServerDatabase, 'createUser' ];
		call_user_func_array($function, func_get_args());
	}
	
	/*
	 * Determines whether an entity exists.
	 * 
	 * It receives the entity's ID.
	 */
	public function exists($id) {
		$app = $this->app;
		
		// Determines whether the user exists
		return $app->webServerDatabase->userExists($id);
	}
	
	/*
	 * Returns an entity of the type of this model. If it doesn't exist, null is
	 * returned.
	 * 
	 * It receives the entity's ID.
	 */
	public function get($id) {
		$app = $this->app;
		
		// Gets the user
		return $app->webServerDatabase->getUser($id);
	}
	
}
